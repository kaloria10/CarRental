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
        header ('Location: http://localhost/carrental/index.php?page=home"');
        
    }


    function displayProfiles($type) {
        
        global $link;
        
        if ($type == 'profiles') {
            $whereClause = "WHERE id = ". mysqli_real_escape_string($link, $_SESSION['id']);
        }

        $query = "SELECT * FROM uzytkownicy ".$whereClause."";
        
        $result = mysqli_query($link, $query);


        if (mysqli_num_rows($result) == 0) {
            echo "Nie ma żadnych użytkowników do wyświetlenia";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {

                echo "Twój email to: " .$row['email']."<br />";
                
                

            }
        }
        
        
    }
    
    /*function displayFields($type) {
        
        global $link;
        
        if ($type == 'public') {
            $whereClause = "";
        }
        
            
        $query = "SELECT * FROM boiska ".$whereClause." ORDER BY `miejscowosc` DESC LIMIT 10";
        
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) == 0) {
            echo "Nie ma żadnych boisk do wyświetlenia";
        } else {
            echo "<table class=table>";
            echo "<thead class=thead-dark>";
            echo "<tr>";
            echo "<th>Nr boiska</th>";
            echo "<th>Miejscowość</th>";
            echo "<th>Ulica</th>";
            echo "<th>Nr_lokalu</th>";
            echo "<th>Kod pocztowy</th>";
            echo "<th>Godzina otwarcia</th>";
            echo "<th>Godzina zamknięcia</th>";
            echo "<th>Typ nawierzchni</th>";
            echo "<th>oświetlenie</th>";
            echo "<th>Opis</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                
              
                
                echo "<tr>";
                echo "<td>".$row['id_boiska']."</td>";
                echo "<td>".$row['miejscowosc']."</td>";
                echo "<td>".$row['ulica']."</td>";
                echo "<td>".$row['nr_lokalu']."</td>";
                echo "<td>".$row['kod_pocztowy']."</td>";
                echo "<td>".$row['godzina_otwarcia']."</td>";
                echo "<td>".$row['godzina_zamkniecia']."</td>";
                echo "<td>".$row['typ_nawierzchni']."</td>";
                echo "<td>".$row['oswietlenie']."</td>";
                echo "<td>".$row['opis_boiska']."</td>";
                echo "</tr>";
                
            }
            echo "</table>";
        }
    }

    function displayGames($type) {
        
        global $link;
        
        if ($type == 'public') {
            $whereClause = "";
        }

        //$query = "SELECT * FROM mecze ".$whereClause." ORDER BY `id_meczu` ASC LIMIT 10";
        $query2 = "SELECT id_meczu, h_rozpoczecia, h_zakonczenia, miejsca, opis, data_meczu, mecze.id_umiejetnosci, boiska.id_boiska, ulica, nr_lokalu, kod_pocztowy, miejscowosc, godzina_otwarcia, godzina_zamkniecia, opis_boiska, typ_nawierzchni, oswietlenie, umiejetnosci.id_umiejetnosci, umiejetnosci_gry
            FROM boiska 
            JOIN mecze 
            ON boiska.id_boiska = mecze.id_boiska
            JOIN umiejetnosci
            ON mecze.id_umiejetnosci = umiejetnosci.id_umiejetnosci".$whereClause."";
        $result = mysqli_query($link, $query2);

        if (mysqli_num_rows($result) == 0) {
            echo "Nie ma żadnych meczów do wyświetlenia";
        } else {
            echo "<table class=table>";
            echo "<thead class=thead-dark>";
            echo "<tr>";
            echo "<th>Mecz</th>";
            echo "<th>Dnia</th>";
            echo "<th>Godzina rozpoczęcia</th>";
            echo "<th>Godzina zakończenia</th>";
            echo "<th>Miejsc</th>";
            echo "<th>Umiejętności</th>";
            echo "<th>Opis</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                
                echo "<tr style=font-weight:bold>";
                echo "<td>".$row['id_meczu']."</td>";
                echo "<td>".$row['data_meczu']."</td>";
                echo "<td>".$row['h_rozpoczecia']."</td>";
                echo "<td>".$row['h_zakonczenia']."</td>";
                echo "<td>".$row['miejsca']."</td>";
                echo "<td>".$row['umiejetnosci_gry']."</td>";
                echo "<td>".$row['opis']."</td>";
                
                echo "<tr>";
                echo "<thead class=thead-light>";
                echo "<tr>";
                echo "<th>Boisko:</th>";
                echo "<th>".$row['miejscowosc'].", ".$row['ulica']." ".$row['nr_lokalu']."</th>";
                echo "<th>".$row['typ_nawierzchni']."</th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";

                echo "</tr>";
                
            }
            echo "</table>";
        }
    }


    function displayUserGames($type) {
        
        global $link;
        
        if ($type == 'userGames') {
            $whereClause = "";
        }

        //$query = "SELECT * FROM mecze ".$whereClause." ORDER BY `id_meczu` ASC LIMIT 10";
        $query2 = "SELECT mecze.id_meczu, mecze.h_rozpoczecia, mecze.h_zakonczenia, mecze.miejsca, mecze.opis, mecze.data_meczu, mecze.id_umiejetnosci, boiska.id_boiska, boiska.ulica, boiska.nr_lokalu, boiska.kod_pocztowy, boiska.miejscowosc, boiska.godzina_otwarcia, boiska.godzina_zamkniecia, boiska.opis_boiska, boiska.typ_nawierzchni, boiska.oswietlenie, umiejetnosci.id_umiejetnosci, umiejetnosci.umiejetnosci_gry, mecze_zawodnicy.id_meczu, mecze_zawodnicy.id_uzytkownika
            FROM boiska 
            JOIN mecze 
            ON boiska.id_boiska = mecze.id_boiska
            JOIN umiejetnosci
            ON mecze.id_umiejetnosci = umiejetnosci.id_umiejetnosci
            JOIN mecze_zawodnicy ON mecze.id_meczu = mecze_zawodnicy.id_meczu
            WHERE mecze_zawodnicy.id_uzytkownika = '".$_SESSION['id']."'";
            
        $result = mysqli_query($link, $query2);

        if (mysqli_num_rows($result) == 0) {
            echo "  Nie zapisałeś się jeszcze na żaden mecz.";
        } else {
            echo "<table class=table>";
            echo "<thead class=thead-dark>";
            echo "<tr>";
            echo "<th>Mecz</th>";
            echo "<th>Dnia</th>";
            echo "<th>Godzina rozpoczęcia</th>";
            echo "<th>Godzina zakończenia</th>";
            echo "<th>Miejsc</th>";
            echo "<th>Umiejętności</th>";
            echo "<th>Opis</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                
                echo "<tr style=font-weight:bold>";
                echo "<td>".$row['id_meczu']."</td>";
                echo "<td>".$row['data_meczu']."</td>";
                echo "<td>".$row['h_rozpoczecia']."</td>";
                echo "<td>".$row['h_zakonczenia']."</td>";
                echo "<td>".$row['miejsca']."</td>";
                echo "<td>".$row['umiejetnosci_gry']."</td>";
                echo "<td>".$row['opis']."</td>";
                echo "<tr>";
                echo "<thead class=thead-light>";
                echo "<tr>";
                echo "<th>Boisko:</th>";
                echo "<th>".$row['miejscowosc'].", ".$row['ulica']." ".$row['nr_lokalu']."</th>";
                echo "<th>".$row['typ_nawierzchni']."</th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "</tr>";
                
            }
            echo "</table>";
        }
    }

        
    

    

    

  

*/
?>
