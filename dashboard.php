<?php
require 'config.php';
if(!isset($_SESSION['user_id'])) header('Location: login.php');

$user = $supabase->from('users')->select('*')->eq('id', $_SESSION['user_id'])->execute();
$votes = $supabase->from('votes')->select('*')->eq('voter_id', $_SESSION['user_id'])->eq('is_validated', true)->execute();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mon tableau de bord</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main>
<h1>Bonjour <?php echo htmlspecialchars($_SESSION['username']);?></h1>
<p>Vos votes validés : <?php echo count($votes['data']);?></p>
<p>Voici votre lien à partager pour recevoir des votes :</p>
<input type="text" value="https://llamabuzz-ga.onrender.com/vote.php?link=<?php echo $_SESSION['unique_link'];?>" readonly>
</main>
</body>
</html>
