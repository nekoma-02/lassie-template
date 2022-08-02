<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');

?>
<div class="header__col header__col_basket"><span class="header__icon icon-bag"></span>
	<div class="header__basket">

		<?
		if (!$compositeStub) {
			if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y')) {

				if ($arParams['SHOW_TOTAL_PRICE'] == 'Y') {
		?>
					<div class="text">В вашей корзине</div><a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="link"><? echo $arResult['NUM_PRODUCTS'] ?> товара на <? echo $arResult['TOTAL_PRICE'] ?></a>
		<?
				}
			}
		}
		?>

	</div>