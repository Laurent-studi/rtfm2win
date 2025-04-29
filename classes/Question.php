<?php
// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');

class questions {
    //-----------------------Attributs--------------------------

    private string $prompt;
    private int $nbCorrect;

    //-----------------------Accesseurs--------------------------

    public function getPrompt(){
        return $this -> prompt;
    }

    public function getNbCorrect(){
        return $this -> nbCorrect;
    }
    //-----------------------Mutateurs--------------------------

    public function setPrompt(string $prompt){
        $this -> prompt = $prompt;
    }

    public function setNbCorrect(int $nbCorrect){
        $this -> nbCorrect = $nbCorrect;
    }
}

