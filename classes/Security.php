<?php

namespace Rtfm2win;

// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');


class Security
{
    // Fonction pour néttoyer les données.
    public function cleanData($data)
    {
        // On commence par retiré les espaces avant et apres la donnée
        $data = trim($data);
        // On supprime les back-slash afin de prévenir l'échappement de caratère spéciaux.
        $data = stripslashes($data);
        // On retire les balises qui pourrais etre entré dans la variable $data.
        $data = strip_tags($data);
        // On return notre data une fois néttoyer.
        return $data;
    }

    // fonction pour gérer les datas de type int
    function cleanIntData($data)
    {
        // Passage de la fonction intval pour convertir les données en int
        $data = intval($data);
        // Si l'ulitsateur rentre autre choses que des nombres la fonction retourne un 0.
        if ($data === 0) {
            // Si $data est égale à 0 alors on retourne un null pour simplifier.
            $data = null;
            return $data;
        } else {
            // Si la valeur est bien un nombre alors on retourne notre valeur dans notre $data pour l'utiliser.
            return $data;
        }
    }
}
