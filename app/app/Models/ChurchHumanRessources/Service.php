<?php

namespace App\Models\ChurchHumanRessources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = []; 
    protected $table = 'chr_services';
}
