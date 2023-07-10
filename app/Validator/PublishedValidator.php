<?php
namespace App\Validator;

use Illuminate\Http\Request;

class PublishedValidator{
    public function published(Request $request)
    {
        return $request->validate(
            [
                'description' => 'required|string',
                'employes_id' => 'integer'
            ]
        );
    }
}
