
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
                            <h5 class='p-5'> ".$row['brandName']." ".$row['carModel']."</h5>    
                                
                                <ul class='list-group list-group-flush'>
                                    <li class='list-group-item'>".$row['seatingCapacity']."</li>
                                    <li class='list-group-item'>".$row['name']."</li>
                                    <li class='list-group-item'>Vestibulum at eros</li>
                                    <a href='#' data-target='#rentModal' data-car_id='".$row['id']."' data-car_details='".$row['brandName']."  ". $row['carModel']."' class='btn btn-success rounded-pill rentThisCarButton'>Wypożycz</a>
                                </ul>   
                            </div>

                            ";
                   }
                }
            
                
                        
                
                
                
            
          
            ?>
        
    
        
</div>
