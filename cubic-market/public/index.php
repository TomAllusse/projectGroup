<?php 
    session_start();

    /* Import */
    require_once 'includes/autoloader.php';
    require_once '../config/db.php';

    use src\Managers\BoutiqueManager;
    use src\Entities\Compte;
    
    if(isset($_POST['pseudo']) && isset($_POST['password']))
    {
        $username = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);

        $param = ["pseudo" => $username];
        
        $manager = new BoutiqueManager($db);
        $result = $manager->getOneCompte($param);
        
        $account = new Compte($result['id_compte'],$result['pseudo'],$result['email'],$result['pwd_hash'],$result['role']);
            
        if($account->login("Admin","Admin1234",$db) === "ROLE_ADMIN"){
          $oAccountAdmin = $account;
        }else if($account->login("Admin","Admin1234",$db) !== "ROLE_USER"){
          $oAccountUser = $account;
        }

        if(!empty($oAccountAdmin))
        {
          $_SESSION['ROLE_ADMIN'] = serialize($oAccountAdmin);
          header('Location: boutique.php');
          exit();
        }else if(!empty($oAccountUser))
        {
          $_SESSION['ROLE_USER'] = serialize($oAccountUser);
          header('Location: boutique.php');
          exit();
        }
        else
        {
          $errorMsg = "Login/Mot de passe incorrect";
        }            
    }    
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil - Connexion</title>
        <link rel="stylesheet" href="src/css/style.css">
        <link rel="stylesheet" href="src/css/styleLogin.css">
        <link href="https://fonts.googleapis.com/css2?family=Alice&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container-lg">
            <!-- ADMIN LOGIN -->
            <div class="loginContainer">
              <div class="loginBoxForm">
                <form action="" method="POST" class="loginForm">
                  <div class="conteneurInput">
                    <label for="username" class="labelUsername">Login:</label>
                    <input type="text" class="usernameInp" id="username" placeholder="Saisir votre login" name="pseudo" required="required">
                  </div>
                  <div class="conteneurInput">
                    <label for="pwd" class="labelPwd">Mot de passe:</label>
                    <input type="password" class="pwdInp" id="pwd" placeholder="Saisir votre mot de passe" name="password" required="required">
                  </div>
                  <button type="submit" class="sendLogin">Se connecter</button>
                </form>
              </div>
            </div>
        </div> 
    </body>
</html>
