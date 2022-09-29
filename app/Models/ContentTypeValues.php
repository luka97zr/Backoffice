<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentTypeValues extends Model
{
    use HasFactory;

    public function contentType() {
        return $this->belongsTo(ContentType::class);
    }

    public function contentValue() {
        return $this->belongsTo(ContentValue::class);
    }
}
