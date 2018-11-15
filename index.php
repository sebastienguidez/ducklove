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

	<?php 
	$result = $bdd->query('SELECT * FROM article left join utilisateur on utilisateur.id = article.utilisateur_id');
	$liste_article = $result->fetchAll();
	foreach($liste_article as $article){
		if ($article["visibilite"] == 1) {
	?>
	<article>
		<p>
			<?php
			echo $article["titre"];
			?>
		</p>
		<p>
			<?php
			echo $article["image"];
			?>
		</p>
		<p>
			<?php
			echo $article["contenu"];
			?>
		</p>
		<p>
			<?php
			echo $article["date_creation"];
			?>
		</p>
		<p>
			<?php
			echo $article["pseudo"];
			?>
		</p>		
	</article>
	<?php
	if ($article["role_id"] == 1 && $article["utilisateur_id"] == $_SESSION['id']) {
		echo '<a href="modif_article.php" > Modifier l\'article</a>';
	}
		}
	}

	?>

<?php 
}
 ?>
</div>
    <?php
    $result->closeCursor();
      include('includes\footer.php');
    ?>
   