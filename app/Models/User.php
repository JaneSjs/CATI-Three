<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'ext_no',
        'email',
        'national_id',
        'phone_1',
        'phone_2',
        'phone_3',
        'gender',
        'dob',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * User can belong to many roles
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * User can belong to many projects
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    /**
     * Check if the user has any of the given roles
     * 
     * @param array $roles
     */
    public function hasAnyRoles(array $roles): bool
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * User can have many feedbacks
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * User can have many survey schemas
     */
    public function schemas(): BelongsToMany
    {
        return $this->belongsToMany(Schema::class);
    }

    /**
     * User can have many survey results
     */
    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    /**
     * User can have many interviews
     */
    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    /**
     * User can have scheduled interviews
     */
    public function scheduled_interviews(): HasMany
    {
        return $this->hasMany(InterviewSchedule::class, 'interview_schedule_id')
                    ->where('interview_status', 'Interview Completed')
                    ->where('quality_control', '!=', 'Cancelled');
    }

    /**
     * Get all users with the role of supervisor
     */
    public function supervisors()
    {
        return $this->belongsToMany(Role::class)
                ->wherePivot('role_id', 5);
    }
}
