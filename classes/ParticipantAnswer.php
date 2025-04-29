<?php
// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');

class participantAnswers{
    //-----------------------Attributs--------------------------

    private int $reponseTime;
    private int $pointsEarned;

    //-----------------------Accesseurs--------------------------

    public function getReponseTime(){
        return $this -> reponseTime;
    }

    public function getPointEarned(){
        return $this -> pointsEarned;
    }

    //-----------------------Mutateurs--------------------------

    public function setReponseTime(int $reponseTime){
        $this -> reponseTime = $reponseTime;
    }

    public function setPointEarned(int $pointsEarned){
        $this -> pointsEarned = $pointsEarned;
    }
}