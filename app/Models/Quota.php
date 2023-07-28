<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quota extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['project_id','schema_id','attribute','value','target_count',
    ];

    /**
     * Quota belongs to a Schema
     */
    public function schema($value=''): BelongsTo
    {
        return $this->belongsTo(Schema::class);
    }
}
