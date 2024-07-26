<?php

namespace App\Console\Commands;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;

class UpdateMatchStatus extends Command
{
    
    protected $signature = 'app:update-match-status';

    
    protected $description = 'Update match status from Programado to Terminado after 3 hours of the scheduled date';

    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $daysAgo = 1;

        $matches = Game::where('status', 'Programado')
                        ->where('date_at', '<=', Carbon::now()->subDays($daysAgo))
                        ->update(['status' => 'Finalizado']);

        
        $this->info('Los estados de los partidos han sido actualizados.');
    }

    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->command('matches:update-status')->hourly();
    // }

}
