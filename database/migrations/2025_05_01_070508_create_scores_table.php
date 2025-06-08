<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('class')->nullable();
            $table->string('semester')->nullable();
            $table->string('year')->nullable();
            $table->string('nisn')->nullable();
            $table->text('spiritual_attitude')->nullable();
            $table->text('social_attitude')->nullable();

            $table->integer('religion_knowledge')->nullable();
            $table->text('religion_knowledge_description')->nullable();
            $table->integer('religion_skill')->nullable();
            $table->text('religion_skill_description')->nullable();
            $table->integer('nation_knowledge')->nullable();
            $table->text('nation_knowledge_description')->nullable();
            $table->integer('nation_skill')->nullable();
            $table->text('nation_skill_description')->nullable();
            $table->integer('indonesia_knowledge')->nullable();
            $table->text('indonesia_knowledge_description')->nullable();
            $table->integer('indonesia_skill')->nullable();
            $table->text('indonesia_skill_description')->nullable();
            $table->integer('math_knowledge')->nullable();
            $table->text('math_knowledge_description')->nullable();
            $table->integer('math_skill')->nullable();
            $table->text('math_skill_description')->nullable();
            $table->integer('english_knowledge')->nullable();
            $table->text('english_knowledge_description')->nullable();
            $table->integer('english_skill')->nullable();
            $table->text('english_skill_description')->nullable();
            $table->integer('science_knowledge')->nullable();
            $table->text('science_knowledge_description')->nullable();
            $table->integer('science_skill')->nullable();
            $table->text('science_skill_description')->nullable();
            $table->integer('social_knowledge')->nullable();
            $table->text('social_knowledge_description')->nullable();
            $table->integer('social_skill')->nullable();
            $table->text('social_skill_description')->nullable();
            
            $table->integer('art_knowledge')->nullable();
            $table->text('art_knowledge_description')->nullable();
            $table->integer('art_skill')->nullable();
            $table->text('art_skill_description')->nullable();
            $table->integer('sport_knowledge')->nullable();
            $table->text('sport_knowledge_description')->nullable();
            $table->integer('sport_skill')->nullable();
            $table->text('sport_skill_description')->nullable();
            $table->integer('local_wisdom_knowledge')->nullable();
            $table->text('local_wisdom_knowledge_description')->nullable();
            $table->integer('local_wisdom_skill')->nullable();
            $table->text('local_wisdom_skill_description')->nullable();
            
            $table->string('interest_subject')->nullable();
            $table->integer('interest_knowledge')->nullable();
            $table->text('interest_knowledge_description')->nullable();
            $table->integer('interest_skill')->nullable();
            $table->text('interest_skill_description')->nullable();
            
            $table->string('independence_subject')->nullable();
            $table->integer('independence_knowledge')->nullable();
            $table->text('independence_knowledge_description')->nullable();
            $table->integer('independence_skill')->nullable();
            $table->text('independence_skill_description')->nullable();

            $table->integer('extraordinary_knowledge')->nullable();
            $table->text('extraordinary_knowledge_description')->nullable();
            $table->integer('extraordinary_skill')->nullable();
            $table->text('extraordinary_skill_description')->nullable();

            $table->integer('sick')->nullable();
            $table->integer('permission')->nullable();
            $table->integer('absent')->nullable();

            $table->foreignId('user_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
