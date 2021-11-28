@include('parts.header')
<div class="catalog__container">
  <div class="catalog__title"><span class="catalog__title__text">Каталог</span></div>
  <div class="catalog__item__container">
    <div class="catalog__item">
      <div class="catalog__item__img">
        <a href=""><img src="/staticfiles/img/LOTR.jpg" alt=""></a>
      </div>
      <div class="catalog__item__title">
        <a class="title__text" href="">Художественная литература</a>
      </div>
    </div>
    <div class="catalog__item">
      <div class="catalog__item__img">
        <img src="/staticfiles/img/economic.jpg" alt="">
      </div>
      <div class="catalog__item__title">
        <span class="title__text">Нехудожественная литература</span>
      </div>
    </div>
    <div class="catalog__item">
      <div class="catalog__item__img">
        <img src="/staticfiles/img/audiobook.jpg" alt="">
      </div>
      <div class="catalog__item__title">
        <span class="title__text">Аудиокниги</span>
      </div>
    </div>
    <div class="catalog__item">
      <div class="catalog__item__img">
        <img src="/staticfiles/img/elec_book.jpg" alt="">
      </div>
      <div class="catalog__item__title">
        <span class="title__text">Электронные книги</span>
      </div>
    </div>
    <div class="catalog__item">
      <div class="catalog__item__img">
        <img src="/staticfiles/img/otkrytka.jpg" alt="">
      </div>
      <div class="catalog__item__title">
        <span class="title__text">Открытки</span>
      </div>
    </div>
    <div class="catalog__item">
      <div class="catalog__item__img">
        <img src="/staticfiles/img/stationery.png" alt="">
      </div>
      <div class="catalog__item__title">
        <span class="title__text">Канцтовары</span>
      </div>
    </div>
  </div>
</div>
@include('parts.footer')