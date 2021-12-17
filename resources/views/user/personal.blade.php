@include('parts.header')
<div class="personal__container">
  <div class="personal__card">
    <div class="card__info">
      <div class="card__img"><img src="/staticfiles/img/no-user-image-icon.jpg" alt=""></div>
      <div class="card__name"><span class="card__name__text">{{ $user->name }}</span></div>
    </div>
    <div class="personal__change"><span class="personal__change__text">Сменить аватар</span></div>
  </div>
  <div class="personal__quit"><a href="/quit" class="quit__text">Выйти</a></div>
  <div class="personal__orders">
    <div class="orders__title"><div class="orders__title__text">Заказы</div></div>
    <div class="orders__items">
      <div class="orders__item">
        <a href="" class="item__title">Заказ №12345</a>
      </div>
      <div class="orders__item">
        <a href="" class="item__title">Заказ №12345</a>
      </div>
      <div class="orders__item">
        <a href="" class="item__title">Заказ №12345</a>
      </div>
    </div>
  </div>
</div>
@include('parts.footer')