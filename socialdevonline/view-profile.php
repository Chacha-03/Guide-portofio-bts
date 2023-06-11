<?php require 'layouts/header.php'; ?>
<?php require 'inc/db-functions.php'; ?>

<?php
//Je le redirige sur la page de connexion si il est pas connecté
if (!is_loggedin()) {
    header('Location: index.php');
}

require 'layouts/nav.php';

if (isset($_GET['id'])) {
   //$getid = intval($_GET['id']);
    $user = get_user_by_id($_GET['id']);
}

// if(isset($_GET["action"]) && $_GET["action"] == "follow"){
    // $res= add_favoris($_GET["id"], $_SESSION["id"]);
    // if($res){
    //  header("Location:view-profile.php");
    //  exit();
    // }
//  }


function check_if_already_follow(){
   // $getfollowid =(intval($_GET['followedid']));
    include('connect.php');
    $check_if_already_follow = $bd-> prepare("SELECT * FROM follow WHERE user_id1 = '".$_SESSION['id']."' AND user_id2 = '". $_GET['id']."'") ;
    $check_if_already_follow->execute(array($_SESSION['id'] ,  $_GET['id'] ));
    if($check_if_already_follow->rowCount() > 0 ) {
        return true;
    }else{
        return false;
    }
    
    }
    //$check_if_already_follow = check_if_already_follow();
    check_if_already_follow();

    //function get_count_follow_by_userid(){
       // $bdd = connect();
     
        // $requete_sql = "SELECT * FROM follow WHERE user_id2 = '".$_GET['id']."'" ;
        // $result_sql = $bdd->query($requete_sql);
    
        // if($result_sql){
            // $follow = $result_sql->fetch_all(MYSQLI_ASSOC);
            // $nb_follow = count($follow);
        // }else{
        // $nb_follow = 0;
        // }
        // return $nb_follow;
  //  }
    
    //get_count_follow_by_userid();

    ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Document</title>
</head>

<body>


    <style>
        .profile-display {
            width: 100%;
            position: relative;
            box-shadow: 0 1px 12px rgba(0, 0, 0, 0.1);
            height: 400px;
            background-color: #fff;
        }

        .profile-cover {
            height: 210px;
            position: absolute;
            top: 0px;
            right: 0px;
            left: 0px;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-position: center center;
        }

        .author-info {
            background-color: #f5f5f5;
            padding: 10px;
            position: absolute;
            top: 40px;
            left: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 240px;
        }

        .author-info .author-info-img {
            width: 100%;
            height: 220px;
            width: 220px;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-position: center center;
            margin-bottom: 3px;
            position: relative;
        }

        .author-meta {
            display: inline-block;
            vertical-align: bottom;
        }

        .author-username {
            font-size: 26px;
            margin: 5px 0 0 0;
        }

        .edit-p {
            position: absolute;
            z-index: 100;
            right: 24px;
            top: 245px;
        }

        .input-submit-profil {

            position: absolute;
            z-index: 100;
            right: 24px;
            top: 245px;
        }
        .input_hidden{
            position: absolute;
        z-index: 100;
        right: 24px;
        top: 290px;
        }
    </style>
    <div class="container bootstrap snippets bootdey">
        <div class="col-md-10">
            <?php if (isset($user)) { ?>
                <div class="profile-display">
                    <?php if ($_GET['id'] == $_SESSION["id"]) { ?>
                        <a href="profile.php" class="btn btn-primary edit-p">Modifier le profile</a>
                    <?php } elseif(check_if_already_follow($_SESSION['id'] , $_GET['id'] )) { ?> 
                        
                       
                        <a href="follow.php?followedid=<?php echo $_GET['id'] ?>" class="btn btn-primary edit-p">Se désabonner</a> 
                        
                    <?php }  else {?>
                        <a href="follow.php?followedid=<?php echo $_GET['id'] ?>" class="btn btn-primary edit-p">S'abonner</a> 
                         <?php }  ?>

                    <div class="profile-cover" style="background-image:url(assets/img/<?php echo $user['cover_picture'] ?>)"></div>
                    <div class="author-info">
                        <div class="author-info-img" style="background-image:url(assets/img/<?php echo $user['profile_picture'] ?>)">
                        </div>
                        <div class="author-meta">
                            <h2 class="author-username">
                                <?php echo $user['firstname'] . ' ' .  $user['lastname'] ?>
                            </h2>

                            <h3 class="author-username" style="text-align: center;">
                            <?php 
                            $bdd = connect();
                           // Supposons que vous avez déjà une connexion à la base de données

                               // Requête pour compter le nombre d'abonnés dans la table
                               $sql = "SELECT COUNT(*) AS follower FROM follow WHERE user_id2 = '".$_GET['id']."'";
                               $result = $bdd->query($sql);
                               
                               if ($result) {
                                   // Récupérer le nombre d'abonnés à partir du résultat de la requête
                                   $row = $result->fetch_assoc();
                                   $count = $row['follower'];
                               
                                   // Afficher le nombre d'abonnés
                                   echo  $count." Abonnés" ;
                               } else {
                                   // En cas d'erreur lors de l'exécution de la requête, afficher 0
                                   echo "0 Abonnés ";
                               }
                               
                               // Fermer la connexion à la base de données
                               $bdd->close();




                            // $requete_sql = "SELECT * FROM follow WHERE user_id2 = '".$_GET['id']."'" ;
                            // $result_sql = $bdd->query($requete_sql);
                            // if($result_sql){
                            //     $follow = $result_sql->fetch_all(MYSQLI_ASSOC);
                            //     $nb_follow = count($follow);
                            // }else{
                            // $nb_follow = 0;
                            // }
                            // return $nb_follow;
                            // echo $nb_follow
                            
                            ?> 
                            </h3>

                        </div>
                    </div>

                </div>

            <?php } ?>
        </div>
    </div>
</body>

</html>