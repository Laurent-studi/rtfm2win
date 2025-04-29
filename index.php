<?php

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion et chargement de  l'autoloader de Composer
try {
    $autoload = require_once __DIR__ . '/vendor/autoload.php';
    if (!$autoload) {
        throw new Exception("Erreur : La connexion à l'autoloader n'a pas pu être établie.");
    }
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}


// Connexion à la base de données
try {
    $pdo = require_once 'config/database.php';
    if (!$pdo) {
        throw new Exception("Erreur : La connexion à la base de données n'a pas pu être établie.");
    }
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}


include_once 'pages/index.html';
//test-Autoload et test-namespace
//use Rtfm2win\User;
//$usertest = new User();
//$usertest->setUserName('test');
//$usertest->setPassword('testpw');
//echo $usertest->getUserName();
//echo $usertest->getPassword();
