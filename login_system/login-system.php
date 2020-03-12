
<?php
require ('./header.php');
?>
  
<main class="container "> 
    <?php 
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "invalidpassword") {
            echo ('<p class="small alert alert-danger text-center">Wrong password. Try again.</p>');
        }
    }
    ?>
    
    <div class="bg-info text-center">
       
        <?php
        if (isset($_SESSION['idUser'])) {
            echo '<p>You\'re logged in!</p>';
        }else  {
            echo '<p>You\'re logged out!</p>';
        }
        ?>
    </div>   
</main>

<?php
require ('./footer.php');