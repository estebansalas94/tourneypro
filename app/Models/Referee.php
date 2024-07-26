<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected array $dates = ['deleted_at'];

    public function matches()
    {
        return $this->belongsToMany(Game::class, 'matches_has_referees','referee_id');
    }
}
