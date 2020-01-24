<!DOCTYPE html>
<html lang="pl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    

    <title>Car Rental</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="?page=home">Car Rental</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="?page=games">link1</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=fields">link2</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=profile">Twój profil</a>
                </li>
                
                <?php 
                $_SESSION['id'] = (isset($_SESSION['id']) ? $_SESSION['id'] : NULL);
                if ($_SESSION['id']==2) {
                    echo "<li class='nav-item active'>
                        <a class='nav-link' href='?page=moderation'>Panel administratora</a>
                    </li>";
                }
                ?>
            </ul>
            
            <!--
            <div class="form-inline pull-xs-right">
                
                <?php /*
                if (!isset($_SESSION['id'])) {
                    echo"<a href='?page=profile' class='nick'>"; displayProfiles('profiles'); echo "</a>";
                } else {
                    echo "";
                } */
                ?>
            </div>
            -->
            
            <div class="form-inline pull-xs-right">

                
                <?php if (isset($_SESSION['id'])) { ?>

                    <a class="btn btn-primary ml-2 my-sm-0" href="?function=logout" role="button">Wyloguj</a>

                <?php } else { ?>

                    <button class="btn btn-primary ml-2 my-sm-0" data-toggle="modal" data-target="#myModal">Logowanie/Rejestracja</button>

                <?php } ?>
                

        </div>
    </nav>