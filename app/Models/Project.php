<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'dpia',
        'start_date',
        'end_date',
        'updated_by',
        'deleted_by'

    ];

    /**
     * A Project can belong to many users
     */
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * This Project can have many surveys
     */
    public function surveys(): HasMany
    {
        return $this->hasMany(Schema::class);
    }

    /**
     * This Project can have many quotas
     */
    public function quotas(): HasMany
    {
        return $this->hasMany(Quota::class);
    }

    /**
     * This Project can have many interviews
     */
    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    /**
     * Processed Respondents 
     * 
     * This Project has many respondents.
     */
    public function respondents(): HasMany
    {
        return $this->hasMany(Respondent::class);
    }

    /**
     * This Project can have many emails
     */
    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    /**
     * This project has DPIA
     */
    public function dpia(): HasOne
    {
        return $this->hasOne(Dpia::class, 'project_id');
    }
}