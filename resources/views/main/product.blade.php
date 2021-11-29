@include('parts/header')
<div class="product__container">
  <div class="product__main">
    <div class="main__img"><img src="/staticfiles/img/{{ $product->img }}" alt=""></div>
    <div class="main__about">
      <div class="main__name"><span class="main__name__text">{{ $product->name }}</span></div>
      <div class="main__price">
        <div class="main__price__actual"><span class="price__actual__text">{{ $product->price }} ₽</span></div>
        @if ($product->previoues_price)
        <div class="main__price__prev"><span class="price__prev__text">{{ $product->previous_price }} ₽</span></div>
        @endif
      </div>
      <!-- <div class="main__buy"><span class="main__buy__text">В корзину</span><div class="main__cart"></div></div> -->
      <div class="main__counter"><div class="main__counter__minus"><span class="counter__minus__text">-</span></div><div class="main__counter__number"><input type="text" maxlength="3" class="counter__number__input"></div><div class="main__counter__plus"><span class="counter__plus__text">+</span></div></div>
    </div>
  </div>
  @if ($product->year || $product->publisher || $product->cover || $product->author)
  <div class="product__info">
    <div class="info__title"><span class="title__text">Описание</span></div>
    <div class="info__card">
      @if ($product->year)
      <div class="card__row"><span class="row__text">Год выпуска: </span><span class="row__value">{{ $product->year }}</span></div>
      @endif
      @if ($product->publisher)
      <div class="card__row"><span class="row__text">Издатель: </span><span class="row__value">{{ $product->publisher }}</span></div>
      @endif
      @if ($product->author)
      <div class="card__row"><span class="row__text">Автор: </span><span class="row__value">{{ $product->author }}</span></div>
      @endif
      @if ($product->cover)
      <div class="card__row"><span class="row__text">Переплет: </span><span class="row__value">{{ $product->cover }}</span></div>
      @endif
    </div>
  </div>
  @endif
  <div class="product__feedback">
    <div class="feedback__title"><span class="title__text">Отзывы</span></div>
    <div class="feedback__card">
      <div class="card__title">
        <div class="card__title__user">
          <div class="user__img">
            <img src="/staticfiles/img/no-user-image-icon.jpg" alt="">
          </div>
          <span class="user__name">Пользователь</span>
        </div>
        <div class="card__title__grade">
          <div class="grade__star active"></div>
          <div class="grade__star active"></div>
          <div class="grade__star active"></div>
          <div class="grade__star active"></div>
          <div class="grade__star"></div>
        </div>
      </div>
      <div class="card__body">
        <span class="body__text">Отличная книга. Классика своего времени. Всем рекомендую к прочтению! Но к издательству есть вопросы с качеством бумаги, ставлю 4.</span>
      </div>
    </div>
    <div class="feedback__card">
      <div class="card__title">
        <div class="card__title__user">
          <div class="user__img">
            <img src="/staticfiles/img/no-user-image-icon.jpg" alt="">
          </div>
          <span class="user__name">Пользователь</span>
        </div>
        <div class="card__title__grade">
          <div class="grade__star active"></div>
          <div class="grade__star active"></div>
          <div class="grade__star active"></div>
          <div class="grade__star active"></div>
          <div class="grade__star active"></div>
        </div>
      </div>
      <div class="card__body">
        <span class="body__text">Пук-пук среньк</span>
      </div>
    </div>
  </div>
  <div class="product__similiar">
    <div class="similiar__title"><span class="title__text">Похожие товары</span></div>
    <div class="similiar__items">
      <div class="items__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__buy"><span class="card__buy__text">В корзину</span><div class="card__cart"></div></div>
      </div>
      <div class="items__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__buy"><span class="card__buy__text">В корзину</span><div class="card__cart"></div></div>
      </div>
      <div class="items__card">
        <div class="card__img"><img src="/staticfiles/img/LOTR.jpg" alt=""></div>
        <div class="card__name"><span class="card__name__text">Властелин колец</span></div>
        <div class="card__price"><div class="card__price__prev"><span class="price__prev__text">650 ₽</span></div><div class="card__price__actual"><span class="price__actual__text">450 ₽</span></div></div>
        <div class="card__buy"><span class="card__buy__text">В корзину</span><div class="card__cart"></div></div>
      </div>
    </div>
  </div>
</div>
@include('parts/footer')