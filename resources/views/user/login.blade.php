@include('parts.header')
<div class="login__container">
  <form class="login__form" action="/login" method="POST">
    @csrf
    <div class="form__title"><span class="form__title__text">Авторизация</span></div>
    <div class="login__fields">
      <div class="login__field"><input type="text" class="field__input" placeholder="E-mail" name="email"></div>
      <div class="login__field"><input type="password" class="field__input" placeholder="Пароль" name="password"></div>
      <div class="login__submit"><input type="submit" class="submit__input" value="Войти"><div class="submit__register"><a href="/register" class="register__text">Зарегистрироваться</a></div></div>
      <div class="login__google"><img src="/staticfiles/img/google.png" alt=""><span class="google__text">Войти с Google</span></div>
      @if (isset($errors))
      <span>{{ var_dump($errors) }}</span>
      @endif
    </div>
  </form>
</div>
@include('parts.footer')