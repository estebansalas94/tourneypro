<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected array $dates = ['deleted_at'];
    public function teams():belongsToMany
    {
        return $this->belongsToMany(Team::class, 'tournaments_has_teams','tournament_id','team_id',);
    }

    public function matches():HasMany
    {
        return $this->hasMany(Game::class);
    }
}
