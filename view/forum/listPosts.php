<?php
// Exemple de comment recuperer les données envoyées par le controller //
$topics = $result["data"]["topics"];
$posts = $result["data"]['posts'];   

?>

<h1>liste posts</h1>

<?php
//foreach($posts as $post ){
    //var_dump($post);die;
    ?>
    <p>Appartient au topic: <?=$post->getTopic()?></p>
    <p>Créé par :<?=$post->getUser()?></p>
    <p>Créé le <?=$post->getPostdate()?></p>
    <p><?=$post->getContent()?></p>
    <?php
//}