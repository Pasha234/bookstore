@include('parts.header')
<div class="order__container">
  <div class="order__title">
    <span class="order__title__text">Заказ №12345</span>
  </div>
  <div class="order__info">
    <div class="info__title">
      <span class="info__title__text">Описание</span>
    </div>
    <div class="info__card">
      <div class="card__row"><span class="row__title">Имя получателя: </span><span class="row__value">Казаков В.В.</span></div>
      <div class="card__row"><span class="row__title">Адрес доставки: </span><span class="row__value">г. Н. Тагил, ул. Колотушкина, 8</span></div>
      <div class="card__row"><span class="row__title">Ориентировочная дата доставки: </span><span class="row__value">2 сентября, 17:00 - 20:00</span></div>
      <div class="card__row"><span class="row__title">Сумма: </span><span class="row__value">23000 ₽</span></div>
    </div>
  </div>
  <div class="order__inner">
    <div class="inner__title">
      <span class="inner__title__text">Содержимое</span>
    </div>
    <div class="inner__card">
      <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
      <div class="card__info">
        <div class="info__title"><span class="info__title__text">Властелин Колец</span></div>
        <div class="info__number"><span class="number__value">1</span><span class="number__text"> шт.</span></div>
        <div class="info__price"><span class="price__value">450</span><span class="price__text"> ₽</span></div>
      </div>
    </div>
    <div class="inner__card">
      <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
      <div class="card__info">
        <div class="info__title"><span class="info__title__text">Властелин Колец</span></div>
        <div class="info__number"><span class="number__value">1</span><span class="number__text"> шт.</span></div>
        <div class="info__price"><span class="price__value">450</span><span class="price__text"> ₽</span></div>
      </div>
    </div>
    <div class="inner__card">
      <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
      <div class="card__info">
        <div class="info__title"><span class="info__title__text">Властелин Колец</span></div>
        <div class="info__number"><span class="number__value">1</span><span class="number__text"> шт.</span></div>
        <div class="info__price"><span class="price__value">450</span><span class="price__text"> ₽</span></div>
      </div>
    </div>
  </div>
</div>
@include('parts.footer')