<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
CJSCore::Init(array("jquery"));
?>
<div>
    <h1>Заказ в 1 клик</h1>
    <button id="show-form" class="btn" >Заказать в 1 клик</button>
    <div class="alert">
        <label id="message"></label>
    </div>
    <div id="buy-one-click" class="hidden">
        <input type="hidden" name="product_id" id="product_id" value="<?=$arParams["ID_PRODUCT"];?>">
        <input type="text" name="phone" id="user_phone" placeholder="Введите телефон" />
        <button id="btn-buy-click">Заказать</button>
    </div>
    
</div>
<?
$jsParams2 = array(
    "ID_PRODUCT" => $arParams["ID_PRODUCT"],
    "URL" => $arParams["URL_FROM"]
);
?>
<script>
	var arParams = <?=CUtil::PhpToJSObject($jsParams2, false, true);?>
</script>