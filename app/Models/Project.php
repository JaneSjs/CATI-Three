<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    public function surveys(): HasMany
    {
        return $this->hasMany(SurveySchema::class);
    }

    /**
     * Processed Respondents 
     * (i.e a client's specific respondents)
     */
    public function respondents(): HasMany
    {
        return $this->hasMany(Respondent::class);
    }
}