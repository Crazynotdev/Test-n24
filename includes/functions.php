<?php

function redirect($url)
{
header("Location: ".$url);
exit;
}

function sanitize($data)
{
return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function isLoggedIn()
{
return isset($_SESSION['user_id']);
}

function requireLogin()
{
if(!isLoggedIn()){
redirect('/login.php');
}
}

function votePrice()
{
return getenv('VOTE_PRICE') ?? 200;
}
