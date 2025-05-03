<?php

namespace Rtfm2win\config;

require_once __DIR__ . '/../vendor/autoload.php';


use Dotenv\Dotenv;
use PDO;
use PDOException;

// Vérifier si l'extension PDO est activée
if (!extension_loaded('pdo')) {
    die("L'extension PDO n'est pas activée. Veuillez l'activer dans votre fichier php.ini.");
}

//message d'erreur si l'extension PDO MySQL n'est pas activée
if (!extension_loaded('pdo_mysql')) {
    die("L'extension PDO MySQL n'est pas activée. Veuillez l'activer dans votre fichier php.ini.");
}

// Charger les variables d'environnement depuis le fichier .env
try {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
} catch (\Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Vérifiez que les variables d'environnement sont chargées
if (empty($_ENV['DB_HOST']) || empty($_ENV['DB_DATABASE'])) {
    die("Erreur : Les variables d'environnement nécessaires ne sont pas chargées correctement.");
}

// Vérification des variables d'environnement nécessaires
$requiredEnvVars = ['DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'];
foreach ($requiredEnvVars as $var) {
    if (empty($_ENV[$var])) {
        die("Erreur : La variable d'environnement {$var} n'est pas définie dans le fichier .env.");
    }
}

//configuration de la connexion à la base de données
$config = [
    'host' => $_ENV['DB_HOST'], // Adresse du serveur de base de données
    'port' => $_ENV['DB_PORT'], // Port par défaut
    'database' => $_ENV['DB_DATABASE'], // Nom de la base de données
    'username' => $_ENV['DB_USERNAME'], // Nom d'utilisateur
    'password' => $_ENV['DB_PASSWORD'], // Mot de passe
    'charset' => 'utf8mb4',         // Jeu de caractères
    'collation' => 'utf8mb4_unicode_ci', // Collation
    //options de connexion avec PDO
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Gestion des erreurs
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode de récupération par défaut
        PDO::ATTR_EMULATE_PREPARES => false, // Désactiver les requêtes préparées émulées
        PDO::ATTR_TIMEOUT => 5, // Délai d'attente de 5 secondes
    ],
];

//try-catch pour gérer les erreurs de connexion
try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage() .
        " (Code : " . $e->getCode() . ")");
}

if (!$pdo) {
    throw new \Exception("Erreur : La connexion PDO n'a pas pu être établie.");
}

if (!$pdo instanceof PDO) {
    throw new \Exception("Erreur : La connexion PDO n'a pas pu être établie.");
}

return $pdo;
