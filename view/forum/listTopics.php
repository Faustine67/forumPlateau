<?php
// Exemple de comment recuperer les données envoyées par le controller //
$categorie= $result["data"]["categorie"];
$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){
    
    ?>
    <p><a href="index.php?ctrl=forum&action=postSelected&id=<?=$topic->getId()?>"><?=$topic->getTopicName()?></a>
    <p> Crée le : <?=$topic-> getTopicDate() ?></p>
    <p> Crée par : <?=$topic-> getUser()->getNickname() ?></p>
        <?php
}
?>

<p>Ajouter un nouveau Topic</p>

<form action=index.php?ctrl=topic&action=addNewTopic&id method="post">
    <input type="text" name="TopicTitle" maxlength="50" placeholder="Topic" required>
    <input type="submit" name="submit" value="Ajouter">
    </form>