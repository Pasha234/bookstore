@include('parts/header')
<div class="search__container" id="container">
  <div class="search__parameters">
    <div class="parameters__direction">
      <div class="direction__title"><span class="direction__title__text">Направление</span></div>
      <div class="direction__fields" id="direction_fields">
        @foreach($directions as $direction)
        <div class="direction__field"><input @click="doSearch()" type="checkbox" id="direction{{ $direction->id }}" value="{{ $direction->id }}" class="direction__field__input" checked /><label for="direction{{ $direction->id }}" class="direction__field__label">{{ $direction->name }}</label></div>
        @endforeach
      </div>
    </div>
    <div class="parameters__price">
      <div class="price__title"><span class="price__title__text">Цена, ₽</span></div>
      <div class="price__fields"><div class="price__field"><p class="field__paragraph">От</p><input id="min_price" v-model="minPrice" @change="doSearch()" type="text" class="field__input" /></div><div class="price__field"><p class="field__paragraph">До</p><input id="max_price" v-model="maxPrice" @change="doSearch()" type="text" class="field__input" /></div></div>
    </div>
    <div class="parameters__input">
      <div class="input__title"><span class="input__title__text">Поиск</span></div>
      <div class="input__field__container"><input id="search_word" v-model="searchWord" type="text" class="input__field"><div class="input__submit" @click="doSearch()"></div></div>
    </div>
  </div>
  <div class="search__results">
    <div class="results__container">
      <div class="results__card" v-for="(item, index) in searchedItems">
        <div class="card__img"><img :src="'/staticfiles/img/' + item.img" alt=""></div>
        <div class="card__name"><span class="card__name__text">@{{ item.name }}</span></div>
        <div class="card__price"><div class="card__price__prev" v-if="item.previous_price"><span class="price__prev__text">@{{ item.previous_price }} ₽</span></div><div class="card__price__actual"><span class="price__actual__text">@{{ item.price }} ₽</span></div></div>
        <div v-if="item.quantity" class="card__counter" :data-id="item.shoplist_id" data-item_id="item.id"><div class="card__counter__minus" @click="decrementCounter(item)"><span class="counter__minus__text">-</span></div><div class="card__counter__number"><input type="text" @input="inputQuantity($event, item)" maxlength="3" :value="item.quantity" class="counter__number__input"></div><div class="card__counter__plus" @click="incrementCounter(item)"><span class="counter__plus__text">+</span></div></div>
        <div v-else class="card__buy" @click="addInShoplist(item)" :data-id="item.id"><span class="card__buy__text">В корзину</span><div class="card__cart"></div></div>
      </div>
    </div>
  </div>
  <div class="search__categories">
    <div class="categories__title">
      <span class="categories__title__text">Категории</span>
    </div>
    <div class="categories__list">
      <ul>
        <li><a href="/audiobooks/search">Аудиокниги</a></li>
        <li><a href="">Электронные книги</a></li>
        <li><a href="">Художественная литература</a></li>
        <li><a href="">Нехудожественная литература</a></li>
        <li><a href="">Открытки</a></li>
        <li><a href="">Канцтовары</a></li>
      </ul>
    </div>
  </div>
</div>
<script src="/staticfiles/js/search.js"></script>
@include('parts/footer')