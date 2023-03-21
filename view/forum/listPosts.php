<?php
// Exemple de comment recuperer les données envoyées par le controller //
$posts = $result["data"]['posts'];
    
?>

<h1>liste posts</h1>

<?php
foreach($posts as $post ){

    ?>
    <p><?=$post->getTopic()?></p>
    <p><?=$post->getNickName()?></p>
    <p><?=$post->getPostdate()?></p>
    <p><?=$post->getContent()?></p>
    <?php
}