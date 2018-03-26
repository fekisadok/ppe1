<?php
session_start();
require ('includes/init.php');
include ('filter/user_filter.php');

if(!empty($_GET['id']) && $_GET['id'] !== get_session('user_id')){
    $id=$_GET['id'];
    $q = $db->prepare('DELETE FROM friends_relationships
                                 WHERE (user_id1= :user_id1 AND user_id2= :user_id2)
                                  OR user_id1= :user_id2 AND user_id2= :user_id1');
    $q->execute([
        'user_id1' => get_session('user_id'),
        'user_id2' => $id
    ]);

    set_flash("Vous n'êtes plus ami avec cet utilisateur !");
    redirect('profil.php?id='.$id);
}else{
    redirect('profil.php?id='.get_session('user_id'));
}