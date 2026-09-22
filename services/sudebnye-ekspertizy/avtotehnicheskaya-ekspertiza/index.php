<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty(
  'title',
  'Автотехническая экспертиза БЭСТ | диагностика, пробег, причины неисправностей и качество ремонта'
);

$APPLICATION->SetPageProperty(
  'description',
  'Автотехническая экспертиза БЭСТ: техническое состояние авто, причины неисправностей и повреждений, качество ремонта, диагностика электронных блоков, определение пробега и моточасов. Фиксация исходных данных и процессуальная устойчивость выводов.'
);

$APPLICATION->SetPageProperty(
  'canonical',
  'https://'.$_SERVER['HTTP_HOST'].'/services/sudebnye-ekspertizy/avtotehnicheskaya-ekspertiza/'
);

$APPLICATION->SetPageProperty(
  'og_title',
  'Автотехническая экспертиза БЭСТ — проверяемые выводы и диагностические протоколы'
);

$APPLICATION->SetPageProperty(
  'og_description',
  'Осмотр кузова и агрегатов, компьютерная диагностика, проверка пробега/моточасов, оценка качества ремонта. Заключение, устойчивое к оспариванию.'
);

?>

<!-- HERO (internal) -->
<section class="section parallax-container section-md bg-gray-700 section-overlay-3"
         data-parallax-img="/local/templates/best/assets/images/features-parallax-1.jpg">
  <div class="material-parallax parallax">
    <img src="/local/templates/best/assets/images/features-parallax-1.jpg" alt=""
         style="display: block; transform: translate3d(-50%, 200px, 0px);">
  </div>

  <div class="parallax-content">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-10 col-lg-8">

          <ul class="brumbs-custom">
            <li><a href="/">Главная</a></li>
            <li><a href="/services/">Услуги</a></li>
            <li><a href="/services/sudebnye-ekspertizy/">Судебные экспертизы</a></li>
            <li class="active">Автотехническая экспертиза</li>
          </ul>

          <h1>Автотехническая экспертиза</h1>
          <p class="lead">
            Экспертное исследование технического состояния транспортного средства,
            причин неисправностей и качества ремонта — с фиксациеи исходных данных и диагностическими протоколами.
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

<!-- Intro / approach -->
<section class="bg-gray-100 py-4">
  <div class="container">
    <div class="profile-light">
      <div class="profile-light__main">
        <div class="profile-light__inner" style="max-width: 980px;">
          <h4 class="profile-light__title">Автотехническое заключение должно быть проверяемым</h4>
          <div class="profile-light__text">
            <p>
              Мы подготавливаем автотехнические заключения в досудебном и судебном порядке:
              фиксируем исходные данные, используем профессиональное оборудование и программные комплексы,
              а выводы формулируем так, чтобы они выдерживали процессуальную проверку.
            </p>
            <p>
              Важен не только результат диагностики, но и то, как он получен и оформлен: это снижает риск оспаривания и повторных экспертиз.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Content blocks -->
<section class="section section-lg bg-white">
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 text-center">
        <h6 class="wow fadeInUpSmall">что мы делаем</h6>
        <h2 class="wow fadeInUpSmall" data-wow-delay=".1s">Предмет и задачи исследования</h2>
        <p class="wow fadeInUpSmall" data-wow-delay=".2s">
          Экспертиза выстраивается под конкретную задачу: от осмотра кузова и агрегатов до компьютерного тестирования электронных блоков.
        </p>
      </div>
    </div>

    <div class="row row-50">

      <!-- block: when needed -->
      <div class="col-xl-9 wow fadeInUpSmall">
        <h3 class="h4">Когда требуется автотехническая экспертиза</h3>
        <p>
          Чаще всего автотехническая экспертиза нужна, когда спор упирается в технические причины и достоверность данных автомобиля.
        </p>

        <div class="row row-30">
          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-wrench"></span>
              <div class="link-box__main">
                <h4>Споры о причинах поломки</h4>
                <p>Определение характера неисправности, причин выхода из строя узлов и агрегатов, влияние эксплуатации и ремонта.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-cog"></span>
              <div class="link-box__main">
                <h4>Оценка качества ремонта</h4>
                <p>Проверка соответствия выполненных работ заявленному объему, выявление дефектов и причин повторных неисправностей.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-speed-fast"></span>
              <div class="link-box__main">
                <h4>Достоверность пробега и данных ЭБУ</h4>
                <p>Диагностика электронных блоков, выявление несоответствий пробега, моточасов и следов вмешательств.</p>
              </div>
            </a>
          </div>
        </div>
      </div>
	</div>
  </div>
</section>

<section class="bg-gray-100 py-4">
  <div class="container">
    <div class="profile-light">
      <div class="profile-light__main">
        <div class="profile-light__inner" style="max-width: 980px;">
          <h4 class="profile-light__title">Оборудование и протоколы</h4>
          <div class="profile-light__text">
            <p>
              Используем специализированные средства осмотра кузова и агрегатов,
              а также программные комплексы диагностики и тестирования ЭБУ по маркам.
              Это позволяет фиксировать данные в воспроизводимом виде.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section pt-4 bg-white">
  <div class="container">
    <div class="row mb-5">

      <!-- block: equipment -->
      <div class="col-xl-9 mt-5 wow fadeInUpSmall" data-wow-delay=".06s">
        <h3 class="h4">Оборудование и программные комплексы</h3>
        <p>
          В рамках подготовки автотехнических заключений используем профессиональное оборудование
          для осмотра кузовных элементов, скрытых полостей, узлов и агрегатов, а также компьютерной диагностики с тестированием электронных блоков.
        </p>

        <div class="row row-30">

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-ruler"></span>
              <div class="link-box__main">
                <h4>Толщиномер Carsys ProPro</h4>
                <p>Осмотр кузовных элементов: определение типа металла, выявление следов окраса и наличия шпаклевки.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-eye"></span>
              <div class="link-box__main">
                <h4>Эндоскоп iCartool (360°)</h4>
                <p>Осмотр скрытых полостей кузова, узлов и агрегатов, в том числе оценка состояния стенок цилиндров и скрытых повреждений.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-laptop-phone"></span>
              <div class="link-box__main">
                <h4>Компьютерная диагностика и тестирование ЭБУ</h4>
                <p>Чтение параметров, проверка работоспособности электронных блоков, анализ данных пробега и моточасов (в зависимости от марки и модели).</p>
              </div>
            </a>
          </div>

        </div>
      </div>

      <!-- block: brand-specific software -->
      <div class="col-xl-9 mt-5 wow fadeInUpSmall" data-wow-delay=".08s">
        <h3 class="h4">Диагностика по маркам</h3>
        <p>
          Используем профильные программные комплексы и интерфейсы для диагностики и тестирования — когда важна максимальная точность данных.
        </p>

        <div class="row row-30">

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-cog"></span>
              <div class="link-box__main">
                <h4>Volkswagen AG</h4>
                <p>Оригинальный адаптер VAS6154A с диагностическим интерфейсом и программным комплексом ODIS (в зависимости от задачи и поколения систем).</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-cog2"></span>
              <div class="link-box__main">
                <h4>BMW Group</h4>
                <p>Программный комплекс ISTA+ для диагностики и анализа параметров электронных систем.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-keyboard"></span>
              <div class="link-box__main">
                <h4>FORD</h4>
                <p>Программный комплекс ForScan с возможностью кодировки и изменения отдельных параметров при необходимости тестирования.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-layers"></span>
              <div class="link-box__main">
                <h4>Volvo, Land Rover, Opel, Subaru, Mitsubishi</h4>
                <p>
                  Volvo (Vida Dice), Land Rover (SDD), Opel (Op-com или GDS2), Subaru (Select Monitor 4), Mitsubishi (MUT 2).
                </p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-car"></span>
              <div class="link-box__main">
                <h4>Универсальная диагностика</h4>
                <p>Launch X-431 Pro 5 — диагностика различных автомобилей, мотоциклов и грузовой техники.</p>
              </div>
            </a>
          </div>

        </div>

        <div class="mt-4">
          <p style="opacity:.75;">
            На сайте представлен не полный перечень диагностируемых марок. Возможность осмотра и диагностики конкретного транспортного средства уточняйте у нас.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Small FAQ -->
<section class="section section-lg bg-gray-100">
  <div class="container">
    <div class="row row-40 justify-content-center">

      <div class="col-md-10 col-lg-6">
        <h3>Вопросы по автотехнической экспертизе</h3>
        <div class="divider-modern"></div>
        <p>
          Если вы сомневаетесь в формате исследования, начнем с оценки материалов: что есть в наличии, что нужно зафиксировать,
          и какие вопросы корректно ставить для получения устойчивых выводов.
        </p>
      </div>

      <div class="col-md-10 col-lg-6">
        <div class="card-group-custom card-group-line" id="accordion-auto" role="tablist" aria-multiselectable="true">

          <article class="card card-custom card-line">
            <div class="card-header" id="accordion-autoHeading1" role="tab">
              <div class="card-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-auto"
                   data-target="#accordion-autoCollapse1" href="#" onclick="return false;"
                   aria-controls="accordion-autoCollapse1" aria-expanded="false">
                  Какие материалы нужны для начала?
                  <div class="card-arrow"></div>
                </a>
              </div>
            </div>
            <div class="collapse" id="accordion-autoCollapse1" role="tabpanel" aria-labelledby="accordion-autoHeading1">
              <div class="card-body">
                <p>Краткое описание ситуации, документы по ремонту/обслуживанию (если есть), фото/видео, перечень вопросов и данные автомобиля (VIN, модель, год).</p>
              </div>
            </div>
          </article>

          <article class="card card-custom card-line">
            <div class="card-header" id="accordion-autoHeading2" role="tab">
              <div class="card-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-auto"
                   data-target="#accordion-autoCollapse2" href="#" onclick="return false;"
                   aria-controls="accordion-autoCollapse2" aria-expanded="false">
                  Можно ли провести экспертизу в досудебном порядке?
                  <div class="card-arrow"></div>
                </a>
              </div>
            </div>
            <div class="collapse" id="accordion-autoCollapse2" role="tabpanel" aria-labelledby="accordion-autoHeading2">
              <div class="card-body">
                <p>Да. Досудебное заключение помогает сформировать позицию, уточнить круг вопросов и подготовить материалы для суда (при необходимости).</p>
              </div>
            </div>
          </article>

          <article class="card card-custom card-line">
            <div class="card-header" id="accordion-autoHeading3" role="tab">
              <div class="card-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-auto"
                   data-target="#accordion-autoCollapse3" href="#" onclick="return false;"
                   aria-controls="accordion-autoCollapse3" aria-expanded="false">
                  По всем ли маркам вы делаете диагностику?
                  <div class="card-arrow"></div>
                </a>
              </div>
            </div>
            <div class="collapse" id="accordion-autoCollapse3" role="tabpanel" aria-labelledby="accordion-autoHeading3">
              <div class="card-body">
                <p>По большинству распространенных марок — да. Перечень на сайте не полный, поэтому лучше уточнить возможность диагностики по конкретной модели.</p>
              </div>
            </div>
          </article>

        </div>
      </div>

    </div>
  </div>
</section>

<!-- Typical questions (strong “court-ready” block) -->
<section class="section section-lg bg-white">
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 text-center">
        <h6 class="wow fadeInUpSmall">практика</h6>
        <h2 class="wow fadeInUpSmall" data-wow-delay=".1s">Типовые вопросы эксперту</h2>
        <p class="wow fadeInUpSmall" data-wow-delay=".2s">
          Ниже — примеры формулировок, которые часто используются в досудебных заключениях и при назначении судебной автотехнической экспертизы.
          Конкретный перечень зависит от обстоятельств дела и имеющихся материалов.
        </p>
      </div>
    </div>

    <div class="row row-30 justify-content-center">

      <!-- Column 1 -->
      <div class="col-md-10 col-lg-6 wow fadeInUpSmall">
        <div class="services-divider__card">
          <h3 class="h5 mb-3">Техническое состояние и причины неисправности</h3>
          <ul class="list-marked">
            <li>Каково техническое состояние транспортного средства (или конкретного узла/агрегата) на момент осмотра?</li>
            <li>Имеются ли неисправности/повреждения? Каков их характер и степень?</li>
            <li>Какова наиболее вероятная причина возникновения выявленной неисправности/повреждения?</li>
            <li>Связана ли неисправность с нарушением правил эксплуатации, перегревом, недостатком смазки, внешним воздействием или износом?</li>
            <li>Могли ли выявленные дефекты возникнуть в результате проведенных ремонтных работ или вмешательства в конструкцию?</li>
          </ul>
        </div>
      </div>

      <!-- Column 2 -->
      <div class="col-md-10 col-lg-6 wow fadeInUpSmall" data-wow-delay=".06s">
        <div class="services-divider__card">
          <h3 class="h5 mb-3">Ремонт и качество выполненных работ</h3>
          <ul class="list-marked">
            <li>Соответствует ли выполненный ремонт заявленному объему работ и требованиям производителя/технологии ремонта?</li>
            <li>Имеются ли признаки некачественного ремонта, несоблюдения технологии или использования неподходящих материалов/запчастей?</li>
            <li>Находится ли выявленная неисправность в причинно-следственной связи с выполненными работами (или их отсутствием)?</li>
            <li>Требуется ли повторный ремонт/замена узла? Каков объем необходимых работ для восстановления работоспособности?</li>
            <li>Могли ли работы/диагностика быть выполнены с нарушением требований, повлиявших на итоговый результат?</li>
          </ul>
        </div>
      </div>

      <!-- Column 3 -->
      <div class="col-md-10 col-lg-6 wow fadeInUpSmall" data-wow-delay=".08s">
        <div class="services-divider__card">
          <h3 class="h5 mb-3">Кузов и следы вмешательств</h3>
          <ul class="list-marked">
            <li>Имеются ли на кузовных элементах признаки вторичной окраски/ремонта (перекрас, шпаклевка, локальные работы)?</li>
            <li>Есть ли признаки скрытых повреждений кузова/силовых элементов, не заявленных при продаже/ремонте?</li>
            <li>Соответствуют ли обнаруженные следы ремонта заявленным обстоятельствам (ДТП/страховому случаю/ремонту у СТО)?</li>
            <li>Имеются ли признаки механического вмешательства в элементы кузова или агрегаты, влияющего на безопасность/эксплуатацию?</li>
          </ul>
        </div>
      </div>

      <!-- Column 4 -->
      <div class="col-md-10 col-lg-6 wow fadeInUpSmall" data-wow-delay=".12s">
        <div class="services-divider__card">
          <h3 class="h5 mb-3">Электронные блоки, пробег и диагностические данные</h3>
          <ul class="list-marked">
            <li>Соответствуют ли диагностические данные электронных блоков заявленным характеристикам автомобиля (включая пробег/моточасы)?</li>
            <li>Имеются ли признаки корректировки пробега или вмешательства в электронные блоки управления?</li>
            <li>Согласуются ли показания пробега/моточасов в различных блоках между собой? Если нет — в чем выражаются расхождения?</li>
            <li>Имеются ли ошибки/события в памяти блоков, указывающие на характер неисправности или условия ее возникновения?</li>
            <li>Возможна ли проверка работоспособности отдельных электронных систем путем тестирования и какие результаты получены?</li>
          </ul>
        </div>
      </div>

    </div>

  </div>
</section>

<section class="bg-gray-100 py-4">
  <div class="container">
    <div class="profile-light">
      <div class="profile-light__main">
        <div class="profile-light__inner" style="max-width: 980px;">
          <h4 class="profile-light__title">Помогаем сформулировать вопросы</h4>
          <div class="profile-light__text">
            <p>
              Перед началом работы мы уточняем предмет доказывания и доступные материалы: документы по ремонту, акты, заказ-наряды,
              фото/видео, данные диагностик. После этого предлагаем корректные формулировки вопросов под вашу ситуацию —
              так, чтобы выводы были проверяемыми и пригодными для процессуальной оценки.
            </p>
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
          <h6 class="wow fadeInLeftSmall">оценка задачи</h6>
          <h2 class="wow fadeInLeftSmall" data-wow-delay=".1s">Нужна автотехническая экспертиза под суд?</h2>
          <p class="lead wow fadeInLeftSmall" data-wow-delay=".15s">
            Оставьте запрос — оценим материалы, уточним возможность диагностики по марке и предложим оптимальный формат работы.
          </p>
        </div>
      </div>
      <div class="col-lg-3 pb-4">
        <div class="bitcoin-widget bitcoin-widget_windowed bitcoin-widget_windowed-1">
          <a class="button button-primary" href="#b24-form">Оставить запрос</a>
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
