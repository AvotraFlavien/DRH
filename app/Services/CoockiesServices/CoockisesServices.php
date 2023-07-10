<?php

namespace App\Services\CoockiesServices;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class CoockisesServices
{
    // Stockage d'un données dans coockies
    public function stockageCoockies($nom_cookie, $data = [])
    {
        // Créer un cookie avec les données encodées en JSON
        // LifeTime 3 minutes
        $cookie = Cookie::make($nom_cookie, json_encode($data), 3,  '/', null, false, false);

        // Retourner une réponse avec le cookie
        return $cookie;
    }
}
