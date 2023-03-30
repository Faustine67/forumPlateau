<!--REGISTER
-on filtre les champs de saisie
-on vérifie que l'utilisateur n'existe pas (mail)
-on vérifie que le pseudo n'existe pas
-on vérifie que les 2 passwords correspondent
-on hash le password (password_hash)
-on ajoute l'user en bdd
-on peut imaginer une redirection vers le formulaire de login dans la foulée -->

<?php

$user= $result["data"]["user"];
vard_dump($user);die;
?>

<h1> S'inscrire </h1>
 
 <form action="index.php?ctrl=security&action=addNewUser" method="POST">
 	<label><b>Nom d'utilisateur</b></label>
 	<input type="text" placeholder="Entrer le nom d'utilisateur" name="nickname" required>

	<label><b>Email</b></label>
 	<input type="email" placeholder="Entrer l'email'" name="email" required>

	<label><b>Mot de passe</b></label>
 	<input type="password" placeholder="Entrer le mot de passe" name="password" required>

	<label><b>Confirmation Mot de passe</b></label>
 	<input type="password" placeholder="Entrer le mot de passe" name="password" required>

 	<input type="submit" id='submit' value='LOGIN' >
 	<?php
 if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
 echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>
 </form>

