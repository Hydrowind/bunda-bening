<?php

namespace App\Filament\Resources\ScoreResource\Pages;

use App\Filament\Resources\ScoreResource;
use App\Models\Score;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditScore extends EditRecord
{
    protected static string $resource = ScoreResource::class;
    protected static string $view = 'filament.resources.score-resource.pages.create';

    public $name;
    public $user_id;
    public $class;
    public $semester;
    public $year;
    public $nisn;

    public $spiritual_attitude;
    public $social_attitude;

    public $religion_knowledge;
    public $religion_knowledge_description;
    public $religion_skill;
    public $religion_skill_description;
    public $nation_knowledge;
    public $nation_knowledge_description;
    public $nation_skill;
    public $nation_skill_description;
    public $indonesia_knowledge;
    public $indonesia_knowledge_description;
    public $indonesia_skill;
    public $indonesia_skill_description;
    public $math_knowledge;
    public $math_knowledge_description;
    public $math_skill;
    public $math_skill_description;
    public $english_knowledge;
    public $english_knowledge_description;
    public $english_skill;
    public $english_skill_description;
    public $science_knowledge;
    public $science_knowledge_description;
    public $science_skill;
    public $science_skill_description;
    public $social_knowledge;
    public $social_knowledge_description;
    public $social_skill;
    public $social_skill_description;

    public $art_knowledge;
    public $art_knowledge_description;
    public $art_skill;
    public $art_skill_description;
    public $sport_knowledge;
    public $sport_knowledge_description;
    public $sport_skill;
    public $sport_skill_description;
    public $local_wisdom_knowledge;
    public $local_wisdom_knowledge_description;
    public $local_wisdom_skill;
    public $local_wisdom_skill_description;

    public $interest_subject;
    public $interest_knowledge;
    public $interest_knowledge_description;
    public $interest_skill;
    public $interest_skill_description;

    public $independence_subject;
    public $independence_knowledge;
    public $independence_knowledge_description;
    public $independence_skill;
    public $independence_skill_description;

    public $extraordinary_knowledge;
    public $extraordinary_knowledge_description;
    public $extraordinary_skill;
    public $extraordinary_skill_description;

    public $sick;
    public $permission;
    public $absent;
    
    public $homeroom_notes;
    public $parental_response;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'students' => User::role('student')->get(),
        ];
    }

    public function mount($record): void
    {
        parent::mount($record);
        
        $record = Score::find($record);

        // load student list
        $this->students = User::role('student')->get();

        // fill form props from the database record
        $this->name     = $record->name;
        $this->user_id  = $record->user_id;
        $this->class    = $record->class;
        $this->semester = $record->semester;
        $this->year     = $record->year;
        $this->nisn     = $record->nisn;

        $this->spiritual_attitude = $record->spiritual_attitude;
        $this->social_attitude    = $record->social_attitude;

        $this->religion_knowledge = $record->religion_knowledge;
        $this->religion_knowledge_description = $record->religion_knowledge_description;
        $this->religion_skill     = $record->religion_skill;
        $this->religion_skill_description     = $record->religion_skill_description;
        $this->nation_knowledge   = $record->nation_knowledge;
        $this->nation_knowledge_description   = $record->nation_knowledge_description;
        $this->nation_skill       = $record->nation_skill;
        $this->nation_skill_description       = $record->nation_skill_description;
        $this->indonesia_knowledge = $record->indonesia_knowledge;
        $this->indonesia_knowledge_description = $record->indonesia_knowledge_description;
        $this->indonesia_skill     = $record->indonesia_skill;
        $this->indonesia_skill_description     = $record->indonesia_skill_description;
        $this->math_knowledge     = $record->math_knowledge;
        $this->math_knowledge_description     = $record->math_knowledge_description;
        $this->math_skill         = $record->math_skill;
        $this->math_skill_description         = $record->math_skill_description;
        $this->english_knowledge  = $record->english_knowledge;
        $this->english_knowledge_description  = $record->english_knowledge_description;
        $this->english_skill      = $record->english_skill;
        $this->english_skill_description      = $record->english_skill_description;
        $this->science_knowledge  = $record->science_knowledge;
        $this->science_knowledge_description  = $record->science_knowledge_description;
        $this->science_skill      = $record->science_skill;
        $this->science_skill_description      = $record->science_skill_description;
        $this->social_knowledge   = $record->social_knowledge;
        $this->social_knowledge_description   = $record->social_knowledge_description;
        $this->social_skill       = $record->social_skill;
        $this->social_skill_description       = $record->social_skill_description;

        $this->art_knowledge      = $record->art_knowledge;
        $this->art_knowledge_description      = $record->art_knowledge_description;
        $this->art_skill          = $record->art_skill;
        $this->art_skill_description          = $record->art_skill_description;
        $this->sport_knowledge    = $record->sport_knowledge;
        $this->sport_knowledge_description    = $record->sport_knowledge_description;
        $this->sport_skill        = $record->sport_skill;
        $this->sport_skill_description        = $record->sport_skill_description;
        $this->local_wisdom_knowledge = $record->local_wisdom_knowledge;
        $this->local_wisdom_knowledge_description = $record->local_wisdom_knowledge_description;
        $this->local_wisdom_skill = $record->local_wisdom_skill;
        $this->local_wisdom_skill_description = $record->local_wisdom_skill_description;

        $this->interest_subject   = $record->interest_subject;
        $this->interest_knowledge = $record->interest_knowledge;
        $this->interest_knowledge_description = $record->interest_knowledge_description;
        $this->interest_skill     = $record->interest_skill;
        $this->interest_skill_description     = $record->interest_skill_description;

        $this->independence_subject = $record->independence_subject;
        $this->independence_knowledge = $record->independence_knowledge;
        $this->independence_knowledge_description = $record->independence_knowledge_description;
        $this->independence_skill   = $record->independence_skill;
        $this->independence_skill_description   = $record->independence_skill_description;

        $this->extraordinary_knowledge = $record->extraordinary_knowledge;
        $this->extraordinary_knowledge_description = $record->extraordinary_knowledge_description;
        $this->extraordinary_skill     = $record->extraordinary_skill;
        $this->extraordinary_skill_description     = $record->extraordinary_skill_description;

        $this->sick     = $record->sick;
        $this->permission = $record->permission;
        $this->absent   = $record->absent;

        $this->homeroom_notes = $record->homeroom_notes;
        $this->parental_response = $record->parental_response;
    }

    public function submit()
    {
        $this->name = User::where('id', $this->user_id)->first()->name;
        // Save logic
        $this->record->update([
            'name' => $this->name,
            'user_id' => $this->user_id,
            'class' => $this->class,
            'semester' => $this->semester,
            'year' => $this->year,
            'nisn' => $this->nisn,
            
            'spiritual_attitude' => $this->spiritual_attitude,
            'social_attitude' => $this->social_attitude,

            'religion_knowledge' => $this->religion_knowledge,
            'religion_knowledge_description' => $this->religion_knowledge_description,
            'religion_skill' => $this->religion_skill,
            'religion_skill_description' => $this->religion_skill_description,
            'nation_knowledge' => $this->nation_knowledge,
            'nation_knowledge_description' => $this->nation_knowledge_description,
            'nation_skill' => $this->nation_skill,
            'nation_skill_description' => $this->nation_skill_description,
            'indonesia_knowledge' => $this->indonesia_knowledge,
            'indonesia_knowledge_description' => $this->indonesia_knowledge_description,
            'indonesia_skill' => $this->indonesia_skill,
            'indonesia_skill_description' => $this->indonesia_skill_description,
            'math_knowledge' => $this->math_knowledge,
            'math_knowledge_description' => $this->math_knowledge_description,
            'math_skill' => $this->math_skill,
            'math_skill_description' => $this->math_skill_description,
            'english_knowledge' => $this->english_knowledge,
            'english_knowledge_description' => $this->english_knowledge_description,
            'english_skill' => $this->english_skill,
            'english_skill_description' => $this->english_skill_description,
            'science_knowledge' => $this->science_knowledge,
            'science_knowledge_description' => $this->science_knowledge_description,
            'science_skill' => $this->science_skill,
            'science_skill_description' => $this->science_skill_description,
            'social_knowledge' => $this->social_knowledge,
            'social_knowledge_description' => $this->social_knowledge_description,
            'social_skill' => $this->social_skill,
            'social_skill_description' => $this->social_skill_description,

            'art_knowledge' => $this->art_knowledge,
            'art_knowledge_description' => $this->art_knowledge_description,
            'art_skill' => $this->art_skill,
            'art_skill_description' => $this->art_skill_description,
            'sport_knowledge' => $this->sport_knowledge,
            'sport_knowledge_description' => $this->sport_knowledge_description,
            'sport_skill' => $this->sport_skill,
            'sport_skill_description' => $this->sport_skill_description,
            'local_wisdom_knowledge' => $this->local_wisdom_knowledge,
            'local_wisdom_knowledge_description' => $this->local_wisdom_knowledge_description,
            'local_wisdom_skill' => $this->local_wisdom_skill,
            'local_wisdom_skill_description' => $this->local_wisdom_skill_description,

            'interest_subject' => $this->interest_subject,
            'interest_knowledge' => $this->interest_knowledge,
            'interest_knowledge_description' => $this->interest_knowledge_description,
            'interest_skill' => $this->interest_skill,
            'interest_skill_description' => $this->interest_skill_description,

            'independence_subject' => $this->independence_subject,
            'independence_knowledge' => $this->independence_knowledge,
            'independence_knowledge_description' => $this->independence_knowledge_description,
            'independence_skill' => $this->independence_skill,
            'independence_skill_description' => $this->independence_skill_description,
            
            'extraordinary_knowledge' => $this->extraordinary_knowledge,
            'extraordinary_knowledge_description' => $this->extraordinary_knowledge_description,
            'extraordinary_skill' => $this->extraordinary_skill,
            'extraordinary_skill_description' => $this->extraordinary_skill_description,
            
            'sick' => $this->sick,
            'permission' => $this->permission,
            'absent' => $this->absent,

            'homeroom_notes' => $this->homeroom_notes,
            'parental_response' => $this->parental_response,
        ]);

        Notification::make()->success()->title('Score updated')->send();
        $this->redirect(ScoreResource::getUrl('index'));
    }
}
