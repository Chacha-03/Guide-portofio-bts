<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a class="navbar-brand me-2" href="posts.php">
    <?php if (!is_loggedin()) 
    { ?> <?php echo $_SESSION["prenom"] ;?> <?php  $_SESSION["nom"]; ?>
    <?php } ;?>
      <img src="../assets/img/ordi.webp" height="16" alt="MDB Logo" loading="lazy" style="margin-top: -1px;" />
    </a>

    <!-- Toggle button -->
    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      </ul>
      <!-- Left links -->

      <div class="d-flex align-items-center">
        <?php if (!is_loggedin()) { ?>
          <button type="button" class="btn btn-link px-3 me-2">
            Se connecter
          </button>
          <button type="button" class="btn btn-primary me-3">
            S'inscrire
          </button>
        <?php } ?>
        <?php if (is_loggedin()) { ?>
          <a class="btn btn-dark px-3" href="profile.php" role="button"><i class="fa-solid fa-user"></i></a>
        <?php } ?>
      </div>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->