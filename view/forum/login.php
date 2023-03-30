<!--LOGIN
 -on filtre les champs de saisie
 -on recherche le mot de passe associé à l'adresse mail
 -on recherche l'utilisateur rattaché à l'adresse mail
 -on vérifie que les mots de passe concordent (password_verify)
 -on stocke l'user en Session (setUser dans App\Session)
 -on redirige sur une page d'accueil -->

<h1> Se connecter </h1>
 
 <form action="index.php?security=forum&action=connexion" method="POST">
 	
	<label><b>Email</b></label>
 	<input type="email" placeholder="Entrer l'email'" name="email" required>

	<label><b>Mot de passe</b></label>
 	<input type="password" placeholder="Entrer le mot de passe" name="password" required>

 	<input type="submit" id='submit' value='Se connecter' name="submitLogin">
 	<?php
 if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
 echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>
 </form>