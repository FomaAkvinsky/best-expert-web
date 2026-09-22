<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty(
  'title',
  'Судебные экспертизы БЭСТ | технические, экономические и документальные исследования'
);

$APPLICATION->SetPageProperty(
  'description',
  'Судебные экспертизы БЭСТ: автотехнические, строительно-технические, финансово-экономические, почерковедческие и комплексные исследования. Методика, проверяемость выводов и процессуальная устойчивость заключений.'
);

$APPLICATION->SetPageProperty(
  'canonical',
  'https://'.$_SERVER['HTTP_HOST'].'/services/sudebnye-ekspertizy/'
);

$APPLICATION->SetPageProperty(
  'og_title',
  'Судебные экспертизы БЭСТ — проверяемость и устойчивость выводов'
);

$APPLICATION->SetPageProperty(
  'og_description',
  'Технические, экономические и документальные судебные экспертизы. Корректная постановка вопросов, контроль качества и защита выводов в процессе.'
);


?>

<!-- HERO (internal) -->
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
            <li><a href="/services/">Услуги</a></li>
            <li class="active">Судебные экспертизы</li>
          </ul>

          <h1>Судебные экспертизы</h1>
          <p class="lead">
            Экспертные исследования, подготовленные с учетом процессуальных требований,
            проверяемости методики и устойчивости выводов к оспариванию.
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
          <h4 class="profile-light__title">Судебная экспертиза — это процесс</h4>
          <div class="profile-light__text">
            <p>
              Мы выстраиваем управляемый экспертный результат: корректная постановка вопросов,
              исследование по методике, контроль логики и качества, заключение,
              пригодное для процессуальной оценки.
            </p>
            <p>
              Это снижает риск оспаривания и повторных экспертиз и помогает держать спор под контролем.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TYPES / structure (like services page, but for judicial expertise) -->
<section class="section section-lg bg-white">
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 text-center">
        <h6 class="wow fadeInUpSmall">направления</h6>
        <h2 class="wow fadeInUpSmall" data-wow-delay=".1s">Виды судебных экспертиз</h2>
        <p class="wow fadeInUpSmall" data-wow-delay=".2s">
          Подбираем формат под задачу и состав материалов — так, чтобы выводы были проверяемыми и устойчивыми в процессе.
        </p>
      </div>
    </div>

    <div class="row row-50">

      <!-- GROUP A -->
      <div class="col-xl-9 wow fadeInUpSmall">
        <h3 class="h4">Технические экспертизы</h3>
        <p>
          Исследования технического состояния, причин повреждений и качества выполненных работ — с фиксацией исходных данных,
          применяемых методик и диагностических протоколов.
        </p>

        <div class="row row-30">

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="/services/sudebnye-ekspertizy/avtotehnicheskaya-ekspertiza/">
              <span class="icon link-box__icon linearicons-car2"></span>
              <div class="link-box__main">
                <h4>Автотехническая экспертиза</h4>
                <p>Техническое состояние, причины неисправностей, качество ремонта, диагностика электронных систем, пробег/моточасы.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-hammer-wrench"></span>
              <div class="link-box__main">
                <h4>Строительно-техническая экспертиза</h4>
                <p>Качество и объем работ, дефекты, причины повреждений, соответствие проекту и нормативам.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-factory"></span>
              <div class="link-box__main">
                <h4>Инженерно-техническая экспертиза</h4>
                <p>Исследование узлов, оборудования, механизмов, производственных систем и причин отказов.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-cart"></span>
              <div class="link-box__main">
                <h4>Товароведческая экспертиза</h4>
                <p>Качество, комплектность, причины дефектов, соответствие характеристикам и условиям эксплуатации.</p>
              </div>
            </a>
          </div>

        </div>
      </div>

      <!-- GROUP B -->
      <div class="col-xl-9 mt-5 wow fadeInUpSmall" data-wow-delay=".06s">
        <h3 class="h4">Экономические и оценочные экспертизы</h3>
        <p>
          Финансовые расчеты, оценка стоимости и обоснование экономических показателей — в формате, пригодном для судебной оценки.
        </p>

        <div class="row row-30">

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-chart-bars"></span>
              <div class="link-box__main">
                <h4>Финансово-экономическая экспертиза</h4>
                <p>Анализ финансовых показателей, расчет экономических параметров и проверка обоснованности доводов сторон.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-calculator"></span>
              <div class="link-box__main">
                <h4>Бухгалтерская экспертиза</h4>
                <p>Проводки, первичные документы, корректность учета, взаиморасчеты, задолженности.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-diamond2"></span>
              <div class="link-box__main">
                <h4>Оценочная экспертиза</h4>
                <p>Оценка стоимости активов, долей, имущества и прав — с учетом требований к отчетам и доказательствам.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-warning"></span>
              <div class="link-box__main">
                <h4>Расчет убытков и упущенной выгоды</h4>
                <p>Проверяемость формул, исходных данных и причинно-следственных связей — без "оценочных допущений в воздухе".</p>
              </div>
            </a>
          </div>

        </div>
      </div>

      <!-- GROUP C -->
      <div class="col-xl-9 mt-5 wow fadeInUpSmall" data-wow-delay=".08s">
        <h3 class="h4">Документальные экспертизы</h3>
        <p>
          Когда документ — ключевое доказательство: исследуем подлинность, давность и признаки вмешательств, оформляя выводы в проверяемом виде.
        </p>

        <div class="row row-30">

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-pen2"></span>
              <div class="link-box__main">
                <h4>Почерковедческая экспертиза</h4>
                <p>Исследование подписей и рукописных записей, сравнение образцов, выводы о выполнителе.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-file-search"></span>
              <div class="link-box__main">
                <h4>Техническая экспертиза документов</h4>
                <p>Признаки подделки, внесения изменений, способы изготовления, печати и реквизиты.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-hourglass"></span>
              <div class="link-box__main">
                <h4>Определение давности документа</h4>
                <p>Исследование времени нанесения реквизитов и последовательности выполнения записей/подписей.</p>
              </div>
            </a>
          </div>

        </div>
      </div>

      <!-- GROUP D -->
      <div class="col-xl-9 mt-5 wow fadeInUpSmall" data-wow-delay=".1s">
        <h3 class="h4">Комплексные и проверочные форматы</h3>
        <p>
          Когда один вид исследования не закрывает задачу, используем комплексный подход или проверяем уже подготовленные заключения.
        </p>

        <div class="row row-30">

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-puzzle"></span>
              <div class="link-box__main">
                <h4>Комплексная экспертиза</h4>
                <p>Несколько направлений исследования с единои логикой выводов и одним контуром ответственности.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-repeat"></span>
              <div class="link-box__main">
                <h4>Повторная и дополнительная экспертиза</h4>
                <p>Когда требуется уточнение, расширение объема вопросов или проверка корректности ранее проведенного исследования.</p>
              </div>
            </a>
          </div>

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
              <span class="icon link-box__icon linearicons-check"></span>
              <div class="link-box__main">
                <h4>Рецензирование экспертных заключений</h4>
                <p>Анализ методики, полноты материалов и логики выводов для оценки уязвимостей и подготовки позиции.</p>
              </div>
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<!-- Small FAQ / clarifying block (accordion like on main) -->
<section class="section section-lg bg-gray-100">
  <div class="container">
    <div class="row row-40 justify-content-center">

      <div class="col-md-10 col-lg-6">
        <h3>Как выбрать нужный формат</h3>
        <div class="divider-modern"></div>
        <p>
          Если вы не уверены, какой вид экспертизы нужен, мы начинаем с оценки материалов и процессуального контекста:
          что именно требуется доказать, какие риски оспаривания возможны, какие вопросы корректно ставить.
        </p>
      </div>

      <div class="col-md-10 col-lg-6">
        <div class="card-group-custom card-group-line" id="accordion-services" role="tablist" aria-multiselectable="true">

          <article class="card card-custom card-line">
            <div class="card-header" id="accordion-servicesHeading1" role="tab">
              <div class="card-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-services"
                   data-target="#accordion-servicesCollapse1" href="#" onclick="return false;"
                   aria-controls="accordion-servicesCollapse1" aria-expanded="false">
                  Что нужно для первичной оценки?
                  <div class="card-arrow"></div>
                </a>
              </div>
            </div>
            <div class="collapse" id="accordion-servicesCollapse1" role="tabpanel" aria-labelledby="accordion-servicesHeading1">
              <div class="card-body">
                <p>Краткое описание спора, перечень документов и материалов, вопросы (если уже сформированы) и срок, к которому нужен результат.</p>
              </div>
            </div>
          </article>

          <article class="card card-custom card-line">
            <div class="card-header" id="accordion-servicesHeading2" role="tab">
              <div class="card-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-services"
                   data-target="#accordion-servicesCollapse2" href="#" onclick="return false;"
                   aria-controls="accordion-servicesCollapse2" aria-expanded="false">
                  Можно ли подключиться до назначения экспертизы судом?
                  <div class="card-arrow"></div>
                </a>
              </div>
            </div>
            <div class="collapse" id="accordion-servicesCollapse2" role="tabpanel" aria-labelledby="accordion-servicesHeading2">
              <div class="card-body">
                <p>Да. Мы помогаем корректно поставить вопросы и собрать материалы так, чтобы снизить риск повторных экспертиз и процессуальных затяжек.</p>
              </div>
            </div>
          </article>

          <article class="card card-custom card-line">
            <div class="card-header" id="accordion-servicesHeading3" role="tab">
              <div class="card-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-services"
                   data-target="#accordion-servicesCollapse3" href="#" onclick="return false;"
                   aria-controls="accordion-servicesCollapse3" aria-expanded="false">
                  Делаете ли вы разъяснения в суде?
                  <div class="card-arrow"></div>
                </a>
              </div>
            </div>
            <div class="collapse" id="accordion-servicesCollapse3" role="tabpanel" aria-labelledby="accordion-servicesHeading3">
              <div class="card-body">
                <p>При необходимости обеспечиваем экспертное сопровождение: разъяснение методики и выводов, ответы на вопросы сторон и суда.</p>
              </div>
            </div>
          </article>

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
          <h2 class="wow fadeInLeftSmall" data-wow-delay=".1s">Нужна экспертиза, которая выдержит процессуальное давление?</h2>
          <p class="lead wow fadeInLeftSmall" data-wow-delay=".15s">
            Оставьте запрос — мы оценим материалы, риски и предложим оптимальный формат работы и сроки.
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
