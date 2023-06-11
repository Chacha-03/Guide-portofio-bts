
<?php require 'inc/db-functions.php'; ?>
<?php 


?>

<?php
// include './connexion/mysqli.php';
$bdd = connect();
$user_id = $_GET["user_id"];
$req = "DELETE FROM user WHERE `user_id` = '$user_id' ";
mysqli_query($bdd, $req);
header("location:index.php");

?>