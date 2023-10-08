<?php

namespace App\Service;

class LastRequestContact 
{
    static public function getLastRequestContact($arrayObject)
    {
        $arrayRequest = $arrayObject['requestContacts'];
        //recupération de la dernière requete du contact
        $lastRequest = array_pop($arrayRequest);

        //l'objet sous forme de tableau sans les requêtes associé
        array_pop($arrayObject);
        $arrayContactOnly = $arrayObject;

        // Objet avec seulement la dernière requête
        $arrayContactOnly["requestContacts"] = $lastRequest;
        $arrayObject = $arrayContactOnly;

        return $arrayObject;
    }
}
