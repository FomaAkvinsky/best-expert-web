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

        <div class="footer-status">
          <div class="row align-items-center row-30">
            <div class="col-lg-4">
              <a class="footer-status__title" href="/accreditation/">
                Аккредитации и членство в СРО
              </a>
            </div>

            <div class="col-lg-8">
              <div class="footer-status__brands">
                <a class="footer-status__brand footer-status__brand--fese"
                   href="/accreditation/"
                   aria-label="Союз финансово-экономических судебных экспертов">
                  <span class="footer-status__brand-kicker">СОЮЗ</span>
                  <span class="footer-status__brand-main">ФЭСЭ</span>
                </a>

                <a class="footer-status__brand footer-status__brand--nopriz"
                   href="/accreditation/"
                   aria-label="НОПРИЗ">
                  <span class="footer-status__brand-main">НОПРИЗ</span>
                </a>

                <a class="footer-status__brand footer-status__brand--audatex"
                   href="/accreditation/"
                   aria-label="Audatex">
                  <span class="footer-status__brand-main">Audatex</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="footer-company">
          <div class="row row-30 align-items-center">
            <div class="col-lg-7">
              <div class="unit unit-spacing-sm flex-column flex-sm-row align-items-sm-center">
                <div class="unit-left">
                  <a class="brand" href="/">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-inverse-105x38-v1.png"
                         alt="БЭСТ" width="105" height="38"
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

            <div class="col-lg-5 text-lg-right">
              <p class="rights">
                <span>&copy; <?=date('Y')?>. Все права защищены.</span>
              </p>
            </div>
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
