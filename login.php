<?php
require 'config.php';
$message = '';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $user = $supabase->from('users')->select('*')->eq('email', $email)->execute();
    if(count($user['data'])>0 && password_verify($password, $user['data'][0]['password'])){
        $_SESSION['user_id'] = $user['data'][0]['id'];
        $_SESSION['username'] = $user['data'][0]['username'];
        $_SESSION['unique_link'] = $user['data'][0]['unique_link'];
        header('Location: vote.php?link='.$_SESSION['unique_link']);
        exit;
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion</title>
<link rel="stylesheet" href="assets/css/style.css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<main>
<h1>Se connecter</h1>
<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Mot de passe" required>
<div class="g-recaptcha" data-sitekey="<?php echo $_ENV['RECAPTCHA_SITE_KEY']; ?>"></div>
<button type="submit">Se connecter</button>
</form>
<p><?php echo $message;?></p>
</main>
</body>
</html>
