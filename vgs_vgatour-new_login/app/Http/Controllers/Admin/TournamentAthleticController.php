<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Athletic;
use App\Models\Tournament;
use App\Models\TournamentHasAthletic;
use Illuminate\Http\Request;

class TournamentAthleticController extends Controller
{
    public function getByIdTournament($id)
    {
        $tournament = Tournament::getById($id);
        $tournamentWithAthletic = Athletic::getTournamentWithAthletic($id);
        if (empty($tournamentWithAthletic['athletics']->toArray()) === true) {
            return view('cms/tournament_has_athletic/athletic/ajax/import_excel_ajax', ['tournamentWithAthletic' => $tournamentWithAthletic, 'moneyOfAthleticWithTournament' => null]);
        }
        $tournamentLatest = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->first();

        return view('cms/tournament_has_athletic/athletic/ajax/import_excel_ajax',
            [
                'tournamentLatest' => $tournamentLatest,
                'tournament' => $tournament,
                'tournamentWithAthletic' => $tournamentWithAthletic
            ]
        );
    }
}
