<?php

namespace App\Services\Publlication;

use App\Gazzle\Facebook;
use App\Gazzle\LinkedIn;
use App\Models\Publication;
use App\Models\SocialeMediaType;
use App\Services\CRUD\CrudServices;
use App\Models\SocialeMediaPublication;
use App\Validator\ValidatorPublication;
use PhpParser\Node\Expr\Cast\String_;

class PublicationServices
{

    public function __construct(
        protected Publication $publication,
        protected SocialeMediaType $socialMedia,
        protected SocialeMediaPublication $socialeMediaPublication,
        protected CrudServices $crudServices,
        protected ValidatorPublication $validator,
        protected Facebook $fb,
        protected LinkedIn $linkedIn
    ) {
    }

    public $tableau = [];
    public $message = "";
    public function verifiedReseauxSociaux(array $reseaux_sociaux, string $mess)
    {
        foreach ($reseaux_sociaux as $key => $value) {
            $response = $this->socialMedia->find($value["id"]);
            if ($response == null) {
                return ["message" => false];
            }
            array_push($this->tableau, ["reseau" => $response, "page" => $value["page"]]);
        }
        $this->message = $mess;
        return ["message" => true, "data" => $this->tableau];
    }

    public function ajoutSocialMediaPublication(int $idPublication)
    {
        foreach ($this->tableau as $key => $value) {
            $this->crudServices->crudGeneralise($this->socialeMediaPublication, [
                "id_publication" => $idPublication,
                "id_sociale_media_types" => $value["reseau"]->id
            ]);
        }


        return $this->publicationWithReseaux();
    }

    public function publicationWithReseaux()
    {
        // dd($this->tableau);
        foreach ($this->tableau as $key => $value) {
            if ($value["page"] != null) {
                // Code Publication Facebook
                $this->fb->publicationPageFacebook(
                    $value["page"][0]["pageId"],
                    $this->message,
                    $value["page"][0]["token"]
                );
            } else {
                //Code Publication LinKedIn
                $this->linkedIn->publcationLinkedIn($this->message);
            }
        }

        return response()->json(["message" => "Publication avec succès"], 200);
    }

    // public function Facebook()
    // {
    //     if ($validator->validateFB($this->request)) {
    //         $pageId = $validator->validateFB($this->request)["pageId"];
    //         $token = $validator->validateFB($this->request)["token"];
    //         $message = $validator->validateFB($this->request)["message"];

    //         return response()->json(["data" => ], 200);
    //     } else {
    //         return response()->json(["error" => "Une erreur est survenue"], 401);
    //     }
    // }
}
