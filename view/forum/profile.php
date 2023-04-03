<?php
$user=$result["data"]["user"];
?>

<h1>Information de l'utilisateur <?=$user->getNickname()?></h1>

<?php
if($user){
	?>
	<p><?=$user->getNickname()?></p>
	<p>Your email: <?=$user->getEmail()?></p>
	<p>Date inscritption:  <?=$user->getInscriptionDate()?></p>
	<p> Role: <?=$user->getRole()?></p>
	<?php
}
else {

     echo "<p> You're not connected</p>";
?>
	<a href="index.php?ctrl=security&action=login">Connexion</a>
	<a href="index.php?ctrl=security&action=register">Inscription</a>
<?php
}
?>