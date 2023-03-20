<?php
// Exemple de comment recuperer les données envoyées par le controller //
$categories = $result["data"]['category'];
    
?>

<h1>liste categories</h1>

<?php
foreach($categories as $categories ){

    ?>
    <p><?=$categories->getCategoryName()?></p>
    <?php
}