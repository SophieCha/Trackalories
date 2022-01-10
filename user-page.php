<?php 
include('./includes/class-autoload.inc.php');
session_start();

$date=date('Y-m-d');



//unset($_SESSION['email']); //ou retour à index.php
//echo 'la session: '. $_SESSION['email'];
$avecSession = new User($_SESSION['email']);
$avecSession->restoreDataFromSession();
$idealKcal= $avecSession->idealKcal();
echo $idealKcal;


$test=new Posts();
$test->getCalories($_SESSION['email'],$date);



require_once('./assets/templates/header.php');


?>
<!-- Button trigger modal -->
<body class="bg-warning ">
    <div class="container bg-light bg-gradient shadow-lg col-8 col-lg-8 mb-3 mt-3 rounded-3 ">
    <h1 class=" display-2 mt-4 text-center">TracKalories</h1>
    <h2 class="display-4 text-center"><?php echo '🥑 Welcome ' . $avecSession->getInfoUser('firstname') .' 🥑'; ?></h2>
 
    <section class="d-flex  flex-column  justify-content-around align-items-start ">
  <div class="row">
    
    
        
        <div class=" col-6 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Profile <?= $info['firstname'];?></h5>
                    <p class="card-text">Firstname: <?= $avecSession->getInfoUser('firstname');?></p>
                    <p class="card-text">Lastname: <?= $avecSession->getInfoUser('lastname');?></p>
                    <p class="card-text">⚖️ Weight:  <?= $avecSession->getInfoUser('weight');?> kilos</p>
                    <p class="card-text">🤸 Size: <?= $avecSession->getInfoUser('size');?> cm</p>
                    <p class="card-text">🎂 Age: <?=$avecSession->calculateAge();?> ans</p>
                    <p class="card-text">〽️ BMI: <?=$avecSession->calculateBmi();?></p>
                    
                    
                    
                  </div>
              </div>
        </div>
      
        <div class="col-6 mt-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title text-center">TO DAY 🍝 </h5>
                <?php $aliments = new Posts(); ?>
                <h6 class="card-title text-center">You ate for 
                    <?= $cal=$aliments->getCalories($_SESSION['email'],$date);
                     echo $cal . 'Kcal';
                     if ($cal > $idealKcal){
                       echo '<h6>Hum maybe it\'s time for a break with food today 💔</h6>';
                     }
                     ?></h6>
                
    <?php if($aliments->getAliment()): ?>
      <?php if($aliments->getEmailDate($_SESSION['email'], $date)): ?>
        <?php foreach($aliments->getEmailDate($_SESSION['email'],$date)as $aliment) : ?>
            
        <div class="col mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $aliment['title'];?></h5>
                    <p class="card-text">📆 
                    <?= $aliment['body'];?>
                     </p>
                    <h6 class="card-subtitle text-muted text-end"> ⚖️  Calories: <?= $aliment['author'];?> kcal</h6>
                    <!--<a href="editForm.php?id=<?= $aliment['id']?>" class="btn btn-warning">Edit</a>
                    <a href="post.process.php?id=<?= $aliment['id']?>&send=del" class="btn btn-danger">Delete</a> -->
                </div>
            </div>
        </div>
        
        
        <?php endforeach ; ?>
        <div class="text-center">
<button type="button" class="my-5 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPostModal">
  Add aliment 🍔 
</button>
</div>

    <?php else : ?>
        <p class="mx-auto mt-5 text-center">You need to eat somedthing!</p>

      <?php endif; ?>
    <?php endif; ?> 
              </div>
            </div>
          </div>
         

        </div>
        
       

</section>
    <section class="d-flex flex-column  justify-content-around align-items-center text-center">    
    


<!-- Modal -->
<div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Some food to add?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="post.process.php" method="post">
            
              <div class="form-group">
                <input id="session" name="getSession" type="hidden" value="<?php echo $_SESSION['email']; ?>">
                  <label> 🥐 Aliment: </label>
                  <input class="form-control" name="post-title"type="text"
                  require>
                </div>
                
            
                <div class="form-group">
                  <label>⚖️ Calories: </label>
                  <input type="number" class="form-control" name="post-author"  require>
                </div>
      
                <div class="form-group">
                  <label> 📆 Date: </label>
                  <input type="date" class="form-control" name="post-content" require>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary">Add aliment</button>
                </div>
            </form>
        </div>    
      
    </div>
  </div>
</div>


<div class="row">
    <?php $aliments = new Posts(); ?>
    <?php if($aliments->getAliment()): ?>
      <?php if($aliments->getEmail($_SESSION['email'])): ?>
        <?php foreach($aliments->getEmail($_SESSION['email'])as $aliment) : ?>
            
        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $aliment['title'];?></h5>
                    <p class="card-text">📆 
                    <?= $aliment['body'];?>
                     </p>
                    <h6 class="card-subtitle text-muted text-end"> ⚖️  Calories: <?= $aliment['author'];?> kcal</h6>
                    <!--<a href="editForm.php?id=<?= $aliment['id']?>" class="btn btn-warning">Edit</a>
                    <a href="post.process.php?id=<?= $aliment['id']?>&send=del" class="btn btn-danger">Delete</a> -->
                </div>
            </div>
        </div>
        
        <?php endforeach ; ?>
        

    <?php else : ?>
        <p class="mx-auto mt-5 text-center">You need to eat somedthing!</p>

      <?php endif; ?>
    <?php endif; ?> 
     

    </div>
    </section>
    </div>
</div>
    














  <?php require_once('./assets/templates/footer.php');?>