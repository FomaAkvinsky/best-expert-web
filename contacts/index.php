<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty('title','Контакты БЭСТ | судебная экспертиза и экспертно-правовое сопровождение');
$APPLICATION->SetPageProperty('description','Контакты БЭСТ: телефон, e-mail, форма обратной связи, карта и адрес. Свяжитесь с нами для оценки материалов и постановки задачи.');
$APPLICATION->SetPageProperty('canonical','https://'.$_SERVER['HTTP_HOST'].'/contacts/');

$APPLICATION->SetPageProperty('og_title','Контакты БЭСТ');
$APPLICATION->SetPageProperty('og_description','Телефон, e-mail, форма обратной связи и карта проезда. Оставьте запрос — мы оценим материалы и предложим формат работы.');

?>

<!-- HERO (internal) -->
<section class="section parallax-container section-md bg-gray-700 section-overlay-3"
         data-parallax-img="/local/templates/best/assets/images/features-parallax-1.jpg">
  <div class="material-parallax parallax">
    <img src="/local/templates/best/assets/images/features-parallax-1.jpg" alt="" style="display:block; transform: translate3d(-50%, 200px, 0px);">
  </div>

  <div class="parallax-content">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-10 col-lg-8">

          <ul class="brumbs-custom">
            <li><a href="/">Главная</a></li>
            <li class="active">Контакты</li>
          </ul>

          <h1 class="wow fadeInUpSmall">Контакты</h1>
          <p class="lead wow fadeInUpSmall" data-wow-delay=".1s">
            Напишите или позвоните — поможем быстро сориентироваться по формату работы и составу материалов.
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

<!-- CONTACTS -->
<section class="section section-lg bg-white">
  <div class="container">
    <div class="row row-50 justify-content-center justify-content-lg-between">

      <!-- Left: contacts + form -->
      <div class="col-md-10 col-lg-5">
        <h3 class="wow fadeInUpSmall">Свяжитесь с нами</h3>
        <p class="wow fadeInUpSmall" data-wow-delay=".05s">
          Удобнее всего начать с короткого описания ситуации и перечня документов — мы подскажем оптимальный следующий шаг.
        </p>

        <div class="row row-20 mt-4">

          <div class="col-12 wow fadeInUpSmall" data-wow-delay=".08s">
            <div class="contact-card">
              <div class="contact-card__title">Телефон</div>
              <div class="contact-card__value">
                <a href="tel:+79035220546">+7 903 522-0546</a>
              </div>
              <div class="contact-card__hint">Пн–Пт, 10:00–19:00 (МСК)</div>
            </div>
          </div>

          <div class="col-12 wow fadeInUpSmall" data-wow-delay=".12s">
            <div class="contact-card">
              <div class="contact-card__title">E-mail</div>
              <div class="contact-card__value">
                <a href="mailto:ask@best-expert.pro">ask@best-expert.pro</a>
              </div>
              <div class="contact-card__hint">Ответим и запросим материалы при необходимости</div>
            </div>
          </div>

          <div class="col-12 wow fadeInUpSmall" data-wow-delay=".16s">
            <div class="contact-card">
              <div class="contact-card__title">Адрес</div>
              <div class="contact-card__value">123098, Москва, ул. Академика Бочвара, 15, 6/2</div>
              <div class="contact-card__hint">Если планируется визит — лучше согласовать время заранее</div>
            </div>
          </div>

        </div>

      </div>

      <!-- Right: map -->
      <div class="col-md-10 col-lg-6">
        <h3 class="mb-3 wow fadeInUpSmall">Карта</h3>

        <div class="map-wrap wow fadeInUpSmall" data-wow-delay=".08s">
          <div id="yandex-map" class="yandex-map"></div>
        </div>

        <script>
          const BEST_MAP = {
            center: [55.803003, 37.455534],
            zoom: 15,
            caption: 'БЭСТ',
            balloon: 'БЭСТ — судебная экспертиза и экспертно-правовое сопровождение'
          };

          function initBestYandexMap() {
            if (!window.ymaps) return;

            ymaps.ready(function () {
              const map = new ymaps.Map('yandex-map', {
                center: BEST_MAP.center,
                zoom: BEST_MAP.zoom,
                controls: ['zoomControl']
              });

              const placemark = new ymaps.Placemark(BEST_MAP.center, {
                iconCaption: BEST_MAP.caption,
                balloonContent: BEST_MAP.balloon
              }, {
                preset: 'islands#darkBlueIcon'
              });

              map.geoObjects.add(placemark);
              map.behaviors.disable('scrollZoom'); // чтобы колесико не перехватывало прокрутку страницы
            });
          }

          // Подгружаем API один раз
          (function loadYMapsOnce(){
            if (window.ymaps) { initBestYandexMap(); return; }

            const s = document.createElement('script');
            s.async = true;
            s.src = 'https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=6ad2bbd6-5ab3-4680-ac91-68d137a6f07f';
            s.onload = initBestYandexMap;
            document.head.appendChild(s);
          })();
        </script>

      </div>

    </div>
	
	<div class="row justify-content-end" id="b24-form">
	  <div class="col-12 mb-4">
		<h3 class="wow fadeInUpSmall">Форма обратной связи</h3>
	  </div>
	  <div class="col-lg-8">
        <div class="application-form wow fadeInUpSmall" data-wow-delay=".08s">
          <?include($_SERVER["DOCUMENT_ROOT"].'/include/main-form.php');?>
        </div>
	  </div>
	</div>
	
  </div>
</section>

<style>
/* локально для страницы, если хочешь — перенеси в общий css */
.contact-card{
  background:#fff;
  /* border-radius:16px;*/
  padding:18px 18px;
  /* box-shadow:0 12px 36px rgba(0,0,0,.06); */
  border:1px solid rgba(0,0,0,.06);
}
.contact-card__title{
  font-size:12px;
  letter-spacing:.08em;
  text-transform:uppercase;
  opacity:.6;
  margin-bottom:6px;
}
.contact-card__value{
  font-size:18px;
  font-weight:600;
  margin-bottom:6px;
  color: #fab915;
}
.contact-card__hint{
  font-size:13px;
  opacity:.65;
}

.map-wrap{
  /* border-radius:16px; */
  overflow:hidden;
  border:1px solid rgba(0,0,0,.06);
  /* box-shadow:0 12px 36px rgba(0,0,0,.06); */
  background:#fff;
}
.yandex-map{
  width:100%;
  height:420px;
}
.map-caption{
  padding:14px 16px 16px;
}
.map-caption__title{
  font-weight:600;
  margin-bottom:4px;
}
.map-caption__text{
  opacity:.7;
  line-height:1.45;
}
</style>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
