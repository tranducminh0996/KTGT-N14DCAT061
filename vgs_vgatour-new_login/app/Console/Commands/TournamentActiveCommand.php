<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tournament;
use Carbon\Carbon;


class TournamentActiveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournament:activeSchedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate the schedule tournament ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $datetime = Carbon::now();
        // $datetime->hour = 0;
        // $datetime->minute = 0;
        $datetime->second = 0;

        $tourNew = Tournament::where('timer', $datetime)->first();


        if ($tourNew !== null) {
            $tourOld = Tournament::where('is_active', '1')->first();
            if ($tourOld !== null && ($tourOld->id != $tourNew->id)) {
                $tourOld->is_active = '0';
                $tourOld->save();
            }

            $tourNew->is_active = '1';
            $tourNew->save();
        }


    }
}
