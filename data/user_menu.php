<?php 
    if(isset($_POST['settings'])){
        settings();
    } else if(isset($_POST['lockscreen'])){
        lockscreen();
    } else if(isset($_POST['logout'])){
        logout();
    }
?>