@include('parts.header')
<div class="home__container" id="container">
  <div class="home__slider" id="slider">
    <div class="slider__img__container">
      <div class="slider__arrow__left" id="slider_arrow_left"></div>
      <div class="slider__img" id="slider_img_container">
        @foreach($slider_offers as $key => $offer)
        @if($key == 0)
        <a href="/offer/{{ $offer->id }}"><img style="display: block;" src="/staticfiles/img/{{ $offer->img }}" alt="" data-number="{{ $key + 1 }}"></a>
        @else
        <a href="/offer/{{ $offer->id }}"><img style="display: none;" src="/staticfiles/img/{{ $offer->img }}" alt="" data-number="{{ $key + 1 }}"></a>
        @endif
        @endforeach
      </div>
      <div class="slider__arrow__right" id="slider_arrow_right"></div>
    </div>
    <div class="slider__pagination" id="slider_pagination">
      @foreach($slider_offers as $key => $offer)
      @if($key == 0)
      <div class="pagination__dot active" data-dot="true" data-number="{{ $key + 1 }}"></div>
      @else
      <div class="pagination__dot" data-dot="true" data-number="{{ $key + 1 }}"></div>
      @endif
      @endforeach
    </div>
    <div class="slider__container__text" id="sliderText">
      @foreach($slider_offers as $key => $offer)
      @if($key == 0)
      <a href="/offer/{{ $offer->id }}"><span class="text" data-number="{{ $key + 1 }}">{{ $offer->title }}</span></a>
      @else
      <a href="/offer/{{ $offer->id }}"><span class="text" style="display:none" data-number="{{ $key + 1 }}">{{ $offer->title }}</span></a>
      @endif
      @endforeach
    </div>
  </div>
  <div class="home__categories" id="categories">
    <div class="categories__container__text"><span class="text" id="categoriesText">Категории</span></div>
    <div class="categories__card">
      <div class="card__img">
        <a href="/fiction/search"><img src="/staticfiles/img/LOTR.jpg" alt=""></a>
      </div>
      <div class="card__container__text">
        <a href="/fiction/search"><span class="card__text">Художественная литература</span></a>
      </div>
    </div>
    <div class="categories__card">
      <div class="card__img">
        <a href="/nonfiction/search"><img src="/staticfiles/img/economic.jpg" alt=""></a>
      </div>
      <div class="card__container__text">
        <a href="/nonfiction/search"><span class="card__text">Нехудожественная литература</span></a>
      </div>
    </div>
    <div class="categories__card">
      <div class="card__img">
        <a href="/elecbooks/search"><img src="/staticfiles/img/elec_book.jpg" alt=""></a>
      </div>
      <div class="card__container__text">
        <a href="/elecbooks/search"><span class="card__text">Электронные книги</span></a>
      </div>
    </div>
    <div class="categories__card">
      <div class="card__img">
        <a href="/audiobooks/search"><img src="/staticfiles/img/audiobook.jpg" alt=""></a>
      </div>
      <div class="card__container__text">
        <a href="/audiobooks/search"><span class="card__text">Аудиокниги</span></a>
      </div>
    </div>
  </div>
  <div class="home__discount" id="discount">
    <div class="discount__title">
      <span class="discount__title__text">Сейчас со скидкой</span>
    </div>
    <div class="discount__items">
      <div class="items__card" v-for="(item, index) in discountItems">
        <div class="card__img"><a :href="'/product/' + item.id"><img :src="'/staticfiles/img/' + item.img" alt=""></a></div>
        <div class="card__name"><a :href="'/product/' + item.id" class="card__name__text">@{{ item.name }}</a></div>
        <div class="card__price"><div class="card__price__prev" v-if="item.previous_price"><span class="price__prev__text">@{{ item.previous_price }} ₽</span></div><div class="card__price__actual"><span class="price__actual__text">@{{ item.price }} ₽</span></div></div>
        <div v-if="item.quantity" class="card__counter" :data-id="item.shoplist_id" data-item_id="item.id"><div class="card__counter__minus" @click="decrementCounter(index)"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" @input="inputQuantity($event, index)" maxlength="3" :value="item.quantity" class="counter__number__input"></div><div class="card__counter__plus" @click="incrementCounter(index)"><span class="counter__plus__text">+</span></div></div>
        <div v-else class="card__buy" @click="addInShoplist(index)" :data-id="item.id"><span class="card__buy__text">В корзину</span><div class="card__cart"></div></div>
      </div>
    </div>
  </div>
  @foreach($offers as $offer)
  @if($offer['on_homepage'] == 1)
  @if($offer['is_compilation'] == 0)
  <div class="home__offer">
    <div class="offer__img"><a href="/offer/{{ $offer->id }}"><img src="/staticfiles/img/{{ $offer->img }}" alt=""></a></div>
    <div class="offer__info">
      <div class="offer__title"><a href="/offer/{{ $offer->id }}" class="offer__title__text">{{ $offer->title }}</a></div>
      <div class="offer__text"><p class="offer__text__paragraph">{{ $offer->description }}</p></div>
      <div class="offer__link"><a href="/offer/{{ $offer->id }}">Перейти к списку товаров</a></div>
    </div>
  </div>
  @endif
  @endif
  @endforeach
  @foreach($offers as $offer)
  @if($offer['on_homepage'] == 1)
  @if($offer['is_compilation'] == 1)
  <div class="home__compilation">
    <div class="compilation__info">
      <div class="compilation__title"><a href="/offer/{{ $offer->id }}" class="compilation__title__text">{{ $offer->title }}</a></div>
      <div class="compilation__text"><p class="compilation__text__paragraph">{{ $offer->description }}</p></div>
      <div class="compilation__link"><a href="/offer/{{ $offer->id }}">Смотреть подборку...</a></div>
    </div>
    <div class="compilation__img"><a href="/offer/{{ $offer->id }}"><img src="/staticfiles/img/{{ $offer->img }}" alt=""></a></div>
  </div>
  @endif
  @endif
  @endforeach
</div>
<script src="/staticfiles/js/slider.js"></script>
<script src="/staticfiles/js/home.js"></script>
@include('parts.footer')