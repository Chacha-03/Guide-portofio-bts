<?php require 'layouts/header.php'; ?>
<?php require 'inc/db-functions.php'; ?>
<?php
if (isset($_POST['login'])) {

  if (!empty($_POST['email']) && !empty($_POST['pass'])) {

    $email      = htmlentities($_POST['email']);
    $pass       = htmlentities($_POST["pass"]);

    $res = user_connect($email, $pass);
  }
}
?>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <?php if (isset($res)) { ?>
          <div class="alert alert-success" role="alert">
            <?php echo ' A simple success alert—check it out!'; ?>
          </div>
        <?php  } ?>
        <img src="./assets/img/ordi.webp" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="" name="formulaire"  onsubmit="return validation();">



          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" />
            <label class="form-label" for="form3Example3">Email</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" name="pass" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" />
            <label class="form-label" for="form3Example4">Mot de passe</label>
          </div>


          <a href="#!" class="text-body">Mot de passe oublié ?</a>


          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" name="login" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Ok" >Se connecter </button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Pas de compte? <a href="register.php" class="link-danger">Inscription</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>

<?php require 'layouts/footer.php'; ?>
<script src="./assets/js/main.js"></script>