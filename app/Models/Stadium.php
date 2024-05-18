<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stadium extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'stadiums';
    protected $guarded = [];
    protected array $dates = ['deleted_at'];

    public function team()
{
    return $this->belongsTo(Team::class);
}
    public function matches()
    {
        return $this->hasMany(Game::class);
    }
}
