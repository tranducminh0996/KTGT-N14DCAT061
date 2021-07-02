<?php

namespace App\Http\Controllers;

use App\Exports\AthleticExport;
use App\Exports\Template\TemplateTournamentHasAthletic;
use App\Imports\AthleticImport;
use App\Models\Athletic;
use App\Models\AthleticAward;
use App\Models\AthleticTimeline;
use App\Models\TournamentBanner;
use App\Models\Tournament;
use App\Models\TournamentHasAthletic;
use App\Models\TournamentHasDate;
use App\Traits\TourTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Support\Facades\Response;
use DB;

class AthleticController extends Controller
{
    use TourTrait, SkipsFailures;

    public function index(Request $request)
    {

        $tourId = $request->tour;

        $tour = $this->getDataTour($tourId);

        $tourId = $tour->id;

        $keyFind = null;

        if ($request->has('search_athletic')) {

            $keyword = $request->search_athletic;

            $keyFind = str_replace('vga', '', $request->search_athletic);
        }
        $listAthletic = Athletic::leftJoin('exel_countries', 'exel_countries.id', 'vgatour_athletic.country')

            ->where(function ($query) use ($keyFind) {
                if ($keyFind != null) {
                    if (is_numeric($keyFind)) {
                        $query->where('vga_id', $keyFind);
                    } else {
                        $query->where('first_name', 'like', '%' . $keyFind . '%');
                        $query->orWhere('last_name', 'like', '%' . $keyFind . '%');
                        $query->orWhere(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'like', '%' . $keyFind . '%');
                        $query->orWhere(DB::raw("CONCAT(`last_name`, ' ', `first_name`)"), 'like', '%' . $keyFind . '%'); //Concat

                    }
                }
            })
            ->select('vgatour_athletic.*', 'exel_countries.name as country_name')
            ->orderBy('first_name')->paginate(20);



        $listBanner = TournamentBanner::join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_tournament_banner.tour_id')
            ->join('vgatour_admin', 'vgatour_admin.id', 'vgatour_tournament_banner.upload_by')
            ->where(function ($q) use ($tourId) {
                if ($tourId !== null) {
                    $q->where('tour_id', $tourId);
                } else {
                    $q->where('vgatour_tournament.is_active', 1);
                }
            })
            ->where('status', 1)
            ->select('vgatour_tournament_banner.*', 'vgatour_admin.name', 'vgatour_tournament.name as name_tour')
            ->get();

        return view('athletic.index', compact('listAthletic', 'listBanner', 'tourId'));
    }

    public function awardAthletic(Request $request, $id)
    {

        $tourId = $request->tour;

        $tour = $this->getDataTour($tourId);

        $tourId = $tour->id;

        $listBanner = TournamentBanner::join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_tournament_banner.tour_id')
            ->join('vgatour_admin', 'vgatour_admin.id', 'vgatour_tournament_banner.upload_by')
            ->where(function ($q) use ($tourId) {
                if ($tourId !== null) {
                    $q->where('tour_id', $tourId);
                } else {
                    $q->where('vgatour_tournament.is_active', 1);
                }
            })
            ->where('status', 1)
            ->select('vgatour_tournament_banner.*', 'vgatour_admin.name', 'vgatour_tournament.name as name_tour')
            ->get();

        $codeAthletic = $request->codeAthletic;
        $nameSelect = $request->nameSelect;

        $listAward = AthleticAward::join('vgatour_athletic', 'vgatour_athletic.id', 'vgatour_athletic_award.athletic_id')
            ->join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_athletic_award.tour_id')
            ->where('vgatour_athletic.id', $id)
            ->where('vgatour_athletic.code_athletic', $codeAthletic)
            ->orderBy('vgatour_tournament.time', 'desc')
            ->orderBy('vgatour_tournament.name')
            ->get();

        return view('athletic.award', compact('listAward', 'nameSelect', 'id', 'codeAthletic', 'tourId', 'listBanner'));
    }

    public function scoreTourAthletic(Request $request, $id)
    {
        $tourId = $request->tour;

        $tour = $this->getDataTour($tourId);

        $tourId = $tour->id;
        $listBanner = TournamentBanner::join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_tournament_banner.tour_id')
            ->join('vgatour_admin', 'vgatour_admin.id', 'vgatour_tournament_banner.upload_by')
            ->where(function ($q) use ($tourId) {
                if ($tourId !== null) {
                    $q->where('tour_id', $tourId);
                } else {
                    $q->where('vgatour_tournament.is_active', 1);
                }
            })
            ->where('status', 1)
            ->select('vgatour_tournament_banner.*', 'vgatour_admin.name', 'vgatour_tournament.name as name_tour')
            ->get();

        $codeAthletic = $request->codeAthletic;
        $nameSelect = $request->nameSelect;

        $listTourAthletic = TournamentHasAthletic::with(['athleticScore' => function ($q) {
            $q->with(['scoreHole' => function ($query) {
                $query->orderBy('hole_stt');
            }])
                ->leftJoin('vgatour_tournament_date', 'date_id', 'vgatour_tournament_date.id')
                ->orderBy('date_id');
        }])
            ->join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_tournament_has_athletic.tournament_id')
            ->where('vgatour_tournament_has_athletic.athletic_id', $id)
            ->get();

        return view('athletic.score', compact('listTourAthletic', 'nameSelect', 'id', 'codeAthletic', 'tourId', 'listBanner'));
    }

    public function infoAthletic(Request $request, $id)
    {
        $tourId = $request->tour;

        $tour = $this->getDataTour($tourId);

        $tourId = $tour->id;

        $codeAthletic = $request->codeAthletic;
        $nameSelect = $request->nameSelect;

        $athletic = Athletic::leftJoin('exel_countries', 'exel_countries.id', 'vgatour_athletic.country')
            ->where('vgatour_athletic.id', $id)
            ->where('code_athletic', $codeAthletic)
            ->select('vgatour_athletic.*', 'exel_countries.name as country_name')
            ->first();

        $listTimeline = AthleticTimeline::join('vgatour_athletic', 'vgatour_athletic.id', 'vgatour_athletic_timeline.athletic_id')
            ->where('vgatour_athletic.id', $id)
            ->orderBy('vgatour_athletic_timeline.stt_view', 'asc')
            ->orderBy('vgatour_athletic_timeline.time_event', 'asc')
            ->orderBy('vgatour_athletic_timeline.created_at')
            ->get();
            
        $listBanner = TournamentBanner::join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_tournament_banner.tour_id')
            ->join('vgatour_admin', 'vgatour_admin.id', 'vgatour_tournament_banner.upload_by')
            ->where(function ($q) use ($tourId) {
                if ($tourId !== null) {
                    $q->where('tour_id', $tourId);
                } else {
                    $q->where('vgatour_tournament.is_active', 1);
                }
            })
            ->where('status', 1)
            ->select('vgatour_tournament_banner.*', 'vgatour_admin.name', 'vgatour_tournament.name as name_tour')
            ->get();

        return view('athletic.info', compact('listTimeline', 'athletic', 'nameSelect', 'id', 'codeAthletic', 'tourId', 'listBanner'));
    }

    public function search(Request $request)
    {

        $keyword = $request->search_athletic;

        $keyFind = str_replace('vga', '', $request->search_athletic);

        $listAthletic = Athletic::where(function ($query) use ($keyFind) {

            if (is_numeric($keyFind)) {
                $query->where('vga_id', $keyFind);
            } else {
                $query->where('first_name', 'like', '%' . $keyFind . '%');
                $query->orWhere('last_name', 'like', '%' . $keyFind . '%');
            }
        })
            ->orderBy('first_name')->paginate(12);

        return view('athletic.index', compact('listAthletic', 'keyword'));
    }

    public function export($id)
    {
        $export = new AthleticExport($id);
        return Excel::download($export, 'athletic.xlsx');
    }

    public function exportTemplate()
    {
        $file = public_path() . '/storage/template.xlsx';
        return Response::download($file);
    }

    public function createImport(Request $request)
    {
        $listTournament = Tournament::getList();
        $getListTournamentOrderByTime = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->get();
        $tournamentLatest = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->first();
        $tournamentWithAhtletic = Athletic::getTournamentWithAthletic($tournamentLatest->id);
        $tournaments = Athletic::getTournamentWithAthletic($tournamentLatest->id)->paginate(50);

        return view('cms/tournament_has_athletic/athletic/import_excel', compact(
            'listTournament',
            'getListTournamentOrderByTime',
            'tournamentWithAhtletic',
            'tournaments',
            'tournamentLatest'
        ));
    }

    public function import(Request $request)
    {
        $request->validate([
            'athletic-file' => 'required'
        ], ['athletic-file.required' => 'Hãy nhập file']);
        $file = $request->file('athletic-file')->store('temp');
        $path = storage_path('app') . '/' . $file;

        $import = new AthleticImport($request->tournament);
        $import->import($path);

        File::delete($path);
        $errors = $import->errors();

        if (empty($import->errors()->toArray()) == false) {
            return back()->with('errors', $errors);
        }

        return back()->with('success', 'All Good!');
    }

    public function deleteRank($id, $tournamentId)
    {
        $athletic = Athletic::findOrFail($id)->code_athletic;
        $tournament = Tournament::getById($tournamentId);
        $tournament->athletics()->detach($id);

        return back()->with('success', 'Bạn đã xóa vận động viên mã ' . '"' . $athletic . '"' . ' thành công khỏi giải ' . '"' . $tournament->name . '"');
    }
}
