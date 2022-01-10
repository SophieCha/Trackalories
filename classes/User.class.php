<?php 
session_start();

  /* --classe User parent Dbh(-> pr connection à la bdd)
        -> CRUD de la table 'users'.
        -> instancié pour tout ce qui sera relatif aux users.--*/

class User extends Dbh {

  public $session;
  private $id;
  private $firstname;
  private $lastname;
  private $email;
  private $password;
  private $sex;
  private $birthyear;
  private $size;
  private $weight;
  private $emailFound;
  // requête chercher ds bdd avec email
  private $sql = "SELECT * FROM users WHERE email=?";



    /* -- paramètre nécessaire pour instanciation de l'objet User : adresse email!--*/
  public function __construct($email){
        //if(!isset($_SESSION['email'])){
          $this->email=$email;
         
          
        //}else{
          //echo $email;
          //$this->email=$_SESSION['email'];
          //$stmt = parent::connect()->prepare($this->sql);
         //$stmt->execute([$this->email]);
          //echo 'session'.$this->email;
          //$emailFound = $stmt->fetchAll();
          //$this->emailFound = $emailFound;
         // $this->setValues();
          //$this->displayInfoUser('firstname');
         //header("location: {$_SERVER['HTTP_ORIGIN']}/Kilos2/user-page.php");


       // }
      }   
        



     /* -- userExist() -> check si $this->email est existant dans la bdd --*/
  public function userExist(){
    
    
        $stmt = parent::connect()->prepare($this->sql);
        $stmt->execute([$this->email]);
        $emailFound = $stmt->fetchAll();

        if ($emailFound ){
            //user existe
            $this->emailFound=$emailFound;
            //var_dump($this->emailFound);
            //echo 'user existe ! ';
            return true;
            
        }else{
            //user n'existe pas
            //echo 'no user';
            //header("location: {$_SERVER['HTTP_ORIGIN']}/Kilos2/index.php");
            
            return false;
            }

            
  }

  protected function checkPassword($pwdInput){
    //!!!$this->checkPassword('yy');//param=_POST pwd confirm login

        //récupère le mdp qui correspond à l'email d'un user
        foreach ($this->emailFound as $info){
          $result=$info['password'];
          //déboggueur:
          //echo $result;
          
        }

        if ($result === $pwdInput){
          //déboggueur:
          //echo 'le mdp est correct : saisi= '.$pwdInput.' in BDD= '.$result;
          return true;
        }else{
          //déboggueur:
          //echo 'le mdp est incorrect : saisi= '.$pwdInput.' in BDD= '.$result;
          $_SESSION['error']='error password';
          header("location: {$_SERVER['HTTP_ORIGIN']}/Trackalories/index.php");
          return false;
        }
      //! look after !!!$mdpcheck = password_verify($mdp, $result['password']);
      }


    public function connectUser($pwdInput){

        $result =($this->userExist());
         if($result === true){
           $result=$this->checkPassword($pwdInput);
            if($result === true){
            echo "<br />tu es connecté";
            $this->setValues();
            //session_start();
            $_SESSION['email'] = $this->email;
            $_SESSION['password']=$this->password;
            $this->session = 'connected';
            //echo $this->session;
            header("location: {$_SERVER['HTTP_ORIGIN']}/Trackalories/user-page.php");
            
            //Déboggueur
            //$this->displayInfoUser('size');
            } else{
            $_SESSION['error']='Incorrect password, please try again!';
            header("location: {$_SERVER['HTTP_ORIGIN']}/Trackalories/index.php");
            }
        }else{

            $_SESSION['error']='This email was not found, please sign up first!';
            header("location: {$_SERVER['HTTP_ORIGIN']}/Trackalories/index.php");

        }}

  /* --  setValues()-> fonction appelé par user si email/user existe, récupère les infos ds la base de données et les attributs aux variables correspondantes dans un objet user --*/
  private function setValues(){
    $value =$this->emailFound;

        foreach($value as $info){
          
          $this->id = $info['id'];
          //echo $this->id." ";
          $this->firstname = $info['firstname'];
          //echo $this->firstname." ";
          $this->lastname=$info['lastname'];
          //echo $this->lastname." ";
          $this->email=$info['email'];
          //echo $this->email." ";
          $this->password=$info['password'];
          //echo $this->password." ";
          $this->sex=$info['sex'];
          //echo $this->sex." ";
          $this->birthyear=$info['birthyear'];
          //echo $this->birthyear." ";
          $this->size=$info['size'];
          //echo $this->size." ";
          $this->weight=$info['weight'];
          //echo $this->weight." ";
          }
        
        }
            


   /* --getInfoUser()->permet de récupérer un élément d'une ligne de la table user $param étant le nom de la colonne de la donnée que l'on souhaite récupérer--*/
  public function getInfoUser($param){

      return($this->$param);
  }


  /* --displayInfoUser()->permet d'afficher un élément d'une ligne de la table user $param étant le nom de la colonne de la donnée que l'on souhaite afficher--*/
  public function displayInfoUser($param){
     
    echo ' '.$this->$param.' ';
      
  
  } 
  

  /* --addUser()->ajouter un nouvel utilisateur, $paramètres récupérés du form signIn-- */
  public function addUser($firstName, $lastname, $emailSignIn, $passwordConfirmation,$sex,$birthyear,$size,$weight) {
    $this->userExist($emailSignIn);
    if ($this->userExist() === false){
    
      $sql = "INSERT INTO users (`firstname`, `lastname`,`email`,`password`,`sex`,`birthyear`,`size`,`weight`) VALUES (?,?,?,?,?,?,?,?);";
      $stmt = parent::connect()->prepare($sql);
      $stmt->execute([$firstName, $lastname, $emailSignIn, $passwordConfirmation,$sex,$birthyear,$size,$weight]);
      //puis lier à fonction connect
      $this->connectUser($passwordConfirmation);

    }else{
      
      $_SESSION['error']='This email is already in use, login instead 😉!';
      header("location: {$_SERVER['HTTP_ORIGIN']}/Trackalories/index.php");
    };
  }

  public function restoreDataFromSession(){
    //si pas de session->index + msg erreur;
    if(!isset ($_SESSION['email'])){
      $_SESSION['error'] =' ⛔ You cannot access to this page! ⛔';
      header("location: {$_SERVER['HTTP_ORIGIN']}/Trackalories/index.php");
    }else{
      $this->userExist();
      $this->setValues();
      //echo $this->birthyear." 🎂";

    };
  } 
    

  public function calculateAge(){
    $actualYear = date("Y");
    $birthYearUser = $this->getInfoUser('birthyear');

    $age = $actualYear - $birthYearUser;
    echo $age;

  }


  public function calculateBmi(){
    
      //On convertit d'abord les données en nombres.
      $weight = (float)$this->getInfoUser('weight');
      //echo $weight;
      $size = (float)$this->getInfoUser('size');
      //echo $size;
      //Puis on calcule l'IMC
      $bmi=($weight/($size**2))*10000;
      echo number_format($bmi,1);

      if ($bmi > 40){
        echo' ➙ Extremely obese';
    
      }else if($bmi>35){
        echo' ➙ Obese class 2';
      }else if($bmi>30){
        echo ' ➙ Obese';
      }else if($bmi>25){
        echo ' ➙ Overweight';
      }else if ($bmi >18.5){
        echo ' ➙ Healthy';

      }else if($bmi>16.5){
        echo' ➙ Underweight';
      }else{
        echo ' ➙ Severe thinness';
      }
    
  }


  public function idealKcal(){
    //get the ideal number of calories for a day
    $sex=$this->getInfoUser('sex');
    

    if ($sex === 'W'){
      $idealNumber=1200;
    }else if($sex === 'M'){
      $idealNumber=2100;
    }else if ($sex === 'N'){
      $idealNumber=1950;
    } 

    return (int)$idealNumber;
  }

   /* public function editPost($id) {
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    return $result;
  }

  public function updatePost($title, $body, $author, $id) {
    $sql = "UPDATE posts SET title = ?, body = ?, author = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$title, $body, $author, $id]);
  }

  
  public function delPost($id) {
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }*/

}