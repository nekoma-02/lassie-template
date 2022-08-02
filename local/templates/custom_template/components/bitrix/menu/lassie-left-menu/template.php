<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>


	<ul class="header__menu menu menu_width_full">
		<?
		$previousLvl = 0;
		$countEl = 0;
		foreach ($arResult as $arItem) :

			if ($previousLvl == 2 && $arItem["DEPTH_LEVEL"] < 3) {
				$previousLvl = 1;
		?></ul>
	</li><?
			}
			if ($previousLvl == 1 && $arItem["DEPTH_LEVEL"] == 1) {
				$previousLvl = 0;
				$countEl = 0;
			?></ul>
	</div>
	</li>
	</ul>
	</li><?
			}
			if ($arItem["DEPTH_LEVEL"] == 2 && $countEl > 8) {
				$countEl = 0;
			?></ul>
	</div>
	<div class="dropdown-menu__menu-col">
		<ul class="vertical-menu"><?
								}
								switch ($arItem["DEPTH_LEVEL"]):
									case 1: ?>
				<li class="menu__item"><a href="<?= $arItem["LINK"] ?>" class="menu__name"><?= $arItem["TEXT"] ?></a>
					<?
										if ($arItem["IS_PARENT"]) : ?>
						<ul class="dropdown-menu">
							<li class="dropdown-menu__content">
								<div class="dropdown-menu__img">
									<img src="<?= SITE_TEMPLATE_PATH ?>/images/header-submenu-1.jpg" alt="девочка">
								</div>
								<div class="dropdown-menu__menu-col">
									<ul class="vertical-menu">
									<? $previousLvl = 1;
										else :
									?>
							</li><?
										endif;
										break;
									case 2:
										if ($arItem["IS_PARENT"]) : ?>
							<li class="vertical-menu__item"><span class="vertical-menu__name"><?= $arItem["TEXT"] ?></span>
								<ul class="vertical-menu__submenu">
								<? $previousLvl = 2;
										else :
								?>
									<li class="vertical-menu__item">
										<a href="<?= $arItem["LINK"] ?>" class="vertical-menu__name"><?= $arItem["TEXT"] ?></a>
									</li>
								<? endif;

										$countEl++;
										break;
									default:
										$countEl++; ?>
								<li class="vertical-menu__submenu-item">
									<a href="<?= $arItem["LINK"] ?>" class="link vertical-menu__submenu-name"><?= $arItem["TEXT"] ?></a>
								</li>
					<? break;
								endswitch;
							endforeach ?>
					<? switch ($previousLvl):
						case 2: ?>
								</ul>
							</li><?
								case 1: ?>
						</ul>
	</div>
	</li>
	</ul>
	</li><?
							endswitch ?>
</ul>
<button class="burger-btn header__nav-btn js-nav-btn"><span class="burger-btn__switch"><?= GetMessage("MENU_MORE") ?></span></button>
<div class="navigation__collapse">
	<ul class="navigation__collapse-menu vertical-menu"><?
														$arResult = array_reverse($arResult);
														foreach ($arResult as $arItem) :
															if ($arItem["DEPTH_LEVEL"] == 1) : ?>
				<li class="navigation__collapse-item vertical-menu__item">
					<a href="<?= $arItem["LINK"] ?>" class="vertical-menu__name"><?= $arItem["TEXT"] ?></a>
				</li><?
															endif;
														endforeach ?>
	</ul>
</div>
<? endif ?>