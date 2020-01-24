<?php
    include("functions.php");
    include("views/header.php");
    
    

    if ($_GET['page'] == 'car') {
        include("views/car.php");
    }
    else if ($_GET['page'] == 'home') {
        include("views/home.php");
    }
    else if ($_GET['page'] == 'profile') {
        include("views/profile.php");
    }
    else if ($_GET['page'] == 'moderation') {
        include("views/moderation.php");
    }
    else {
        include("views/home.php");   
    }
    include("views/footer.php");

    
?>