<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */

// echo '<pre>';
// print_r($actualItem);
// echo '</pre>';
// die();
if ($haveOffers)
{
	$showDisplayProps = !empty($item['DISPLAY_PROPERTIES']);
	$showProductProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $item['OFFERS_PROPS_DISPLAY'];
	$showPropsBlock = $showDisplayProps || $showProductProps;
	$showSkuBlock = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && !empty($item['OFFERS_PROP']);
}
else
{
	$showDisplayProps = !empty($item['DISPLAY_PROPERTIES']);
	$showProductProps = $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES']);
	$showPropsBlock = $showDisplayProps || $showProductProps;
	$showSkuBlock = false;
}
?>
<div class="good__content">
	<a class="good__link" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>">
		<img id="<?=$itemIds['PICT']?>" src="<? echo $item['PREVIEW_PICTURE']['SRC']?>" alt="Товар" class="good__img" title="">
		<? if ($item['LABEL'] &&!empty($item['LABEL_ARRAY_VALUE'])){
			foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value)
			{
				if ($code == 'SALELEADER') {
				?>
				<span class="flag flag_type_<? echo $code; ?>" title="<? echo $value; ?>"><? echo $value; ?></span>
				<?
				}
				
			}
		} ?>
	</a>

	<?php

	if ($showSubscribe)
	{
		// $APPLICATION->IncludeComponent("bitrix:rating.vote", "like",
		// 	Array(
		// 		"ENTITY_TYPE_ID" => "IBLOCK_ELEMENT",
		// 		"ENTITY_ID" => $item['ID']
		// 	),
		// 	$component,
		// 	array("HIDE_ICONS" => "Y")
		// );	
		?>
		<a href="javascript:void(0);" class="like">Мне нравится</a>
		<?
	}
	?>
	<h4 class="good__name"><?=$productTitle?></h4>

	<? if (!empty($price)){
		?><div  data-entity="price-block"><?
		if ('Y' == $arParams['SHOW_OLD_PRICE'] && $price['RATIO_PRICE'] < $price['RATIO_BASE_PRICE']){
			?><span class="good__price good__price_new" id="<?=$itemIds['PRICE']?>"><?= $price['PRINT_RATIO_PRICE']?></span><?
			?><span class="good__price good__price_old" id="<?=$itemIds['PRICE_OLD']?>"><?=$price['PRINT_RATIO_BASE_PRICE']?></span><?
		}else{
			?><span class="good__price" id="<?=$itemIds['PRICE']?>"><?= $price['PRINT_RATIO_PRICE']?></span><?
		}
		if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y'){
			?><span id="<?=$itemIds['DSC_PERC']?>"
				class="good__discount"
				<?=($price['PERCENT'] > 0 ? '' : 'style="display: none;"')?>
			><?=GetMessage('SB_MESS_DIFF_PERCENT', [ '#DIFF#' => $price['PERCENT']])?></span><?
		}
		?></div><?
	}?>
</div>

<div class="good__hover">
	<?
	if ($haveOffers && $showSkuBlock){
		?><div id="<?=$itemIds['PROP_DIV']?>">
		<?
		foreach ($arParams['SKU_PROPS'] as $skuProperty)
		{
			if ($skuProperty['CODE'] == 'COLOR_REF') {
				continue;
			}

			$propertyId = $skuProperty['ID'];
			$skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);
			if (!isset($item['SKU_TREE_VALUES'][$propertyId]))
				continue;
			?>
			<div class="good__order-row" data-entity="sku-line-block">
				<label class="good__order-label"><? 
					echo GetMessage(
						'SB_MESS_TITLE_SKU',
						[ '#SKU#' => mb_strtolower($skuProperty['NAME']) ]
					);
				?></label>
				<? 



				foreach ($skuProperty['VALUES'] as $value) : 
					if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']]))
						continue;

					$value['NAME'] = htmlspecialcharsbx($value['NAME']);
					?> 
					<div class="checkbox-tile" >
						<input 
							id="<?=$propertyId?>_<?=$value['ID']?>"
							name="<?=$propertyId?>"
							type="radio" 
							data-treevalue="<?=$propertyId?>_<?=$value['ID']?>" data-onevalue="<?=$value['ID']?>"
							required=""
							class="checkbox-tile__elem"
						>
						<label 
							for="<?=$propertyId?>_<?=$value['ID']?>" 
							class="checkbox-tile__label"
						><?=$value['NAME']?></label>
					</div>
				<? endforeach ?> 
				<div style="clear: both;"></div>
			</div>
			<?
		}
		?>
		</div>


		<?
		foreach ($arParams['SKU_PROPS'] as $skuProperty)
		{
			if (!isset($item['OFFERS_PROP'][$skuProperty['CODE']]))
				continue;
			$skuProps[] = array(
				'ID' => $skuProperty['ID'],
				'SHOW_MODE' => $skuProperty['SHOW_MODE'],
				'VALUES' => $skuProperty['VALUES'],
				'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
			);
		}

		unset($skuProperty, $value);

		if ($item['OFFERS_PROPS_DISPLAY'])
		{
			foreach ($item['JS_OFFERS'] as $keyOffer => $jsOffer)
			{
				$strProps = '';

				if (!empty($jsOffer['DISPLAY_PROPERTIES']))
				{
					foreach ($jsOffer['DISPLAY_PROPERTIES'] as $displayProperty)
					{
						$strProps .= '<dt>'.$displayProperty['NAME'].'</dt><dd>'
							.(is_array($displayProperty['VALUE'])
								? implode(' / ', $displayProperty['VALUE'])
								: $displayProperty['VALUE'])
							.'</dd>';
					}
				}
				$item['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
			}
			unset($jsOffer, $strProps);
		}
	}
	
	foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName)
	{
		switch ($blockName)
		{

			case 'quantityLimit':
				if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
				{
					if ($haveOffers)
					{
						if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
						{
							?>
							<div class="product-item-info-container product-item-hidden"
								id="<?=$itemIds['QUANTITY_LIMIT']?>"
								style="display: none;"
								data-entity="quantity-limit-block">
								<div class="product-item-info-container-title">
									<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
									<span class="product-item-quantity" data-entity="quantity-limit-value"></span>
								</div>
							</div>
							<?
						}
					}
					else
					{
						if (
							$measureRatio
							&& (float)$actualItem['CATALOG_QUANTITY'] > 0
							&& $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
							&& $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
						)
						{
							?>
							<div class="product-item-info-container product-item-hidden" id="<?=$itemIds['QUANTITY_LIMIT']?>">
								<div class="product-item-info-container-title">
									<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
									<span class="product-item-quantity" data-entity="quantity-limit-value">
										<?
										if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
										{
											if ((float)$actualItem['CATALOG_QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
											{
												echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
											}
											else
											{
												echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
											}
										}
										else
										{
											echo $actualItem['CATALOG_QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
										}
										?>
									</span>
								</div>
							</div>
							<?
						}
					}
				}

				break;
			case 'quantity':
		
				$divQuiantity = '<div class="good__order-row" data-entity="quantity-block">
					<label class="good__order-label">'.GetMessage('SB_MESS_TITLE_COUNT').'</label>
					<div class="input-number">
						<input type="number" step="1" min="1" class="input-number__elem" id="'.$itemIds['QUANTITY'].'" name="'.$arParams['PRODUCT_QUANTITY_VARIABLE'].'" value="'.$measureRatio.'">
						<div class="input-number__counter">
							<span id="'.$itemIds['QUANTITY_UP'].'" class="input-number__counter-spin input-number__counter-spin_more">'.GetMessage('SB_MESS_COUNT_MORE').'</span>
							<span id="'.$itemIds['QUANTITY_DOWN'].'" class="input-number__counter-spin input-number__counter-spin_less">'.GetMessage('SB_MESS_COUNT_LESS').'</span>
						</div>
					</div>
				</div>';
				if (!$haveOffers)
				{
					if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY'])
					{
						echo $divQuiantity;
					}
				}
				elseif ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
				{
					if ($arParams['USE_PRODUCT_QUANTITY'])
					{
						echo $divQuiantity;
					}
				}

				break;

			case 'buttons':
					if (!$haveOffers)
					{
						if ($actualItem['CAN_BUY'])
						{
							echo 'hello';
							?>
							<div class="product-item-button-container" id="<?=$itemIds['BASKET_ACTIONS']?>">
										<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
											href="javascript:void(0)" rel="nofollow">
											<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
										</a>
									</div>
							<?
						}
						else
						{
							
							if ($showSubscribe)
							{
								$APPLICATION->IncludeComponent(
									'bitrix:catalog.product.subscribe',
									'',
									array(
										'PRODUCT_ID' => $actualItem['ID'],
										'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
										'BUTTON_CLASS' => 'btn btn-primary '.$buttonSizeClass,
										'DEFAULT_DISPLAY' => true,
										'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
									),
									$component,
									array('HIDE_ICONS' => 'Y')
								);
							}
							?>
							<a class="btn btn-link <?=$buttonSizeClass?>" id="<?=$itemIds['NOT_AVAILABLE_MESS']?>"
											href="javascript:void(0)" rel="nofollow">
											<?=$arParams['MESS_NOT_AVAILABLE']?>
										</a>
							<?
						}
					}
					else
					{
						if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
						{ 
							//echo 'hello';

								if ($showSubscribe)
								{
									$APPLICATION->IncludeComponent(
										'bitrix:catalog.product.subscribe',
										'',
										array(
											'PRODUCT_ID' => $item['ID'],
											'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
											'BUTTON_CLASS' => 'btn btn-primary '.$buttonSizeClass,
											'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
											'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
										),
										$component,
										array('HIDE_ICONS' => 'Y')
									);
								}
								?>
								<a class="btn btn-link <?=$buttonSizeClass?>"
											id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow"
											<?=($actualItem['CAN_BUY'] ? 'style="display: none;"' : '')?>>
											<?=$arParams['MESS_NOT_AVAILABLE']?>
										</a>
										<div id="<?=$itemIds['BASKET_ACTIONS']?>" <?=($actualItem['CAN_BUY'] ? '' : 'style="display: none;"')?>>
											<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
												href="javascript:void(0)" rel="nofollow">
												<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
											</a>
										</div>
							<?
						}
						else
						{
							?>
							<button class="btn" href="<?=$item['DETAIL_PAGE_URL']?>">
								<?=$arParams['MESS_BTN_DETAIL']?>
							</button>
							<?
						}
					}
				break;

		}
		 
	}
	
	?>
</div>
