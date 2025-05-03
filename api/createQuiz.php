<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// API pour créer un utilisateur
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

//namespace user
use Rtfm2win\Quiz;
use Rtfm2win\config;


// Autloload
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../classes/Quiz.php';


// verification de la méthode utilisée

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Mauvaise méthode utilisée.']);
    exit;
}

// Récupération des données JSON du frontend
$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'] ?? null;
$basePoint = $data['basePoint'] ;
$splitPoints = $data['splitPoints'] ;


// appel de la classe quiz + creation nouvelle objet
try {
    $quiz = new Quiz(); 
    $quiz->setTitle($title);
    $quiz->setBasePoints($basePoint);
    $quiz->setSplitPoints($splitPoints);
    

    echo json_encode([
        
        'title' => $quiz->getTitle(),
        'basePoints' => $quiz->getBasePoints(),
        'splitPoints' => $quiz->getSplitPoints(),
    ]);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de base de données : ' . $e->getMessage()]);
    exit;
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la création du quiz : ' . $e->getMessage()]);
    exit;
}