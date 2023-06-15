<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'database',
        'start_date',
        'end_date'

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
    public function surveys(): BelongsToMany
    {
        return $this->belongsToMany(Schema::class);
    }

    /**
     * Processed Respondents 
     * (i.e a client's specific respondents)
     * 
     * This Project has many respondents.
     */
    public function respondents(): HasMany
    {
        return $this->hasMany(Respondent::class);
    }
}