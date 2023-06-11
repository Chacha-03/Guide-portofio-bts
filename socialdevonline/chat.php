<?php require 'layouts/header.php'; ?>

<?php require 'inc/db-functions.php'; ?>

<?php

$destinataire = $_GET['id_posteur'];
// REDIRECTION SUR LA PAGE DE CONNEXION S'IL N'EST PAS CONNECTER
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
}
?>

<?php require 'layouts/nav.php'; ?>
<?php
$bdd = connect();
// $nom = $_SESSION["nom"];
if (isset($_POST["envoie"])) {
    if (!empty($_POST['message'])) {
        $message = htmlentities($_POST['message']);
        $created = date('Y/m/d H:i:s');
      

        $req  = "INSERT INTO `message` (`message_id`, `expediteur`, `message`, `destinataire`, `created`) VALUES (NULL, '" . $_SESSION["id"] . "', '$message', '$destinataire',  now() )";
        mysqli_query($bdd, $req);
        // if(isset($_GET['id'])){
        // $user = get_user_by_id($_GET['id']);
        // }


        //  $requete_sql = "INSERT INTO message(user_id, message, created) VALUES ( ".$user['id']." , '$message', '$created')";
        //  $result_sql = $bdd->query($requete_sql);
        //  return $result_sql;
        //  var_dump($result_sql);

    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/chat.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<section style="background-color: #CDC4F9;">
<h1 class="h1_name">Bonjour <?php echo $_SESSION["prenom"]  ?>, Chattez'en direct! Chatbox</h1>

  <div class="container py-5">

    <div class="row">
      <div class="col-md-12">

        <div class="card" id="chat3" style="border-radius: 15px;">
          <div class="card-body">

            <div class="row">
              <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

                <div class="p-3">

                  <!-- <div class="input-group rounded mb-3">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                      aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                      <i class="fas fa-search"></i>
                    </span>
                  </div> -->

                  

                  <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
                    <!-- <ul class="list-unstyled mb-0">
                    <?php
                   // $req = "select * from user ";
                   // $res = mysqli_query($bdd, $req);
                   // while ($ligne = mysqli_fetch_assoc($res)) { ?>
                  
                      <li class="p-2 border-bottom">
                      <?php //$user = get_user_by_id($ligne["user_id"]);
       
                            ?>
                        <a href="chat.php?id_posteur=<?php //echo $user["user_id"] ?>" class="d-flex justify-content-between">
                          <div class="d-flex flex-row">
                            <div>
                                <img   class="d-flex align-self-center me-3" src="./assets/img/<?php //echo $ligne["profile_picture"] ?>" alt="aavatar" width=60> 
                              <span class="badge bg-success badge-dot"></span>
                            </div>
                            <div class="pt-1">
                            <a href="envoie">  <p class="fw-bold mb-0"> <?php //echo $ligne["firstname"] ?> <?php //echo $ligne["lastname"] ?></p> </a>
                              <p class="small text-muted">Hello, Are you there?</p>
                            </div>
                          </div>
                          <div class="pt-1">
                           <p class="small text-muted mb-1">Just now</p>
                           <span class="badge bg-danger rounded-pill float-end">3</span> 
                           </div> 
                        </a>
                      </li>
                      <?php // } ?>
                     
                    </ul> -->
                  </div>

                
                </div>

              </div>
              
              <div class="col-md-6 col-lg-7 col-xl-8">

            <div class="pt-3 pe-3" data-mdb-perfect-scrollbar="true"
                  style="position: relative; height: 400px">

                  <?php
                //  echo $_SESSION["nom"]   ;
                //  echo $destinataire = $_SESSION["nom"] ;
                $req = "select * from message
                where expediteur = '$destinataire'  AND   destinataire = '".$_SESSION["id"]."' ORDER BY message DESC  ";
                        
                $res = mysqli_query($bdd, $req);
                while ($exped = mysqli_fetch_assoc($res)) {?>
                    <!-- // echo "<li class='message'>" . $ligne["created"] . " - "
                        // . $ligne["expediteur"] . " - "
                        // . $ligne["message"] .
                        // "</li>";
                -->
                

                  <div class="d-flex flex-row justify-content-start">
                  <?php //$user = get_user_by_id($user["user_id"]);
       
                   ?> 
                    <!-- <a href="">  -->
                   <!-- <img   src="./assets/img/<?php
                   // echo $user["profile_picture"] ?>" alt="avatar 1" style="width: 45px; height: 100%;"> </a> -->
                    <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                      alt="avatar 1" style="width: 45px; height: 100%;"> -->
                    <div>
                      <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;"><?php echo $exped["message"]?> </p>
                      <p class="small ms-3 mb-3 rounded-3 text-muted float-end"><?php echo display_time_ago($exped["created"]) ?></p>
                    </div>
                  </div>

                 <?php }
                ?>




                  <?php
                //  echo $_SESSION["nom"]   ;
                //  echo $destinataire = $_SESSION["nom"] ;
                $req = "select * from message where expediteur = '".$_SESSION["id"]."' AND  destinataire = '$destinataire' ORDER BY message ASC ";
                $res = mysqli_query($bdd, $req);
                while ($ligne = mysqli_fetch_assoc($res)) {?>
                    <!-- echo "<li class='message'>" . $ligne["created"] . " - " -->
                        <!-- . $ligne["expediteur"] . " - " -->
                        <!-- . $ligne["message"] . -->
                        <!-- "</li>"; -->
                
                
                  <div class="d-flex flex-row justify-content-end">
                    <div>
                      <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary"> <?php  echo $ligne["message"] ?></p>
                      <p class="small me-3 mb-3 rounded-3 text-muted"><?php echo display_time_ago($ligne["created"]); ?></p>
                    </div>
                    <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                      alt="avatar 1" style="width: 45px; height: 100%;"> -->
                  </div>
                <?php  }
                ?>
                  
                 


            </div>
                  <form action="" method="post">
                 <div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
                  <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                    alt="avatar 3" style="width: 40px; height: 100%;"> -->
                  <textarea type="text" class="form-control form-control-lg" id="exampleFormControlInput2"
                    placeholder="Type message" name="message"> </textarea>
                  <!-- <a class="ms-1 text-muted" href="#!"><i class="fas fa-paperclip"></i></a>
                  <a class="ms-3 text-muted" href="#!"><i class="fas fa-smile"></i></a>
                  <a class="ms-3" href="#!"><i class="fas fa-paper-plane"></i></a> -->
                  <input type="submit"  class="btn btn-primary  ms-4" value="send" name="envoie">
                </div>
                </form>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>
</section>
</body>
</html>