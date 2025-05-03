<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// API pour créer un utilisateur
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

//namespace user
use Rtfm2win\User;
use Rtfm2win\config;

// Autloload
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../classes/User.php';


// verification de la méthode utilisée

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Mauvaise méthode utilisée.']);
    exit;
}

// Récupération des données JSON du frontend
$data = json_decode(file_get_contents('php://input'), true);
$pseudo = $data['pseudo'] ?? null;
$email = $data['email'] ?? null;
$password = $data['password'] ?? null;

// validation d'entrée des données
if (empty($pseudo) || empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(['error' => 'Tous les champs sont obligatoires.']);
    exit;
}
// Validation du format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Format d\'email invalide.']);
    exit;
}
// Validation du format mot de passe
if (strlen($password) < 8) {
    http_response_code(400);
    echo json_encode(['error' => 'Le mot de passe doit contenir au moins 8 caractères.']);
    exit;
}
// Validation du format pseudo
/* if (strlen($pseudo) < 3 || strlen($pseudo) > 20) {
    http_response_code(400);
    echo json_encode(['error' => 'Le pseudo doit contenir entre 3 et 20 caractères.']);
    exit;
} */

// appel de la classe User + creation nouvelle objet

try {
    $user = new User();
    $user->setUserName($pseudo);
    $user->setEmail($email);
    $user->setPassword($password);
    //$newUser = $user->save();

    echo json_encode([
        'success' => true,
        'user_id' => $newUser,
        'pseudo' => $user->getUserName(),
        'email' => $user->getEmail()
    ]);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de base de données : ' . $e->getMessage()]);
    exit;
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la création de l\'utilisateur : ' . $e->getMessage()]);
    exit;
}

