<?php 
   require_once('../../config/connect.php');

   $idProd = $_POST['idProd'];

   mysqli_query($ConnectDatabase, "DELETE FROM products WHERE `products`.`ID` = $idProd");
   
   $Photos = mysqli_query($ConnectDatabase, "SELECT * FROM `photos` WHERE `IDPROD`='$idProd'");    
   $Photos = mysqli_fetch_all($Photos, MYSQLI_ASSOC);
   
   $length = count($Photos);
   for ($i=0; $i < $length; $i++) { 
       unlink('../../'.$Photos[$i]['SRC']);
   }
   
   mysqli_query($ConnectDatabase, "DELETE FROM photos WHERE `photos`.`IDPROD` = $idProd");

   require_once('../../config/products.php');
?>

<div id="block-prod-list">

   <?php 
       addProdListAdm($TableProd, $TablePhotos);
   ?>

</div>