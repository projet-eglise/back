<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorTopic extends Model
{
    use HasFactory;
    
    protected $guarded = [];  
    protected $table = 'logs_error_topics';
}
