<?php

namespace Rtfm2win;

// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');

class Participation
{
    //-----------------------Attributs--------------------------

    private DateTime $participationDate;
    private DateTime $endDateParticipation;
    private float $totalScore;
    private int $rankPosition = 0;
    private bool $participationActive = true;

    //-----------------------Accesseurs--------------------------

    public function getParticipationDate()
    {
        return $this -> participationDate;
    }

    public function getEndDateParticipation()
    {
        return $this -> endDateParticipation;
    }

    public function getTotalScore()
    {
        return $this -> totalScore;
    }

    public function getRankPosition()
    {
        return $this -> rankPosition;
    }

    public function getParticipationActive()
    {
        return $this -> participationActive;
    }

    //-----------------------Mutateurs--------------------------

    public function setParticipationDate(DateTime $participationDate)
    {
        $this -> participationDate = $participationDate;
    }

    public function setEndDateParticipation(DateTime $endDateParticipation)
    {
        $this -> endDateParticipation = $endDateParticipation;
    }

    public function setTotalScore(float $totalScore)
    {
        $this -> totalScore = $totalScore;
    }

    public function setRankPosition(int $rankPosition)
    {
        $this -> rankPosition = $rankPosition;
    }

    public function setParticipationActive(bool $participationActive)
    {
        $this -> participationActive = $participationActive;
    }
}
