
<?php
// Exemple de comment recuperer les données envoyées par le controller //
$categories = $result["data"]['categories'];
// $topics= $result["data"]['topics'];    
?>

<h1>liste categories</h1>



<?php

foreach($categories as $category ){
    ?>
    <p><a href="index.php?ctrl=forum&action=listTopics&id=<?=$category->getId()?>"><?=$category->getCategoryName()?></a>
    <?php
}