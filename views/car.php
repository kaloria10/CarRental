
<div class="container car my-2 shadow-sm p-3 mb-5  rounded">
    <div class="row">
        <div class="col-sm-6">
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
                                <div class='carImg'>
                                    <img src='img/".$row['carImage']."' class='img-fluid' alt='car'>
                                </div>
                            </div>
                            ";
                   }
                }
            
                
                        
                
                
                
            
          
            ?>
        </div>
        <div class="col-sm-6">
            <p>tutduduua</p>
        </div>
    </div>
