<?php

namespace Michelangelo\Confy\Models;

use Illuminate\Database\Eloquent\Model;

class Confy extends Model {

    protected $table = 'configs';

    protected $fillable = ['key', 'category', 'model_id', 'model_type'];

}