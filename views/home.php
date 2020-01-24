<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 text-center">Wypożyczalnia samochodów</h1>
  </div>
</div>

<div class="container ">
  <div class="navbar justify-content-center">
      <form method="post">
        <input class="btn btn-primary rounded-pill shadow-sm" type="submit" name="wszystkie" value="Wszystkie"/>
        <input class="btn btn-primary rounded-pill shadow-sm " type="submit" name="male" value="Małe"/>
        <input class="btn btn-primary rounded-pill shadow-sm " type="submit" name="srednie" value="Średnie"/>
        <input class="btn btn-primary rounded-pill shadow-sm " type="submit" name="dostawcze" value="Dostawcze"/> <br />
    </form>
    <form>
    <!--
    <select>
      <option name="alfabetycznie" value="alfabetycznie">Rosnąco</option>
      <option name="malejaco" value="malejaco">Malejąco</option>
    </select>
    </form>
    -->
    
  </div>
  <div class="row">
    <div class="col align-items-center">        
        <?php

        
        if (isset($_POST['male'])) {
            displayCar("male", "");
        } else if (isset($_POST['srednie'])) {
            displayCar("srednie", "");
        } else if (isset($_POST['dostawcze'])) {
            displayCar("dostawcze", "");
        } else {
          
            displayCar("cars", "");
        }
        

        ?>
     
    </div>
  </div>
</div>

