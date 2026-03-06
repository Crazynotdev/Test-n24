<?php
require 'config.php';

$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $recaptcha = $_POST['g-recaptcha-response'];

    // Vérification ReCaptcha
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$_ENV['RECAPTCHA_SECRET_KEY']."&response=".$recaptcha);
    $res = json_decode($response);
    if(!$res->success){
        $message = "Captcha invalide.";
    } else {
        // Vérification si déjà inscrit
        $exist = $supabase->from('users')->select('*')->eq('email', $email)->execute();
        if(count($exist['data']) > 0){
            header('Location: login.php');
            exit;
        } else {
            $supabase->from('users')->insert([
                'username'=>$username,
                'email'=>$email,
                'password'=>$password,
                'unique_link'=>bin2hex(random_bytes(8))
            ])->execute();
            header('Location: login.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Inscription</title>
<link rel="stylesheet" href="assets/css/style.css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<main>
<h1>Créer un compte</h1>
<form method="POST">
<input type="text" name="username" placeholder="Nom d'utilisateur" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Mot de passe" required>
<div class="g-recaptcha" data-sitekey="<?php echo $_ENV['RECAPTCHA_SITE_KEY']; ?>"></div>
<button type="submit">S'inscrire</button>
</form>
<p><?php echo $message;?></p>
</main>
</body>
</html>
