<?php 
    session_start();
// fonction qui permet de tester si l'utilisateur est connecté
    function is_loggedin(){
        if(!isset($_SESSION['id'])){
            // Si elle existe pas on retourne False
            return false;
        }
        return true;
    }

    function connect(){
        $host       ="localhost";
        $username   ="root";
        $pass       ="";
        $dbname     ="socialdev_bdd";


        $connexion = new mysqli($host, $username, $pass, $dbname);
        if($connexion){
            return $connexion;
        }else{
            die('Connexion Impossible');
        }
        
        
    }


    // INSCRIPTION

    function user_register($genre, $prenom, $nom, $tel, $datenaiss, $email, $login, $pass){
        $bdd = connect();

        if(!user_exist($email)){
        /* Définition de la requête SQL*/
        $requete_sql = "INSERT INTO user(firstname, lastname, username, birthday, gender, number, email, password) VALUES ('$prenom', '$nom', '$login', '$datenaiss', '$genre', '$tel', '$email', '$pass')";

        /* Execution de la requête SQL */
        $result_sql = $bdd->query($requete_sql);

        return $result_sql;
        }else{
            return false;
        }
    }

    //  VERIF USER EMAIL

    function user_exist($email){
        $bdd = connect();

        $requete_sql ="SELECT * FROM user WHERE email = '$email'";

        $result_sql = $bdd->query($requete_sql);


        if($result_sql->num_rows > 0 ){
            return true;
        }
        return false;
    }

    // CONNEXION

    function user_connect($email, $pass){
        $bdd = connect();

        $requete_sql ="SELECT * FROM user WHERE email = '$email'";

        $result_sql = $bdd->query($requete_sql);


        if($result_sql->num_rows > 0 ){
            $user = $result_sql->fetch_array();
            $password_hash = $user["password"];

            if(password_verify($pass, $password_hash)){
                // Création de la session
                    $_SESSION["id"] = $user["user_id"];
                    $_SESSION["login"] = $user["username"];
                    $_SESSION["nom"] = $user["lastname"];
                    $_SESSION["prenom"] = $user["firstname"];

                // Redirection de la page vers les posts
                header('Location: posts.php');
            }else{
                return "Mot de Passe Incorrect";
            }

        }else{
            return " Email  Incorrect";
        }
    }


    function create_post($feed, $picture){
        $bdd = connect();
        $user_id = $_SESSION['id'];
        $post_image = $picture;
        $created = date('Y/m/d H:i:s');

        // Defintion de la requete SQL
        $requete_sql = "INSERT INTO post(user_id, post_image, content, created) VALUES ('$user_id', '$post_image', '$feed', '$created')";

        /* Execution de la requete SQL */
        $result_sql = $bdd->query($requete_sql);
        return $result_sql;
    }
    
    function create_post_without_picture($feed){
        $bdd = connect();
        $user_id = $_SESSION['id'];
        $created = date('Y/m/d H:i:s');

        // Defintion de la requete SQL
        $requete_sql = "INSERT INTO `post_sans_photo` (`post_id`, `user_id`, `content`, `created`) VALUES (NULL, '$user_id', '$feed', '$created')";

        /* Execution de la requete SQL */
        $result_sql = $bdd->query($requete_sql);
        return $result_sql;
    }
    

    function get_all_posts(){
        $bdd =  connect();


        // Defintion de la requete SQL
        $requete_sql = "SELECT * FROM post ORDER BY created DESC";

        // Execution de la requete SQL
        $result_sql = $bdd->query($requete_sql);

        if($result_sql->num_rows > 0){
            $posts = $result_sql->fetch_all(MYSQLI_ASSOC);
            return $posts;
        }else{
            return " Aucun posts";
        }
    }

    function get_user_by_id($id){
        $bdd =  connect();


        // Defintion de la requete SQL
        $requete_sql = "SELECT * FROM user WHERE user_id = $id";

        // Execution de la requete SQL
        $result_sql = $bdd->query($requete_sql);

        if($result_sql->num_rows > 0){
            $user = $result_sql->fetch_array();
            return $user;
        }else{
            return " Aucun user";
        }
        
    }



function display_time_ago($created){
    $time =  strtotime($created);
    
    $time_difference = time() - $time;

    if($time_difference < 1 ) {
        return "Il y'a moins d'une seconde";
    }

    $conditions = array (
        12 * 30 * 24 * 60 * 60 => 'an', //31 104 000
        30 * 24 * 60 * 60 => 'mois', //2
        24 * 60 * 60 => 'jour', //
        60 * 60 => 'heure', // 3600 
        60 => 'minute',
        1 => 'seconde',

    );

    foreach($conditions as $seconds => $texte){
        $diff =  $time_difference / $seconds;

        if($diff>=1){
            $diff_round =  round($diff);
            if($diff_round > 1 && $texte != 'mois'){
                $texte .= 's'; 
            }
            return "Il y'a $diff_round $texte";
        }
    }


}

function display_age($birthday){
    $current_year = date("Y");
    $birthday_year = date('Y', strtotime($birthday));
    $year = $current_year -  $birthday_year;
    return $year ." ans";
}


function edit_user($user_id, $nom, $prenom, $tel, $pp, $pc){
    $bdd = connect();

        /* Définition de la requête SQL*/
        $requete_sql = "UPDATE user SET firstname= '$prenom', lastname='$nom', number='$tel', profile_picture ='$pp', cover_picture='$pc' WHERE user_id= $user_id";

        /* Execution de la requête SQL */
        $result_sql = $bdd->query($requete_sql);

        return $result_sql;

}

function check_if_already_like($post_id, $user_id){
    $bdd = connect();
    
    /* Définition de la requête SQL */
    $requete_sql = "SELECT * FROM likes WHERE user_id = '$user_id' AND post_id = '$post_id'" ;
    /* Execution de la requête SQL */
    $result_sql = $bdd->query($requete_sql);
    if($result_sql->num_rows > 0){
        return true;
    }else{
        return false;
    }
}
function delete_like_by_userid($post_id, $user_id){
    $bdd = connect();
    
    /* Définition de la requête SQL */
    $requete_sql = "DELETE FROM likes WHERE user_id = '$user_id' AND post_id = '$post_id'" ;
    /* Execution de la requête SQL */
    $result_sql = $bdd->query($requete_sql);
    if($result_sql){
        header("Location: posts.php");
    }
}
function add_like($post_id, $user_id){
    date_default_timezone_set('Europe/Paris');
    $bdd = connect();
    $created = date('Y/m/d H:i:s');
    if(check_if_already_like($post_id, $user_id)){
        delete_like_by_userid($post_id, $user_id);
    }else{
        /* ADD LIKE FOR THIS POST */
        /* Définition de la requête SQL */
        $requete_sql = "INSERT INTO likes(post_id,user_id,created) VALUES ('$post_id','$user_id','$created')";
        /* Execution de la requête SQL */
        $result_sql = $bdd->query($requete_sql);
        return $result_sql;
    }
    
}
function get_count_likes_by_postid($post_id){
    $bdd = connect();
    /* Définition de la requête SQL */
    $requete_sql = "SELECT * FROM likes WHERE post_id = $post_id" ;
    /* Execution de la requête SQL */
    $result_sql = $bdd->query($requete_sql);

    if($result_sql){
        $likes = $result_sql->fetch_all(MYSQLI_ASSOC);
        $nb_likes = count($likes);
    }else{
    $nb_likes = 0;
    }
    return $nb_likes;
}

function add_comment($post_id, $user_id, $nompre, $commentaire){
    date_default_timezone_set('Europe/Paris');
    $bdd = connect();
    $created = date('Y/m/d H:i:s');
    /* Définition de la requête SQL */
    $requete_sql = "INSERT INTO comments (post_id , user_id, name, content_comment, created) VALUES ('$post_id','$user_id','$nompre','$commentaire', '$created')";
    /* Execution de la requête SQL */
    $result_sql = $bdd->query($requete_sql);
    return $result_sql;
}
function get_all_comments_by_postid($post_id){
    $bdd = connect();
    
    /* Définition de la requête SQL */
    $requete_sql = "SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY created DESC";
    /* Execution de la requête SQL */
    $result_sql = $bdd->query($requete_sql);
    if($result_sql->num_rows > 0){
        $posts = $result_sql->fetch_all(MYSQLI_ASSOC);
        return $posts;
    }else{
        return false;
    }
}

function get_count_comments_by_postid($post_id){
    $bdd = connect();
    /* Définition de la requête SQL */
    $requete_sql = "SELECT * FROM comments WHERE post_id = $post_id" ;
    /* Execution de la requête SQL */
    $result_sql = $bdd->query($requete_sql);
    if($result_sql){
        $comments = $result_sql->fetch_all(MYSQLI_ASSOC);
        $nb_comments = count($comments);
    }else{
        $nb_comments = 0;
    }
    
    return $nb_comments;
}

function check_if_already_favoris($post_id, $user_id){
    $bdd = connect();
    
    /* Définition de la requête SQL */
    $requete_sql = "SELECT * FROM favoris WHERE id_user = '$user_id' AND id_post = '$post_id'" ;
    /* Execution de la requête SQL */
    $result_sql = $bdd->query($requete_sql);
    if($result_sql->num_rows > 0){
        return true;
    }else{
        return false;
    }
}
function delete_favoris_by_userid($post_id, $user_id){
    $bdd = connect();
    
    /* Définition de la requête SQL */
    $requete_sql = "DELETE FROM favoris WHERE id_user = '$user_id' AND id_post = '$post_id'" ;
    /* Execution de la requête SQL */
    $result_sql = $bdd->query($requete_sql);
    if($result_sql){
        header("Location: posts.php");
    }
}
function add_favoris($post_id, $user_id){
    date_default_timezone_set('Europe/Paris');
    $bdd = connect();
    $created = date('Y/m/d H:i:s');
    if(check_if_already_favoris($post_id, $user_id)){
        delete_favoris_by_userid($post_id, $user_id);
    }else{
        /* ADD LIKE FOR THIS POST */
        /* Définition de la requête SQL */
        $requete_sql = "INSERT INTO favoris(id_post,id_user,created) VALUES ('$post_id','$user_id','$created')";
        /* Execution de la requête SQL */
        $result_sql = $bdd->query($requete_sql);
        return $result_sql;
    }
    
}
function get_count_favoris_by_postid($post_id){
    $bdd = connect();
    /* Définition de la requête SQL */
    $requete_sql = "SELECT * FROM favoris WHERE id_post = $post_id" ;
    /* Execution de la requête SQL */
    $result_sql = $bdd->query($requete_sql);

    if($result_sql){
        $favoris = $result_sql->fetch_all(MYSQLI_ASSOC);
        $nb_favoris = count($favoris);
    }else{
    $nb_favoris = 0;
    }
    return $nb_favoris;
}


function get_user_id_by_id($id){
    $bdd =  connect();


    // Defintion de la requete SQL
    $requete_sql = "SELECT user_id FROM post WHERE user_id = $id";

    // Execution de la requete SQL
    $result_sql = $bdd->query($requete_sql);

    if($result_sql->num_rows > 0){
        $user = $result_sql->fetch_array();
        return $user;
    }else{
        return " Aucun user";
    }
    
}


// function check_if_already_follow($user_id, $user){
//     $bdd = connect();
    
   
//     $requete_sql = "SELECT * FROM follow WHERE user_id1 = '$user_id' AND user_id2 = '$user'" ;
   
//     $result_sql = $bdd->query($requete_sql);
//     if($result_sql->num_rows > 0){
//         return true;
//     }else{
//         return false;
//     }
// }
function delete_follow_by_userid($user, $user_id){
    $bdd = connect();
    
    /* Définition de la requête SQL */
    $requete_sql = "DELETE FROM follow WHERE user_id1 = '$user_id' AND user_id2 = '$user'" ;
    /* Execution de la requête SQL */
    $result_sql = $bdd->query($requete_sql);
    if($result_sql){
        header("Location: view-profile.php");
    }
}
function addfollow($user, $user_id){
    date_default_timezone_set('Europe/Paris');
    $bdd = connect();
    $created = date('Y/m/d H:i:s');
    if(check_if_already_follow($user, $user_id)){
        delete_follow_by_userid($user, $user_id);
    }else{
        
        
        $requete_sql = "INSERT INTO follow(user_id1, user_id2, created) VALUES ('$user_id','$user','$created')";
        $result_sql = $bdd->query($requete_sql);
        return $result_sql;
    }
    
}
function get_count_follow_by_userid($user){
    $bdd = connect();
 
    $requete_sql = "SELECT * FROM follow WHERE user_id2 = $user" ;
    $result_sql = $bdd->query($requete_sql);

    if($result_sql){
        $follow = $result_sql->fetch_all(MYSQLI_ASSOC);
        $nb_follow = count($follow);
    }else{
    $nb_follow = 0;
    }
    return $nb_follow;
}
