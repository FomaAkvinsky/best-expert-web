<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty('title','О компании БЭСТ | судебная экспертиза и экспертные исследования');
$APPLICATION->SetPageProperty('description','БЭСТ — судебно-экспертная организация. Проводим экспертизы и экспертные исследования для судов, 
юристов и корпоративных клиентов. Методика, контроль качества, ответственность за выводы.');

$APPLICATION->SetPageProperty('canonical','https://'.$_SERVER['HTTP_HOST'].'/about/');

$APPLICATION->SetPageProperty('og_title','О компании БЭСТ — судебно-экспертная организация');
$APPLICATION->SetPageProperty('og_description','БЭСТ — экспертная организация, специализирующаяся на судебных экспертизах и экспертно-правовом сопровождении сложных споров. Методика, процесс, ответственность.');

?>


<section class="section parallax-container section-md bg-gray-700 section-overlay-3" 
		data-parallax-img="/local/templates/best/assets/images/features-parallax-1.jpg">
  <div class="material-parallax parallax">
	<img src="/local/templates/best/assets/images/features-parallax-1.jpg" alt="" style="display: block; transform: translate3d(-50%, 200px, 0px);">
  </div>
  <div class="parallax-content">
    <div class="container">
		<div class="row align-items-center">
		  <div class="col-md-10 col-lg-8">

			<ul class="brumbs-custom">
			  <li><a href="/">Главная</a></li>
			  <li class="active">О компании</li>
			</ul>

			<h1 class="wow fadeInUpSmall">О компании БЭСТ</h1>
			<p class="lead wow fadeInUpSmall" data-wow-delay=".1s">
			  Судебно-экспертная организация. Единая методология, контроль качества и центр ответственности за выводы.
			</p>
			
		  </div>
		  <div class="col-lg-4 text-center">

			<div class="wow fadeInUpSmall" data-wow-delay=".2s">
			  <a class="button button-primary" href="#b24-form">Оставить запрос</a>
			</div>

		  </div>
		</div>
	</div>
  </div>
</section>

<!-- WHO WE ARE (profile-light) -->
<section class="bg-gray-100 py-4">
  <div class="container">
    <div class="profile-light">
      <div class="profile-light__main">
        <div class="profile-light__inner" style="max-width: 900px;">
          <h4 class="profile-light__title">Экспертная организация, а не набор отдельных специалистов</h4>
          <div class="profile-light__text">
            <p>
              БЭСТ создана как судебно-экспертная организация с единой методологией, внутренним контролем качества
              и распределенной ответственностью между экспертами и руководителями направлений.
            </p>
            <p>
              Мы объединяем специалистов разных профилей в рамках одной системы работы и одного центра ответственности
              за итоговый экспертный результат.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ROLE IN PROCESS -->
<section class="section section-sm bg-white">
  <div class="container">
    <div class="row row-50 justify-content-center align-items-center">
      <div class="col-md-10 col-lg-6">
        <h3>Роль БЭСТ в судебном процессе</h3>
        <div class="divider-modern"></div>
        <p>
          БЭСТ не занимает сторону спора и не подменяет собой суд. Наша задача — обеспечить корректное,
          методически обоснованное и проверяемое экспертное исследование.
        </p>
        <p>
          Мы рассматриваем экспертизу как часть судебного механизма: результаты должны быть понятны,
          воспроизводимы и пригодны для процессуальной оценки.
        </p>
      </div>

      <div class="col-md-10 col-lg-6">
        <div class="image-group-1">
          <img class="wow fadeIn" src="<?=SITE_TEMPLATE_PATH?>/assets/images/about-image-1-399x307.jpg" alt="Экспертная поддержка от БЭСТ" width="399" height="307"/>
          <img class="wow fadeIn" src="<?=SITE_TEMPLATE_PATH?>/assets/images/about-003.jpg" alt="Об экспертизе в БЭСТ" width="421" height="332" data-wow-delay=".3s"/>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT IS ORGANIZED -->

<section class="section section-lg bg-gray-100" id="services">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-10 col-md-12 text-center">
        <h6 class="wow fadeInUpSmall">Как устроена работа</h6>
        <h2 class="wow fadeInUpSmall" data-wow-delay=".1s">
          <span class="d-inline-block" style="max-width: 760px;">
            Внутри БЭСТ экспертиза организована как <strong>контролируемая система</strong>
          </span>
        </h2>
      </div>
    </div>
  </div>
</section>

<section class="section section-lg bg-white text-center">
  <div class="container container-md-smaller">

    <ul class="list-steps">
      <li class="list-steps__item wow fadeInLeftSmall" data-wow-delay=".1s">
        <div class="list-steps__item-counter"></div>
        <div class="list-steps__item-divider"></div>
        <div class="list-steps__item-main">
          <h4><a href="#" onclick="return false;">Единый центр методологической ответственности</a></h4>
          <p>Методика, требования к полноте материалов и логике выводов задаются как стандарт организации.</p>
        </div>
      </li>

      <li class="list-steps__item wow fadeInLeftSmall" data-wow-delay=".2s">
        <div class="list-steps__item-counter"></div>
        <div class="list-steps__item-divider"></div>
        <div class="list-steps__item-main">
          <h4><a href="#" onclick="return false;">Контроль этапов и качества исследования</a></h4>
          <p>Проверяется корректность постановки вопросов, ход исследований и связность выводов.</p>
        </div>
      </li>

      <li class="list-steps__item wow fadeInLeftSmall" data-wow-delay=".3s">
        <div class="list-steps__item-counter"></div>
        <div class="list-steps__item-divider"></div>
        <div class="list-steps__item-main">
          <h4><a href="#" onclick="return false;">Единая ответственность за итоговый результат</a></h4>
          <p>Заключение воспринимается как итог системы, а не как отдельное мнение — с возможностью разъяснения методики.</p>
        </div>
      </li>
    </ul>
  </div>
</section>

<!-- PROFESSIONAL STATUS -->
<section class="section section-lg bg-gray-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 text-center">
        <h6 class="wow fadeInUpSmall">статус организации</h6>
        <h2 class="wow fadeInUpSmall" data-wow-delay=".1s">Профессиональные аккредитации и членство в СРО</h2>
      </div>
    </div>

    <?php
    $APPLICATION->IncludeComponent(
        'best:document.list',
        'detailed',
        [
            'IBLOCK_CODE' => 'best_documents',
            'DOC_TYPES' => ['fese', 'sro'],
            'CACHE_TYPE' => 'A',
            'CACHE_TIME' => 3600,
        ]
    );
    ?>

    <div class="text-center mt-4">
      <a class="button button-primary" href="/accreditation/">Все документы и реквизиты</a>
    </div>
  </div>
</section>

<!-- CTA -->
      <section class="section bg-gray-700 particles-js-outer">
        <div id="particles-js"></div>
        <div class="container">
          <div class="row justify-content-center justify-content-xl-between align-items-center">
            <div class="col-lg-8">
              <div class="section-lg">
                <h6 class="wow fadeInLeftSmall">надежная опора</h6>
                <h2 class="wow fadeInLeftSmall" data-wow-delay=".1s">Нужна экспертиза или консультация по задаче?</h2>
                <p class="lead wow fadeInLeftSmall" data-wow-delay=".15s">Оставьте запрос — мы оценим материалы и предложим формат работы.</p>
              </div>
            </div>
            <div class="col-lg-3 pb-4">
              <div class="bitcoin-widget bitcoin-widget_windowed bitcoin-widget_windowed-1">
				<a class="button button-primary" href="#b24-form">
					Оставить запрос
				</a>
                <?/*<div class="btcwdgt-chart" data-bw-theme="light"></div>*/?>
              </div>
            </div>
          </div>
        </div>
      </section>


<!-- TEAM & RESPONSIBILITY (3 cards) -->
<section class="section section-lg bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 text-center">
        <h6>Команда и ответственность</h6>
        <h2>Руководители направлений отвечают за <strong>методику и качество</strong></h2>
        <p>Ведущие эксперты имеют опыт работы в государственных экспертных структурах и огромную практику в судебных процессах.</p>
      </div>
    </div>

    <div class="row row-bordered-1">
      <div class="col-sm-6 col-lg-4 wow fadeIn">
        <article class="box-minimal">
          <span class="icon box-minimal__icon linearicons-license"></span>
          <h4 class="box-minimal__title">Единые стандарты</h4>
          <div class="box-minimal__divider"></div>
          <p>Единый подход к постановке вопросов, методике и оформлению заключений.</p>
        </article>
      </div>

      <div class="col-sm-6 col-lg-4 wow fadeIn" data-wow-delay=".1s">
        <article class="box-minimal">
          <span class="icon box-minimal__icon linearicons-shield-check"></span>
          <h4 class="box-minimal__title">Контроль качества</h4>
          <div class="box-minimal__divider"></div>
          <p>Проверка полноты, логики и обоснованности выводов до выдачи заключения.</p>
        </article>
      </div>

      <div class="col-sm-6 col-lg-4 wow fadeIn" data-wow-delay=".2s">
        <article class="box-minimal">
          <span class="icon box-minimal__icon linearicons-bubble-text"></span>
          <h4 class="box-minimal__title">Ответственность за выводы</h4>
          <div class="box-minimal__divider"></div>
          <p>Готовность разъяснять методику и поддерживать экспертный результат в процессе.</p>
        </article>
      </div>
    </div>
  </div>
</section>

<!-- divider -->
      <section class="section bg-gray-700 py-5">
        <div class="container">
          <div class="row justify-content-center justify-content-xl-between align-items-center">
            <div class="col-lg-8">
                <h6 class="wow fadeInLeftSmall">консультация эксперта</h6>
                <h2 class="wow fadeInLeftSmall" data-wow-delay=".1s">Не знаете, с чего начать?</h2>
                <p class="lead wow fadeInLeftSmall" data-wow-delay=".15s">Просто напишите нам. Мы подскажем.</p>
            </div>
            <div class="col-lg-3 pb-4">
              <div class="bitcoin-widget bitcoin-widget_windowed bitcoin-widget_windowed-1">
				<a class="button button-primary" href="#b24-form">
					Написать в БЭСТ
				</a>
                <?/*<div class="btcwdgt-chart" data-bw-theme="light"></div>*/?>
              </div>
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
