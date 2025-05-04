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
    
    private $pdo;
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
        $this -> basePoints = $basePoints;
    }

    public function setSplitPoints(bool $splitPoints)
    {
        $this -> splitPoints = $splitPoints;
    }

    //-------------------------------------------------
//methode save() manquante a créé ici
public function save()
{
    if (!$this->pdo instanceof \PDO) {
        throw new \Exception("Erreur : La connexion PDO n'est pas valide.");
    }

    // Utilisation de la connexion PDO de l'attribut $this->pdo
    $stmt = $this->pdo->prepare("INSERT INTO quiz (title, unique_link, qr_code, createdAt, base_points, split_points) 
                    VALUES (:title, :unique_link, :qr_code, :createdAt, :base_points, :split_points)");

    // Initialisation des dates
    $now = new DateTime();
    $this->createdAt = $now;
    

    // Liaison des paramètres
    $stmt->bindValue(':title', $this->title);
    $stmt->bindValue(':unique_link', $this->link);
    $stmt->bindValue(':qr_code', $this->qrCode);
    $stmt->bindValue(':createdAt', $this->createdAt);
    $stmt->bindValue(':base_points', $this->basePoints);
    $stmt->bindValue(':split_points', $this->splitPoints);
    

    // Exécution de la requête
    if ($stmt->execute()) {
        return (int) $this->pdo->lastInsertId();
    } else {
        throw new \Exception("Erreur lors de l'enregistrement de l'utilisateur");
    }
}
}