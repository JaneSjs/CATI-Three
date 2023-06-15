<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Result extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'schema_id',
        'ip_address',
        'mac_address',
        'user_agent',
        'latitude',
        'longitude',
        'altitude',
        'altitude_accuracy',
        'position_accuracy',
        'heading',
        'speed',
        'timestamp',
        'content'
    ];

    /**
     * Survey Results belongs to many Users
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Survey Results belongs to a Survey Schema
     *
     */
    public function schema(): BelongsTo
    {
        return $this->belongsTo(Schema::class);
    }
}
