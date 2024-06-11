<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected array $dates = ['deleted_at'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
