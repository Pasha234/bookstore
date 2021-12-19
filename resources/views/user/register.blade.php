@include('parts.header')
<div class="register__container">
  <form class="register__form" action="" method="POST">
    <div class="form__title"><span class="form__title__text">Регистрация</span></div>
    <div class="register__fields">
      @csrf
      <div class="register__field"><input type="text" class="field__input" placeholder="Имя" name="name"></div>
      <div class="register__field"><input type="text" class="field__input" placeholder="Фамилия" name="last_name"></div>
      <div class="register__field"><input type="text" class="field__input" placeholder="E-mail" name="email"></div>
      <div class="register__field"><input type="password" class="field__input" placeholder="Пароль" name="password"></div>
      <div class="register__submit"><input type="submit" class="submit__input" value="Зарегистрироваться"></div>
      <div class="register__google"><img src="/staticfiles/img/google.png" alt=""><span class="google__text">Зарегистрироваться с Google</span></div>
      @if ($errors->any())
      <ul>
      @foreach($errors->all() as $message)
      <li><h3>{{ $message }}</h3></li>
      @endforeach
      </ul>
      @endif
    </div>
  </form>
</div>
@include('parts.footer')