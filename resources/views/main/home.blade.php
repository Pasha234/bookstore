@include('parts.header')
<div class="home__container">
  <div class="home__slider" id="slider">
    <div class="slider__img__container">
      <div class="slider__arrow__left" id="slider_arrow_left"></div>
      <div class="slider__img" id="slider_img_container"><a href="/offer/1"><img style="display: block;" src="/staticfiles/img/books.jpg" alt="" data-number="1"></a><a href="/offer/2"><img style="display: none;" src="/staticfiles/img/LOTR.jpg" alt="" data-number="2"></a></div>
      <div class="slider__arrow__right" id="slider_arrow_right"></div>
    </div>
    <div class="slider__pagination" id="slider_pagination">
      <div class="pagination__dot active" data-dot="true" data-number="1"></div>
      <div class="pagination__dot" data-dot="true" data-number="2"></div>
    </div>
    <div class="slider__container__text" id="sliderText"><a href="/offer/1"><span class="text" data-number="1">Распродажа на книги издательства АСТ</span></a><a href="/offer/2"><span class="text" style="display:none" data-number="2">Я жидко пернул)))</span></a></div>
  </div>
  <div class="home__categories" id="categories">
    <div class="categories__container__text"><span class="text" id="categoriesText">Категории</span></div>
    <div class="categories__card">
      <div class="card__img">
        <a href=""><img src="/staticfiles/img/LOTR.jpg" alt=""></a>
      </div>
      <div class="card__container__text">
        <a href="/"><span class="card__text">Художественная литература</span></a>
      </div>
    </div>
    <div class="categories__card">
      <div class="card__img">
        <a href=""><img src="/staticfiles/img/economic.jpg" alt=""></a>
      </div>
      <div class="card__container__text">
        <a href=""><span class="card__text">Нехудожественная литература</span></a>
      </div>
    </div>
    <div class="categories__card">
      <div class="card__img">
        <a href=""><img src="/staticfiles/img/elec_book.jpg" alt=""></a>
      </div>
      <div class="card__container__text">
        <a href=""><span class="card__text">Электронные книги</span></a>
      </div>
    </div>
    <div class="categories__card">
      <div class="card__img">
        <a href=""><img src="/staticfiles/img/audiobook.jpg" alt=""></a>
      </div>
      <div class="card__container__text">
        <a href=""><span class="card__text">Аудиокниги</span></a>
      </div>
    </div>
  </div>
  <div class="home__discount" id="discount">
    <div class="discount__title">
      <span class="discount__title__text">Сейчас со скидкой</span>
    </div>
    <div class="discount__items">
      <div class="items__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__counter"><div class="card__counter__minus"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" maxlength="3" class="counter__number__input"></div><div class="card__counter__plus"><span class="counter__plus__text">+</span></div></div>
      </div>
      <div class="items__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__counter"><div class="card__counter__minus"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" maxlength="3" class="counter__number__input"></div><div class="card__counter__plus"><span class="counter__plus__text">+</span></div></div>
      </div>
      <div class="items__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__counter"><div class="card__counter__minus"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" maxlength="3" class="counter__number__input"></div><div class="card__counter__plus"><span class="counter__plus__text">+</span></div></div>
      </div>
      <div class="items__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__counter"><div class="card__counter__minus"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" maxlength="3" class="counter__number__input"></div><div class="card__counter__plus"><span class="counter__plus__text">+</span></div></div>
      </div>
      <div class="items__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__counter"><div class="card__counter__minus"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" maxlength="3" class="counter__number__input"></div><div class="card__counter__plus"><span class="counter__plus__text">+</span></div></div>
      </div>
      <div class="items__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__counter"><div class="card__counter__minus"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" maxlength="3" class="counter__number__input"></div><div class="card__counter__plus"><span class="counter__plus__text">+</span></div></div>
      </div>
      <div class="items__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__counter"><div class="card__counter__minus"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" maxlength="3" class="counter__number__input"></div><div class="card__counter__plus"><span class="counter__plus__text">+</span></div></div>
      </div>
    </div>
  </div>
  <div class="home__offer" id="offer_one">
    <div class="offer__img"><img src="/staticfiles/img/anime.png" alt=""></div>
    <div class="offer__info">
      <div class="offer__title"><span class="offer__title__text">Снова в школу!</span></div>
      <div class="offer__text"><p class="offer__text__paragraph">Подготовьте своего ребенка в школу вместе с BookStore. Скидка на учебники, тетради, ручки и рюкзаки для школы.</p></div>
      <div class="offer__link"><a href="">Перейти к списку товаров</a></div>
    </div>
  </div>
  <div class="home__compilation" id="comp_one">
    <div class="compilation__info">
      <div class="compilation__title"><span class="compilation__title__text">Книги, которые согреют ваш вечер</span></div>
      <div class="compilation__text"><p class="compilation__text__paragraph">Подборка книг для грядущих холодов (Не забудьте взять к ним теплые носки и чашку горячего чая)</p></div>
      <div class="compilation__link"><a href="">Смотреть подборку...</a></div>
    </div>
    <div class="compilation__img"><img src="/staticfiles/img/compilation.png" alt=""></div>
  </div>
</div>
<script src="/staticfiles/js/slider.js"></script>
@include('parts.footer')