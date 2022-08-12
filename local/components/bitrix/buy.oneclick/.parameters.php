<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"ID_PRODUCT" => array(
			"NAME" => GetMessage("ID_PRODUCT"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
			"DEFAULT" => "1"
		),
		"URL_FROM" => array(
			"NAME" => GetMessage("URL_FROM"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
			"DEFAULT" => "1"
		),
		"CACHE_TIME" => array(
			"DEFAULT"=> 36000000,
		),
	),
);