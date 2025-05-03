<?php

// Activer l'affichage des erreurs pour le débogage <- a retirer en prod
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion et chargement de  l'autoloader de Composer + gestion erreur
try {
    $autoload = require_once __DIR__ . '/vendor/autoload.php';
    if (!$autoload) {
        throw new Exception("Erreur : La connexion à l'autoloader n'a pas pu être établie.");
    }
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}


// Connexion à la base de données + gestion erreur
try {
    $pdo = require_once 'config/database.php';
    if (!$pdo) {
        throw new Exception("Erreur : La connexion à la base de données n'a pas pu être établie.");
    }
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Vérifiez si le script actuel est directement appelé
if (php_sapi_name() !== 'cli-server' && isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
    return false; // Laissez le serveur traiter directement les fichiers dans /api/
}

// Inclure la page index.html
include_once 'pages/index.html';

// Test des classes
//test-Autoload et test-namespace
//use Rtfm2win\User;
//$usertest = new User();
//$usertest->setUserName('test');
//$usertest->setPassword('testpw');
//echo $usertest->getUserName();
//echo $usertest->getPassword();
