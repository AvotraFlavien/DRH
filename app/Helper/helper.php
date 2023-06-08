<?php

namespace App\Helper;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Helper
{

    public function explode_character($string, $character)
    {
        return explode($character, $string);
    }

    // Images, dossier emplacement, $user_id
    public function helperStockagePublicImage($images, $emplacement, $user_id= null)
    {
        $explode_image = $this->explode_character($images, ";");

        $nom_image = [];
        foreach ($explode_image as $key => $image) {
            $get_content_image = file_get_contents($image);
            $randomNumber = mt_rand(100000, 999999);

            // Mandefa anle image any @ Storage
            $stockage = Storage::disk('public')->put(
                $emplacement . '/' . $randomNumber . '_' . $user_id . '-images.jpg',
                $get_content_image
            );

            array_push($nom_image, $emplacement . '/' . $randomNumber . '_' . $user_id . '-images.jpg');
        }

        return ($stockage == true) ? implode(";", $nom_image) : false;
    }

    public function delteteTokenLogout()
    {
        try {
            Auth::user()->tokens()->delete();
            Auth::guard("web")->logout();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
