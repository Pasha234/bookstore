@include('parts.header')
<div class="register__container">
  <form class="register__form" action="" method="POST">
    <div class="form__title"><span class="form__title__text">Регистрация</span></div>
    <div class="register__fields">
      <div class="register__field"><input type="text" class="field__input" placeholder="Имя"></div>
      <div class="register__field"><input type="text" class="field__input" placeholder="Фамилия"></div>
      <div class="register__field"><input type="text" class="field__input" placeholder="E-mail"></div>
      <div class="register__field"><input type="password" class="field__input" placeholder="Пароль"></div>
      <div class="register__submit"><input type="submit" class="submit__input" value="Зарегистрироваться"></div>
      <div class="register__google"><img src="/staticfiles/img/google.png" alt=""><span class="google__text">Зарегистрироваться с Google</span></div>
    </div>
  </form>
</div>
@include('parts.footer')