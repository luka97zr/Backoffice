<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentValue extends Model
{
    use HasFactory;

    public function contentTypeValues() {
        return $this->hasMany(ContentTypeValues::class);
    }
}
