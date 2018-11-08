<?php
    session_start();
    include('includes\header.php');
    include('includes\connexion.php');
?>
<div>
    <h1>les canards</h1>
    <h3>la page d'accueil</h3>

    <a href="create_article.php">Créer un article</a>
<?php
 	 $result = $bdd->query('SELECT * FROM article LEFT JOIN categorie on article.categorie_id = categorie.id WHERE article.visibilite = 1');
 	 $liste_articles = $result->fetchAll();

 	foreach ($liste_articles as $article) {

 ?>
 		<p><?php echo $article["titre"]; ?> </p>

<?php 
}
 ?>
</div>
    <?php
    $bdd->closeCursor();
      include('includes\footer.php');
    ?>
   