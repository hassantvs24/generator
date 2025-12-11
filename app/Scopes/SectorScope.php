<?php
/**
 * Created by PhpStorm.
 * User: Nazmul
 * Date: 12-May-18
 * Time: 12:05 AM
 */

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SectorScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->where('sector', 'Generator');
    }

}