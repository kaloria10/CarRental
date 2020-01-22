

<div class="container car my-2 shadow-sm p-3 mb-5  rounded">
    <div class="row">
        <div class="col-md-4">

                <br /><br /><br /><br />
                <?php
                if (!isset($_SESSION['id'])) {
                    echo("Musisz sie zalogować!");
                } else {
                    displayProfiles('profiles');
                    
                    displayUserRents('myRents');
                }
                    
                ?>

        </div>
    </div>
</div>