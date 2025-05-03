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
use Rtfm2win\Security;

// Autloload
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../classes/Quiz.php';


// verification de la méthode utilisée

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Mauvaise méthode utilisée.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'] ?? null;
$basePoint = $data['basePoint'] ?? null;
$splitPoints = $data['splitPoints'] ?? null;

