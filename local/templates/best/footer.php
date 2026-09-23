<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

$asset = Asset::getInstance();

// JS из купленного шаблона
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/core.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/script.js');
?>

  <footer class="section footer-classic context-dark">
    <div class="container">
      <div class="footer-classic__main">

        <div class="row mb-4">
          <div class="col-12">
            <p class="rights">
              <a href="/accreditation/">
                ООО «БЭСТ» — аккредитованная при Союзе ФЭСЭ судебно-экспертная организация.
                Член СРО в области инженерных изысканий; сведения включены в Единый реестр НОПРИЗ.
              </a>
            </p>
          </div>
        </div>

        <div class="row row-50">
          <div class="col-lg-6">
            <div class="unit unit-spacing-sm flex-column flex-sm-row align-items-sm-center">
              <div class="unit-left">
                <a class="brand" href="/">
                  <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-inverse-105x38-v1.png"
                       alt="" width="105" height="38"
                       srcset="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-inverse-210x76-v1.png 2x">
                </a>
              </div>
              <div class="unit-body">
                <p class="rights">
                  <span>ООО «Бюро экспертных систем и технологий»</span>
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-6 text-lg-right">
            <p class="rights">
              <span>&copy; <?=date('Y')?>. Все права защищены.</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>

</div><!-- /.page -->


<?php $APPLICATION->ShowHeadStrings(); ?>
<?php $APPLICATION->ShowHeadScripts(); ?>

</body>
</html>
