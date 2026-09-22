<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var CMain $APPLICATION */

use Bitrix\Main\Page\Asset;

$asset = Asset::getInstance();

// CSS из купленного шаблона
$asset->addCss(SITE_TEMPLATE_PATH . '/assets/css/fonts.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/assets/css/bootstrap.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/assets/css/style.css');
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title><?php $APPLICATION->ShowTitle(); ?></title>
	
	<?
    $APPLICATION->ShowMeta("robots", false, false);
    $APPLICATION->ShowMeta("description", false, false);
	?>

	<link rel="icon" type="image/svg+xml" href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicon.svg">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicon-v1.png">
	<link rel="mask-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicon.svg" color="#1d1d1b">
    
	<!-- Google Fonts (как в шаблоне) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Exo+2:100,300,500,700,100italic,300italic%7CMontserrat:400,700">
	
	<?
	$APPLICATION->ShowLink("canonical", null, false);
	
	$APPLICATION->ShowCSS(true, false);

	$APPLICATION->SetPageProperty('og_image','https://'.$_SERVER['HTTP_HOST'].SITE_TEMPLATE_PATH.'/assets/images/favicon-v1.png');
	?>
	

	<meta property="og:title" content="<?$APPLICATION->ShowProperty('og_title');?>" />
	<meta property="og:description" content="<?$APPLICATION->ShowProperty('og_description');?>" />
	<meta property="og:image" content="<?$APPLICATION->ShowProperty('og_image');?>" />
	<link rel="image_src" href="<?$APPLICATION->ShowProperty('og_image');?>"  />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?$APPLICATION->ShowProperty("canonical");?>" />
	
</head>

<body>
<?php 
if(!empty($_REQUEST['panel']) && $_REQUEST['panel'] == 'y') {
	$APPLICATION->ShowPanel(); 
}
?>

<div class="preloader">
  <div class="preloader-body">
    <div class="preloader-item">
      <div class="diamond"></div>
      <div class="diamond"></div>
      <div class="diamond"></div>
    </div>
  </div>
</div>

<div class="page">

  <header class="section page-header" id="home">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
      <nav class="rd-navbar rd-navbar-classic"
           data-layout="rd-navbar-fixed"
           data-sm-layout="rd-navbar-fixed"
           data-md-layout="rd-navbar-fixed"
           data-lg-layout="rd-navbar-static"
           data-xl-layout="rd-navbar-static"
           data-xxl-layout="rd-navbar-static"
           data-sm-device-layout="rd-navbar-fixed"
           data-md-device-layout="rd-navbar-fixed"
           data-lg-device-layout="rd-navbar-static"
           data-xl-device-layout="rd-navbar-static"
           data-xxl-device-layout="rd-navbar-static"
           data-lg-stick-up="true"
           data-xl-stick-up="true"
           data-xxl-stick-up="true"
           data-lg-stick-up-offset="46px"
           data-xl-stick-up-offset="46px"
           data-xxl-stick-up-offset="46px">

        <div class="rd-navbar-main-outer">
          <div class="rd-navbar-main">
            <!-- RD Navbar Panel-->
            <div class="rd-navbar-panel">
              <!-- RD Navbar Toggle-->
              <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-outer"><span></span></button>
              <!-- RD Navbar Brand-->
              <div class="rd-navbar-brand">
                <a class="brand" href="/">
                  <img class="brand-logo-dark"
                       src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-best-105x38-v1.png"
                       alt=""
                       width="105" height="38"
                       srcset="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-best-210x76-v1.png 2x"/>
                  <img class="brand-logo-light"
                       src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-inverse-105x38-v1.png"
                       alt=""
                       width="105" height="38"
                       srcset="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-inverse-210x76-v1.png 2x"/>
                </a>
              </div>
            </div>

            <div class="rd-navbar-nav-outer">
                <!-- Меню (пока статикой, на следующем шаге заменим на bitrix:menu, не ломая разметку) -->
                <ul class="rd-navbar-nav">
                  <li class="rd-nav-item"><a class="rd-nav-link" href="/">Главная</a></li>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="/about/">О компании</a></li>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="/services/">Услуги</a></li>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="/contacts/">Контакты</a></li>
                </ul>
            </div>

            <!-- Правая часть шапки (кнопка/контакты) — оставим место, позже подключим include -->
            <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
            <div class="rd-navbar-collapse">
              <div class="rd-navbar-info">
                <a class="button button-sm button-primary" href="#b24-form">Получить консультацию</a>
              </div>
            </div>

          </div>
        </div>

      </nav>
    </div>
  </header>
