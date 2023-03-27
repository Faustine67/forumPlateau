<?php
// Exemple de comment recuperer les données envoyées par le controller //
$topic = $result["data"]["topic"];
$posts = $result["data"]['posts']; 

?>

<h1>liste posts du topic <?=$topic->getTopicName()?></h1>

<?php
if($posts) {
    foreach($posts as $post ){
        ?>
        <!-- topic et user sont des clés etrangères, 
        lorsque l'on appelle GetTopic, on obtient une "entité" entiere, 
        il faut par la suite preciser l'info que l'on veut dans cette "entité" -->
        <p>Appartient au topic: <?=$post->getTopic()->getTopicName()?></p>
        <p>Créé par :<?=$post->getUser()->getNickName()?></p>
        <p>Créé le <?=$post->getPostdate()?></p>
        <p><?=$post->getContent()?></p>
        <br>
        <?php
            if($_SESSION["id_user"] == $post->getUser()->getId()) { ?>
                <p><a href="index.php?ctrl=forum&action=deletePost&id=<?=$topic->getId()?>">Supprimer</a></p>
                <p><a href="">Editer</a></p>
       <?php } 
    }
}
 else {
     echo "<p> Pas de post dans ce topic</p>";
}
?>
<br>
<p>Ajouter un nouveau Post au topic "<?=$topic->getTopicName()?>"</p>
<form action="index.php?ctrl=forum&action=addNewPost&id=<?= $topic->getId() ?>" method="POST">
    <input type="text" name="content" maxlength="50" placeholder="Post" required>
    <input type="submit" name="submit" value="Ajouter"/>
</form>