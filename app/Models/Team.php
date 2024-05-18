<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected array $dates = ['deleted_at'];

    public function tournaments():belongsToMany
    {
        return $this->belongsToMany(Tournament::class, 'tournaments_has_teams');
    }

    public function templates():HasMany
    {
        return $this->hasMany(Template::class);
    }

    public function stadium()
    {
        return $this->hasOne(Stadium::class);
    }

    public function matches()
    {
        return $this->belongsTo(Game::class);
    }
}
