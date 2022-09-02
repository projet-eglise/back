<?php

namespace App\Models\ChurchHumanRessources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Christian extends Model
{
    use HasFactory;

    protected $guarded = []; 
    protected $table = 'chr_christians';
}
