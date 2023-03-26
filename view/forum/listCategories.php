
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/stylelistCategories.css" rel="stylesheet">
</head>
<body>
<?php
// Exemple de comment recuperer les données envoyées par le controller //
$categories = $result["data"]['categories'];
?>

<h1>liste categories</h1>



<?php

foreach($categories as $category ){
    ?>
<div class="card">
    <p><a href="index.php?ctrl=forum&action=topicSelected&id=<?=$category->getId()?>"><?=$category->getCategoryName()?></a></p>
</div>
    <?php
}
?>
<form action="index.php?ctrl=forum&action=addNewCategory ?>" method="POST">
    <label for="nouvelle-categorie">Ajouter une nouvelle catégorie:
    <input type="text" name="categoryName" maxlength="50" placeholder="Category" required>
    </label>
    <input type="submit" name="submit" value="Ajouter">
</form>
</body>
