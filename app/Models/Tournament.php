<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected array $dates = ['deleted_at'];
    /*public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }*/
}
