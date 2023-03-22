<?php
// Exemple de comment recuperer les données envoyées par le controller //
$categories= $result["data"]["categories"];
$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){
    ?>
    <p><?=$topic->getTopicName()?></p>
    <?php
}


  
