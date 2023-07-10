<?php

namespace App\Gazzle;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class LinkedIn
{
    public function __construct(
        protected Client $client
    ) {
    }


    public function publcationLinkedIn(string $message)
    {
        $apiUrl = 'https://api.linkedin.com/v2/ugcPosts';
        $accessToken = 'AQX_nCC3VxmNwpVW9zN-OEuMLX5EsgzFk7zxf1t9xXg-pBZ4pJlkExm9n5v_2LprzSmW189_k84bK97wkWADNoJ2tpyw7nUZ2_oXD1Ty3Ax23Z_cSbTZRQ8iGpBRUwvLKwoO4iRhaanFuTbR1ShZUfrR_BLCD_6uNbZFcKTr1zLW-qu261VcDPnn93EoSxWQseVvq3g-e40jEj3aQcbxNdbthDyRfKuMQqIilkpSav-nTV6evLOwSMRdtPFdeDG4fCR5jCxHgwKzXSL8kQ3quLb5QFP3YGM0AaguDmnAMr1jThfPXCB22_UmEZBE9rsHH1h2TFC03-V7QpGUyZOitYOsnTbbtg'; // Ajoutez votre jeton d'accès LinkedIn ici

        $data = [
            "author" => "urn:li:person:LRXPCfHSS-",
            "lifecycleState" => "PUBLISHED",
            "specificContent" => [
                "com.linkedin.ugc.ShareContent" => [
                    "shareCommentary" => [
                        "text" => $message
                    ],
                    "shareMediaCategory" => "NONE"
                ]
            ],
            "visibility" => [
                "com.linkedin.ugc.MemberNetworkVisibility" => "PUBLIC"
            ]
        ];

        $client = new Client();

        try {
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                    'x-li-format' => 'json'
                ],
                'json' => $data
            ]);

            // Vérifiez le code d'état de la réponse pour gérer les succès ou les échecs
            if ($response->getStatusCode() == 201) {
                // La publication a réussi
                return ["message" => "Publication réussie sur LinkedIn."];
            } else {
                // La publication a échoué
                return ["message" => 'Échec de la publication sur LinkedIn.'];
            }
        } catch (Exception $e) {
            // Gérer les exceptions
            return $e->getMessage();
        }
    }


    public function publicationPageLinkedIn(string $page, string $message, string $token)
    {
        $client = $this->client;
        $tok = $token;
        // dd($page);
        // $id_page = "107430119076818";
        // EABgaGiNPi7wBAGhSXZBPk4YDZAUpjm7jt2hiQL6i1UL5P7jqiMO1P48eamChG4S5djjDLnfOvkI4805esXyZCPXYbxZA57fRDe4veaYWMr16ZC4ZCZBtsXoWZBpdsqN4VRYoCECCijYAmJr1xvJ1lwsYo89Y2yMEtf96sPrgT6U71YjHKFSkCnwrkKasZCzyZBH7gZD

        $response = $client->post("https://api.linkedin.com/v2/ugcPosts", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ],
            'form_params' => [
                'message' => $message,
            ],
        ]);

        $result = json_decode($response->getBody(), true);

        if ($result["id"]) {
            return "Publication avec succès";
        }

        return ["error" => "Id ou token non trouvé"];
    }
}
