

<div class="container">
    <h2>Twoje dane:</h2>
     

    
    
    
    <br /><br /><br /><br />
    <?php
    if (!isset($_SESSION['id'])) {
        echo("Musisz sie zalogować!");
    } else {
        displayProfiles('profiles');
        
    }
        
    ?>

</div>