<div class="overlay" id="loginform">
  <div class="login_container">
    <h2>Zaloguj się</h2>
    <div class="content">
      <form action="#" method="post" class="login_form">
        <div class="input-group mb-3 input-group-lg">
          <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required autocomplete="off" name="login">
        </div>
        <div class="input-group mb-3 input-group-lg">
          <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required autocomplete="off" name="password">
        </div>
        <div class="buttton_container">
          <button type="submit" class="btn check_login_btn">Zaloguj</button>
          <a href="#"><button type="button" class="btn check_login_btn">Anuluj</button></a>
        </div>
        <?= (isset($_GET['error']) ? '<p class="error1">Niepoprawne dane logowania!</p>' : '') ?>
      </form>
    </div>
  </div>
</div>