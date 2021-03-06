@include('parts.header')
<div class="catalog__container">
  <div class="catalog__title"><span class="catalog__title__text">Каталог</span></div>
  <div class="catalog__item__container">
    @foreach ($categories as $category)
      <div class="catalog__item">
        <div class="catalog__item__img">
          <a href="/{{ $category->link }}/search"><img src="/staticfiles/img/{{ $category->img }}" alt=""></a>
        </div>
        <div class="catalog__item__title">
          <a href="/{{ $category->link }}/search" class="title__text">{{ $category->name }}</a>
        </div>
      </div>
    @endforeach
  </div>
</div>
@include('parts.footer')