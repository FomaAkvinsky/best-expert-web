<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty('title','БЭСТ — судебная экспертиза и экспертно-правовое сопровождение сложных споров');
$APPLICATION->SetPageProperty('description','Технологичная судебная экспертиза и экспертно-правовое сопровождение сложных споров. Методически корректные 
выводы, контроль качества и снижение риска оспаривания.');

$APPLICATION->SetPageProperty('canonical','https://'.$_SERVER['HTTP_HOST'].'/');

$APPLICATION->SetPageProperty('og_title','БЭСТ - Экспертиза будущего. Уже сейчас.');
$APPLICATION->SetPageProperty('og_description','Мы проводим судебные экспертизы и сопровождаем споры так, чтобы выводы выдерживали процессуальное давление. Методика, контроль качества и ответственность за результат.');

?>

<!-- HERO -->
<section class="section bg-gray-800">
  <div class="slick-group-slider bg-gray-700">
    <div class="carousel-parent-outer">

      <svg class="carousel-parent-shape" width="1216px" height="625px" viewBox="0 0 1216 625" preserveAspectRatio="none">
        <path fill-rule="evenodd" d="M-0.000,311.382 C-0.000,311.382 62.999,372.037 102.727,273.078 C118.498,233.793 168.280,306.657 186.342,249.138 C203.245,195.310 231.848,195.447 246.067,143.801 C266.856,68.285 291.661,3.867 310.569,0.159 C341.089,-5.826 374.891,182.287 422.852,134.224 C468.160,88.821 511.245,170.842 535.135,177.317 C545.468,180.117 579.312,194.321 613.972,189.287 C635.941,186.097 655.397,155.251 678.475,172.529 C726.537,208.512 730.880,342.989 781.202,397.567 C807.168,425.730 831.757,373.189 862.428,356.869 C890.078,342.156 923.937,365.255 946.043,356.869 C975.409,345.727 998.875,341.716 1015.324,294.624 C1027.442,259.931 1032.880,184.101 1048.770,155.771 C1068.789,120.077 1110.838,156.070 1129.996,129.436 C1169.461,74.571 1216.000,43.251 1216.000,43.251 L1216.000,624.999 L-0.000,624.999 L-0.000,311.382 Z"></path>
      </svg>

      <div class="parallax-scene parallax-scene-js" data-scalar-x="5" data-scalar-y="10">
        <div class="layer-1">
          <div class="layer" data-depth=".55">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/medal-424x427.png" alt="" width="424" height="427"/>
          </div>
        </div>
        <div class="layer-2">
          <div class="layer" data-depth=".25">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/medal-424x427.png" alt="" width="424" height="427"/>
          </div>
        </div>
        <div class="layer-3">
          <div class="layer" data-depth=".2">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/medal-424x427.png" alt="" width="424" height="427"/>
          </div>
        </div>
        <div class="layer-4">
          <div class="layer" data-depth=".25">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/medal-424x427.png" alt="" width="424" height="427"/>
          </div>
        </div>
      </div>

      <!-- ВАЖНО: slick-slider как в исходнике -->
      <div class="slick-slider carousel-parent"
           data-arrows="true"
           data-loop="true"
           data-autoplay="true"
           data-dots="true"
           data-swipe="true"
           data-items="1"
           data-fade="true"
           data-child="#slider-child-carousel"
           data-for="#slider-child-carousel">

        <!-- SLIDE 1 (просто div как в исходнике) -->
        <div>
          <div class="slick-slide-caption">
            <h6>экспертные системы и технологии</h6>
            <h1>Экспертиза будущего. Уже сейчас</h1>
            <h3 class="decoration-heading-1">Один шаг до неоспоримости</h3>
            <p>
              Технологичная судебная экспертиза и экспертно-правовое сопровождение сложных споров.
              Методика, контроль качества и проверяемая логика выводов.
            </p>
            <div class="slick-slide-caption__footer">
              <a class="button button-primary" href="#b24-form">Получить консультацию эксперта</a>
            </div>
          </div>
        </div>

        <!-- SLIDE 2 -->
        <div>
          <div class="slick-slide-caption">
            <h6>Процессуальная устойчивость</h6>
            <div class="heading-1">Исследование как система</div>
            <h3 class="decoration-heading-1">А не субъективное мнение</h3>
            <p>
              Управляемый процесс: сроки, этапы, самопроверка и ответственность за выводы.
              Это снижает риск оспаривания и повторных экспертиз.
            </p>
            <div class="slick-slide-caption__footer">
              <a class="button button-primary" href="#b24-form">Оценить задачу и сроки</a>
            </div>
          </div>
        </div>
		
		<!-- SLIDE 3 -->
		<div>
		  <div class="slick-slide-caption">
			<h6>Контроль качества и ответственность</h6>
			<div class="heading-1">Заключение как основа позиции</div>
			<h3 class="decoration-heading-1">А не формальная бумага</h3>
			<p>
			  Мы сопровождаем экспертизу до финального процессуального результата:
			  разъясняем методику, защищаем выводы и отвечаем за их обоснованность.
			</p>
			<div class="slick-slide-caption__footer">
			  <a class="button button-primary" href="#b24-form">
				Обсудить задачу
			  </a>
			</div>
		  </div>
		</div>

      </div>
    </div>

    <!-- ВАЖНО: slick-slider как в исходнике -->
    <div class="slick-slider carousel-child"
         id="slider-child-carousel"
         data-for=".carousel-parent"
         data-arrows="false"
         data-loop="true"
         data-dots="false"
         data-swipe="false"
         data-fade="true"
         data-items="1"
         data-slide-to-scroll="1">

      <div class="item" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/images/slider-001-v2.jpg');"></div>
      <div class="item" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/images/slider-002-v1.jpg');"></div>
	  <div class="item" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/images/slider-slide-3.jpg');"></div>


    </div>
  </div>
</section>

<!-- PAIN -->
<section class="section section-sm bg-white" id="about">
  <div class="container">
    <div class="row row-50 justify-content-center flex-md-row-reverse align-items-center">
      <div class="col-md-10 col-lg-6">
		<h3>Когда экспертиза создает риски</h3>
        <div class="divider-modern"></div>
          <p>
			Мы часто подключаемся уже на этапе, когда экспертиза перестает быть инструментом
			установления фактов и начинает создавать дополнительные процессуальные риски.
		  </p>
		  <p>
			Формально исследования проводятся, сроки идут, заключения выдаются —
			но в итоге стороны сталкиваются с затяжками, повторными назначениями
			и выводами, которые невозможно уверенно использовать в суде.
		  </p>

      </div>
	  <div class="col-md-10 col-lg-6">
        <div class="image-group-1">
		  <img class="wow fadeIn" src="<?=SITE_TEMPLATE_PATH?>/assets/images/about-image-1-399x307.jpg" alt="" width="399" height="307"/>
		  <img class="wow fadeIn" src="<?=SITE_TEMPLATE_PATH?>/assets/images/about-image-2-421x332.jpg" alt="" width="421" height="332" data-wow-delay=".3s"/>
        </div>
      </div>
    </div>
	
	<div class="row row-30">
            <div class="col-lg-6 wow fadeInUpSmall">
              <!-- Link Box--><a class="link-box" href="#" onclick="return false;"><span class="icon link-box__icon linearicons-hourglass"></span>
                <div class="link-box__main">
                  <p>Экспертизы длятся месяцами без понятных причин.</p>
                </div></a>
            </div>
            <div class="col-lg-6 wow fadeInUpSmall" data-wow-delay=".02s">
              <!-- Link Box--><a class="link-box" href="#" onclick="return false;"><span class="icon link-box__icon linearicons-cross-circle"></span>
                <div class="link-box__main">
                  <p>Заключения легко оспариваются и разваливаются в суде.</p>
                </div></a>
            </div>
            <div class="col-lg-6 wow fadeInUpSmall" data-wow-delay=".1s">
              <!-- Link Box--><a class="link-box" href="#" onclick="return false;"><span class="icon link-box__icon linearicons-repeat"></span>
                <div class="link-box__main">
                  <p>Назначаются повторные и дополнительные экспертизы.</p>
                </div></a>
            </div>
            <div class="col-lg-6 wow fadeInUpSmall" data-wow-delay=".12s">
              <!-- Link Box --><a class="link-box" href="#" onclick="return false;"><span class="icon link-box__icon linearicons-bubble-question"></span>
                <div class="link-box__main">
                  <p>Эксперт не готов объяснять и защищать сделанные выводы.</p>
                </div></a>
            </div>
    </div>

  </div>
</section>

<section class="bg-gray-100 py-4">
  <div class="container">
    <div class="profile-light">
      <div class="profile-light__main">
        <div class="profile-light__inner">
          <h4 class="profile-light__title">
            Мы строим экспертизу иначе —
          </h4>
          <div class="profile-light__text">
            <p>
              не как разрозненное исследование и набор субъективных выводов,
              а как управляемый и проверяемый процесс.
            </p>
            <p>
              С понятной методикой, контролем этапов, сроков и логики исследования —
              чтобы экспертное заключение работало на процесс,
              а не создавало новые риски.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- How we work -->
<section class="section section-lg bg-white text-center">
  <div class="container container-md-smaller">
    <div class="row justify-content-center">
      <div class="col-sm-10 col-md-12">
        <h6 class="wow fadeInUpSmall">Как мы работаем</h6>
        <h2 class="wow fadeInUpSmall" data-wow-delay=".1s">
          <span class="d-inline-block" style="max-width: 750px;">
            Экспертиза в БЭСТ — это <strong>управляемый процесс</strong> с прогнозируемым результатом
          </span>
        </h2>
      </div>
    </div>

    <ul class="list-steps">
      <!-- STEP 1 -->
      <li class="list-steps__item wow fadeInLeftSmall" data-wow-delay=".1s">
        <div class="list-steps__item-counter"></div>
        <div class="list-steps__item-divider"></div>
        <div class="list-steps__item-main">
          <h4><a href="#" onclick="return false;">Фиксируем задачу и процессуальный контекст</a></h4>
          <p>
            Уточняем цель экспертизы, материалы и вопросы, которые должны быть корректно сформулированы для суда.
            Определяем формат работы, состав исследований и ожидаемые сроки.
          </p>
        </div>
      </li>

      <!-- STEP 2 -->
      <li class="list-steps__item wow fadeInLeftSmall" data-wow-delay=".2s">
        <div class="list-steps__item-counter"></div>
        <div class="list-steps__item-divider"></div>
        <div class="list-steps__item-main">
          <h4><a href="#" onclick="return false;">Проводим исследование по методике и с контролем этапов</a></h4>
          <p>
            Работаем на собственной материально-технической базе, используем современные методы и оборудование.
            Контролируем логику исследования и ход работ на каждом этапе, чтобы выводы оставались проверяемыми.
          </p>
        </div>
      </li>

      <!-- STEP 3 -->
      <li class="list-steps__item wow fadeInLeftSmall" data-wow-delay=".3s">
        <div class="list-steps__item-counter"></div>
        <div class="list-steps__item-divider"></div>
        <div class="list-steps__item-main">
          <h4><a href="#" onclick="return false;">Готовим заключение и обеспечиваем процессуальную устойчивость</a></h4>
          <p>
            Формируем структурированное заключение без избыточных интерпретаций и с прозрачной логикой выводов.
            При необходимости разъясняем методику и защищаем выводы в процессе.
          </p>
        </div>
      </li>
    </ul>
  </div>
</section>

<!-- Counters -->
<section class="section parallax-container section-lg section-overlay-5 context-dark text-center"
         data-parallax-img="<?=SITE_TEMPLATE_PATH?>/assets/images/parallax-2.jpg">
  <div class="parallax-content">
    <div class="container">
      <div class="row row-30">

        <!-- Counter 1 -->
        <div class="col-6 col-md-3">
          <article class="counter-classic">
            <div class="counter-classic__main">
              <div class="counter">2007</div>
            </div>
            <p class="counter-classic__title">Год начала работы</p>
          </article>
        </div>

        <!-- Counter 2 -->
        <div class="col-6 col-md-3">
          <article class="counter-classic">
            <div class="counter-classic__main">
              <div class="counter">1000</div><span>+</span>
            </div>
            <p class="counter-classic__title">Судебных экспертиз</p>
          </article>
        </div>

        <!-- Counter 3 -->
        <div class="col-6 col-md-3">
          <article class="counter-classic">
            <div class="counter-classic__main">
              <div class="counter">1</div>
            </div>
            <p class="counter-classic__title">Центр ответственности за выводы</p>
          </article>
        </div>

        <!-- Counter 4 -->
        <div class="col-6 col-md-3">
          <article class="counter-classic">
            <div class="counter-classic__main">
              <div class="counter">0</div>
            </div>
            <p class="counter-classic__title">Маркетинговых обещаний</p>
          </article>
        </div>

      </div>
    </div>
  </div>
</section>
	  

<!-- FOR WHOM -->
<section class="section section-lg">
  <div class="container">
  
	<h3>Для кого мы работаем</h3>
    <div class="divider-modern"></div>
    <p>
		Мы говорим на языке процесса: сроки, методика, проверяемая логика, устойчивость выводов.
	</p>
  
	<div class="row row-30">

	  <!-- Юристы -->
	  <div class="col-lg-6 wow fadeInUpSmall">
		<a class="link-box" href="#" onclick="return false;">
		  <span class="icon link-box__icon linearicons-briefcase"></span>
		  <div class="link-box__main">
			<h4>Юристам</h4>
			<p>
			  Экспертизы, на которые можно уверенно положиться
			  в судебном процессе и переговорах.
			</p>
		  </div>
		</a>
	  </div>

	  <!-- Суды -->
	  <div class="col-lg-6 wow fadeInUpSmall" data-wow-delay=".02s">
		<a class="link-box" href="#" onclick="return false;">
		  <span class="icon link-box__icon linearicons-balance"></span>
		  <div class="link-box__main">
			<h4>Судам</h4>
			<p>
			  Четкие, методически корректные и понятные заключения
			  без избыточных интерпретаций.
			</p>
		  </div>
		</a>
	  </div>

	  <!-- Корпоративные клиенты -->
	  <div class="col-lg-6 wow fadeInUpSmall" data-wow-delay=".1s">
		<a class="link-box" href="#" onclick="return false;">
		  <span class="icon link-box__icon linearicons-apartment"></span>
		  <div class="link-box__main">
			<h4>Корпоративным клиентам</h4>
			<p>
			  Экспертиза и сопровождение споров в ситуациях,
			  где цена ошибки особенно высока.
			</p>
		  </div>
		</a>
	  </div>

	  <!-- Сложные дела -->
	  <div class="col-lg-6 wow fadeInUpSmall" data-wow-delay=".12s">
		<a class="link-box" href="#" onclick="return false;">
		  <span class="icon link-box__icon linearicons-puzzle"></span>
		  <div class="link-box__main">
			<h4>Для сложных дел</h4>
			<p>
			  Междисциплинарные споры, где стандартных подходов
			  и шаблонных экспертиз недостаточно.
			</p>
		  </div>
		</a>
	  </div>

	</div>

  </div>
</section>

<!-- TRUST -->

<section class="section parallax-container section-md bg-gray-700 section-overlay-3 text-center"
         data-parallax-img="<?=SITE_TEMPLATE_PATH?>/assets/images/features-parallax-1.jpg">
  <div class="parallax-content">
    <div class="container">
      <h6>Почему нам доверяют</h6>
      <h2>БЭСТ — экспертиза, <strong>выстроенная как процесс</strong></h2>
      <p>Шесть оснований, которые помогают снижать риски и повышать устойчивость экспертных выводов в суде.</p>

      <!-- Bootstrap collapse -->
      <div class="card-group-custom card-group-line" id="accordion-trust" role="tablist" aria-multiselectable="true">
        <div class="row row-5 justify-content-center">

          <!-- LEFT COLUMN -->
          <div class="col-sm-10 col-lg-6">

            <!-- 1 -->
            <article class="card card-custom card-line">
              <div class="card-header" id="accordion-trustHeading1" role="tab">
                <div class="card-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-trust"
                     data-target="#accordion-trustCollapse1" href="#" onclick="return false;" aria-controls="accordion-trustCollapse1" aria-expanded="true">
                    Методика и проверяемая логика исследования
                    <div class="card-arrow"></div>
                  </a>
                </div>
              </div>
              <div class="collapse" id="accordion-trustCollapse1" role="tabpanel" aria-labelledby="accordion-trustHeading1">
                <div class="card-body">
                  <p>
                    Мы опираемся на утвержденные подходы, корректную постановку вопросов и прозрачную логику выводов.
                    Это снижает пространство для произвольных трактовок и повышает устойчивость заключения в процессе.
                  </p>
                </div>
              </div>
            </article>

            <!-- 2 -->
            <article class="card card-custom card-line">
              <div class="card-header" id="accordion-trustHeading2" role="tab">
                <div class="card-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-trust"
                     data-target="#accordion-trustCollapse2" href="#" onclick="return false;" aria-controls="accordion-trustCollapse2" aria-expanded="false">
                    Контроль качества на каждом этапе
                    <div class="card-arrow"></div>
                  </a>
                </div>
              </div>
              <div class="collapse" id="accordion-trustCollapse2" role="tabpanel" aria-labelledby="accordion-trustHeading2">
                <div class="card-body">
                  <p>
                    Экспертиза — это не один финальный документ. Мы контролируем полноту материалов, ход исследований,
                    корректность методики и связность выводов, чтобы исключать ошибки, которые затем приводят к оспариванию.
                  </p>
                </div>
              </div>
            </article>

            <!-- 3 -->
            <article class="card card-custom card-line">
              <div class="card-header" id="accordion-trustHeading3" role="tab">
                <div class="card-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-trust"
                     data-target="#accordion-trustCollapse3" href="#" onclick="return false;" aria-controls="accordion-trustCollapse3" aria-expanded="false">
                    Эксперты с опытом государственной экспертной системы
                    <div class="card-arrow"></div>
                  </a>
                </div>
              </div>
              <div class="collapse" id="accordion-trustCollapse3" role="tabpanel" aria-labelledby="accordion-trustHeading3">
                <div class="card-body">
                  <p>
                    В команде — эксперты с практическим опытом в государственных экспертных структурах.
                    Мы понимаем требования суда к доказательности и форме изложения, и работаем в этой логике.
                  </p>
                </div>
              </div>
            </article>

          </div>

          <!-- RIGHT COLUMN -->
          <div class="col-sm-10 col-lg-6">

            <!-- 4 -->
            <article class="card card-custom card-line">
              <div class="card-header" id="accordion-trustHeading4" role="tab">
                <div class="card-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-trust"
                     data-target="#accordion-trustCollapse4" href="#" onclick="return false;" aria-controls="accordion-trustCollapse4" aria-expanded="false">
                    Собственная материально-техническая база
                    <div class="card-arrow"></div>
                  </a>
                </div>
              </div>
              <div class="collapse" id="accordion-trustCollapse4" role="tabpanel" aria-labelledby="accordion-trustHeading4">
                <div class="card-body">
                  <p>
                    Оборудование и база позволяют проводить ключевые исследования без зависимостей и задержек,
                    а также обеспечивать воспроизводимость результатов и корректную фиксацию данных.
                  </p>
                </div>
              </div>
            </article>

            <!-- 5 -->
            <article class="card card-custom card-line">
              <div class="card-header" id="accordion-trustHeading5" role="tab">
                <div class="card-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-trust"
                     data-target="#accordion-trustCollapse5" href="#" onclick="return false;" aria-controls="accordion-trustCollapse5" aria-expanded="false">
                    Управление сроками и понятные этапы
                    <div class="card-arrow"></div>
                  </a>
                </div>
              </div>
              <div class="collapse" id="accordion-trustCollapse5" role="tabpanel" aria-labelledby="accordion-trustHeading5">
                <div class="card-body">
                  <p>
                    Мы заранее фиксируем этапы, состав работ и ожидаемые сроки. Это помогает избегать “затяжных”
                    экспертиз без объяснений и снижает риск повторных назначений из-за организационных провалов.
                  </p>
                </div>
              </div>
            </article>

            <!-- 6 -->
            <article class="card card-custom card-line">
              <div class="card-header" id="accordion-trustHeading6" role="tab">
                <div class="card-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-trust"
                     data-target="#accordion-trustCollapse6" href="#" onclick="return false;" aria-controls="accordion-trustCollapse6" aria-expanded="false">
                    Готовность разъяснять методику и защищать выводы
                    <div class="card-arrow"></div>
                  </a>
                </div>
              </div>
              <div class="collapse" id="accordion-trustCollapse6" role="tabpanel" aria-labelledby="accordion-trustHeading6">
                <div class="card-body">
                  <p>
                    При необходимости мы разъясняем логику исследования и методику, отвечаем на вопросы и
                    сопровождаем экспертизу в процессе — чтобы выводы сохраняли устойчивость, а не оставались “на бумаге”.
                  </p>
                </div>
              </div>
            </article>

          </div>
        </div>
      </div>

      <a class="button button-primary" href="#b24-form">Оставить запрос</a>
    </div>
  </div>
</section>


<!-- Principles -->
<section class="section bg-white" id="principles">
  <div class="container">
    <div class="row row-bordered-1">

      <div class="col-sm-6 col-lg-4 wow fadeIn">
        <article class="box-minimal">
          <span class="icon box-minimal__icon linearicons-license"></span>
          <h4 class="box-minimal__title">Ответственность важнее громких обещаний</h4>
          <div class="box-minimal__divider"></div>
          <p>Мы не подменяем исследование формулировками. Выводы опираются на материалы, методику и проверку.</p>
        </article>
      </div>

      <div class="col-sm-6 col-lg-4 wow fadeIn" data-wow-delay=".1s">
        <article class="box-minimal">
          <span class="icon box-minimal__icon linearicons-cog"></span>
          <h4 class="box-minimal__title">Методика важнее интерпретации</h4>
          <div class="box-minimal__divider"></div>
          <p>Сначала корректная постановка вопросов и метод. Затем вывод, который можно воспроизвести и проверить.</p>
        </article>
      </div>

      <div class="col-sm-6 col-lg-4 wow fadeIn" data-wow-delay=".2s">
        <article class="box-minimal">
          <span class="icon box-minimal__icon linearicons-timer"></span>
          <h4 class="box-minimal__title">Скорость не в ущерб точности</h4>
          <div class="box-minimal__divider"></div>
          <p>Сроки планируются по этапам. Мы ускоряем процесс за счет организации и контроля, а не упрощений.</p>
        </article>
      </div>

      <div class="col-sm-6 col-lg-4 wow fadeIn">
        <article class="box-minimal">
          <span class="icon box-minimal__icon linearicons-hourglass"></span>
          <h4 class="box-minimal__title">Время эксперта имеет ценность</h4>
          <div class="box-minimal__divider"></div>
          <p>Мы работаем структурно: фиксируем входные данные, исключаем лишние итерации и пустые запросы.</p>
        </article>
      </div>

      <div class="col-sm-6 col-lg-4 wow fadeIn" data-wow-delay=".1s">
        <article class="box-minimal">
          <span class="icon box-minimal__icon linearicons-balance"></span>
          <h4 class="box-minimal__title">Экспертиза — часть процесса, а не формальность</h4>
          <div class="box-minimal__divider"></div>
          <p>Мы учитываем процессуальный контекст: как заключение будет читаться, проверяться и защищаться в суде.</p>
        </article>
      </div>

      <div class="col-sm-6 col-lg-4 wow fadeIn" data-wow-delay=".2s">
        <article class="box-minimal">
          <span class="icon box-minimal__icon linearicons-clipboard-check"></span>
          <h4 class="box-minimal__title">Факты важнее предположений</h4>
          <div class="box-minimal__divider"></div>
          <p>Там, где можно измерить и зафиксировать — мы измеряем и фиксируем. Это делает выводы устойчивыми.</p>
        </article>
      </div>

    </div>
  </div>
</section>

<!-- Services -->
<section class="section section-lg bg-gray-100" id="services">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 text-center">
        <h6 class="wow fadeInUpSmall">Услуги</h6>
        <h2 class="wow fadeInUpSmall" data-wow-delay=".1s">
          Экспертиза и право — <strong>единая доказательственная система</strong>
        </h2>
        <p class="wow fadeInUpSmall" data-wow-delay=".2s">
          Мы не продаем “виды экспертиз”. Мы выстраиваем управляемый экспертный результат:
          методика → доказательства → процессуальная устойчивость. 
        </p>
      </div>
    </div>
  </div>
</section>

<section class="section section-lg bg-white">
  <div class="container">
    <div class="row row-50 ">

      <!-- BLOCK 1 -->
      <div class="col-xl-9 wow fadeInUpSmall">
        <h3 class="h4">Судебно-экспертные исследования</h3>
        <p>
          Ключевая компетенция БЭСТ: экспертизы, выстроенные как технологический процесс и рассчитанные на работу в суде. 
        </p>

        <div class="row row-30">

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-balance"></span>
              <div class="link-box__main">
                <h4>Судебные экспертизы</h4>
                <p>Почерковедческие, технические и иные исследования с методически выверенной логикой и проверяемыми выводами.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-file-search"></span>
              <div class="link-box__main">
                <h4>Экспертизы документов</h4>
                <p>Давность, подлинность, вмешательства и способы изготовления — когда документ становится ключевым доказательством.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-puzzle"></span>
              <div class="link-box__main">
                <h4>Экспертизы повышенной сложности</h4>
                <p>Комплексные исследования с единой логикой выводов и одним центром ответственности.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-bubble-text"></span>
              <div class="link-box__main">
                <h4>Экспертное сопровождение</h4>
                <p>Разъяснение методики, подготовка к участию в суде, ответы на вопросы сторон и суда — экспертиза не заканчивается выдачей заключения.</p>
              </div>
            </a>
          </div>

        </div>
      </div>

      <!-- BLOCK 2 -->
      <div class="col-xl-9 mt-5 wow fadeInUpSmall" data-wow-delay=".08s">
        <h3 class="h4">Юридические и экспертно-правовые услуги</h3>
        <p>
          Работаем там, где стандартной юридической практики недостаточно, а результат зависит от качества экспертизы,
          расчетов и доказательной базы. 
        </p>

        <div class="row row-30">

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-chart-bars"></span>
              <div class="link-box__main">
                <h4>Оценочные и финансово-экономические экспертизы</h4>
                <p>Оценка, анализ, расчет убытков и упущенной выгоды — то, что можно обосновать и защитить в суде.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-briefcase"></span>
              <div class="link-box__main">
                <h4>Юридические услуги и судебное представительство</h4>
                <p>Процессуальное сопровождение и позиция, усиленная экспертизой — право и экспертиза работают как единая система.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-shield-check"></span>
              <div class="link-box__main">
                <h4>Due Diligence и сопровождение сделок</h4>
                <p>Проверка правовых и финансовых рисков, активов и обязательств — чтобы предотвращать споры, а не фиксировать их постфактум.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-apartment"></span>
              <div class="link-box__main">
                <h4>Экспертное сопровождение корпоративных и имущественных споров</h4>
                <p>Корпоративные, строительные, имущественные споры и взыскание убытков — когда “цифры важнее эмоций”. </p>
              </div>
            </a>
          </div>

        </div>
      </div>

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
                <h6 class="wow fadeInLeftSmall">сделайте шаг к победе</h6>
                <h2 class="wow fadeInLeftSmall" data-wow-delay=".1s">Нужна экспертиза, которая станет надежной основой позиции?</h2>
                <p class="lead wow fadeInLeftSmall" data-wow-delay=".15s"> Оставьте запрос — мы оценим задачу, процессуальные риски и предложим
            оптимальный формат экспертной работы.</p>
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

<!-- Key Team (Slider) -->
<section class="section section-md bg-white text-center" id="team">
  <div class="container">
    <h6>Ключевые сотрудники</h6>
    <h2>Руководители <strong>экспертных</strong> направлений</h2>
    <p>Отвечают за методику, качество и устойчивость выводов по своим специализациям.</p>

    <!-- Slick slider -->
    <div class="slick-slider row row-50"
		 data-arrows="true"
		 data-dots="true"
		 data-loop="true"
		 data-autoplay="false"
		 data-swipe="true"
		 data-items="1"
		 data-sm-items="1"
		 data-md-items="1"
		 data-lg-items="3"
		 data-xl-items="3"
		 data-slide-to-scroll="1"
		 data-center-mode="false"
		 data-sm-arrows="false"
		 data-sm-dots="true">


      <!-- 1 -->
      <div class="col-lg-4">
        <article class="profile-modern">
          <figure class="profile-modern__figure">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/team-01-1-lobanov.jpg" alt="Алексей Лобанов" width="342" height="303"/>
          </figure>
          <div class="profile-modern__main">
            <div class="profile-modern__inset">
              <h4 class="profile-modern__name">Алексей Лобанов</h4>
              <h5 class="profile-modern__position">Руководитель компании, эксперт-криминалист</h5>
            </div>
            <p>
              Почерковедческие экспертизы, исследования реквизитов документов, лингвистические исследования.
              Опыт работы более 20 лет, экспертная практика более 10 лет.
            </p>
			<p>
              <a href="https://t.me/anonorma" target="_blank"><span class="fa-brands fa-telegram"></span> написать в Telegram</a>
            </p>
          </div>
        </article>
      </div>

      <!-- 2 -->
      <div class="col-lg-4">
        <article class="profile-modern">
          <figure class="profile-modern__figure">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/team-member-03.jpg" alt="Елена Меринова" width="342" height="303"/>
          </figure>
          <div class="profile-modern__main">
            <div class="profile-modern__inset">
              <h4 class="profile-modern__name">Елена Меринова</h4>
              <h5 class="profile-modern__position">Начальник направления экспертиз документов</h5>
            </div>
            <p>
              Судебно-техническая экспертиза документов, реквизиты документов.
              Экспертная специализация более 20 лет, профильная квалификация и сертификация.
            </p>
          </div>
        </article>
      </div>

      <!-- 3 -->
      <div class="col-lg-4">
        <article class="profile-modern">
          <figure class="profile-modern__figure">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/team-02-trocenko.jpg" alt="Андрей Троценко" width="342" height="303"/>
          </figure>
          <div class="profile-modern__main">
            <div class="profile-modern__inset">
              <h4 class="profile-modern__name">Андрей Троценко</h4>
              <h5 class="profile-modern__position">Начальник направления автотехнических экспертиз</h5>
            </div>
            <p>
              Автотехническая и транспортно-трасологическая экспертиза, обстоятельства ДТП и техническое состояние ТС.
              Опыт в расследовании ДТП и организации БДД с 2006 года, управленческий опыт в ГИБДД.
            </p>
			<p>
              <a href="https://t.me/anonorma" target="_blank"><span class="fa-brands fa-telegram"></span> написать в Telegram</a>
            </p>
          </div>
        </article>
      </div>

      <!-- 4 -->
      <div class="col-lg-4">
        <article class="profile-modern">
          <figure class="profile-modern__figure">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/team-member-04.jpg" alt="Юлия Александрова" width="342" height="303"/>
          </figure>
          <div class="profile-modern__main">
            <div class="profile-modern__inset">
              <h4 class="profile-modern__name">Юлия Александрова</h4>
              <h5 class="profile-modern__position">Начальник направления землеустроительных экспертиз</h5>
            </div>
            <p>
              Землеустройство, геодезия, кадастровые работы и судебная землеустроительная экспертиза.
              Практика в землеустройстве с 2008 года, экспертная работа с 2021 года.
            </p>
          </div>
        </article>
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
