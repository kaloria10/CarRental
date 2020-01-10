<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 text-center">Wypożyczalnia samochodów</h1>
  </div>
</div>

<div class="container ">
  <div class="navbar justify-content-center">
      <form method="post">
        <input type="submit" name="wszystkie" value="Wszystkie"/>
        <input type="submit" name="male" value="Małe"/>
        <input type="submit" name="srednie" value="Średnie"/>
        <input type="submit" name="dostawcze" value="Dostawcze"/>
    </form>
    
  </div>
  <div class="row">
    <div class="col align-items-center">        
        <?php

        if (isset($_POST['wszystkie'])) {
          displayCar("cars");
        }
        else if (isset($_POST['male'])) {
          displayCar("male");
        }
        else if (isset($_POST['srednie'])) {
          displayCar("srednie");
        }
        else if (isset($_POST['dostawcze'])) {
          displayCar("dostawcze");
        }

      
      
    

        

        ?>
     
    </div>
  </div>
</div>