<?php require 'layouts/header.php'; ?>

<?php require 'inc/db-functions.php'; 
$bdd = connect();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User_message</title>
</head>
<body>
<ul class="list-unstyled mb-0">
                    <?php

                    $req = "select * from user ";
                    $res = mysqli_query($bdd, $req);
                    while ($ligne = mysqli_fetch_assoc($res)) { ?>
                        <!-- echo "<option>" . $ligne["firstname"] . "</option>"; -->
                  
                      <li class="p-2 border-bottom">
                      <?php $user = get_user_by_id($ligne["user_id"]);
       
                            ?>
                        <a href="chat.php?id_posteur=<?php echo $user["user_id"] ?>" class="d-flex justify-content-between">
                          <div class="d-flex flex-row">
                            <div>
                              <!-- <img
                                src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                alt="avatar" width="60"> -->
                                <img   class="d-flex align-self-center me-3" src="./assets/img/<?php echo $ligne["profile_picture"] ?>" alt="aavatar" width=60> 
                              <span class="badge bg-success badge-dot"></span>
                            </div>
                            <div class="pt-1">
                            <a href="chat.php?id_posteur=<?php echo $user["user_id"] ?>">  <p class="fw-bold mb-0"> <?php echo $ligne["firstname"] ?> <?php echo $ligne["lastname"] ?></p> </a>
                              <!-- <p class="small text-muted">  <?php

                                    //  $requete_sql = "SELECT message FROM user LIMIT 1";

                                    //  $result_sql = $bdd->query($requete_sql);
                                    //  if($result_sql->num_rows > 0){
                                        //  $firstmsg = $result_sql->fetch_array();
                                        //  return $firstmsg;
                                    //  }else{
                                        //  return " Aucun message";
                                    //  }?>
                                               -->
                                       <!-- <p> <?php
                                       // echo   $ligne = $firstmsg ['message'] ; ?> </p> -->
                                      
                                <?php   ?>
                                 <!-- </p> -->
                            </div>
                          </div>
                          <!-- <div class="pt-1"> -->
                            <!-- <p class="small text-muted mb-1">Just now</p> -->
                            <!-- <span class="badge bg-danger rounded-pill float-end">3</span> -->
                          <!-- </div> -->
                        </a>
                      </li>
                      <?php  } ?>
</body>
</html>