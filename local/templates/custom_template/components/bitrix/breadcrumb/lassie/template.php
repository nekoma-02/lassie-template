<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';


$strReturn .= '<ul class="breadcrumbs">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
			$strReturn .= '
			<li class="breadcrumbs__item">
				'.$arrow.'
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" class="breadcrumbs__name">
					'.$title.'
				</a>
				<meta itemprop="position" content="'.($index + 1).'" />
			</li>';
	}
	else
	{
		$strReturn .= '
		<li class="breadcrumbs__item">
		<a title="'.$title.'" class="breadcrumbs__name">
		'.$title.'
		</a>
			</li>';
	}
}

$strReturn .= '</ul>';

return $strReturn;
