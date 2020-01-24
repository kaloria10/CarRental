<?php

session_start();

$link = mysqli_connect("localhost", "root", "", "carrental");
$link->set_charset("utf8");
if (mysqli_connect_errno()) {

    print_r(mysqli_connect_error());
    exit();
}

if (isset($_GET['function']) == "logout") {

    session_unset();
    header('Location: http://localhost/carrental/index.php?page=home"');
}


function displayProfiles($type)
{

    global $link;

    if ($type == 'profiles') {
        $whereClause = "WHERE id = " . mysqli_real_escape_string($link, $_SESSION['id']);
    }

    $query = "SELECT * FROM `users` " . $whereClause . "";

    $result = mysqli_query($link, $query);


    if (mysqli_num_rows($result) == 0) {
        echo "Nie ma żadnych użytkowników do wyświetlenia";
    } else {
        while ($row = mysqli_fetch_assoc($result)) {

            echo "Jesteś zalogowany jako: " . $row['email'] . "";
        }
    }
}

function displayUserRents($type)
{

    global $link;

    if ($type == 'myRents') {
        $whereClause = "WHERE renterId = " . mysqli_real_escape_string($link, $_SESSION['id']);


        $query = "SELECT *, cars.id AS veihicleID , (DATEDIFF(`timeTo`,`timeFrom`) * `pricePerDay`) AS priceCount FROM cars 
        LEFT JOIN brands ON cars.carBrand = brands.brandId 
        LEFT JOIN categories ON cars.category = categories.categoryId 
        LEFT JOIN leased ON cars.id = leased.carId 
        LEFT JOIN users ON leased.renterId = users.id " . $whereClause . "";


        $result = mysqli_query($link, $query);


        if (mysqli_num_rows($result) == 0) {
            echo "Nie ma nic do wyswietlenia <a href='?page=home'>Kliknij tutaj by zobaczyć jakie samochody możesz wypożyczyć</a>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {

                echo "
                       
                       <div class='card home'>
                       <div class='carImg'>
                           <img src='img/" . $row['carImage'] . "' class='img-fluid' alt='car'>
                       </div>
                           <div class='card-body'>
                           <a class='car-name' href=?page=car&IDSAMOCHODU=" . $row['veihicleID'] . "><h5 class='card-title'>" . $row['brandName'] . "  " . $row['carModel'] . "</h5></a>
                                   <table class='table table-bordered'>
                                   <tbody>
                                     <tr>
                                       <th scope='row'>Od</th>
                                       <td>" . $row['timeFrom'] . "</td>
                                     </tr>
                                     <tr>
                                       <th scope='row'>Do</th>
                                       <td>" . $row['timeTo'] . "</td>
                                     </tr>
                                     <tr>
                                       <th scope='row'>Do zapłaty</th>
                                       <td>" . $row['priceCount'] . "</td>
                                     </tr>
                                   </tbody>
                                 </table>   
                                 <a href='#' data-target='#opinionModal' data-toggle='modal' data-user_email='" . $row['email'] . "' data-car_id2=" . $row['veihicleID'] . " data-car_details='" . $row['brandName'] . "  " . $row['carModel'] . "' class='btn btn-success rounded-pill px-4 addReviewButton'>Dodaj opinię</a> 
                           </div>
                   </div>
               
                            ";
            }
        }
    }
}








function displayCar($type, $orderMethod = "rosnaco")
{
    global $link;

    if ($type == 'cars') {
        $whereClause = "";
        $sortBy = "";
    } else if ($type == 'male') {

        $whereClause = " WHERE category = 1";
    } else if ($type == 'srednie') {

        $whereClause = " WHERE category = 2";
    } else if ($type == 'dostawcze') {

        $whereClause = " WHERE category = 3";
    }

    if ($orderMethod == "malejaco") {
        $sortBy = "ORDER BY `brandName` DESC ";
    } else {
        $sortBy = "ORDER BY `brandName` ASC";
    }
    $query = "SELECT * FROM cars 
         LEFT JOIN brands ON cars.carBrand = brands.brandId 
         LEFT JOIN categories ON cars.category = categories.categoryId " . $whereClause . " " . $sortBy . "";

    /*$reviewQuery = "SELECT COUNT(review) FROM reviews WHERE"*/

    $result = mysqli_query($link, $query);



    if (mysqli_num_rows($result) == 0) {
        echo "Nie ma nic do wyswietlenia";
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            
            echo "
                            <div class='card home'>
                                <div class='carImg'>
                                    <a href=?page=car&IDSAMOCHODU=" . $row['id'] . "><img src='img/" . $row['carImage'] . "' class='img-fluid' alt='car'></a>
                                </div>
                                    <div class='card-body'>
                                            <a class='car-name' href=?page=car&IDSAMOCHODU=" . $row['id'] . "><h5 class='card-title'>" . $row['brandName'] . "  " . $row['carModel'] . "</h5></a>
                                            <ul>
                                                <li class='specIco'><img class='sm-icon' alt='ilosc osob' src='img/people.svg'>" . $row['seatingCapacity'] . "</li>
                                                <li class='specIco'><img class='sm-icon' alt='paliwo' src='img/fuel.svg'>" . $row['fuelType'] . "</li>
                                                <li class='specIco'><img class='sm-icon' alt='skrzynia biegów' src='img/shift.svg'>" . $row['transmission'] . "</li>
                                            </ul>
                                            <table class='table table-bordered'>
                                                <tbody>
                                                    <tr>
                                                    <th scope='row'>Kategoria:</th>
                                                    <td>" . $row['name'] . "</td>
                                                    </tr>
                                                    <tr>
                                                    <th scope='row'>Cena za dzień</th>
                                                    <td>" . $row['pricePerDay'] . " zł</td>
                                                    </tr>";
                                                    $countReviewsQuery = "SELECT *, COUNT(review_id) AS NumberOfReviews FROM reviews WHERE carId = " . $row['id'] . " AND `reviews`.`reviewAccepted` = 1";
                                                        $result2 = mysqli_query($link, $countReviewsQuery);
                                                        while ($row2 = mysqli_fetch_assoc($result2)){

                                                            echo"
                                                    <tr>
                                                    <th scope='row'>Liczba opinii</th>
                                                    <td>" . $row2['NumberOfReviews'] . "</td>
                                                    </tr>";}
                                                    echo"
                                                    
                                                </tbody>
                                            </table> 
                                        
                                        <a href=?page=car&IDSAMOCHODU=" . $row['id'] . " class='btn btn-success rounded-pill'>Więcej</a>
                                        <a href='#' data-toggle='modal' data-target='#rentModal' data-car_id='" . $row['id'] . "' data-car_details='" . $row['brandName'] . "  " . $row['carModel'] . "' class='btn btn-success rounded-pill rentThisCarButton'>Wypożycz</a>
                                    
                                    </div>
                            </div>
                        ";
        }
    }
}
function displayOpinion($type)
{

    global $link;

    if ($type == 'opinion') {
        $whereOpinion = "WHERE carId = " . $_GET['IDSAMOCHODU'] . " AND `reviews`.`reviewAccepted` = 1";
        $query = "SELECT * FROM reviews 
        LEFT JOIN users ON reviews.userEmail = users.email " . $whereOpinion . "" ;
        



        $result = mysqli_query($link, $query);


        if (mysqli_num_rows($result) == 0) {
            echo "Nie ma jeszcze żadnych opinii";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {

                echo "<div class='border border-primary shadow-sm p-3 mb-5 rounded '>
                       <h5 style='display:inline-block'>" . $row['email'] . "</h5> <p style='display:inline-block' class='font-italic'> " . $row['reviewDate'] . " </p>
                       <p> " . $row['reviewContent'] . " </p>
                       </div>";
            }
        }
    }
}

function displayOpinionModeration($type)
{

    global $link;

    if ($type == 'opinion') {

        if ($_SESSION['id'] == 2) {

            
            $query = "SELECT * FROM reviews 
            LEFT JOIN users ON reviews.userEmail = users.email WHERE `reviews`.`reviewAccepted` = 0";



            $result = mysqli_query($link, $query);


            if (mysqli_num_rows($result) == 0) {
                echo "Nie ma nic do wyswietlenia";
            } else {
                while ($row = mysqli_fetch_assoc($result)) {

                    echo "<div class='border border-primary shadow-sm p-3 mb-5 rounded'>
                   <h5 style='display:inline-block'>" . $row['email'] . "</h5> <p style='display:inline-block' class='font-italic'> " . $row['reviewDate'] . " </p>
                   <p> " . $row['reviewContent'] . " </p>
                   <a href=# data-opinion_id='".$row['review_id']."' class='btn btn-danger rounded-pill acceptReview'>Zaakceptuj</a> 
                   </div>";
                }
            }
        } else {
            $message = "Musisz być zalgowany jako administrator aby moderować opinie";
            echo "<script type='text/javascript'>alert('$message');
            window.location.assign('index.php?page=home');
            </script>";
        }
    }
}
