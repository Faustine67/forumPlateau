<?php
// Exemple de comment recuperer les données envoyées par le controller //
$topics = $result["data"]["topics"];
$posts = $result["data"]['posts'];   

?>

<h1>liste posts</h1>

<?php
foreach($posts as $post ){
    ?>
    <!-- topic et user sont des clés etrangères, 
    lorsque l'on appelle GetTopic, on obtient une "entité" entiere, 
    il faut par la suite preciser l'info que l'on veut dans cette "entité" -->
    <p>Appartient au topic: <?=$post->getTopic()->getTopicName()?></p>
    <p>Créé par :<?=$post->getUser()->getNickName()?></p>
    <p>Créé le <?=$post->getPostdate()?></p>
    <p><?=$post->getContent()?></p>
    <?php
}
?>

<p>Ajouter un nouveau Post au topic "<?=$post->getTopic()->getTopicName()?>"</p>
<form action="index.php?ctrl=forum&action=addNewPost&id=<?= $topics->getId() ?>" method="POST">
    <input type="text" name="content" maxlength="50" placeholder="Post" required>
    <input type="submit" name="submit" value="Ajouter">
</form>