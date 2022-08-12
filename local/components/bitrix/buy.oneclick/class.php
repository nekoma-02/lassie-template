<?php

namespace Component\Buy\Controller;

use Bitrix\Main\Context;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Helpers\Admin\Blocks\OrderBuyer;
use Bitrix\Sale\Order;
use Bitrix\Sale\PaySystem\Manager;
use CBitrixComponent;



\Bitrix\Main\Loader::includeModule("sale");
\Bitrix\Main\Loader::includeModule("catalog");

class BuyOneClick extends CBitrixComponent implements Controllerable
{

    public function onPrepareComponentParams($arParams)
    {

        return $arParams;
    }

    // Обязательный метод
    public function configureActions()
    {

        return [
            'buyFromDetailPage' => [ // Ajax-метод
                'prefilters' => [],
            ],
            'buyFromBasketOneClick' => [ // Ajax-метод
                'prefilters' => [],
            ],
        ];
    }

    private static function buyOneClick($phone, $productId = null) {
        if (empty($phone)) {
            return ['errors' => array('message' => GetMessage("MESSAGE_EMPTY_PHONE"))];
        }

        global $USER;
        if ($USER->IsAuthorized()) {
            $userId = $USER->GetID();
        } else {
            $userId = Fuser::getId();
        }

        $deliveryId = 2;
        $paymentId = 3;

        if (empty($productId) || $productId == null) {
            $basket = Basket::loadItemsForFUser($userId, Context::getCurrent()->getSite());
        } else {
            $basket = Basket::create(SITE_ID);
        
            $arFields = array(
                'QUANTITY' => 1,
                "PRODUCT_PROVIDER_CLASS" => "\Bitrix\Catalog\Product\CatalogProvider"
            );
    
            $product = $basket->createItem("catalog", $productId);
            $product->setFields($arFields);
        }
        

        $order = Order::create(SITE_ID, $userId);
        $order->setPersonTypeId(OrderBuyer::getDefaultPersonType($order->getSiteId()));
        $order->setBasket($basket);
        
        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem(
            \Bitrix\Sale\Delivery\Services\Manager::getObjectById($deliveryId)
        );

        $shipmentItemCollection = $shipment->getShipmentItemCollection();
        
        foreach ($basket as $basketItem) {
            $product = $shipmentItemCollection->createItem($basketItem);
            $product->setQuantity($basketItem->getQuantity());
        }

        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem(Manager::getObjectById($paymentId));
        
        $payment->setField("SUM", $order->getPrice());
        $payment->setField("CURRENCY", $order->getCurrency());

        $propertyCollection = $order->getPropertyCollection();
        foreach ($propertyCollection as $property) {
            if ($property->getField('CODE') == 'BUYONECLICK') $property->setValue("Y");
            if ($property->getField('CODE') == 'PHONE') $property->setValue($phone);
        }

        $result = $order->save();

        if (!$result->isSuccess()) {
            return ['errors' => array('message' => GetMessage("MESSAGE_ORDER_WRONG"))];
        }

        return [
            'success' => array('message' => GetMessage("MESSAGE_ORDER_SUCCESS")),
        ];
    }



    // Ajax-методы должны быть с постфиксом Action
    public function buyFromDetailPageAction($phone, $productId)
    {
       return self::buyOneClick($phone, $productId);
    }

    public function buyFromBasketOneClickAction($phone)
    {
       return self::buyOneClick($phone);
    }

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }
}
