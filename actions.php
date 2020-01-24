<?php

    include("functions.php");

    if ($_GET['action'] == "loginSignup") {
        
        $error = "";
        
        if (!$_POST['email']) {
            
            $error = "Adres e-mail jest wymagany";
            
        } else if (!$_POST['password']) {
            
            $error = "Musisz wpisać hasło";
            
        } else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
  
            $error = "Proszę wprowadzić poprawny adres e-mail";
            
        } 
        
        if ($error != "") {
            
            echo $error;
            exit();
            
        }
        
        //SEKCJA REJESTRACJI
        
        if ($_POST['loginActive'] == "0") {
            
            $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) > 0) $error = "That email address is already taken.";
            else {
                
                $query = "INSERT INTO users (`email`, `password`) VALUES ('". mysqli_real_escape_string($link, $_POST['email'])."', '". mysqli_real_escape_string($link, $_POST['password'])."')";
                
                if (mysqli_query($link, $query)) {
                    
                    $_SESSION['id'] = mysqli_insert_id($link);
                    
                    $query = "UPDATE users SET password = '". md5(md5($_SESSION['id']).$_POST['password']) ."' WHERE id = ".$_SESSION['id']." LIMIT 1";
                    mysqli_query($link, $query);
                    
                    echo 1;
                    
                    
                    
                } else {
                    
                    $error = "Nie można utworzyć użytkownika, spróbuj później";
                    
                }
                
            }
            //SEKCJA LOGOWANIA
        } else {
            
            $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            
            $result = mysqli_query($link, $query);
            
            $row = mysqli_fetch_assoc($result);
                
                if ($row['password'] == md5(md5($row['id']).$_POST['password'])) {
                    
                    echo 1;
                    
                    $_SESSION['id'] = $row['id'];
                    
                    
                } else {
                    
                    $error = "Nie znaleziono takiego użytkownika";
                    
                }

            
        }

         if ($error != "") {
            
            echo $error;
            exit();
            
        }
        
        
        
    } else if ($_GET['action'] == "rentCar") {

        $rentError="";
        
        
        if (!isset($_SESSION['id'])) {
            $rentError = "Musisz sie zalogować żeby móc wypożyczać! <button class='closeLoginModal' data-target='#myModal' data-toggle='modal'>Kliknij tutaj aby się zalogowować</button>";
        } else if (!$_POST['timeFrom']) {
            $rentError = "Musisz wybrać od kiedy chcesz wypożyczyć samochód";
        } else if (!$_POST['timeTo']) {
            $rentError = "Musisz wybrać do kiedy chcesz wypożyczyć samochód";
        } 
        
        if ($rentError != "") {
            
            echo $rentError;
            exit();
        } else {

        $start_date = "'".$_POST['timeFrom']."'";
        $end_date = "'".$_POST['timeTo']."'";

        //$query = "SELECT * FROM leased WHERE carId = '". mysqli_real_escape_string($link, $_POST['car_id'])."' LIMIT 1";
        $query =  "SELECT * FROM `leased` WHERE `carId` = '". mysqli_real_escape_string($link, $_POST['car_id'])."' 
                                AND ((`timeFrom`>".$start_date." AND `timeTo`<".$end_date.") 
                                OR (`timeFrom`<".$start_date." AND `timeTo`>".$end_date.") 
                                OR (`timeFrom`<".$end_date." AND `timeTo`>".$end_date.") 
                                OR (`timeFrom`<".$start_date." AND `timeTo`>".$start_date."))";
        
        
                                

        $result = mysqli_query($link, $query);
        
            if (mysqli_num_rows($result) > 0) {
                $rentError = "Ten samochód jest już wypożyczony w tym czasie";
                } else {
                    $rentQuery = "INSERT INTO `leased` (`rentId`, `carId`, `renterId`, `timeFrom`, `timeTo`, `priceTotal`) VALUES (NULL, '". mysqli_real_escape_string($link, $_POST['car_id'])."', '" . $_SESSION['id'] . "', '". mysqli_real_escape_string($link, $_POST['timeFrom'])."', '". mysqli_real_escape_string($link, $_POST['timeTo'])."', '100')";
                    mysqli_query($link, $rentQuery);
                    
                    echo 11;
                }


            if ($rentError != "") {
            
                echo $rentError;
                exit();
                
            }
            



        }
    } else if ($_GET['action'] == "addOpinion") {
        
        $opinionError ="";

        if (!$_POST['reviewContent']) {
            $opinionError = "Musisz wpisać treść opinii";
        } 
        
        if ($opinionError != "") {
            
            echo $opinionError;
            exit();
        } else {

        $reviewContent = "'".$_POST['reviewContent']."'";
        $carId = "'".$_POST['carId']."'";
        $userEmail = "'".$_POST['user_email']."'";

        $addOpinionQuery = "INSERT INTO `reviews` (`carId`, `userEmail`, `reviewContent`, `reviewDate`) VALUES ($carId,$userEmail, $reviewContent, CURRENT_TIMESTAMP)";
        
        mysqli_query($link, $addOpinionQuery);
        echo 1;
    }
}   else if ($_GET['action'] == "acceptReview") {
        $acceptReviewQuery = "UPDATE `reviews` SET `reviewAccepted` = '". mysqli_real_escape_string($link, $_POST['reviewAccepted'])."'  
        WHERE `reviews`.`review_id` = '". mysqli_real_escape_string($link, $_POST['review_id'])."'";
        mysqli_query($link, $acceptReviewQuery);
}




    
    
?>