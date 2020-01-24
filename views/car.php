
<div class="container car my-2 shadow-sm p-3 mb-5  rounded">
    <div class="row">
        <div class="col-md-4">
            <?php
                
                
                $whereClause = "WHERE id = ".$_GET['IDSAMOCHODU'];
                $query = "SELECT * FROM cars 
                LEFT JOIN brands ON cars.carBrand = brands.brandId 
                LEFT JOIN categories ON cars.category = categories.categoryId ".$whereClause."";
               
               /*$reviewQuery = "SELECT COUNT(review) FROM reviews WHERE"*/
       
               $result = mysqli_query($link, $query);
               
               
       
               if (mysqli_num_rows($result) == 0) {
                   echo "Nie ma nic do wyswietlenia";
               } else {
                   while ($row = mysqli_fetch_assoc($result)) {
                       
                       echo " 
 
                                <div class='card'>
                                
                                    <img src='img/".$row['carImage']."' class='img-fluid' alt='car'>
                                
                                </div>
                            </div>
                            <div class='col-md-4'></div>
                            <div class='col-md-4'>
                               
                                
                            <table class='table table-bordered'>
                                <thead class='thead-dark'>
                                    <tr>
                                    <th scope='col' colspan='2'>".$row['brandName']." ".$row['carModel']."</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <th scope='row'>Kategoria:</th>
                                        <td>".$row['name']."</td>
                                    </tr>
                                    <tr>
                                        <th scope='row'>Liczba miejsc:</th>
                                        <td>".$row['seatingCapacity']."</td>
                                    </tr>
                                    <tr>
                                        <th scope='row'>Skrzynia biegów:</th>
                                        <td>".$row['transmission']."</td>
                                    </tr>
                                    <tr>
                                        <th scope='row'>Pojemność bagażnika:</th>
                                        <td>".$row['trunkCapacity']."</td>
                                    </tr>
                                    <tr>
                                        <th scope='row'>Cena za dzień</th>
                                        <td>".$row['pricePerDay']." zł</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href='#' data-toggle='modal' data-target='#rentModal' data-car_id='".$row['id']."' data-car_details='".$row['brandName']."  ". $row['carModel']."' class='btn btn-success rounded-pill rentThisCarButton'>Wypożycz</a>


                            </div>

                            ";
                   }
                }
            
                
                        
                
                
                
            
          
            ?>
        
    
        
    </div>
</div>
</div>
<div class='row'>
    <div class="container car my-2 shadow-sm p-3 mb-5  rounded">
        <h2>Opinie</h2>
        <?php displayOpinion("opinion") ?>
    </div>
</div>
