
<?php
//var_dump($categories);die;
// Exemple de comment recuperer les données envoyées par le controller //
$categories = $result["data"]['categories'];
    
?>

<h1>liste categories</h1>

<?php
foreach($categories as $category ){
    ?>
    <p><?=$category->getCategoryName() ?></p>
    <?php
}