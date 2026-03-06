<?php
session_start();
//require __DIR__ . '/vendor/autoload.php';

use Supabase\SupabaseClient;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$supabase = new SupabaseClient($_ENV['SUPABASE_URL'], $_ENV['SUPABASE_KEY']);
