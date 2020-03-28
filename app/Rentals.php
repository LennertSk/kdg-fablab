<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{
    protected $fillable = [ 'id', 'id_toestel', 'id_ontlener', 'email_ontlener', 'start_datum', 'eind_datum', 'is_active', 'opmerkingen' ];
}
