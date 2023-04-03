<?php
// Exemple de comment recuperer les données envoyées par le controller //
$categorie = $result["data"]['categorie'];
$topics = $result["data"]['topics'];
// on a pas besoin d'afficher les données du controller post. Les données seront envoyées grace à AddNewTopic, mais elles n'ont pas besooin d'être dans l'affiche.
// on ne recupere que les données que l'on affiche.

?>
<h1>liste topics de la catégorie <?= $categorie->getCategoryName() ?></h1>

<?php
if($topics){
	foreach ($topics as $topic) {
	?>
		<div class="card">
			<p><a href="index.php?ctrl=forum&action=postSelectedbyTopic&id=<?= $topic->getId() ?>"><?= $topic->getTopicName() ?></a>
			<p> Crée le : <?= $topic->getTopicDate() ?></p><br>
			<p> Crée par : <?= $topic->getUser()->getNickname() ?></p><br>
			<?php
			// Si c'est la session de l'user correspondant, il peut supprimer son topic
			if (App\Session::getUser()->getId() == $topic->getUser()->getId()) { ?>
				<p><a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer</a></p>
				<p><a href="">Editer</a></p>
			<?php 
			}
	}
}	
	else {
	echo "<p> Pas de topic dans la catégorie</p>";
		}

?>
	</div>
	<form action="index.php?ctrl=forum&action=addNewTopic&id=<?= $categorie->getId() ?>" method="POST">
		<label for="nouveau-topic">Ajouter un nouveau Topic</label>
		<input type="text" name="topicName" maxlength="50" placeholder="Topic" required />



		<label for="postName">Ajouter un nouveau post</label>
		<textarea id="postName" name="postName" placeholder="Post" required rows="5" cols="33"> </textarea>
		<input type="submit" name="submit" value="Ajouter" />
	</form>