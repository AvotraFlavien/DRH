<?php
namespace App\Services\CRUD;

use Illuminate\Database\Eloquent\Model;

class CrudServices {

    public function crudGeneralise(Model $model, $form = array())
    {
        return $model::create($form);
    }
}
