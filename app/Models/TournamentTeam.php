<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentTeam extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tournaments_has_teams';
    protected $guarded = [];
    protected array $dates = ['deleted_at'];
}
