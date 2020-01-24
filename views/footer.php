
<footer>
    
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- Modal logowanie/rejestracja-->
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
<!-- Modal wypozyczenia -->
<div class="modal fade" id="rentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Wypożycz samochód</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="alert alert-danger" id="rentAlert"></div>
        <input type="hidden" id="idHolder" name="idHolder" value="">
        <p>Wypożyczasz auto: <span id="carDetails"></span>
            <form>
              <div class="form-group">
                <label for="timeFrom">Od kiedy?</label>
                <input type="datetime-local" class="form-control" id="timeFrom" placeholder="Od kiedy" value=2020-01-16T19:30>
              </div>
              <div class="form-group">
                <label for="timeTo">Do kiedy?</label>
                <input type="datetime-local" class="form-control" id="timeTo" placeholder="Do kiedy?" value=2020-01-17T16:20>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
        <button type="button" id="confirmRent" class="btn btn-primary">Zatwierdź</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="opinionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodaj opinię</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="alert alert-danger" id="opinionAlert"></div>
        <input type="text" id="idOpinionHolder" name="idOpinionHolder" value="">
        <input type="text" id="emailHolder" name="emailHolder" value="">
        <p>Oceniasz auto: <span id="carOpinionDetails"></span>
            <form>
              <div class="form-group">
                <label for="opinion">Dodaj opinię</label>
                <textarea class="form-control" id="opinionContent" rows="3"></textarea>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
        <button type="button" id="confirmOpinion" class="btn btn-primary">Zatwierdź</button>
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

    $(".rentThisCarButton").click(function() {
      var car_details = $(this).data('car_details');
      var car_id = $(this).data('car_id');
      $('#carDetails').html( car_details );
      $('#idHolder').val( car_id );
    })

    $(".addReviewButton").click(function() {
      var car_details = $(this).data('car_details');
      var car_id2 = $(this).data('car_id2');
      var user_email = $(this).data('user_email');
      $('#carOpinionDetails').html( car_details );
      $('#idOpinionHolder').val( car_id2 );
      $('#emailHolder').val( user_email );
    })
    

    $("#confirmRent").click(function() {
      $.ajax({
            type: "POST",
            url: "actions.php?action=rentCar", 
            data: "timeFrom=" + $("#timeFrom").val() + "&timeTo=" + $("#timeTo").val() + "&car_id=" + $("#idHolder").val(),
            success: function(result) {
              if (result == "11") {
                
                window.location.assign("http://localhost/carrental/index.php?page=profile");    

            } else {
              $("#rentAlert").html(result).show();
            }
            } 
        })
    
    })

    $("#confirmOpinion").click(function() {
      $.ajax({
            type: "POST",
            url: "actions.php?action=addOpinion", 
            data: "reviewContent=" + $("#opinionContent").val() + "&carId=" + $("#idOpinionHolder").val() + "&user_email=" + $("#emailHolder").val(),
            success: function(result) {
              if (result == "1") {
                
                window.location.assign("http://localhost/carrental/index.php?page=car&IDSAMOCHODU=" + $("#idOpinionHolder").val(),);   //POPRAWIĆ TO 

            } else {
              $("#opinionAlert").html(result).show();
            }
            } 
        })
    
    })
    
    $(".closeLoginModal").click(function() {
      $('#MyModal').modal('show');
      $('#rentModal').modal('hide');
    });

    $(".test").click(function() {
      $('#rentModal').modal('show');
    })

    
    
    
    </script>
  </body>
</html>

