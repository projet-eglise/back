<?php

namespace App\Models\Logs;

use App\Models\ChurchHumanRessources\Christian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    
    protected $guarded = [];  
    protected $table = 'logs_requests';

    public function userUuid(): string
    {
        return $this->user()?->uuid ?? '';
    }

    public function userFirstname(): string
    {
        return $this->user()?->firstname ?? '';
    }

    public function userLastname(): string
    {
        return $this->user()?->lastname ?? '';
    }

    public function userFullname(): string
    {
        return $this->user()?->fullname() ?? '';
    }

    public function userProfilePicture(): string
    {
        return $this->user()?->profile_picture ?? '';
    }

    private function user(): ?Christian
    {
        $result = Christian::where('uuid', $this->user_uuid)->get();
        return $result->isEmpty() ? null : $result->first();
    }
}
