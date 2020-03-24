<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [ 'id', 'name', 'id_toestel', 'location', 'description', 'specificaties', 'is_available', 'max_duration_days' ];
}
