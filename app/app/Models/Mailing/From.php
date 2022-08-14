<?php

namespace App\Models\Mailing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class From extends Model
{
    use HasFactory;
    protected $table = 'mailing_froms';
}
