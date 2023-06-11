<?php require 'layouts/header.php'; ?>
<?php require 'inc/db-functions.php'; ?>
<?php

if (isset($_POST['inscription'])) {

    if (!empty($_POST['genre']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['datenaiss']) && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['pass'])) {

        $genre      = htmlentities($_POST['genre']);
        $prenom     = htmlentities($_POST['prenom']);
        $nom        = htmlentities($_POST['nom']);
        $tel        = htmlentities($_POST['tel']);
        $datenaiss  = htmlentities($_POST['datenaiss']);
        $email      = htmlentities($_POST['email']);
        $login      = htmlentities($_POST['login']);
        $pass       = password_hash($_POST["pass"], PASSWORD_DEFAULT);

        $inscription = user_register($genre, $prenom, $nom, $tel, $datenaiss, $email, $login, $pass);

        // if ($inscription) {
            // echo 'ok';
        // } else {
            // echo 'k.o';
        // }
    }
}

?>

<!-- Section: Design Block -->
<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
        background-image: url('./assets/img/fondcristal.jpg');
        height: 300px;
        "></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
        <div class="card-body py-5 px-md-5">
            <?php if ( isset($inscription) && $inscription) { ?>
                <div class="alert alert-success" role="alert">
                    Inscription réussie
                </div>
            <?php  } ?>

            <?php if ( isset($inscription)  && !$inscription) { ?>
                <div class="alert alert-danger" role="alert">
                    Inscription échoué
                </div>
            <?php  } ?>



        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-5">Inscription</h2>
                <form method="POST" action="">
                    <div class="form-outline mb-4">
                        <select class="form-select" name="genre" id="genre">
                            <option value="mr">Monsieur</option>
                            <option value="mme">Madame</option>
                        </select>
                        <label class="form-label" for="form3Example3">Genre</label>
                    </div>
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" name="prenom" id="prenom" class="form-control" />
                                <label class="form-label" for="form3Example1">Prenom</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" name="nom" id="nom" class="form-control" />
                                <label class="form-label" for="form3Example2">Nom</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="date" name="datenaiss" id="datenaiss" class="form-control" />
                        <label class="form-label" for="form3Example3">Date de naissance</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="tel" name="tel" id="tel" class="form-control" />
                        <label class="form-label" for="form3Example3">telephone</label>
                    </div>

                    <!-- Email input -->


                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="form3Example3" class="form-control" />
                        <label class="form-label" for="form3Example3">Email</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" name="login" id="login" class="form-control" />
                        <label class="form-label" for="form3Example3">Login</label>
                    </div>




                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="pass" id="form3Example4" class="form-control" />
                        <label class="form-label" for="form3Example4">Mot de Passe </label>
                    </div>
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Deja un compte? <a href="index.php" class="link-danger">Se connecter</a></p>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="inscription" class="btn btn-primary btn-block mb-4">
                        S'inscrire
                    </button>

                    <!-- Register buttons -->

                </form>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Section: Design Block -->

<?php require 'layouts/footer.php'; ?>