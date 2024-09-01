<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;

    const TYPE_PARTNER = 'PARTNER';
    const TYPE_GUEST_DOCUMENTATION = 'GUEST_DOCUMENTATION';
    const TYPE_HERO = 'HERO';
    const TYPE_HOME_SECTION_1 = 'HOME_SECTION_1';
    const TYPE_HOME_SECTION_5 = 'HOME_SECTION_5';

    protected $morphMap = [
        'user' => 'App\Models\User',
        'post' => 'App\Models\Post',
        'product' => 'App\Models\Product',
        // Add other morphable models if needed
    ];

    protected $fillable = [
        'originalname',
        'alt_text,',
        'mimetype',
        'encoding',
        'path',
        'destination',
        'size',
        'aux',
        'uploader_id',
        'object_id',
        'object_type',
    ];

    public function object()
    {
        return $this->morphTo();
    }

}
