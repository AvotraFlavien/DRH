<?php

namespace App\Gazzle;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class Facebook
{
    public function __construct(
        protected Client $client
    ) {
    }

    public function listePageFacebook()
    {
        $url = 'https://graph.facebook.com/me';
        $params = [
            'query' => [
                'fields' => 'id,name,accounts',
                'access_token' => 'EABgaGiNPi7wBAMfJEKUS6KhdNdeRFqIaQZA9ZCJRMvcZCbtXzKSjPik4yEprFxpZAucZAq5ZCLXO6X2zMK8Hvs8nl3L6sKBSmZBEoSqZAu6nyqevQG6A1IrgjxBVdZBXGxJRdZAi5BWzIf1Ok4bqRd76jZCe69ZAOb82eOZCEx9UGNbcGHKGQU2TtJmpj',
            ]
        ];

        $response = $this->client->get($url, $params);

        $result = json_decode($response->getBody(), true);

        // Affichez la réponse (à des fins de débogage)
        return $result;
    }


    public function fileToUpload($filePath)
    {
        $fileContents = file_get_contents($filePath);

        return base64_encode($fileContents);
    }

    public function publicationPageFacebook(string $page, string $message, string $token)
    {
        $client = $this->client;
        $tok = $token;
        // dd($page);
        // $id_page = "107430119076818";
        // EABgaGiNPi7wBAGhSXZBPk4YDZAUpjm7jt2hiQL6i1UL5P7jqiMO1P48eamChG4S5djjDLnfOvkI4805esXyZCPXYbxZA57fRDe4veaYWMr16ZC4ZCZBtsXoWZBpdsqN4VRYoCECCijYAmJr1xvJ1lwsYo89Y2yMEtf96sPrgT6U71YjHKFSkCnwrkKasZCzyZBH7gZD

        $response = $client->post("https://graph.facebook.com/$page/feed", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ],
            'form_params' => [

                'message' => $message,
                // 'source' => 'http://localhost:8000/storage/Images/profil_default.png'
            ],
        ]);

        $result = json_decode($response->getBody(), true);

        if ($result["id"]) {
            return "Publication avec succès";
        }

        return ["error" => "Id ou token non trouvé"];

    }
}
