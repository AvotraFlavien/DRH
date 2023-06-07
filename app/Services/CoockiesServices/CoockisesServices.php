<?php

namespace App\Services\CoockiesServices;

use Illuminate\Http\Response;


class CoockisesServices
{
    // Stockage d'un données dans coockies
    public function stockageCoockies($nom_cookie, $data = [])
    {
        // Stockage cookie
        // $data = ['nom' => 'Avotra', 'age' => 30, 'pays' => 'France'];

        // Créer un cookie avec les données encodées en JSON
        // LifeTime 3 minutes
        $cookie = cookie($nom_cookie, json_encode($data), 3);

        // Retourner une réponse avec le cookie
        return $cookie;
    }
}
