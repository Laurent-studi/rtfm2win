<?php

namespace Rtfm2win;

use DateTime;
use Rtfm2win\User;
// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');

class Quiz
{
    //-----------------------Attributs--------------------------
    private string $title;
    private string $link = 'test link';
    private string $qrCode = '';
    private DateTime $createdAt;
    private int $basePoints = 3000;
    private int $splitPoints = 1;
    
    private $pdo;

    public function __construct()
    {
        $this->pdo = include __DIR__ . '/../config/database.php';
        if (!$this->pdo) {
            throw new \Exception("Erreur : Impossible d'établir une connexion à la base de données.");
        }
    }
    //-----------------------Accesseurs--------------------------
    public function getTitle()
    {
        return $this -> title;
    }

    public function getlink()
    {
        return $this -> link;
    }

    public function getqrCode()
    {
        return $this -> qrCode;
    }

    public function getCreatedAt() : DateTime
    {
        return $this -> createdAt;
    }

    public function getBasePoints()
    {
        return $this -> basePoints;
    }

    public function getSplitPoints()
    {
        return $this -> splitPoints;
    }    

    //-----------------------Mutateurs--------------------------

    public function setTitle(string $title)
    {
        $secureTitle = new Security();
        $title = $secureTitle -> cleanData($title);
        $this -> title = $title;
    }

    public function setlink(string $link)
    {
        $this -> link = $link;
    }

    public function setqrCode(string $qrCode)
    {
        $this -> qrCode = $qrCode;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this -> createdAt = $createdAt;
    }

    public function setBasePoints(int $basePoints)
    {
        $secureBasePoints = new Security;
        $basePoints = $secureBasePoints->cleanData($basePoints);
        $basePoints = $secureBasePoints->cleanIntData($basePoints);
        $this -> basePoints = $basePoints;
    }

    public function setSplitPoints(bool $splitPoints)
    {
        $this -> splitPoints = $splitPoints;
    }

    //-------------------------------------------------
//methode save() manquante a créé ici
public function saveQuiz()
{
    if (!$this->pdo instanceof \PDO) {
        throw new \Exception("Erreur : La connexion PDO n'est pas valide.");
    }

    // Utilisation de la connexion PDO de l'attribut $this->pdo
    $stmt = $this->pdo->prepare("INSERT INTO  quiz (user_id,title, unique_link, qr_code, created_at, base_points, split_points) 
                    VALUES (:user_id,:title, :unique_link, :qr_code, :created_at, :base_points, :split_points)");

    // Initialisation des dates
    $now = new DateTime();
    $this->createdAt = $now;
    
    
    // Liaison des paramètres
    $stmt->bindValue(':user_id', 1);
    $stmt->bindValue(':title', $this->title);
    $stmt->bindValue(':unique_link', $this->link);
    $stmt->bindValue(':qr_code', $this->qrCode);
    $stmt->bindValue(':created_at', $this->createdAt->format('Y-m-d H:i:s'));
    $stmt->bindValue(':base_points', $this->basePoints);
    $stmt->bindValue(':split_points', $this->splitPoints);
    

    // Exécution de la requête
    if ($stmt->execute()) {
        return (int) $this->pdo->lastInsertId();
    } else {
        throw new \Exception("Erreur lors de l'enregistrement du quiz");
    }
}
}