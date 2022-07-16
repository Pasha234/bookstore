@include('parts.header')
<div class="personal__container" id="container">
  <div class="personal__card">
    <div class="card__info">
      @if ($user->img)
      <div class="card__img"><img id="avatar_personal" src="{{ $user->img }}" alt=""></div>
      @else
      <div class="card__img"><img src="/staticfiles/img/no-user-image-icon.jpg" alt=""></div>
      @endif
      <div class="card__name"><span class="card__name__text">{{ $user->name }}</span></div>
    </div>
    <div class="personal__change" @click="showAvatarForm()"><span class="personal__change__text">Сменить аватар</span><input v-if="change_avatar" @change="changeAvatar" accept="image/*" type="file" /></div>
  </div>
  <div class="personal__quit"><a href="/quit" class="quit__text">Выйти</a></div>
  <div class="personal__orders">
    <div class="orders__title"><div class="orders__title__text">Заказы</div></div>
    <div class="orders__items">
      <span v-if="orders.length == 0">Заказов нет</span>
      <div class="orders__item" v-for="(order, index) in orders">
        <a :href="'/order/' + order.id" class="item__title">Заказ №@{{ order.id }}</a>
      </div>
    </div>
  </div>
</div>
<script src="/staticfiles/js/personal.js"></script>
@include('parts.footer')