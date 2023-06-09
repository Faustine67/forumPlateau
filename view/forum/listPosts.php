<?php
// Exemple de comment recuperer les données envoyées par le controller //
$topic = $result["data"]["topic"];
$posts = $result["data"]['posts'];
$user= $result["data"]["user"];


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
        <p> Crée par :<a href="index.php?ctrl=forum&action=infosOtherUser&id=<?= $post->getUser()->getId() ?>"><?= $post->getUser()->getNickname() ?></a></p>
        <p>Créé le <?=$post->getPostdate()?></p>
        <p><?=$post->getContent()?></p>
        <br>
        <?php
			// Si c'est la session de l'user correspondant, il peut supprimer son post
            if(App\Session::getUser()->getId() == $post->getUser()->getId()) { 
				?>
                <p><a href="index.php?ctrl=forum&action=deletePost&id=<?=$post->getId()?>">Supprimer</a></p>
                <p><a href="">Editer</a></p>
       		<?php 
			}
    }
}
 else {
     echo "<p> Pas de post dans ce topic</p>";
}
?>

<p>Ajouter un nouveau Post au topic "<?=$topic->getTopicName()?>"</p>

<form action="index.php?ctrl=forum&action=addNewPost&id=<?= $topic->getId() ?>" method="POST">
<textarea id="content" name="content" placeholder="content" required rows="5" cols="33"> </textarea>
    <input type="submit" name="submit" value="Ajouter"/>
</form>
<?php
// } 
 ?>