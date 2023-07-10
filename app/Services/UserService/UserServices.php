<?php

namespace App\Services\UserService;

use App\Models\User;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Validator\UserValidator;
use App\Validator\ProfilValidator;
use Illuminate\Support\Facades\DB;
use App\Services\CRUD\CrudServices;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Services\ProfilService\ProfilService;
use App\Notifications\ValidationCodeNotification;
use App\Services\CoockiesServices\CoockisesServices;

/**
 * Class utiliser pour traiter le model USER
 */
class UserServices
{

    protected $__validator;
    private $__profilService;
    protected $__request;
    protected $__crud;
    protected $__model;
    protected $__cookie;

    public function __construct(
        User $model_user,
        // ProfilService $profilService,
        UserValidator $validator,
        CrudServices $crudServices,
        Request $request,
        CoockisesServices $cook
    ) {
        $this->__validator = $validator;
        $this->__request = $request;
        $this->__crud = $crudServices;
        $this->__model = $model_user;
        // $this->__profilService = $profilService;
        $this->__cookie = $cook;
    }

    public function loginService()
    {
        $validation = $this->__validator->validationLogin($this->__request);
        $user = User::where('email', '=', $validation["email"])->get()->first();
        if ($validation && $user && Hash::check($validation["password"], $user->password) == true) {
            $token = $user->createToken($user->name . ' ' . $user->email);
            return response()->json(
                [
                    "user" => ["id" => $user->id, "id_employe" => $user->employe, "role" => $user->role, "name" => $user->name, "email" => $user->email],
                    "success" => "true",
                    "token" => $token->plainTextToken
                ],
                200
            );
        } else {
            return response()->json(["message" => "Mail non trové", "success" => false], 400);
        }
    }

    /**
     * Vérification mail lors de l'essai de connexion
     *
     * @return envoiMail
     */
    public function mailVerification()
    {
        $validationForm = $this->__validator->validatorConnexion($this->__request);

        $user = User::where('email', '=', $validationForm["email"])->get()->first();
        if ($validationForm && $user) {
            Cookie::forget('cookie');

            // Random de 6 chiffres
            $randomNumber = rand(100000, 999999);

            $name = $user->name;

            // Notification par mail du code de validation du compte
            $code = $randomNumber;
            $user->notify(new ValidationCodeNotification(
                "Code validation",
                "Bonjour $name !",
                "Voici votre code de validation : $code",
                null
            ));

            // $user->id
            $cookie = $this->__cookie->stockageCoockies(
                "cookie",
                ["id" => $user->id, "name" => $name, "code" => $code]
            );
            $response = new Response($cookie);
            return $response->cookie('cookie', $response);
        } else {
            return response()->json(["message" => "Mail non trové", "success" => false], 400);
        }
    }


    /**
     * Verification password et création token de connexion
     *
     * @return token
     */
    public function passwordVerification($user)
    {
        $validationForm = $this->__validator->validatorPassword($this->__request);
        if ($validationForm) {
            if (
                $user && Hash::check($validationForm["password"], $user->password) == true
            ) {
                $token = $user->createToken($user->name . ' ' . $user->email);
                return response()->json(
                    [
                        "user" => ["name" => $user->name, "email" => $user->email],
                        "success" => "true",
                        "token" => $token->plainTextToken
                    ],
                    200
                );
            } else {
                return response()->json([
                    "message" => "user non trouvé"
                ], 401);
            }
        }
    }
}
