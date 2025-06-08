<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class',
        'semester',
        'year',
        'nisn',

        'spiritual_attitude',
        'social_attitude',

        'religion_knowledge',
        'religion_knowledge_description',
        'religion_skill',
        'religion_skill_description',
        'nation_knowledge',
        'nation_knowledge_description',
        'nation_skill',
        'nation_skill_description',
        'indonesia_knowledge',
        'indonesia_knowledge_description',
        'indonesia_skill',
        'indonesia_skill_description',
        'math_knowledge',
        'math_knowledge_description',
        'math_skill',
        'math_skill_description',
        'english_knowledge',
        'english_knowledge_description',
        'english_skill',
        'english_skill_description',
        'science_knowledge',
        'science_knowledge_description',
        'science_skill',
        'science_skill_description',
        'social_knowledge',
        'social_knowledge_description',
        'social_skill',
        'social_skill_description',

        'art_knowledge',
        'art_knowledge_description',
        'art_skill',
        'art_skill_description',
        'sport_knowledge',
        'sport_knowledge_description',
        'sport_skill',
        'sport_skill_description',
        'local_wisdom_knowledge',
        'local_wisdom_knowledge_description',
        'local_wisdom_skill',
        'local_wisdom_skill_description',

        'interest_subject',
        'interest_knowledge',
        'interest_knowledge_description',
        'interest_skill',
        'interest_skill_description',

        'independence_subject',
        'independence_knowledge',
        'independence_knowledge_description',
        'independence_skill',
        'independence_skill_description',
        
        'extraordinary_knowledge',
        'extraordinary_knowledge_description',
        'extraordinary_skill',
        'extraordinary_skill_description',
        
        'sick',
        'permission',
        'absent',

        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
