<?php

namespace App\Services\Account;

use App\Models\Employe;
use App\Models\User;
use App\Services\CRUD\CrudServices;
use Illuminate\Http\Request;
use App\Validator\ValidatorUsers;
use Illuminate\Support\Facades\Hash;

class ServiceAccount
{
    public function __construct(
        protected ValidatorUsers $validatorUsers,
        protected Request $request,
        protected Employe $__model_employe,
        protected User $__model,
        protected CrudServices $__crud
    ) {
    }


    public function createEmploye()
    {
        $validationEmploye = $this->validatorUsers->validateFormEmploye($this->request);
        $val = ($validationEmploye) ? $this->__crud->crudGeneralise($this->__model_employe, $validationEmploye) : $validationEmploye;
        return $val;
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
    }
}
