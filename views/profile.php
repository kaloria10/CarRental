

<div class="container car my-2 shadow-sm p-3 mb-5  rounded">
    <div class="row">
        
                <?php
                if (!isset($_SESSION['id'])) {
                    echo("Musisz sie zalogować!");
                } else {
                    
                    echo"<div class='container'>";
                    echo"<h5 p-5>Tutaj znajdziesz swoje zamówienia:</h5>";
                    displayUserRents('myRents');
                    echo"</div>";
                    
                }
                    
                ?>

        
    </div>
</div>