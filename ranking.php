<?php
require 'config.php';
$candidates = $supabase->from('candidates')->select('*')->order('votes_count','desc')->execute();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Classement en direct</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main>
<h1>Classement des candidats</h1>
<table border="1" cellpadding="10">
<tr>
<th>Nom</th>
<th>Votes validés</th>
</tr>
<?php foreach($candidates['data'] as $c): ?>
<tr>
<td><?php echo htmlspecialchars($c['username']);?></td>
<td><?php echo $c['votes_count'];?></td>
</tr>
<?php endforeach;?>
</table>
</main>
</body>
</html>
