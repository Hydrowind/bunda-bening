<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    const WHATSAPP = 'WhatsApp';
    const HEADSCRIPT = 'HeadScript';
    const BODYSCRIPT = 'BodyScript';
    
    const HOME_SECTION_1_TITLE = 'HomeSection1Title';
    const HOME_SECTION_2_TITLE = 'HomeSection2Title';
    const HOME_SECTION_3_TITLE = 'HomeSection3Title';
    const HOME_SECTION_4_TITLE = 'HomeSection4Title';
    const HOME_SECTION_5_TITLE = 'HomeSection5Title';
    
    const HOME_SECTION_1_CONTENT = 'HomeSection1Content';
    const HOME_SECTION_5_CONTENT = 'HomeSection5Content';
    
    const WHATSAPP_SECTION = 'WhatsAppSection';
    
    
    const ABOUT_SECTION_1_TITLE = 'AboutSection1Title';
    const ABOUT_SECTION_1_CONTENT = 'AboutSection1Content';

    protected $fillable = [
        'name',
        'value',
    ];

    public static function getWhatsApp(){
        return Configuration::where('name', Configuration::WHATSAPP)->first()->value;
    }

    public static function getHeadScript(){
        return Configuration::where('name', Configuration::HEADSCRIPT)->first()->value;
    }

    public static function getBodyScript(){
        return Configuration::where('name', Configuration::BODYSCRIPT)->first()->value;
    }

    public static function getHomeSectionTitle($sec_num){
        $whereClause = '';

        switch($sec_num){
            case 1: $whereClause = Configuration::HOME_SECTION_1_TITLE; break;
            case 2: $whereClause = Configuration::HOME_SECTION_2_TITLE; break;
            case 3: $whereClause = Configuration::HOME_SECTION_3_TITLE; break;
            case 4: $whereClause = Configuration::HOME_SECTION_4_TITLE; break;
            case 5: $whereClause = Configuration::HOME_SECTION_5_TITLE; break;
            default: break;
        }

        return Configuration::where('name', $whereClause)->first()->value;
    }

    public static function getHomeSectionContent($sec_num){
        $whereClause = '';

        switch($sec_num){
            case 1: $whereClause = Configuration::HOME_SECTION_1_CONTENT; break;
            case 5: $whereClause = Configuration::HOME_SECTION_5_CONTENT; break;
            default: break;
        }

        return Configuration::where('name', $whereClause)->first()->value;
    }

    public static function getAboutSectionTitle($sec_num){
        $whereClause = '';

        switch($sec_num){
            case 1: $whereClause = Configuration::ABOUT_SECTION_1_TITLE; break;
            default: break;
        }

        return Configuration::where('name', $whereClause)->first()->value;
    }

    public static function getAboutSectionContent($sec_num){
        $whereClause = '';

        switch($sec_num){
            case 1: $whereClause = Configuration::ABOUT_SECTION_1_CONTENT; break;
            default: break;
        }

        return Configuration::where('name', $whereClause)->first()->value;
    }

    public static function getWhatsAppSection(){
        return Configuration::where('name', Configuration::WHATSAPP_SECTION)->first()->value;
    }

    public static function getHomeSectionImage($sec_num){
        switch($sec_num){
            case 1: return FileUpload::where('object_type', FileUpload::TYPE_HOME_SECTION_1)->first();
            case 5: return FileUpload::where('object_type', FileUpload::TYPE_HOME_SECTION_5)->first();
        }
    }
}
