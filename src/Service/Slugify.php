<?php
// src/Service/Slugify.php

namespace App\Service;

class Slugify 
{
    public function generate(string $input):string
    {
        //traiter les caractères spéciaux 
        $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
        //remplacer par:
        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
        // Remplacer toutes les espaces par des tirets 
        $input= str_replace(' ', '-', $input);
        // Remplacer toutes les caractères spéciaux
        $input= str_replace($search, $replace, $input);
        //il n'y a pas plusieurs - successifs
        $input = preg_replace('/--+/', '-', $input);
        //la chaîne générée est en minuscules
        $input = strtolower($input);
        // supprimer  les caractères spéciaux.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $input); 
    }
}
