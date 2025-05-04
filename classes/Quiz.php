<?php

namespace Rtfm2win;

use DateTime;

// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');

class Quiz
{
    //-----------------------Attributs--------------------------
    private string $title;
    private string $link;
    private string $qrCode;
    private DateTime $createdAt;
    private int $basePoints = 3000;
    private bool $splitPoints = true;
    private float $timeDeduction;  //Nécessaire? pas noter modifiable dans le CDC !!

    private $pdo;

    //-----------------------Constructeur--------------------------

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

    public function getCreatedAt()
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

    public function getTimeDeduction()
    {
        return $this -> timeDeduction;
    }

    //-----------------------Mutateurs--------------------------

    public function setTitle(string $title)
    {
        $secureTitle = new Security;
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

    public function setBasePoints($basePoints)
    {
        $secureBasePoints = new Security;
        $basePoints = $secureBasePoints -> cleanIntData($basePoints);
        $this -> basePoints = $basePoints;
    }

    public function setSplitPoints(bool $splitPoints)
    {
        $this -> splitPoints = $splitPoints;
    }

    public function setTimeDeduction(float $timeDeduction)
    {
        $this -> timeDeduction = $timeDeduction;
    }

    //-----------------------------
    public function save()
    {
        if (!$this->pdo instanceof \PDO) {
            throw new \Exception("Erreur : La connexion PDO n'est pas valide.");
        }

        // Utilisation de la connexion PDO de l'attribut $this->pdo
        $stmt = $this->pdo->prepare("INSERT INTO quiz (title, link, qrCode, createdAt, basePoints, splitPoints) 
                        VALUES (:title, :link, :qrCode, :createdAt, :basePoints, :splitPoints)");

        // Initialisation des dates
        $now = new DateTime();
        $this->createdAt = $now;        

        // Liaison des paramètres
        $stmt->bindValue(':title', $this->title);
        $stmt->bindValue(':link', $this->link);
        $stmt->bindValue(':qrCode', $this->qrCode);
        $stmt->bindValue(':createdAt', $this->createdAt);
        $stmt->bindValue(':basePoints', $this->basePoints);
        $stmt->bindValue(':splitPoints', $this->splitPoints);
        

        // Exécution de la requête
        if ($stmt->execute()) {
            return (int) $this->pdo->lastInsertId();
        } else {
            throw new \Exception("Erreur lors de l'enregistrement de l'utilisateur");
        }
    }
}
