<?php

namespace App\Validator;

use Illuminate\Http\Request;

class ValidatorPublication
{
    public function validateFB(Request $request)
    {
        return $request->validate(
            [
                'description' => 'required|string',
                'reseaux_sociaux' => 'required|array',
                'reseaux_sociaux.*.id' => 'required|integer',
                'reseaux_sociaux.*.page' => 'array',
                'reseaux_sociaux.*.page.*.pageId' => 'string',
                'reseaux_sociaux.*.page.*.token' => 'string',
            ]
        );
    }
}
