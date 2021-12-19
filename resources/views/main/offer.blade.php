@include('parts.header')
<div class="offer__container" id="container">
  <div class="offer__title__container">
    <div class="offer__img"><img src="/staticfiles/img/{{ $offer->img }}" alt=""></div>
    <div class="offer__info">
      <div class="offer__title"><span class="offer__title__text">{{ $offer->title }}</span></div>
      <div class="offer__text"><p class="offer__text__paragraph">{{ $offer->description }}</p></div>
    </div>
  </div>
  <div class="offer__items">
    <div class="items__card" v-for="(item, index) in offerItems">
      <div class="card__img"><img :src="'/staticfiles/img/' + item.img" alt=""></div>
      <div class="card__name"><span class="card__name__text">@{{ item.name }}</span></div>
      <div class="card__price"><div class="card__price__prev" v-if="item.previous_price"><span class="price__prev__text">@{{ item.previous_price }} ₽</span></div><div class="card__price__actual"><span class="price__actual__text">@{{ item.price }} ₽</span></div></div>
      <div v-if="item.quantity" class="card__counter" :data-id="item.shoplist_id" data-item_id="item.id"><div class="card__counter__minus" @click="decrementCounter(this.offerItems[index])"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" @input="inputQuantity($event, this.offerItems[index])" maxlength="3" :value="item.quantity" class="counter__number__input"></div><div class="card__counter__plus" @click="incrementCounter(this.offerItems[index])"><span class="counter__plus__text">+</span></div></div>
      <div v-else class="card__buy" @click="addInShoplist(this.offerItems[index])" :data-id="item.id"><span class="card__buy__text">В корзину</span><div class="card__cart"></div></div>
    </div>
  </div>
</div>
<script src="/staticfiles/js/offer.js"></script>
@include('parts.footer')