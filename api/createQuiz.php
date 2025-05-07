<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// API pour créer un quiz
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

//namespace

use Rtfm2win\Quiz;
use Rtfm2win\Security;
use Rtfm2win\QuizQuestion;




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
$data = $_POST;
// on applique la valeur null si la valeur title est vide.
$title = $data['title'];
// on applique la valeur par défaut de 3000 points si la valeur n'est pas renseigner.
$basePoint = $data['basePoints'] ?? 3000;
// on applique l'état par défaut si la valeur n'est pas modifier par l'utilisateur.
$splitPoints = $data['splitPoints'] ?? 1;
// on applique la valeur par défaut de 30 seconde si la valeur n'est pas renseigner.
$maxTimes = $data['maxTimes'] ?? 30;

//Vérification de sécuriter de la variable title
function securTitle ($data){
    $secureData =new Security();
    $data = $secureData->cleanData($data);
    return $data;
}
// Validation d'entrée du titre de quiz

if (empty($title)) {
    
    echo json_encode(['error' => 'Le titre du quiz doit etre renseigné']);
    exit;
    
}else if ($title != securTitle($title)){
    echo json_encode(['error' => 'Attention toute tentative d\'injection via ce formulaire entraîne une attaque de la team aquaponey']);
    exit;    
}

// Validation du format title

if (strlen($title) < 10 || strlen($title) > 50) {
    http_response_code(400);
    echo json_encode(['error' => 'Le titre doit contenir entre 10 et 50 caractères.']);
    
}

// Validation du max de points par question

if ($basePoint < 1500) {
    http_response_code(400);
    echo json_encode(['Warning' => 'La valeur de Point par question ne peut être inférieure à 1500 pour des raisons de jouabilité. <br>La valeur par défaut de 3 000 points sera donc utiliser.']);
    $basePoint = 3000;

}

// Validation du temps par question

if ($maxTimes < 15) {
    http_response_code(400);
    echo json_encode(['Warning' => 'la Valeur de temps par question ne peux etre inférieur à 15 secondes pour des raisons de jouabilité. <br>La valeur par défaut de 30 seconde sera utiliser.']);
    $maxTimes = 30;    
}

if($splitPoints == 'true'){
    $splitPoints = 1;
}else{
    $splitPoints = 0;
}




// appel de la classe quiz + creation nouvelle objet
try {
    $quiz = new Quiz(); 
    $quiz->setTitle($title);
    $quiz->setBasePoints($basePoint);
    $quiz->setSplitPoints($splitPoints);

    $tempsQuiz = new QuizQuestion();
    $tempsQuiz->setMaxTime($maxTimes);

    $newQuiz = $quiz->saveQuiz();
    

    echo json_encode([
        
        'title' => $quiz->getTitle(),
        'basePoints' => $quiz->getBasePoints(),
        'splitPoints' => $quiz->getSplitPoints(),
        'maxTimes' => $tempsQuiz->getMaxTime()
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

