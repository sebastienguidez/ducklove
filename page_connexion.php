<?php
session_start();
$titre="Connexion";    
      include('includes\header.php');
      include('includes\connexion.php');
    ?>
<?php
if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
{
	echo '<form method="post" action="page_connexion.php">
	<fieldset>
	<legend>Connexion</legend>
	<p>
	<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
	<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
	</p>
	</fieldset>
	<p><input type="submit" value="Connexion" /></p></form>
	<a href="./register.php">Pas encore inscrit ?</a>
	 
	</div>
	</body>
	</html>';
}

else
{
    $message='';
    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $query = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
	if ($data['password'] == crypt($_POST["password"], 'toto')) // Acces OK !
	{
	    $_SESSION['pseudo'] = $data['pseudo'];
	    $_SESSION['id'] = $data['id'];
	    $_SESSION['role'] = $data['role_id'];
	    $_SESSION['password'] = $data['password'];
	    header('Location: index.php');  
	}
	else // Acces pas OK !
	{
	echo "vous n avez pas acces";
	}
    $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}

?>
