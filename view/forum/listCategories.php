<?php
// Exemple de comment recuperer les données envoyées par le controller //

$categories = $result["data"]['categories'];
?>

<h1>liste categories</h1>

<?php

foreach ($categories as $category) {
?>
	<div class="card">
		<p><a href="index.php?ctrl=forum&action=topicSelectedByCategory&id=<?= $category->getId() ?>"><?= $category->getCategoryName() ?></a></p>
	</div>
<?php
}
if(isset($_SESSION["user"]) && ($_SESSION["user"]->getRole()=="admin")){
	?>

<form action="index.php?ctrl=forum&action=addNewCategory" method="POST">
	<label for="nouvelle-categorie">Ajouter une nouvelle catégorie:
		<input type="text" name="categoryName" maxlength="50" placeholder="Category" required>
	</label>
	<input type="submit" name="submit" value="Ajouter">
</form>

<?php
}
?>