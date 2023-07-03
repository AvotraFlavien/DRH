<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use App\Validator\ValidatorUsers;
use Illuminate\Support\Facades\Auth;
use App\Services\Account\ServiceAccount;

class EmployeController extends Controller
{

    public function __construct(
            protected ValidatorUsers $validatorUsers, protected Request $request,
            protected ServiceAccount $serviceAccount, protected Employe $__model_employe
        )
    {
        // $this->authorizeResource($this->__model_employe, );
    }

    public function createEmployer()
    {
        // dd($this->authorize("create", $this->__model_employe));
        $employe = $this->serviceAccount->createEmploye();

        return response()->json(["data" => $employe, "message" => "insertion avec succès", "success" => true], 200);
    }

    public function createEmployeAccount(Employe $employe)
    {
        // dd($employe);
        $user = $this->serviceAccount->serviceAddAccountUser($employe);
        return response()->json(["data" => $user, "message" => "Insertion réussie"], 200);
    }

    public function listeEmploye(){
        return response()->json(["liste" => Employe::paginate(3), "success" => true],200);
    }
}
