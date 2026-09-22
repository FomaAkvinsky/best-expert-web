<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
$APPLICATION->SetPageProperty("title", "404 Not Found");
$APPLICATION->SetPageProperty("h1", "Страница не найдена");
?>

<section class="my-5 py-5">
	<div class="container text-center" style="min-height:45vh">
	  <div class="row justify-content-center">
		<div class="col-lg-10 col-xl-8">
		  <p class="h1 text-dark text-center">404 Not Found</p>
		  <p class="text-center">Извините, страница не найдена.<p>
		  <p class="text-center">
			Для поиска необходимой информации воспользуйтесь меню, представленным в шапке сайта.
		  </p>
		</div>
	  </div>
	</div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>