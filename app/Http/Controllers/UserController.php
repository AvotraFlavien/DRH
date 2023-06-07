<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService\UserServices;

class UserController extends Controller
{
    public function __construct(
        protected UserServices $__userService,
        protected Request $__request,
    ) {
    }


    public function verificationMail()
    {
        // Connexion tokony manoratra mail aloha de code de vaidation vao mot de passe
        return $this->__userService->mailVerification();
    }


    // Verification par code de validation envoyer par mail
    public function verificationUser(User $id_user)
    {
        $len_code = strlen($this->__request->code);
        if ($len_code < 6 || $len_code > 6) {
            return response()->json(["message" => "Le code doit éxactement contenir 6 chiffres"], 401);
        } else {
            $valeurCookie = $this->__request->cookie('cookie');
            if ($valeurCookie) {
                $decodageJson = json_decode($valeurCookie);

                $retVal = ($decodageJson->id == $id_user->id &&
                    $this->__request->code == $decodageJson->code) ? "code valider" : "code non valide";
                return response()->json(["message" => $retVal, "user" => [
                    "id" => $id_user->id,
                    "email" => $id_user->email
                ]], 201);
            } else {
                return response()->json(["message" => 'Le cookie n\'existe pas ou est vide'], 401);
            }
        }
    }


    // Vérification mot de passe et connexion
    public function verificationPassword(User $user)
    {
        $valeurCookie = $this->__request->cookie('cookie');
        if ($valeurCookie) {
            $decodageJson = json_decode($valeurCookie);

            $val = ($decodageJson->id == $user->id) ? $this->__userService->passwordVerification($user) : ["message" => "cookie de cet user non trouvé"];
            return response()->json($val);
        }

        return response()->json(["message" => "cookie vide"], 400);
    }
}
