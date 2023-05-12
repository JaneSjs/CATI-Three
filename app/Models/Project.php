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
        return $this->belongsToMany(User::class)
            ->withPivot('manager_id', 'supervisor_id', 'scriptor_id', 'qc_id');
    }

    /**
     * This Project can belong to many managers
     */
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user', 'manager_id');
    }

    /**
     * This Project can belong to many scriptors
     */
    public function scriptors() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user', 'scriptor_id');
    }

    /**
     * This Project can belong to many supervisors
     */
    public function supervisors() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user', 'supervisor_id');
    }

    /**
     * This Project can belong to many agents
     */
    public function agents() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'agent_id');
    }

    /**
     * This Project can belong to many qcs
     */
    public function qcs() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'qc_id');
    }

    /**
     * This Project can belong to many clients
     */
    public function clients() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'client_id');
    }


    /**
     * This Project can have many surveys
     */
    public function surveys(): HasMany
    {
        return $this->hasMany(SurveySchema::class);
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