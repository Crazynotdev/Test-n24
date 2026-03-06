<?php
require 'config.php';
if(!isset($_SESSION['user_id'])) header('Location: login.php');

$link = $_GET['link'] ?? '';
$user = $supabase->from('users')->select('*')->eq('unique_link', $link)->execute();
if(count($user['data'])===0) exit('Lien invalide.');

$candidates = $supabase->from('candidates')->select('*')->execute();
$message = '';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $candidate_id = $_POST['candidate_id'];
    $supabase->from('votes')->insert([
        'voter_id'=>$_SESSION['user_id'],
        'candidate_id'=>$candidate_id,
        'is_validated'=>false,
        'voter_name'=>$_SESSION['username'],
        'voter_number'=>$_POST['voter_number']
    ])->execute();
    $message = "Vote envoyé, en attente de validation par l'admin.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Vote</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main>
<h1>Votez pour votre candidat</h1>
<?php echo $message;?>
<form method="POST">
<input type="text" name="voter_number" placeholder="Votre numéro" required>
<select name="candidate_id" required>
<?php foreach($candidates['data'] as $c): ?>
<option value="<?php echo $c['id'];?>"><?php echo htmlspecialchars($c['username']);?></option>
<?php endforeach;?>
</select>
<button type="submit">Voter</button>
</form>
</main>
</body>
</html>
