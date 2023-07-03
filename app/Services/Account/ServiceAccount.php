<?php

namespace App\Services\Account;

use App\Helper\Helper;
use App\Models\Employe;
use App\Models\User;
use App\Services\CRUD\CrudServices;
use Illuminate\Http\Request;
use App\Validator\ValidatorUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ServiceAccount
{
    public function __construct(
        protected ValidatorUsers $validatorUsers,
        protected Request $request,
        protected Employe $__model_employe,
        protected User $__model,
        protected CrudServices $__crud,
        protected Helper $helper
    ) {
    }


    public function createEmploye()
    {
        $validationEmploye = $this->validatorUsers->validateFormEmploye($this->request);
        if ($validationEmploye) {
            // $image = Storage::disk('public')->path("Images/profil_default.png");
            // $images_enregistrer = $this->helper->helperStockagePublicImage($image, "Profil");
            // $validationEmploye["photo"] = "http://127.0.0.1:8000/".$images_enregistrer;
            $validationEmploye["photo"] = "http://127.0.0.1:8000/storage/Images/profil_default.png";
            $this->__crud->crudGeneralise($this->__model_employe, $validationEmploye);
        }
        return $validationEmploye;
    }

    public function serviceAddAccountUser($employe)
    {
        $validation = $this->validatorUsers->validateForm($this->request);
        if ($validation) {
            $validation["employe"] = $employe->id;
            $pass = $validation["password"];
            $validation["password"] = Hash::make($validation["password"]);

            $this->__crud->crudGeneralise($this->__model, $validation);
            return array("name" => $validation["name"], "email" => $validation["email"], "password" => $pass);
        }

        return $validation;
    }
}
