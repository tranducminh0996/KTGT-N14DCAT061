<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Traits\BaseController;
use App\Http\Controllers\Controller;
use App\Models\TournamentBanner;
use App\Traits\TourTrait;
use App\Models\Admin\Video;
use App\Models\Athletic;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VideoController extends Controller
{
    use BaseController, TourTrait;

    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new Video();
        $this->slug = 'video';
    }

    public function index(Request $request)
    {
        $data = Video::getList();

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('video.show', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> <a href="' . route('video.delete', $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->editColumn('category_video_id', function ($row) {
                    $category = $row->category;
                    $category = $category['name'];
                    return $category;
                })
                ->editColumn('tournament_id', function ($row) {
                    $tournament = $row->tournament;
                    $tournament = $tournament['name'];
                    return $tournament;
                })
                ->editColumn('url', function ($post) {
                    return route('video.show', ['id' => $post->id]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('cms/video/index');
    }

    public function showVideo($id)
    {
        $listStatus = ['Deactivated', 'Activated'];
        $video = Video::getByIdWithTag($id);

        if (!$video) {
            return abort(404);
        }
        if ($video['tag'] != null) {
            $tag = [];
            foreach ($video['tag'] as $itemTag) {
                $tag[] = $itemTag['name'];
            }
            $video['tag'] = implode(',', $tag);
        }
        $listTournament = Tournament::getList();
        $getListTournamentOrderByTime = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->get();
        $tournamentLatest = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->first();
        $tournamentWithAhtletic = Athletic::getTournamentWithAthletic($tournamentLatest->id);

        return view('cms/video/edit', compact('video', 'listTournament', 'getListTournamentOrderByTime','tournamentLatest','tournamentWithAhtletic', 'listStatus'));
    }

    public function edit($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'video_url' => 'required|string|max:150',
            'description' => 'required',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không quá 255 ký tự',
            'slug.required' => 'Tên slug không được để trống',
            'slug.max' => 'Tên slug không được quá 255 ký tự',
            'video_url.required' => 'Link Video không được để trống',
            'video_url.max' => 'Link Video không được quá 150 ký tự',
            'description.required' => 'Mô tả không được để trống',
        ]);

        $params = [
            'name' => $request->name,
            'description' => $request->description,
            'publish_date' => Carbon::parse('now')->format('Y-m-d H:i:s'),
            'slug' => $request->slug,
            'featured' => $request->featured,
            'home' => $request->home,
            'category_video_id' => $request->category,
            'order' => $request->order,
            'status' => $request->status,
            'video_url' => $request->video_url,
            'video_thumbnail_url' => $request->thumbnail,
            'post_source' => $request->post_source,
            'tournament_id' => (int)$request['tournament']
        ];

        $tagsRequest = explode(',', $request->tag);

        $video = Video::getById($id);
        if (!$video) {
            return abort(404);
        }
        if ($params['video_thumbnail_url'] === null) {
            $params['video_thumbnail_url'] = $video->video_thumbnail_url;
        }
        if (Video::getNameSlug($request->slug) !== null) {
            $params['slug'] = $request->slug . '-' . rand(1, 100);
        }

        Video::updateVideo($id, $params, $tagsRequest);

        if($request->submit == 'save') {
            flash(__('suavideothanhcong'))->success();

            return redirect()->route('video.list');
        }
        if($request->submit == 'apply') {
            return back()->with('message', 'Bạn đã sửa nội dung Video thành công');
        }
    }

    public function create()
    {
        $listTournament = Tournament::getList();
        $getListTournamentOrderByTime = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->get();
        $tournamentLatest = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->first();
        $tournamentWithAhtletic = Athletic::getTournamentWithAthletic($tournamentLatest->id);

        return view('cms/video/create' , compact('listTournament', 'getListTournamentOrderByTime','tournamentLatest','tournamentWithAhtletic'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
//            'slug' => 'required|string|max:255',
            'video_url' => 'required|string|max:150',
            'description' => 'required',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không quá 255 ký tự',
//            'slug.required' => 'Tên slug không được để trống',
//            'slug.max' => 'Tên slug không được quá 255 ký tự',
            'video_url.required' => 'Link Video không được để trống',
            'video_url.max' => 'Link Video không được quá 150 ký tự',
            'description.required' => 'Mô tả không được để trống',
        ]);

        $tags = explode(',', $request->tag);

        $params = [
            'name' => $request->name,
            'description' => $request->description,
            'publish_date' => Carbon::parse('now')->format('Y-m-d H:i:s'),
            'slug' => $request->slug,
            'featured' => $request->featured,
            'home' => $request->home,
            'category_video_id' => $request->category,
            'order' => $request->order,
            'status' => $request->status,
            'video_url' => $request->video_url,
            'video_thumbnail_url' => $request->thumbnail,
            'post_source' => $request->post_source,
            'tournament_id' => (int)$request['tournament']
        ];
        if (Video::getNameSlug($request->slug) !== null) {
            $params['slug'] = $request->slug . '-' . rand(1, 100);
        }

        Video::storeVideo($params, $tags);

        return back()->with('message', 'Bạn đã tạo mới bài viết thành công');
    }

    public function getRouteSlug($slug, Request $request)
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

        $video = Video::getNameSlug($slug);
        if ($video === null) {
            return abort(404);
        }
       
        return view('cms/video/detail', compact('video', 'tourId', 'tour', 'listBanner'));
    }
}
