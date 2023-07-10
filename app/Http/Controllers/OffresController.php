<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use App\Gazzle\Facebook;
use App\Models\Publication;
use Illuminate\Http\Request;
use App\Models\SocialeMediaType;
use Illuminate\Support\Facades\DB;
use App\Services\CRUD\CrudServices;
use Illuminate\Support\Facades\Auth;
use App\Validator\PublishedValidator;
use App\Validator\ValidatorPublication;
use App\Services\Publlication\PublicationServices;

class OffresController extends Controller
{
    public function __construct(
        protected Facebook $fb,
        protected Request $request,
        protected SocialeMediaType $typeSocialMedia,
        protected PublicationServices $publicationServices,
        protected CrudServices $crudServices,
        protected Publication $publication
    ) {
    }


    /**
     * Liste Réseaux Sociaux Disponibles
     *
     * @return ListeRéseuxSociaux
     */
    public function ListeSocialMedia()
    {
        return response()->json(["data" => $this->typeSocialMedia::all()], 200);
    }

    /**
     * Function pour lister les pages sur fb
     * Compte Fb essai : Ressources Humaines
     * mdp : AinamanankasinaAvotraFlavien0101
     *
     * @return ListePageFb
     */
    public function listePageFb()
    {
        return response()->json(["data" => $this->fb->listePageFacebook()], 200);
    }

    public function publicationOffres(ValidatorPublication $validator, PublishedValidator $publishedvalidator)
    {
        $verification = $this->publicationServices->verifiedReseauxSociaux(
            $validator->validateFB($this->request)["reseaux_sociaux"],
            $validator->validateFB($this->request)["description"]
        );
        if ($verification["message"] == false) {
            return response()->json(["message" => "Une erreur a été survenue"], 401);
        }

        $pu = $publishedvalidator->published($this->request);
        DB::beginTransaction();
        if ($pu) {
            try {
                $pu["employes_id"] = Auth::user()->employe;
                // Ajout dans publication
                $pubSocial = $this->crudServices->crudGeneralise($this->publication, $pu);
                // Ajout dans social media publcation
                DB::commit();
                return $this->publicationServices->ajoutSocialMediaPublication($pubSocial->id);
            } catch (\Throwable $e) {
                dd($e->getMessage());
                DB::rollBack();
            }
        }
    }

    public function publcationLinkedIn()
    {
        $apiUrl = 'https://api.linkedin.com/v2/ugcPosts';
        $accessToken = 'AQX_nCC3VxmNwpVW9zN-OEuMLX5EsgzFk7zxf1t9xXg-pBZ4pJlkExm9n5v_2LprzSmW189_k84bK97wkWADNoJ2tpyw7nUZ2_oXD1Ty3Ax23Z_cSbTZRQ8iGpBRUwvLKwoO4iRhaanFuTbR1ShZUfrR_BLCD_6uNbZFcKTr1zLW-qu261VcDPnn93EoSxWQseVvq3g-e40jEj3aQcbxNdbthDyRfKuMQqIilkpSav-nTV6evLOwSMRdtPFdeDG4fCR5jCxHgwKzXSL8kQ3quLb5QFP3YGM0AaguDmnAMr1jThfPXCB22_UmEZBE9rsHH1h2TFC03-V7QpGUyZOitYOsnTbbtg'; // Ajoutez votre jeton d'accès LinkedIn ici

        $data = [
            "author" => "urn:li:person:LRXPCfHSS-",
            "lifecycleState" => "PUBLISHED",
            "specificContent" => [
                "com.linkedin.ugc.ShareContent" => [
                    "shareCommentary" => [
                        "text" => "Essai 3"
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
                echo 'Publication réussie sur LinkedIn.';
            } else {
                // La publication a échoué
                echo 'Échec de la publication sur LinkedIn.';
            }
        } catch (Exception $e) {
            // Gérer les exceptions
            echo 'Erreur lors de la publication sur LinkedIn : ' . $e->getMessage();
        }
    }
}
