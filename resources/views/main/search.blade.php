@include('parts/header')
<div class="search__container">
  <div class="search__parameters">
    <div class="parameters__direction">
      <div class="direction__title"><span class="direction__title__text">Направление</span></div>
      <div class="direction__fields">
        <div class="direction__field"><input type="checkbox" id="direction1" class="direction__field__input" checked /><label for="direction1" class="direction__field__label">О войне</label></div>
        <div class="direction__field"><input type="checkbox" id="direction2" class="direction__field__input" checked /><label for="direction2" class="direction__field__label">Классика</label></div>
        <div class="direction__field"><input type="checkbox" id="direction3" class="direction__field__input" checked /><label for="direction3" class="direction__field__label">Фантастика</label></div>
        <div class="direction__field"><input type="checkbox" id="direction4" class="direction__field__input" checked /><label for="direction4" class="direction__field__label">Фентези</label></div>
      </div>
    </div>
    <div class="parameters__price">
      <div class="price__title"><span class="price__title__text">Цена, ₽</span></div>
      <div class="price__fields"><div class="price__field"><p class="field__paragraph">От</p><input type="text" class="field__input" id="firstPrice" /></div><div class="price__field"><p class="field__paragraph">До</p><input type="text" class="field__input" id="lastPrice" /></div></div>
    </div>
    <div class="parameters__input">
      <div class="input__title"><span class="input__title__text">Поиск</span></div>
      <div class="input__field__container"><input type="text" class="input__field"><div class="input__submit"></div></div>
    </div>
  </div>
  <div class="search__results">
    <div class="results__container">
      <div class="results__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__buy"><span class="card__buy__text">В корзину</span><div class="card__cart"></div></div>
      </div>
      <div class="results__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__counter"><div class="card__counter__minus"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" maxlength="3" class="counter__number__input"></div><div class="card__counter__plus"><span class="counter__plus__text">+</span></div></div>
      </div>
      <div class="results__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец Дж. Р.Р. Толкиен</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__counter"><div class="card__counter__minus"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" maxlength="3" class="counter__number__input"></div><div class="card__counter__plus"><span class="counter__plus__text">+</span></div></div>
      </div>
    </div>
  </div>
  <div class="search__categories">
    <div class="categories__title">
      <span class="categories__title__text">Категории</span>
    </div>
    <div class="categories__list">
      <ul>
        <li><a href="">Аудиокниги</a></li>
        <li><a href="">Электронные книги</a></li>
        <li><a href="">Художественная литература</a></li>
        <li><a href="">Нехудожественная литература</a></li>
        <li><a href="">Открытки</a></li>
        <li><a href="">Канцтовары</a></li>
      </ul>
    </div>
  </div>
</div>
@include('parts/footer')