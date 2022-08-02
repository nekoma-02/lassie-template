<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

// echo '<pre>';
// print_r($arResult["ITEMS"]);
// echo '</pre>';


?>
<div class="reviews">

<div class="reviews__other"><?
if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	if($arItem["FIELDS"]["TIMESTAMP_X"]){
		$dateTimeItem 
			=ConvertDateTime($arItem["FIELDS"]["TIMESTAMP_X"], 'DD.MM.YYYY')
			.GetMessage('MESS_ARTICLE_DATE_TIME')
			.ConvertDateTime($arItem["FIELDS"]["TIMESTAMP_X"], 'HH:MI');
		$argDateTimeItem 
			=ConvertDateTime($arItem["FIELDS"]["TIMESTAMP_X"], 'YYYY-MM-DD')
			.'T'
			.ConvertDateTime($arItem["FIELDS"]["TIMESTAMP_X"], 'HH:MI');
	}else{
		$dateTimeItem = $argDateTimeItem = '';
	}

	?>
	<article class="review reviews__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="raiting review__raiting">
		<?foreach([5,4,3,2,1] as $star):?>
			<span class="raiting__star<?=$arItem["DISPLAY_PROPERTIES"]['RATING']['VALUE'] == $star?' raiting__star_active':''?>"><?=$star?></span>
		<?endforeach;?>
		</div>
		<div class="review__message">
			<p class="text"><?=$arItem["DISPLAY_PROPERTIES"]["COMMENT"]["VALUE"]?:''?></p>
		</div>
		<footer class="review__footer">
			<p><?=$arItem["DISPLAY_PROPERTIES"]["NAME"]['VALUE']?GetMessage('MESS_WHO_ADD', ['#NAME#' => $arItem["DISPLAY_PROPERTIES"]["USER_NAME"]['VALUE']]):''?>
				<time datetime="<?=$argDateTimeItem?>"><?=$dateTimeItem?></time>
			</p>
		</footer>
	</article>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<?=$arResult["NAV_STRING"]?>
<?endif;
?></div>
<div class="reviews__own">
<?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "lassie", Array(
	"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"IBLOCK_TYPE" => "reviews",	// Тип инфоблока
		"IBLOCK_ID" => "5",	// Инфоблок
		"PROPERTY_CODES" => array(	// Свойства, выводимые на редактирование
			
			"33",
			"31",
			"32",
			'NAME',
			"29"
			
			
			
		),
		"PROPERTY_CODES_REQUIRED" => array(	// Свойства, обязательные для заполнения
			
		),
		"GROUPS" => array(	// Группы пользователей, имеющие право на добавление/редактирование
			0 => "1",
			1 => "2",
		),
		"STATUS_NEW" => "N",	// Деактивировать элемент
		"STATUS" => "ANY",	// Редактирование возможно
		"LIST_URL" => "",	// Страница со списком своих элементов
		"ELEMENT_ASSOC" => "CREATED_BY",	// Привязка к пользователю
		"ELEMENT_ASSOC_PROPERTY" => "",
		"MAX_USER_ENTRIES" => "100000",	// Ограничить кол-во элементов для одного пользователя
		"MAX_LEVELS" => "100000",	// Ограничить кол-во рубрик, в которые можно добавлять элемент
		"LEVEL_LAST" => "Y",	// Разрешить добавление только на последний уровень рубрикатора
		"USE_CAPTCHA" => "Y",	// Использовать CAPTCHA
		"USER_MESSAGE_EDIT" => "",	// Сообщение об успешном сохранении
		"USER_MESSAGE_ADD" => "",	// Сообщение об успешном добавлении
		"DEFAULT_INPUT_SIZE" => "30",	// Размер полей ввода
		"RESIZE_IMAGES" => "N",	// Использовать настройки инфоблока для обработки изображений
		"MAX_FILE_SIZE" => "0",	// Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",	// Использовать визуальный редактор для редактирования текста анонса
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",	// Использовать визуальный редактор для редактирования подробного текста
		"CUSTOM_TITLE_NAME" => "",	// * наименование *
		"CUSTOM_TITLE_TAGS" => "",	// * теги *
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",	// * дата начала *
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",	// * дата завершения *
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",	// * раздел инфоблока *
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",	// * текст анонса *
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",	// * картинка анонса *
		"CUSTOM_TITLE_DETAIL_TEXT" => "",	// * подробный текст *
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",	// * подробная картинка *
		"SEF_FOLDER" => "/",	// Каталог ЧПУ (относительно корня сайта)
		"COMPONENT_TEMPLATE" => "lassie",
		'ID_ELEMENT' => $arParams['ID_ELEMENT']
	),
	$component,
	array('HIDE_ICONS' => 'Y')
);?>
</div>

<script>
		BX('count-reviews').innerHTML = '<?=$arResult["NAV_RESULT"]->NavRecordCount?>';
</script>
</div>