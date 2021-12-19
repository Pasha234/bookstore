@include('parts.header')
<div class="order__container">
  <div class="order__title">
    <span class="order__title__text">Заказ №{{ $order->id }}</span>
  </div>
  <div class="order__info">
    <div class="info__title">
      <span class="info__title__text">Описание</span>
    </div>
    <div class="info__card">
      <div class="card__row"><span class="row__title">Имя получателя: </span><span class="row__value">{{ $order->recipient }}</span></div>
      <div class="card__row"><span class="row__title">Адрес доставки: </span><span class="row__value">{{ $order->address }}</span></div>
      <div class="card__row"><span class="row__title">Ориентировочная дата доставки: </span><span class="row__value">{{ $order->indicativeDeliveryDate }}</span></div>
      <div class="card__row"><span class="row__title">Сумма: </span><span class="row__value">{{ $order->sum }} ₽</span></div>
    </div>
  </div>
  <div class="order__inner">
    <div class="inner__title">
      <span class="inner__title__text">Содержимое</span>
    </div>
    @foreach($order_items as $value)
    <div class="inner__card">
      <div class="card__img"><img src="/staticfiles/img/{{ $value->img }}" alt=""></div>
      <div class="card__info">
        <div class="info__title"><span class="info__title__text">{{ $value->name }}</span></div>
        <div class="info__number"><span class="number__value">{{ $value->quantity }}</span><span class="number__text"> шт.</span></div>
        <div class="info__price"><span class="price__value">{{ $value->price * $value->quantity }}</span><span class="price__text"> ₽</span></div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@include('parts.footer')