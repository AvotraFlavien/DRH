<?php

namespace App\Validator;

use Illuminate\Http\Request;

class ValidatorUsers
{
    public function validateForm(Request $request)
    {
        return $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:200',
                'password' => 'required|string|min:8|max:50',
                'role' => 'required|string',
                'status' => 'required|integer'
            ]
        );
    }

    public function validateFormEmploye(Request $request)
    {
        return $request->validate(
            [

                "nom" => 'required|string|max:255',
                "prenom" => 'required|string|max:255',
                "matricule" => 'required|integer',
                "poste" => 'required|string|max:255',
                "telephone" => 'nullable|integer',
                "date_naissance" => 'nullable|date' ,
                "adresse" => 'nullable|string|max:255',
                "photo" => 'nullable|string|max:255',
                "status" => "integer"
            ]
        );
    }
}
