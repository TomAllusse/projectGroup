<?php 
    session_start();

    /* Import */
    require_once 'includes/autoloader.php';
    require_once '../config/db.php';

    use src\Managers\BoutiqueManager;
    use src\Entities\Compte;
    
    if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['pwd']))
    {
        $hash = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_ARGON2ID);
        $username = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

        $param = ["pseudo" => $username, "email" => $email, "pwd_hash" => $hash];
        
        $manager = new BoutiqueManager($db);
        $account = new Compte(null,$username,$email,$hash,'ROLE_USER');
        $lastId = $manager->add($account);

        $account->setId($lastId);
            
        if($lastId !== null){
          $oAccount = $account;
        }

        if(!empty($oAccount))
        {
          $_SESSION['ROLE_USER'] = serialize($oAccount);
        //   header('Location: boutique.php');
        //   exit();
        }
        else
        {
          $errorMsg = "Erreur lors de la création !";
        }            
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <form action="inscription.php?action=signup" method="POST" class="admin-panel">
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" class="input-cubic" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" class="input-cubic" required>

        <label for="pwd">Mot de passe :</label>
        <input type="password" id="pwd" name="pwd" class="input-cubic" required>

        <button type="submit" class="btn-inscription">S'inscrire sur Cubic Market</button>
    </form>
</body>
</html>