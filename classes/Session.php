<?php 

namespace Rtfm2win;

use DateTime;

// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');

class Session
{
    //-----------------------Attributs--------------------------

    private int $idSession;
    private DateTime $startDate;
    private DateTime $endDate;
    private bool $sessionActive;

    //-----------------------Accesseurs--------------------------

    public function getStartDate()
    {
        return $this -> startDate;
    }

    public function getEndDate()
    {
        return $this -> endDate;
    }

    public function getSessionActive()
    {
        return $this -> sessionActive;
    }

    //-----------------------Mutateurs--------------------------

    public function setStartDate(DateTime $startDate)
    {
        $this ->startDate = $startDate;
    }

    public function setEndDate(DateTime $endDate)
    {
        $this -> endDate = $endDate;
    }

    public function setSessionActive(bool $sessionActive)
    {
        $this -> sessionActive = $sessionActive;
    }
}