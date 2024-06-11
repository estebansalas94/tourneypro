<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Goal extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected array $dates = ['deleted_at'];

    public function match()
    {
        return $this->belongsTo(Game::class, 'id');
    }

    public function player()
    {
        return $this->belongsTo(Template::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
