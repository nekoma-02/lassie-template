<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}
?>


<footer class="footer">
	<div class="container footer__container">
		<div class="footer__col">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . "local/include/purchases_title.php"
				),
				false
			); ?>

			<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom", 
	array(
		"ROOT_MENU_TYPE" => "bottom_left",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "bottom"
	),
	false
); ?>

		</div>
		<div class="footer__col">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . "local/include/lassie_title.php"
				),
				false
			); ?>
			<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom", 
	array(
		"ROOT_MENU_TYPE" => "bottom",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "bottom"
	),
	false
); ?>
		</div>
		<div class="footer__col">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . "local/include/lassie_club_title.php"
				),
				false
			); ?>
			<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom", 
	array(
		"ROOT_MENU_TYPE" => "bottom_right",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "bottom"
	),
	false
); ?>
		</div>
		<div class="footer__col">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_DIR . "local/include/social_media.php"
				),
				false
			); ?>
			<ul class="footer__socials socials">
				<li class="socials__item"><a href="javascript:void(0);" class="socials__name socials__name_vk"><span class="icon-vkontakte"></span></a>
				</li>
				<li class="socials__item"><a href="javascript:void(0);" class="socials__name socials__name_ok"><span class="icon-odnoklassniki"></span></a>
				</li>
				<li class="socials__item"><a href="javascript:void(0);" class="socials__name socials__name_fb"><span class="icon-facebook"></span></a>
				</li>
				<li class="socials__item"><a href="javascript:void(0);" class="socials__name socials__name_tw"><span class="icon-twitter-bird"></span></a>
				</li>
			</ul>
			<p class="footer__text">Следи за новостями и акциями
				<br>в социальных сетях. Будь первым!
			</p>
		</div>
	</div>
	<div class="footer__bottom">
		<div class="container footer__container">
			<div class="footer__bottom-col">
				<p class="footer__text">Официальный интернет-магазин Lassie® в России</p>
			</div>
			<div class="footer__bottom-col">
				<div class="footer__text-group"><a href="tel:+78003331204" class="footer__text">8 (800) 333-12-04 </a><span class="footer__text">(горячая линия)</span>
				</div>
				<div class="footer__text-group"><a href="tel:+74952150435" class="footer__text">8 (495) 215-04-35 </a><span class="footer__text">(ежедневно с 9:00 до 24:00)</span>
				</div><a href="mailto:order@lassieshop.ru" class="footer__text footer__text_block">order@lassieshop.ru</a>
			</div>
		</div>
	</div>
</footer>
<script src="<?=SITE_TEMPLATE_PATH?>/scripts/app.min.js"></script>
</body>

</html>

