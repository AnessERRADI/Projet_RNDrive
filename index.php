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
//enregistrement location 
$matricule=@$_POST['matricule'];
$contact_cl=@$_POST['contact_cl'];
$contact_chf=@$_POST['contact_chf'];
$nom=@$_POST['nom'];
$duree=@$_POST['duree'];
$prix=@$_POST['prix'];
if(isset($_POST['bld'])&&!empty($matricule)){
$rq=mysqli_query($conn,"insert into tblocation(matriculev,contact_locat,nom_locat,
date_locat,duree_prev,reservation,contact_chauff) 
values('$matricule','$contact_cl','$nom',now(),'$duree','non','$contact_chf')");
if($rq){
$mess='<b class="succes">Loction validée !</b>';
     mysqli_query($conn,"update tbvoiture set disponible='non' where matricule='$matricule'");

}
else
$mess="<b class='erreur'>Impossible de valider la location !</b>";
}

?>
<?php  
//modification location 

if(isset($_POST['bmodif'])&&!empty($matricule)){
/*
$rq=mysqli_query($conn,"insert into tblocation(matriculev,contact_locat,nom_locat,
date_locat,duree_prev,reservation,contact_chauff) 
values('$matricule','$contact_cl','$nom',now(),'$duree','non','$contact_chf')");
*/
$rq=mysqli_query($conn,"update tblocation set contact_locat='$contact_cl',nom_locat='$nom',date_locat=now(),
duree_prev='$duree',reservation='non',contact_chauff='$contact_chf' where matriculev='$matricule'") ;
if($rq){
$mess='<b class="succes">Modification éffectuée !</b>';

}
else
$mess="<b class='erreur'>Impossible de modifier !</b>";
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
//annuler ou confirmer la fin d'une  location

if(isset($_POST['bsupp'])&&!empty($matricule)){
$rq=mysqli_query($conn,"delete from tblocation  where matriculev='$matricule' ");
if($rq){
$mess='<b class="succes">Annulation éffectuée !</b>';
   mysqli_query($conn,"update tbvoiture set disponible='oui' where matricule='$matricule' ");
}
else
$mess="<b class='erreur'>Impossible d'annuler !</b>";
}

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
	<a href="voiture.php">Enregistrement des voitures</a><br><br>
		<?php 
	
  print"<h2>Liste des voitures disponibles pour location :</h2>";
  
  $qq2=mysqli_query($conn,"select * from tbvoiture where disponible='oui' ");
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
	<h2>Enregistrement des locations de voitures</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" >
  <table align="">
  
     <tr ><td></td><td> <?php print $mess;?></td></tr>
   <tr><td></td><td><strong>Matricule voiture:</strong></td></tr>
   <tr><td></td><td><input type="text" name="matricule"  size="25"></td></tr>
 
   <tr><td></td><td><strong>Contact client(e) :</strong></td></tr>
   <tr><td></td><td><input type="text" name="contact_cl"  size="25"></td></tr>
   
   <tr><td></td><td><strong>Nom client(e) :</strong></td></tr>
   <tr><td></td><td><input type="text" name="nom"   size="25"></td></tr>
   
   <tr><td></td><td><strong>Durée prevue :</strong></td></tr>
   <tr><td></td><td><input type="number" name="duree"   size="25"></td></tr>
   
   <tr><td></td><td><strong>Contact chauffeur :</strong></td></tr>
   <tr><td></td><td><input type="text" name="contact_chf"   size="25"></td></tr>
   
      <tr><td></td><td><input type="submit" name="bld" value="Enregistrer" class="bouton" ></td></tr>
      <tr><td></td><td><input type="submit" name="bmodif" value="Modifier" class="bouton" ></td></tr>
       <tr><td></td><td><input type="submit" name="bsupp" value="Annuler/Terminer" class="bouton" ></td></tr>
  
  </table>
  </form>
  <br>
  <?php 

  print"<h2>Liste des locations en cours :</h2>";
  $qq=mysqli_query($conn,"select matriculev,contact_locat,nom_locat,duree_prev,date_locat,contact_chauff,
  duree_prev*prix_locat as montant,case when datediff(now(),date_locat)>=duree_prev then 'Terminée' else 'En cours'
  end as etat
  from tblocation inner join tbvoiture on tblocation.matriculev=tbvoiture.matricule  where reservation='non'");
  print'<table border="1" class="tab"><tr><th>Matricule voiture</th><th>Contact client</th><th>Nom client</th><th>Nombre jours</th>
  <th>Date début</th><th>Contact chauffeur</th><th>Montant total (fcfa)</th><th>Etat</th></tr>';
	while($rst=mysqli_fetch_assoc($qq)){
	 print"<tr>";
	       
	         echo"<td>".$rst['matriculev']."</td>";
	         echo"<td>".$rst['contact_locat']."</td>";
	         echo"<td>".$rst['nom_locat']."</td>";
	         echo"<td>".$rst['duree_prev']."</td>";
	         echo"<td>".$rst['date_locat']."</td>";
	         echo"<td>".$rst['contact_chauff']."</td>";
	         echo"<td>".$rst['montant']."</td>";
	         echo"<td>".$rst['etat']."</td>";
	         print"</tr>";
	}
	  print'</table>';
 
  ?>
 
	
	</div>
</body>
</html>