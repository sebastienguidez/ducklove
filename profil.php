<?php
	session_start();
    include('includes\header.php');
    include('includes\connexion.php');

 $query = $bdd->prepare('SELECT * FROM utilisateur LEFT JOIN role on utilisateur.role_id = role.id WHERE utilisateur.pseudo = ? or utilisateur.role_id = 3');
         $query->execute(array($_SESSION['pseudo']));
              	$info_perso = $query->fetch();
?>
<p>
  <a class="btn btn-primary" data-toggle="collapse" href="#collapseUser" role="button" aria-expanded="false" aria-controls="collapseUser">
    Votre profil
  </a>
  <?php
  if ($info_perso['nom_role'] == "Administrateur")
  echo '
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
    Profil des autres utilisateurs
  </button>'
  ?>
</p>
<div class="collapse" id="collapseUser">
  <div class="card card-body">
 <?php	
 if (isset($_SESSION['pseudo'])) {

        echo  	'nom: '.$info_perso['nom'].'<br>
        		prenom: '.$info_perso['prenom'].'<br>
        		mail: '.$info_perso['mail'].'<br>
        		pseudo: '.$info_perso['pseudo'].'<br>
        		role: '.$info_perso['nom_role'].'<br>';
}
?>
<form action="profil.php" method="post">
	<button class="btn btn-outline-success my-2 my-sm-0" type="submit"name="submit" value="submit">modifier votre profil</button>
</form>

  </div>
</div>
<?php
if ($info_perso['nom_role'] == "Administrateur")
{
 $query = $bdd->prepare('SELECT * FROM utilisateur LEFT JOIN role on utilisateur.role_id = role.id WHERE utilisateur.role_id != 1');
 $query->execute(array());
 $info_persos = $query->fetch();

echo '
	<div class="collapse" id="collapseUsers">
	  <div class="card card-body">
	    nom: '.$info_persos['nom'].'<br>
        		prenom: '.$info_persos['prenom'].'<br>
        		mail: '.$info_persos['mail'].'<br>
        		pseudo: '.$info_persos['pseudo'].'<br>
        		role: '.$info_persos['nom_role'].'<br>
		</div>
	  </div>';
}
//AFFICHE UN SEUL UTILISATEUR
  ?>


<?php
	if (isset($_POST['submit'])) {
		
?>
	<form action="profil.php" method="post">
		<p>
		 	<label>Nom</label>
            <input type="text" name="nom" /><br>
            <label>Prénom</label>
            <input type="text" name="prenom" /><br>
            <label>password</label>
            <input type="text" name="password" /><br>
            <label>mail</label>
            <input type="email" name="mail" /><br>
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit_update" value="submit">valider la modification</button>
		
		</p>
	</form>
<?php 
}
	if (isset($_POST['submit_update'])){
     $query = $bdd->prepare('UPDATE utilisateur SET nom = ?,prenom = ?,mail= ?, password = ? where pseudo = ?');
		$query->execute(array($_POST['nom'],$_POST['prenom'],$_POST['mail'],crypt($_POST['password'],'toto'), $_SESSION['pseudo']));
	}

// IF EMPTY ALORS PAS rentrer d info
      $query->closeCursor();
      include('includes\footer.php');
    ?>