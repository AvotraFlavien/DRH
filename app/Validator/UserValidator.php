<?php

namespace App\Validator;

use Exception;
use Illuminate\Http\Request;

class UserValidator
{
    public function validateForm(Request $request)
    {

        // try {
        return $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:200',
                'password' => 'required|string|min:8|max:50',
                // 'biography' => 'string'
            ]
        );
        // } catch (Exception $e) {
        //     dd($e);
        // }
    }

    public function validationLogin(Request $request)
    {
        return $request->validate(
            [
                'email' => 'required|email|max:200',
                'password' => 'required|string|min:8|max:50'
            ]
        );
    }

    public function validatorConnexion(Request $request)
    {
        return $request->validate(
            [
                'email' => 'required|email|max:200',
            ]
        );
    }

    public function validatorPassword(Request $request)
    {
        return $request->validate(
            [
                'password' => 'required|string|min:8|max:50'
            ]
        );
    }

    public function validateConversation(Request $request)
    {

        // try {
        return $request->validate(
            [
                'message' => 'required',
                'choose_recepteur' => 'required'
            ]
        );
        // } catch (Exception $e) {
        //     dd($e);
        // }
    }
}
