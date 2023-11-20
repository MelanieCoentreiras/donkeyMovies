<?php
require 'templates/header.php';

/*
$sth = $pdo->query('SELECT * FROM user');
// fetch all rows into array, by default PDO::FETCH_BOTH is used
$rows = $sth->fetchAll(PDO::FETCH_ASSOC);


var_dump($rows);

$id_user = isset ($_GET['idmovie']);
$sth = $pdo->prepare('SELECT * FROM movie WHERE idmovie=:id');
$sth->bindValue(':id', $id_user, PDO::PARAM_INT);
$sth->execute();
*/

// on déclare une session
session_start();

// quand le bouton est activé, définir les actions de condition
if(isset($_POST['send'])){
    // si les deux champs ne sont pas vides
    if(!empty($_POST['email']) AND !empty($_POST['password'])){
        $email_user = ($_POST['email']); // déclarer l'email de l'user
        $password_user = sha1($_POST['password']); // déclarer son mdp et le crypter ...
        // on va récup tous les users avec une requête préparer
        $findUser = $pdo->prepare('SELECT * FROM user WHERE email = ? AND password = ?'); // ? valeur user mdp
        // requête executer, spécifier email et mdp verif que les deux valeurs sont bien ds la table
        $findUser->execute(array($email, $password_user));
        // si on a au moins un élément > 0 on va connecter le user
        if($findUser->rowCount() > 0){
            $_SESSION['email'] = $email_user;
            $_SESSION['password'] = $password_user;
            $_SESSION['iduser'] = $findUser->fetch()['iduser'];
            //echo $_SESSION['iduser'];
            header('Location: index.php');

        }else{
            echo " votre email ou mot de passe est incorrect";
        }

    }
}
    

?>

<div class="container-sm">
    <form method="POST" action="">
    <br>
    <h1>Mon compte</h1>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Votre e-mail</label>
        <input type="email" name="email_user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Votre mot de passe</label>
        <input type="password" name="password_user" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" name="send" class="btn btn-primary">Se connecter</button>
</form>
</div>
















<?php
require 'templates/footer.php';
?>