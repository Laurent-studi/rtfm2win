<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// API pour créer un quiz
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

use Rtfm2win\Security;

use Rtfm2win\Question;

// Autoload
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../classes/Question.php';

// Vérification de la méthode utilisée
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Mauvaise méthode utilisée.']);
    exit;
}

// Récupération des données JSON du frontend
$data = json_decode(file_get_contents('php://input'), true);
$prompt = $data['prompt'] ?? '';
$answer = $data['answer'] ?? [];

// Vérification de sécurité de la variable texte
function securText($data) {
    $secureData = new Security();
    $data = $secureData->cleanData($data);
    return $data;
}

// Modification de la valeur du checkbox en int pour la BDD
function returnIntCheckBox(string $data) {
    return $data === '1' ? 1 : 0;
}

// Validation d'entrée de l'énoncé de la réponse
if (empty($prompt)) {
    echo json_encode(['error' => 'L\'énoncé de la question doit être renseigné.']);
    exit;
} elseif ($prompt !== securText($prompt)) {
    echo json_encode(['error' => '<strong>Idem : </strong> Attention toute tentative d\'injection via ce formulaire entraîne une attaque de la team aquaponey']);
    exit;
}

// Validation du format texte
if (strlen($prompt) > 50) {
    http_response_code(400);
    echo json_encode(['error' => 'La question ne doit pas contenir plus de 50 caractères.']);
    exit;
}

try {
    // Création de la question
    $question = new Question();
    $question->setPrompt($prompt);
    $question->setNbCorrect(count(array_filter($answer, fn($a) => $a['isCorrect'] ?? false)));

    $newQuestion = $question->saveQuestion();
    $id= $question->getIdQuestion();
    $savedAnswers = [];

    // Création des réponses
    foreach ($answer as $answerData) {
        //inclure create answer
        require __DIR__ . '/../api/createAnswers.php';
    }

    // Réponse finale
    echo json_encode([
        'question' => $question->getPrompt(),
        'answers' => $savedAnswers,
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
