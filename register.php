    <?php
    session_start();
    include('includes\header.php');
    include('includes\connexion.php');

    $request = $bdd->prepare('INSERT INTO utilisateur(nom, prenom, password, mail, pseudo,role_id) VALUES( :nom, :prenom, :password, :mail, :pseudo, :role)');

    if (isset($_POST["submit"]) && (!empty($_POST["submit"])))
    {
        var_dump($_POST);

    $request->execute(array(
      'nom' => $_POST["nom"],
      'prenom' => $_POST["prenom"],
      'password' => crypt($_POST["password"], 'toto'),
      'mail' => $_POST["mail"],
      'pseudo' =>  substr(substr(strtoupper($_POST["prenom"]),0,1) . str_replace(' ','',strtolower($_POST["nom"])),0,11),
      'role' => $_POST["role"]
      ));
    }

    ?>
    <div class="form-style-8">
        <h2>Formulaire d'inscription</h2>
        <form action="index.php" method="post">
        <p>
            <label>Nom</label>
            <input type="text" name="nom" /><br>
            <label>Prénom</label>
            <input type="text" name="prenom" /><br>
            <label>password</label>
            <input type="text" name="password" /><br>
            <label>mail</label>
            <input type="email" name="mail" /><br>
            <label>role</label>
            <select name="role">
             <?php
                $result_role = $bdd->query('SELECT * FROM role');
                while ($role = $result_role->fetch()) {
                        echo '<option value="'. $role['id'].'"> '.$role['nom_role']. '</option>';
                }
            ?>
            </select>
            <label>Actif</label>
            <input type="checkbox" name="actif"  value="1"/>oui
            <input type="checkbox" name="nactif"  value="0" checked/>non<br>
            <input type="submit" name="submit" value="Valider" /><br>
        </p>
        </form>
    </div>
    <?php
        $request->closeCursor();
        include('includes\footer.php');
    ?>