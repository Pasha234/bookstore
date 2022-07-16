<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <link href="/staticfiles/css/index.css" rel="stylesheet">
  <script src="/staticfiles/js/burger.js"></script>
  <script src="https://unpkg.com/vue@3.2.22"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>BookStore - Самый уютный магазин с книгами</title>
</head>
<body>
  <div class="content" id="content">
    <div class="navbar__min" id="sidebar-min">
      <div class="navbar__burger" id="burger_min"><span></span></div>
      <span class="navbar__logo" id="logo"><a href="/">BookStore</a></span>
    </div>
  <div class="navbar" id="sidebar">
  <div class="navbar__burger" id="burger"><span></span></div>
  <span class="navbar__logo" id="logo"><a href="/">BookStore</a></span>
  <nav class="navbar__navigation">
    <div class="nav__item"><a href="/">Главная</a></div>
    <div class="nav__item"><a href="/shoplist">Корзина</a></div>
    <div class="nav__item"><a href="/catalog">Каталог</a></div>
  </nav>
  @if(isset($user))
  <div class="navbar__user">
    <div class="user__img">
      @if ($user->img)
      <a href="/personal"><img id="avatar_sidebar" src="{{ $user->img }}" alt=""></a>
      @else
      <a href="/personal"><img src="/staticfiles/img/no-user-image-icon.jpg" alt=""></a>
      @endif
    </div>
    <div class="user__name">
      <span id="username"><a href="/personal">{{ $user->name }}</a></span>
    </div>
  </div>
  @else
  <div class="navbar__user">
    <div class="user__name">
      <a href="/login">Войти</a>
    </div>
  </div>
  @endif
  </div>
  <div class="overlay"></div>