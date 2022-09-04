<?php

namespace App\Models\ChurchHumanRessources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'chr_churches';

    public function pastor()
    {
        return $this->belongsTo(Christian::class, 'pastor_id')->first();
    }

    public function main_administrator()
    {
        return $this->belongsTo(Christian::class, 'main_administrator_id')->first();
    }
}
