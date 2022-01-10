<?php 
include('./includes/class-autoload.inc.php');
/*dans l'idéal, session start dans le header, + fonctionnalité pr se souvenir de la personne*/



session_start();

unset($_SESSION['email']);//temporaire pr débugguer=disconnect






require_once('./assets/templates/header.php');

//$user = new User('admin@mail.com');
//$user->userExist(); 
//$user->connectUser('db');
//$user->connectUser();
//$user->displayInfoUser('firstname'); 





?>

<!--Home page of the application, use to login or sign in-->
<body class="bg-warning ">
    <div class="container bg-light bg-gradient shadow-lg col-8 col-lg-6 mb-5 mt-5 rounded-3 ">
    <section class="d-flex flex-column justify-content-center align-items-center text-center">    
    <h1 class="display-2 mt-4 ">TracKalories </h1>
    <p class="strong fw-lighter">Follow your diet to shine like an athlete!</p>
    <img class="img-fluid col-6 mt-5 mb-4" src="assets/img/potato.png" alt="man trying to be fit" />

    <?php if(isset ($_SESSION['error'])){

      ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> <?php echo $_SESSION['error'];?> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

   <?php
    }
  
    unset($_SESSION['error']);?>

   
  
  

    <!--Login part -->
  <button class="btn btn-lg  btn-warning mb-3 col-8 text-center shadow " type="button" data-bs-toggle="collapse" data-bs-target="#formLogin" aria-expanded="false" aria-controls="formLogin">LOGIN</button>
  
  <!--Hidden form, visible when you want to login-->
  <form class="collapse col-8" name="formLogin" id="formLogin" action="./post.process.php" method="post">
     <input type="email" name="emailLogin" class="form-control" id="emailLogin" placeholder="Email adress" aria-describedby="emailInsertion" required></input>
     <input type="password" name="passwordLogin" class="form-control mt-1 " id="passwordLogin" placeholder="Password" required></input>
    <button type="submit" name="login" class="btn btn-sm btn-success mt-1 col-5">Enter</button>
  </form>


 

  
    <!--Sign in part  -->
    <p class="small mt-3 mb-1">Here for the first time?</p>
    <button type="button" class="btn btn-outline-warning shadow-sm mb-3" data-bs-toggle="collapse" data-bs-target="#formSignIn" aria-expanded="false" aria-controls="formSignIn">Sign up</button>
    <!--Hidden form, visible when you want to login-->
    <form class="collapse col-8 " id="formSignIn" name="formSignIn" action="./post.process.php" method="post">
     <input type="text" class="form-control mb-1" name="firstName" id="firstName" placeholder="First Name" required></input>
     <input type="text" class="form-control mb-1" name="lastname" id="lastname" placeholder="lastname" required></input>
    <input type="email" class="form-control mb-1" name="emailSignIn" id="emailSignIn" placeholder="Email adress" aria-describedby="emailInsertion" required></input>
     <input type="password" class="form-control mb-1 " name="passwordSignIn" id="passwordSignIn" placeholder="Choose password" required></input>
     <input type="password" class="form-control mb-1 " name="passwordConfirmation" id="passwordConfirmation" placeholder="Confirm password" required></input>
     <select class="form-select mb-1 text-muted" name="sex" aria-label="Default select example" required>
        <option value="M">Men</option>
        <option value="W">Women</option>
        <option value="N">Prefer not to say</option>
      </select>
      
     <input type="number" class="form-control mb-1" name="birthday" id="birthday" placeholder="Year of birth (ex: 1955)"  min="1910" max="2022" maxlength="4" required></input>
     <input type="number" class="form-control mb-1 "name="size" id="size" placeholder="size in cm" maxlength="3" min="50" max="300"required></input>
     <input type="number" class="form-control mb-1 "name="weight" id="weight" placeholder="weight (full number)" min="10" max="999" maxlength="3" required></input>  
     
     <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="acceptingTerms" required>
      <label class="form-check-label" for="acceptingTerms">
        Agree to terms and conditions.
      </label>
    </div>
    <button type="submit" name="signIn" class="btn btn-sm btn-success  col-md-5 col-sm-6 mt-1 mb-4" >Continue</button>
  </form>
</section>
</div>

<?php require_once('./assets/templates/footer.php');?>
    
    

    