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

    public function setBasePoints(int $basePoints)
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
}
