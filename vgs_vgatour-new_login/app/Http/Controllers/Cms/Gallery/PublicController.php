<?php


namespace App\Http\Controllers\Cms\Gallery;


use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Traits\Response;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    use Response;

    protected $tournamentModel;

    public function __construct(Tournament $tournamentModel)
    {
        $this->tournamentModel = $tournamentModel;
    }

    public function onSearchTournament(Request $request) {
        $keyword = $request->get("keyword", null);
        $tournamentQuery = $this->tournamentModel->newQuery();
        $tournamentQuery->where("name", "LIKE", '%' . $keyword . '%');
        $tournamentQuery->orderBy("created_at", "DESC");
        $results = $tournamentQuery->get();
        $this->addData($results);
        $this->setErrorCode(1);
        return $this->getResponse();
    }
}
