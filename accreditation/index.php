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

                    <h1 class="wow fadeInUpSmall">Аккредитации, СРО и профессиональный статус ООО «БЭСТ»</h1>
                    <p class="lead wow fadeInUpSmall" data-wow-delay=".1s">
                        Статус судебно-экспертной организации и профессиональные основания для выполнения отдельных видов исследований и инженерных изысканий.
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
                    <h4 class="profile-light__title">Профессиональный статус подтверждается документами и реестрами</h4>
                    <div class="profile-light__text">
                        <p>
                            Для судебной экспертизы и инженерных изысканий используются разные профессиональные основания.
                            Мы указываем их отдельно, чтобы не смешивать статус негосударственной судебно-экспертной организации
                            и членство в СРО.
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
                <p class="wow fadeInUpSmall" data-wow-delay=".2s">
                    ООО «БЮРО ЭКСПЕРТНЫХ СИСТЕМ И ТЕХНОЛОГИЙ» аккредитовано при Союзе финансово-экономических судебных экспертов
                    в качестве негосударственной судебно-экспертной организации.
                </p>
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
                <p class="wow fadeInUpSmall" data-wow-delay=".2s">
                    ООО «БЭСТ» является членом Ассоциации «Национальное объединение изыскателей „Альянс Развитие“».
                    Сведения об организации включены в Единый реестр НОПРИЗ.
                </p>
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
                <p class="wow fadeInUpSmall" data-wow-delay=".2s">
                    Отдельные сертификаты подтверждают право использования профессионального программного обеспечения и баз данных,
                    применяемых в экспертной работе.
                </p>
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
                <a class="button button-primary" href="/contacts/">Связаться с БЭСТ</a>
            </div>
        </div>
    </div>
</section>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
