
<footer>
    
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="loginModalTitle">Login</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="alert alert-danger" id="loginAlert"></div>
        <form>
            <input type="hidden" id="loginActive" name="loginActive" value="1">
  <fieldset class="form-group">
    <label for="email">E-mail</label>
    <input type="email" class="form-control" id="email" placeholder="E-mail">
  </fieldset>
  <fieldset class="form-group">
    <label for="password">Hasło</label>
    <input type="password" class="form-control" id="password" placeholder="Hasło">
  </fieldset>
</form>
      </div>
      <div class="modal-footer">
          <a id="toggleLogin">Rejestracja</a>
          
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
        <button type="button" id="loginSignupButton" class="btn btn-primary">Zaloguj się</button>
      </div>
    </div>
  </div>
  
</div>
    
    </div>
  </div>
</div>
<script>
        $("#toggleLogin").click(function() {
          
            //jeżeli element o id="loginActive" przyjmię wartość 1 to:
            if ($("#loginActive").val() == "1") {
                
                $("#loginActive").val("0");
                $("#loginModalTitle").html("Rejestracja");
                $("#loginSignupButton").html("Zarejestruj się");
                $("#toggleLogin").html("Wróć do logowania");

            } else {
                $("#loginActive").val("1");
                $("#loginModalTitle").html("Logowanie");
                $("#loginSignupButton").html("Zaloguj się");
                $("#toggleLogin").html("Utwórz konto");
            }
            
        })
        
        /*$(".carInfo").click(function() {
          $.ajax({
            type: "POST",
            url: "views/car.php?action=showCarInfo", 
            data: "carId=" + $(this).attr("data-carId"),
            success: function(result) {
              alert(result);
              window.location.assign("http://localhost/carrental/index.php?page=car");   
              
            }  
        })
        })
        */

        $("#loginSignupButton").click(function() {
        
        $.ajax({
            type: "POST",
            url: "actions.php?action=loginSignup", 
            data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
            success: function(result) {
              if (result == "1") {
                
                window.location.assign("http://localhost/carrental/index.php?page=profile");    

            } else {
              $("#loginAlert").html(result).show();
            }
            }  
        })
        
    })

    
    
    </script>
  </body>
</html>

