
<?php 
session_start();
include('connect.php');
$getfollowid = $_GET['followedid'];

//if (isset($_GET['id'])) {
//    $getid = intval($_GET['id']);
//     $user = get_user_by_id($_GET['id']);
// }

if($getfollowid != $_SESSION['id'] ){
    $check_if_already_follow = $bd-> prepare("SELECT * FROM follow WHERE user_id1 = '".$_SESSION['id']."' AND user_id2 = '$getfollowid'") ;
    $check_if_already_follow->execute(array($_SESSION['id'] , $getfollowid ));
    $check_if_already_follow = $check_if_already_follow->rowCount();

    if($check_if_already_follow > 0){
        $delete_follow = $bd->prepare( "DELETE FROM follow WHERE user_id1 = '".$_SESSION['id']."' AND user_id2 = '$getfollowid' ");
        $delete_follow->execute(array($_SESSION['id'] , $getfollowid ));

       // $add_follow = $bd->prepare("INSERT INTO follow (follow_id, user_id1, user_id2, created) VALUES (NULL, '".$_SESSION['id']." ', ".$_GET['id'].", NOW() ");
       // $add_follow->execute(array($_SESSION['id'] ,$_GET['id'] ));
       
    } else{
       // $delete_follow = $bd->prepare( "DELETE FROM follow WHERE user_id1 = '".$_SESSION['id']."' AND user_id2 = '$getfollowid' ");
       // $delete_follow->execute(array($_SESSION['id'] , $getfollowid ));
        
        $add_follow = $bd->prepare("INSERT INTO follow (user_id1, user_id2, created) VALUES ('".$_SESSION['id']." ', '$getfollowid', NOW())");
        $add_follow->execute(array($_SESSION['id'] ,$getfollowid ));
        //return $add_follow;
    } //else{
        //echo 'Impossile de s\'abonner un probleme est survenu veuillez reessayez plus tard!';
        
        header('Location: '.$_SERVER['HTTP_REFERER']);
         exit();
}








