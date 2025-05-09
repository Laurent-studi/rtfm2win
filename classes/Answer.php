<?php

namespace Rtfm2win;


// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');

class Answer
{
    //-----------------------Attributs--------------------------

    private string $text;
    private bool $isCorrect = false;
    private int $idQuestion;


    private $pdo;

    public function __construct()
    {
        $this->pdo = include __DIR__ . '/../config/database.php';
        if (!$this->pdo) {
            throw new \Exception("Erreur : Impossible d'établir une connexion à la base de données.");
        }
    }

    //-----------------------Accesseurs--------------------------

    public function getText()
    {
        return $this -> text;
    }

    public function getIsCorrect()
    {
        return $this -> isCorrect;
    }

    public function getIdQuestion(){
        return $this -> idQuestion;
    }

    //-----------------------Mutateurs--------------------------

    public function setText(string $text)
    {
        $secureText = new Security();
        $text = $secureText->cleanData($text);
        $this -> text = $text;
    }

    public function setIsCorrect(bool $isCorrect)
    {
        
        $this -> isCorrect = $isCorrect;
    }

    public function setIdQuestion(int $idQuestion){
        $this -> idQuestion = $idQuestion;
    }

    //methode save() manquante a créé ici
public function saveAnswer()
{
    if (!$this->pdo instanceof \PDO) {
        throw new \Exception("Erreur : La connexion PDO n'est pas valide.");
    }

    // Utilisation de la connexion PDO de l'attribut $this->pdo
    $stmt = $this->pdo->prepare("INSERT INTO  answer (question_id, text, is_correct) 
                    VALUES (:question_id,:text, :isCorrect)");    
    
    // Liaison des paramètres
    $stmt->bindValue(':question_id',$this ->idQuestion);
    $stmt->bindValue(':text', $this->text);
    $stmt->bindValue(':isCorrect', $this->isCorrect);
    

    // Exécution de la requête
    if ($stmt->execute()) {
        return (int) $this->pdo->lastInsertId();
    } else {
        throw new \Exception("Erreur lors de l'enregistrement du quiz");
    }
}
}
