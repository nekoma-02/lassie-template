<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


$arSort = array(
	'price' => 'CATALOG_PRICE_1',
	'new' => 'DATE_CREATE',
	'availibel' => 'CATALOG_AVAILABLE'
);

if(isset($_COOKIE['sort']) && isset($arSort[$_COOKIE["sort"]])){
	$arParams['ELEMENT_SORT_FIELD'] = $arSort[$_COOKIE['sort']];
}
if (isset($_GET["sort"]) && isset($_GET["method"]) && isset($arSort[$_GET["sort"]])){
	$arParams['ELEMENT_SORT_FIELD'] = $arSort[$_GET["sort"]];
	setcookie('sort', $_GET["sort"], 0, SITE_DIR);
	$arParams["ELEMENT_SORT_ORDER"] = $_GET["method"];
}


$arResult['AR_SORT'] = $arSort;
