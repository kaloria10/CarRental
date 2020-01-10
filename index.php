<?php
    include("functions.php");
    include("views/header.php");
    
    

    if ($_GET['page'] == 'car') {
        include("views/car.php");
    }
    else if ($_GET['page'] == 'home') {
        include("views/home.php");
    }
    include("views/footer.php");

    
?>