<?php
// Exemple de comment recuperer les données envoyées par le controller //
$categorie = $result["data"]["categories"];
$topics = $result["data"]['topics'];
$posts = $result["data"]['posts'];

?>

<h1>liste topics de la catégorie <?= $categorie->getCategoryName() ?></h1>

<?php
foreach ($topics as $topic) {
?>
	<div class="card">
		<p><a href="index.php?ctrl=forum&action=postSelected&id=<?= $topic->getId() ?>"><?= $topic->getTopicName() ?></a>
		<p> Crée le : <?= $topic->getTopicDate() ?></p><br>
		<p> Crée par : <?= $topic->getUser()->getNickname() ?></p><br>
		<?php
		if ($_SESSION["id_user"] == $topic->getUser()->getId()) { ?>
			<p><a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer</a></p>
			<p><a href="">Editer</a></p>
		<?php }
		?>
	<?php
}

	?>
	</div>
	<form action="index.php?ctrl=forum&action=addNewTopic&id=<?= $categorie->getId() ?>" method="POST">
	<label for="nouveau-topic">Ajouter un nouveau Topic</label>
		<input type="text" name="topicName" maxlength="50" placeholder="Topic" required />
		<input type="submit" name="submit" value="Ajouter" />
	</form>
	<form action="index.php?ctrl=forum&action=addNewPost&id=<?= $posts->getId() ?>" method="POST">
	<label for="nouveau-post">Ajouter un nouveau post/label>
		<input type="text" name="postName" maxlength="50" placeholder="Post" required />
		<input type="submit" name="submit" value="Ajouter" />
	</form>