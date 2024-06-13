<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Game extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'matches';
    protected $guarded = [];
    protected array $dates = ['deleted_at'];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function referees()
    {
        return $this->belongsToMany(Referee::class, 'matches_has_referees','match_id');
    }

    public function mainReferee()
    {
        return $this->belongsToMany(Referee::class, 'matches_has_referees', 'match_id', 'referee_id')
                    ->where('referee_type', 'main referee')
                    ->first();
    }

    public function teamLocal()
    {
        return $this->belongsTo(Team::class, 'team_local_id');
    }

    public function teamVisitor()
    {
        return $this->belongsTo(Team::class, 'team_visitor_id');
    }

    public function goals()
    {
        return $this->hasMany(Goal::class, 'match_id');
    }

    public function cards()
    {
        return $this->hasMany(Card::class, 'match_id');
    }

    
    
}
