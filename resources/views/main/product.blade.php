@include('parts/header')
<div class="product__container" id="container">
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
      <div class="main__counter" v-if="this.product.quantity"><div class="main__counter__minus" @click="decrementCounter(this.product)"><span class="counter__minus__text">-</span></div><div class="main__counter__number"><input type="text" maxlength="3" :value="product.quantity" @input="inputQuantity($event, this.product)" class="counter__number__input"></div><div class="main__counter__plus" @click="incrementCounter(this.product)"><span class="counter__plus__text">+</span></div></div>
      <div class="main__buy" v-else @click="addInShoplist(this.product)"><span class="main__buy__text">В корзину</span><div class="main__cart"></div></div>
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
    @forelse($feedbacks as $feedback)
    <div class="feedback__card">
      <div class="card__title">
        <div class="card__title__user">
          <div class="user__img">
            <img src="/staticfiles/img/no-user-image-icon.jpg" alt="">
          </div>
          <span class="user__name">{{ $feedback->user_name }}</span>
        </div>
        <div class="card__title__grade">
          @for ($i = 1; $i <= 5; $i++)
            @if($i <= $feedback->grade)
            <div class="grade__star active"></div>
            @else
            <div class="grade__star"></div>
            @endif
          @endfor
        </div>
      </div>
      <div class="card__body">
        <span class="body__text">{{ $feedback->text }}</span>
      </div>
    </div>
    @empty
    <span>Отзывов нет. Станьте первыми!</span>
    @endforelse
  </div>
  <div class="product__similiar">
    <div class="similiar__title"><span class="title__text">Похожие товары</span></div>
    <div class="similiar__items">
      <span v-if="similiarItems.length == 0">Не удалось найти похожие товары</span>
      <div class="items__card" v-for="(item, index) in similiarItems" :key="similiarItems">
        <div class="card__img"><a :href="'/product/' + item.id"><img :src="'/staticfiles/img/' + item.img" alt=""></a></div>
        <div class="card__name"><a :href="'/product/' + item.id" class="card__name__text">@{{ item.name }}</a></div>
        <div class="card__price"><div class="card__price__prev" v-if="item.previous_price"><span class="price__prev__text">@{{ item.previous_price }} ₽</span></div><div class="card__price__actual"><span class="price__actual__text">@{{ item.price }} ₽</span></div></div>
        <div v-if="item.quantity" class="card__counter" :data-id="item.shoplist_id" data-item_id="item.id"><div class="card__counter__minus" @click="decrementCounter(this.similiarItems[index])"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" @input="inputQuantity($event, this.similiarItems[index])" maxlength="3" :value="item.quantity" class="counter__number__input"></div><div class="card__counter__plus" @click="incrementCounter(this.similiarItems[index])"><span class="counter__plus__text">+</span></div></div>
        <div v-else class="card__buy" @click="addInShoplist(this.similiarItems[index])" :data-id="item.id"><span class="card__buy__text">В корзину</span><div class="card__cart"></div></div>
      </div>
    </div>
  </div>
</div>
<script src="/staticfiles/js/product.js"></script>
<script>
  vm.$data.product = {
    id: "{{ $product->id }}",
    quantity: "{{ $product->quantity }}",
    shoplist_id: "{{ $product['shoplist_id'] }}"
  }
</script>
@include('parts/footer')