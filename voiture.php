<?php 
/*include_once('conn.php');*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dblouervoiture";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
} 
$mess='';

?>

<?php  
//enregistrement des voitures
$matricule=@$_POST['matricule'];
$nom=@$_POST['nom'];
$prix=@$_POST['prix'];
if(isset($_POST['badd'])&&!empty($matricule)){
$rq=mysqli_query($conn,"insert into tbvoiture(matricule,nom,prix_locat,disponible) 
values('$matricule','$nom','$prix','oui')");
if($rq){
$mess='<b class="succes">Enregistrement éffectué !</b>';
}
else
$mess="<b class='erreur'>Impossible d'enregistrer !</b>";
}

?>
<?php  
//suppresion voiture

if(isset($_POST['bsupp'])&&!empty($matricule)){
$rq=mysqli_query($conn,"delete from tbvoiture where matricule='$matricule'");
if($rq){
$mess='<b class="succes">Suppréssion éffectuée !</b>';
}
else
$mess="<b class='erreur'>Impossible de supprimer!</b>";
}

?>
<?php  
//retraits produits
/*
$codepr=@$_POST['codepr'];
$quantite=@$_POST['quantite'];
$datexp=@$_POST['datexp'];
if(isset($_POST['bretrait'])&&!empty($codepr)){
$rq=mysqli_query($conn,"update produit set nbre=nbre-$quantite where codeprod='$codepr' and datexp='$datexp'");
if($rq){
$mess='<b class="succes">RETRAIT DE PRODUIT REUSSI !</b>';
}
else
$mess="<b class='erreur'>IMPOSSIBLE DE RETIRER LE PRODUIT !</b>";
}
*/
?>

<?php 
//supprimer 
/*
if(isset($_POST['boutsupp'])&&!empty($codepr)){
$rq=mysqli_query($conn,"delete from produit  where codeprod='$codepr' and datexp='$datexp'");
if($rq){
$mess='<b class="succes">SUPPRESSION REUSSIE !</b>';
}
else
$mess="<b class='erreur'>IMPOSSIBLE DE SUPPRIMER !</b>";
}
*/
?>
<!-- Created by TopStyle Trial - www.topstyle4.com -->
<!DOCTYPE html>
<html>
<head>
	<title>chcode_appli</title>
	<meta charset="utf8">
 <link rel="stylesheet" type="text/css" href="mystyle2.css">
</head>

<body>
	<div align="center"><br>
	<a href="index.php">Location des voitures</a><br><br>
	<h2>Enregistrement des voitures</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" >
  <table align="">
  
     <tr ><td></td><td> <?php print $mess;?></td></tr>
   <tr><td></td><td><strong>Matricule voiture:</strong></td></tr>
   <tr><td></td><td><input type="text" name="matricule"  size="25"></td></tr>
 
   <tr><td></td><td><strong>Nom voiture :</strong></td></tr>
   <tr><td></td><td><input type="text" name="nom"  size="25"></td></tr>
   
   <tr><td></td><td><strong>Prix location (fcfa) / jour :</strong></td></tr>
   <tr><td></td><td><input type="number" name="prix"   size="25"></td></tr>
   
   
      <tr><td></td><td><input type="submit" name="badd" value="Enregistrer" class="bouton" ></td></tr>
       <tr><td></td><td><input type="submit" name="bsupp" value="Supprimer" class="bouton" ></td></tr>
  
  </table>
  </form>
  <br>
  <?php 
	
  print"<h2>Liste des voitures disponibles pour location :</h2>";
  
  $qq2=mysqli_query($conn,"select * from tbvoiture ");
  print'<table border="1" class="tab"><tr><th>Numéro matricule</th><th>Nom</th><th>Prix location (fcfa) / jour</th></tr>';
	while($rst2=mysqli_fetch_assoc($qq2)){
	 print"<tr>";
	       
	         echo"<td>".$rst2['matricule']."</td>";
	         echo"<td>".$rst2['nom']."</td>";
	         echo"<td>".$rst2['prix_locat']."</td>";
	         print"</tr>";
	}
	  print'</table>';
  
  ?>
	
	</div>
</body>
</html>