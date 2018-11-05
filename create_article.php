    <?php
    session_start();
    include('includes\header.php');
    include('includes\connexion.php');

//FAIRE UNE REQUETE POUR DIRE QU IL PEUT CREER L ARTICLE SI IL EST INSCRIT (SESSION['role'])
    if (isset($_SESSION['role'])) {
        $request = $bdd->prepare('INSERT INTO article(titre, contenu, image, utilisateur_id, date_creation) VALUES( :titre, :contenu, :image, :utilisateur_id, :date_creation)');

        if (isset($_POST["submit"]) && (!empty($_POST["submit"])))
        {
            var_dump($_POST);

        $request->execute(array(
          'titre' => $_POST["titre"],
          'contenu' => $_POST["contenu"],
          'image' => $_POST["image"],
          'utilisateur_id' => $request["utilisateur_id"],
          'date_creation' =>  $_POST['date_creation']
          ));
        }

        ?>
        <div class="form-style-8">
            <h2>création de l'article</h2>
            <form action="index.php" method="post">
            <p>
                <label>Titre</label>
                <input type="text" name="titre" /><br>
                <label>Image</label>
                <input type="file" name="image" /><br>
                <label>Contenu</label>
                <textarea name="contenu" rows=4 cols=40 > </textarea><br>
                <label>Date</label>
                <input type="date" name="date" /><br>
                <input type="submit" name="submit" value="Valider" /><br>
            </p>
            </form>
        </div>
    <?php
        $request->closeCursor();
    }
    else
    {
     echo 'Veuillez vous connecter ou vous inscrire pour pouvoir rédiger un article<br>
        <a href="index.php">Retourner à la page d\'acceuil</a> <br>
        <a href="register.php">Créer un compte</a> <br>
        <a href="page_connexion.php">Se connecter</a>
        '; 
    }

    
    include('includes\footer.php');
    ?>