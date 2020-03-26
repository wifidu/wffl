<?php

namespace App\Models;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['type', 'path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
