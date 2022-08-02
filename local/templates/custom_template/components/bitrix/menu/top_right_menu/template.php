<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
// echo '<pre>';
// print_r($arResult);
// echo '</pre>';

?>

<? if (!empty($arResult)) : ?>
	<ul class="header__top-menu menu">

		<?
		foreach ($arResult as $arItem) :
			if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
		?>

			<li class="menu__item"><a class="link menu__name" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>

		<? endforeach ?>

	</ul>
<? endif ?>