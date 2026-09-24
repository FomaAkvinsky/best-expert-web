<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty('title','Аккредитации, СРО и профессиональный статус ООО «БЭСТ»');
$APPLICATION->SetPageProperty('description','Профессиональный статус ООО «БЭСТ»: аккредитация при Союзе ФЭСЭ, членство в СРО в области инженерных изысканий, сведения НОПРИЗ и используемые профессиональные программные комплексы.');
$APPLICATION->SetPageProperty('canonical','https://'.$_SERVER['HTTP_HOST'].'/accreditation/');
$APPLICATION->SetPageProperty('og_title','Аккредитации и профессиональный статус БЭСТ');
$APPLICATION->SetPageProperty('og_description','ФЭСЭ, СРО в области инженерных изысканий, НОПРИЗ и подтверждающие документы ООО «БЭСТ».');
?>

<section class="section parallax-container section-md bg-gray-700 section-overlay-3"
         data-parallax-img="/local/templates/best/assets/images/features-parallax-1.jpg">
    <div class="material-parallax parallax">
        <img src="/local/templates/best/assets/images/features-parallax-1.jpg" alt=""
             style="display:block; transform:translate3d(-50%, 200px, 0px);">
    </div>
    <div class="parallax-content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-10 col-lg-8">
                    <ul class="brumbs-custom">
                        <li><a href="/">Главная</a></li>
                        <li><a href="/about/">О компании</a></li>
                        <li class="active">Аккредитации и СРО</li>
                    </ul>

                    <h1 class="wow fadeInUpSmall">Аккредитации, СРО и профессиональный статус</h1>
                    <p class="lead wow fadeInUpSmall" data-wow-delay=".1s">
                        Здесь собраны документы и сведения, по которым можно проверить аккредитацию БЭСТ, членство в СРО и профессиональные сертификаты.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-gray-100 py-4">
    <div class="container">
        <div class="profile-light">
            <div class="profile-light__main">
                <div class="profile-light__inner" style="max-width:980px;">
                    <h4 class="profile-light__title">Все ключевые документы — в одном месте</h4>
                    <div class="profile-light__text">
                        <p>
                            Аккредитации, сведения из профессиональных реестров и сертификаты собраны здесь вместе с реквизитами и подтверждающими документами.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-lg bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <h6 class="wow fadeInUpSmall">судебная экспертиза</h6>
                <h2 class="wow fadeInUpSmall" data-wow-delay=".1s">Аккредитация при Союзе ФЭСЭ</h2>
            </div>
        </div>

        <?php
        $APPLICATION->IncludeComponent(
            'best:document.list',
            '',
            [
                'IBLOCK_CODE' => 'best_documents',
                'DOC_TYPES' => ['fese'],
                'CACHE_TYPE' => 'A',
                'CACHE_TIME' => 3600,
            ]
        );
        ?>
    </div>
</section>

<section class="section section-lg bg-gray-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <h6 class="wow fadeInUpSmall">инженерные изыскания</h6>
                <h2 class="wow fadeInUpSmall" data-wow-delay=".1s">Членство в СРО и сведения НОПРИЗ</h2>
            </div>
        </div>

        <?php
        $APPLICATION->IncludeComponent(
            'best:document.list',
            '',
            [
                'IBLOCK_CODE' => 'best_documents',
                'DOC_TYPES' => ['sro'],
                'CACHE_TYPE' => 'A',
                'CACHE_TIME' => 3600,
            ]
        );
        ?>
    </div>
</section>

<section class="section section-lg bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <h6 class="wow fadeInUpSmall">технологическая база</h6>
                <h2 class="wow fadeInUpSmall" data-wow-delay=".1s">Профессиональные программные комплексы</h2>
            </div>
        </div>

        <?php
        $APPLICATION->IncludeComponent(
            'best:document.list',
            '',
            [
                'IBLOCK_CODE' => 'best_documents',
                'DOC_TYPES' => ['audatex'],
                'CACHE_TYPE' => 'A',
                'CACHE_TIME' => 3600,
            ]
        );
        ?>
    </div>
</section>

<section class="section bg-gray-700 particles-js-outer">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row justify-content-center justify-content-xl-between align-items-center">
            <div class="col-lg-8">
                <div class="section-lg">
                    <h6 class="wow fadeInLeftSmall">профессиональный статус</h6>
                    <h2 class="wow fadeInLeftSmall" data-wow-delay=".1s">Нужны реквизиты или подтверждающие документы?</h2>
                    <p class="lead wow fadeInLeftSmall" data-wow-delay=".15s">
                        Свяжитесь с нами — предоставим актуальные сведения для суда, закупочной процедуры или проверки контрагента.
                    </p>
                </div>
            </div>
            <div class="col-lg-3 pb-4">
                <a class="button button-primary" href="#b24-form">Связаться с БЭСТ</a>
            </div>
        </div>
    </div>
</section>

<!-- CONTACTS / FORM ANCHOR -->
<section class="section section-lg" id="b24-form">
  <div class="container">
    <div class="row justify-content-center justify-content-lg-between row-2-columns-bordered row-50">
      <div class="col-md-10 col-lg-4">
        <h3>Свяжитесь с нами</h3>
        <ul class="list-creative">
          <li>
            <dl class="list-terms-medium">
              <dt>Телефон</dt>
              <dd>
                <ul class="list-xs">
                  <li><a href="tel:+79035220546">+7 903 522-0546</a></li>
                </ul>
              </dd>
            </dl>
          </li>
          <li>
            <dl class="list-terms-medium">
              <dt>E-mail</dt>
              <dd>
                <ul class="list-xs">
                  <li><a href="mailto:ask@best-expert.pro">ask@best-expert.pro</a></li>
                </ul>
              </dd>
            </dl>
          </li>
        </ul>
      </div>

      <div class="col-md-10 col-lg-7">
        <h3>Форма обратной связи</h3>
        <div class="application-form">
          <?include($_SERVER["DOCUMENT_ROOT"].'/include/main-form.php');?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
