<?php
// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');

class Answer {
    //-----------------------Attributs--------------------------

    private string $text;
    private bool $isCorrect = false;

    //-----------------------Accesseurs--------------------------

    public function getText(){
        return $this -> text;
    }

    public function getIsCorrect(){
        return $this -> isCorrect;
    }

    //-----------------------Mutateurs--------------------------

    public function setText(string$text){
        $this -> text = $text;
    }

    public function setIsCorrect(bool $isCorrect){
        $this -> isCorrect = $isCorrect;
    }
}

