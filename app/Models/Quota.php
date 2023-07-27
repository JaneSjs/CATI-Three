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
    protected $fillable = ['occupation','region','county','sub_county','district','division','location','sub_location','constituency','ward','sampling_point','setting','gender','exact_age','education_level','marital_status','religion','income','Lsm','ethnic_group','employment_status','age_group',
    ];

    /**
     * Quota belongs to a Schema
     */
    public function schema($value=''): BelongsTo
    {
        return $this->belongsTo(Schema::class);
    }
}
