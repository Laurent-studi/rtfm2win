<?php
// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');

class QuizQuestion {
    //-----------------------Attributs--------------------------

    private int $maxTime = 30;
    private int $seqOrder;

    //-----------------------Accesseurs--------------------------

    public function getMaxTime(){
        return $this -> maxTime;
    }

    public function getSeqOrder(){
        return $this -> seqOrder;
    }

    //-----------------------Mutateurs--------------------------

    public function setMaxTime(int $maxTime){
        $this -> maxTime = $maxTime;
    }

    public function setSeqOrder(int $seqOrder){
        $this -> seqOrder = $seqOrder;
    }
}

