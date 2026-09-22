<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty('title','Услуги БЭСТ | судебные экспертизы и экспертно-правовое сопровождение');
$APPLICATION->SetPageProperty('description','Услуги БЭСТ: судебные экспертизы, экспертизы документов, комплексные исследования, экспертное сопровождение, финансово-экономические экспертизы, Due Diligence и юридическое сопровождение. Методика, контроль качества, устойчивость выводов.');
$APPLICATION->SetPageProperty('canonical','https://'.$_SERVER['HTTP_HOST'].'/services/');

$APPLICATION->SetPageProperty('og_title','Услуги БЭСТ — экспертиза и право как единая система');
$APPLICATION->SetPageProperty('og_description','Судебные экспертизы и экспертно-правовое сопровождение сложных споров. Управляемый процесс, контроль качества и снижение риска оспаривания.');

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
            <li class="active">Услуги</li>
          </ul>

          <h1 class="wow fadeInUpSmall">Услуги БЭСТ</h1>
          <p class="lead wow fadeInUpSmall" data-wow-delay=".1s">
            Экспертиза и право как единая доказательственная система: методика, контроль качества и процессуальная устойчивость выводов.
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
          <h4 class="profile-light__title">Мы не продаем "виды экспертиз"</h4>
          <div class="profile-light__text">
            <p>
              Мы выстраиваем управляемый экспертный результат: корректная постановка задачи и вопросов,
              исследование по методике, контроль логики и качества, заключение, пригодное для процессуальной оценки.
            </p>
            <p>
              Это снижает риск оспаривания и повторных экспертиз и помогает держать процесс под контролем.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Services (two big groups) -->
<section class="section section-lg bg-white">
  <div class="container">

    <div class="row row-50">

      <!-- GROUP 1 -->
      <div class="col-xl-9 wow fadeInUpSmall">
        <h3 class="h4">Судебно-экспертные исследования</h3>
        <p>
          Экспертизы, выстроенные как технологический процесс и рассчитанные на работу в суде: проверяемая логика, контроль качества и ответственность за выводы.
        </p>

        <div class="row row-30">

          <div class="col-12">
            <a class="link-box" style="max-width:100%" href="/services/sudebnye-ekspertizy/" onclick="return false;">
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

      <!-- GROUP 2 -->
      <div class="col-xl-9 mt-5 wow fadeInUpSmall" data-wow-delay=".08s">
        <h3 class="h4">Юридические и экспертно-правовые услуги</h3>
        <p>
          Работаем там, где стандартной юридической практики недостаточно, а результат зависит от качества экспертизы, расчетов и доказательной базы.
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
                <p>Корпоративные, строительные, имущественные споры и взыскание убытков — когда "цифры важнее эмоций".</p>
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
                   data-target="#accordion-servicesCollapse1" href="#" onclick="return false;" aria-controls="accordion-servicesCollapse1" aria-expanded="false">
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
                   data-target="#accordion-servicesCollapse2" href="#" onclick="return false;" aria-controls="accordion-servicesCollapse2" aria-expanded="false">
                  Можно ли подключиться до назначения экспертизы судом?
                  <div class="card-arrow"></div>
                </a>
              </div>
            </div>
            <div class="collapse" id="accordion-servicesCollapse2" role="tabpanel" aria-labelledby="accordion-servicesHeading2">
              <div class="card-body">
                <p>Да. Мы консультируем по корректной постановке вопросов и составу материалов, чтобы снизить риск повторных экспертиз и процессуальных затяжек.</p>
              </div>
            </div>
          </article>

          <article class="card card-custom card-line">
            <div class="card-header" id="accordion-servicesHeading3" role="tab">
              <div class="card-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-services"
                   data-target="#accordion-servicesCollapse3" href="#" onclick="return false;" aria-controls="accordion-servicesCollapse3" aria-expanded="false">
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
