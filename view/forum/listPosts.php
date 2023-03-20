<?php
// Exemple de comment recuperer les données envoyées par le controller //
$posts = $result["data"]['post'];
    
?>

<h1>liste posts</h1>

<?php
foreach($posts as $post ){

    ?>
    <p><?=post->getTopic()?></p>
    <p><?=$post->getPostdate()?></p>
    <p><?=$post->getContent()?></p>
    <p><?=$post->getUser()?></p>
    <p><?=$post->getPostdate()?></p>
    <?php
}