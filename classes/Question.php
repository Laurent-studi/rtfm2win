<?php

namespace Rtfm2win;
use DateTime;

// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');

class Question
{
    //-----------------------Attributs--------------------------
    
    private string $prompt;
    private int $nbCorrect;
    private int $idQuestion = 0;

    private $pdo;


    public function __construct()
    {
        $this->pdo = include __DIR__ . '/../config/database.php';
        if (!$this->pdo) {
            throw new \Exception("Erreur : Impossible d'établir une connexion à la base de données.");
        }
    }

    //-----------------------Accesseurs--------------------------
    
    public function getPrompt()
    {
        return $this -> prompt;
    }

    public function getNbCorrect()
    {
        return $this -> nbCorrect;
    }

    public function getIdQuestion(){
        return $this -> idQuestion;
    }
    //-----------------------Mutateurs--------------------------

    public function setPrompt(string $prompt)
    {
        $securePrompt = new Security();
        $prompt = $securePrompt -> cleanData($prompt);
        $this -> prompt = $prompt;
    }

    public function setNbCorrect(int $nbCorrect)
    {
        $secureNbCorrect = new Security;
        $nbCorrect = $secureNbCorrect->cleanData($nbCorrect);
        $nbCorrect = $secureNbCorrect->cleanIntData($nbCorrect);
        $this -> nbCorrect = $nbCorrect;
    }

    


    public function saveQuestion()
{
    if (!$this->pdo instanceof \PDO) {
        throw new \Exception("Erreur : La connexion PDO n'est pas valide.");
    }

    // Utilisation de la connexion PDO de l'attribut $this->pdo
    $stmt = $this->pdo->prepare("INSERT INTO  question (prompt,nb_correct) 
                    VALUES (:prompt,:nbCorrect)");
    
    // Liaison des paramètres
    
    $stmt->bindValue(':prompt', $this->prompt);
    $stmt->bindValue(':nbCorrect', $this->nbCorrect);   
    

    // Exécution de la requête
    if ($stmt->execute()) {
        $this->idQuestion = (int) $this->pdo->lastInsertId();
        return $this->idQuestion;
    } else {
        throw new \Exception("Erreur lors de l'enregistrement du quiz");
    }
}
}
