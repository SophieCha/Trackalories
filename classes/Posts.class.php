<?php 

class Posts extends Dbh {
  public function getAliment() {
    $sql = "SELECT * FROM posts";
    $stmt = parent::connect()->prepare($sql);
    $stmt->execute();

    while($result = $stmt->fetchAll()) {
      return $result;
    }
  }

  public function addAliment($title, $body, $author, $email) {
    
    $sql = "INSERT INTO posts(title, body, author, email) VALUES (?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$title, $body, $author,$email]);
  }



     public function editAliment($id) {
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    return $result;
  }

      public function getEmail($email) {
    $sql = "SELECT * FROM posts WHERE email=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$email]);

    while($result = $stmt->fetchAll()) {
      return $result;
    }}

     public function getEmailDate($email,$date) {
    $sql = "SELECT * FROM posts WHERE (email=? AND body=?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$email,$date]);

    while($result = $stmt->fetchAll()) {
      return $result;
    }}


    public function getCalories($email,$date){
      $sql = "SELECT author FROM posts WHERE (email=? AND body=?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$email,$date]);

    while($result = $stmt->fetchAll()) {
     $cal=0;
      foreach($result as $results){
        
        //echo $results['author'];
        $cal=$cal + $results['author'];

      }
      
     echo (int)($cal);
    
    }}




  public function updateAliment($title, $body, $author, $id) {
    $sql = "UPDATE posts SET title = ?, body = ?, author = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$title, $body, $author, $id]);
  }

  
  public function delAliment($id) {
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }
}

