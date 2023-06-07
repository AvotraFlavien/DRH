<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Services\Account\ServiceAccount;
use App\Validator\ValidatorUsers;
use Illuminate\Http\Request;

class EmployeController extends Controller
{

    public function __construct(
            protected ValidatorUsers $validatorUsers, protected Request $request,
            protected ServiceAccount $serviceAccount
        )
    {
    }

    public function createEmployer()
    {
        $this->serviceAccount->createEmploye();
        return response()->json(["message" => "insertion avec succès", "success" => true], 200);
    }

    public function createEmployeAccount(Employe $employe)
    {
        // dd($employe);
        $user = $this->serviceAccount->serviceAddAccountUser($employe);
        return response()->json(["data" => $user, "message" => "Insertion réussie"], 200);
    }
}
