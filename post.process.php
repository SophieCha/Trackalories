<?php 
  include "./includes/class-autoload.inc.php";

  

  $newAliment = new Posts();

  /*post.process permet de traiter les différents formulaires envoyés  
  /* Premier cas, gestion du formulaire sign in*/
  
  if(isset($_POST['signIn'])) {

    
    
   $firstName = $_POST['firstName'];
    $lastname = $_POST['lastname'];
    $emailSignIn = $_POST['emailSignIn'];
    $passwordSignIn = $_POST['passwordSignIn'];
    $passwordConfirmation = $_POST['passwordConfirmation'];
    $sex = $_POST['sex'];
    $birthyear = $_POST['birthday'];
    $size = $_POST['size'];
    $weight = $_POST['weight'];

    $user = new User($emailSignIn);
    //$user->userExist();
    echo $weight;
    $user->addUser($firstName, $lastname, $emailSignIn, $passwordConfirmation,$sex,$birthyear,$size,$weight);



        /*//verif if email doesn't exist
        $result= ($user->getUserEmail($emailSignIn));

        if ($result === true ){
            //true -> existe déjà
            include '/index.php';
            echo 'email already in use';
        
            }else{
                //false-> n'existe pas encore, dpnc peut s'inscrire
                $user->addUser($firstName, $lastname, $emailSignIn,$passwordConfirmation,$sex,$birthday,$size,$weight);
                //redirection vers le compte user.
                $user->connectUser($emailSignIn,$passwordConfirmation);
                header("location: {$_SERVER['HTTP_ORIGIN']}/Kilos2/user-page.php");
            }*/
    
    /*ici gestion du formulaire de Login*/
    }else if(isset($_POST['login'])){
        
        $emailLogin = $_POST['emailLogin'];
        $passwordLogin = $_POST['passwordLogin'];

        $user = new User($emailLogin);
        $user->connectUser($passwordLogin);
       
       //s $result= ($user->connectUser($emailLogin,$passwordLogin));

    
    /*ici gestion du formulaire d'insertion d'aliments*/
    }else if(isset($_POST['submit'])) {
    
        var_dump($_POST);
        $title = $_POST['post-title'];
        $body = $_POST['post-content'];
        $author = $_POST['post-author'];
        $email = $_POST['getSession'];
  
        $newAliment->addAliment($title, $body, $author,$email);
  
        header("location: {$_SERVER['HTTP_REFERER']}");
    }

  ?>