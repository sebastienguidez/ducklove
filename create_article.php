    <?php
    session_start();
    include('includes\header.php');
    include('includes\connexion.php');

    if (isset($_SESSION['role'])) {
        $request = $bdd->prepare('INSERT INTO article(titre, contenu, image, utilisateur_id, date_creation, categorie_id) 
                                    VALUES( :titre, :contenu, :image, :utilisateur_id, :date_creation, :categorie_id)');

        if (isset($_POST["submit"]) && (!empty($_POST["submit"])))
        {
        
        $date = date("Y-m-d H:i:s");
        $request->execute(array(
          'titre' => $_POST["titre"],
          'contenu' => $_POST["contenu"],
          'image' => $_POST["image"],
          'utilisateur_id' => $_SESSION['utilisateur_id'],
          'date_creation' =>  $date,
          'categorie_id' => $_POST['categorie_id']
          ));
        }
        ?>
        <div class="form-style-8">
            <h2>création de l'article</h2>
            <form action="" method="post">
            <p>
                <label>Titre</label>
                <input type="text" name="titre" /><br>
                 <label>Categorie</label>
                <input type="text" name="categorie_id" /><br>
                <label>Image</label>
                <input type="file" name="image" /><br>
                <label>Contenu</label>
                <textarea name="contenu" rows=4 cols=40 > </textarea><br>
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