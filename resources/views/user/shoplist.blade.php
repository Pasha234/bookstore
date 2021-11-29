@include('parts.header')
<div class="shoplist__container" id="container">
  <div class="shoplist__content">
    <div class="content__title">
      <span class="content__title__text">Корзина</span>
    </div>
    <div class="content__cards">
      <span v-if="items.length == 0">Корзина пуста, но вы можете что-то выбрать из нашего <a href="">каталога</a></span>
      <div class="content__card" v-for="(item, index) in items" :key="index">
        <div class="card__img"><img :src="item.img" alt=""></div>
        <div class="card__info">
          <div class="info__title"><span class="info__title__text">@{{ item.title }}</span></div>
          <div class="info__counter"><div class="counter__minus" @click="decrementCounter(index)"><span class="counter__minus__text">-</span></div><div class="counter__number"><input type="text" maxlength="3" class="counter__number__input" :value="item.quantity" @input="inputQuantity($event, index)" @change="changeQuantity($event, index)"></div><div class="counter__plus" @click="incrementCounter(index)"><span class="counter__plus__text">+</span></div></div>
          <div class="info__delete"><a href="javascript:void()">Удалить</a></div>
          <div class="info__price">
            <div class="price__actual"><span class="price__actual__text">@{{ item.price }} ₽</span></div>
            <div class="price__prev" v-if="item.prev_price"><span class="price__prev__text">@{{ item.prev_price }} ₽</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="shoplist__price">
    <div class="price__title"><span class="price__title__text">Итого:</span></div>
    <div class="price__number"><span class="price__number__text">@{{ totalSum }} ₽</span></div>
    <div class="price__checkout"><span class="checkout__text">Оформить заказ</span></div>
  </div>
</div>
<script src="/staticfiles/js/shopList.js"></script>
@include('parts.footer')