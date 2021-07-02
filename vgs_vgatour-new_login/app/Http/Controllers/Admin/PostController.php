<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Traits\BaseController;
use App\Http\Controllers\Controller;
use App\Traits\TourTrait;
use App\Models\TournamentBanner;
use App\Models\Admin\Post;
use App\Models\Admin\Tag;
use App\Models\Athletic;
use App\Models\Tournament;
use App\Traits\HasAjaxRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PostController extends Controller
{
    use BaseController, HasAjaxRequest, TourTrait;

    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new Post();
        $this->slug = 'post';
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->datatables();
        }

        if (view()->exists('cms/post/index')) {
            return view('cms/post/index');
        }

        return abort('404');
    }

    public function getDataTables(Request $request)
    {
        return Datatables::of($this->model::getList($request->all()))
            ->escapeColums([])
            ->addIndexColumn()
            ->addColums('action', function ($row) {
                return view('cms/include/action', [
                    'edit' => route('cms/post/editAdd', $row->id),
                    'delete' => route('cms/post/delete', $row->id)
                ]);
            })
            ->make(true);
    }

    public function getPosts(Request $request)
    {
        $data = Post::getList();
        

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('post.show', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> <a href="' . route('post.delete', $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->editColumn('category_id', function ($row) {
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
                    return route('post.show', ['id' => $post->id]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('cms/post/index');
    }

    public function create()
    {
        $listTournament = Tournament::getList();
        $getListTournamentOrderByTime = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->get();
        $tournamentLatest = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->first();
        $tournamentWithAhtletic = Athletic::getTournamentWithAthletic($tournamentLatest->id);

        return view('cms/post/create', compact('listTournament', 'getListTournamentOrderByTime', 'tournamentLatest', 'tournamentWithAhtletic'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:400',
            'description' => 'required|string|max:400',
            'content' => 'required',
            'format_type' => 'required',
        ], [
            'name.required' => 'Tên bài viết không được để trống',
            'name.max' => 'Tên bài viết không được vượt quá 255 ký tự',
            'description.required' => 'Mô tả bài viết không được để trống',
            'description.max' => 'Mô tả bài viết không được quá 400 ký tự',
            'content.required' => 'Nội dung bài viết không được để trống',
            'format_type.required' => 'Định dạng bài không được để trống'
        ]);

        $tags = explode(',', $request->tag);
        $params = [
            'name' => $request['name'],
            'description' => $request['description'],
            'content' => $request['content'],
            'status' => $request['status'],
            'upload_by' => 1,
            'post_source' => $request['post_source'],
            'tournament_id' => (int)$request['tournament'],
            'order' => $request['order'],
            'slug' => $request['slug'],
            'thumbnail' => $request['thumbnail'],
            'format_type' => $request['format_type'],
            'date_post' => Carbon::parse('now')->format('Y-m-d H:i:s'),
        ];
        if (Post::getNameSlug($request->slug) !== null) {
            $params['slug'] = $request->slug . '-' . rand(1, 100);
        }

        Post::storePost($params, $tags);

        return back()->with('message', 'Bạn đã tạo bài viết mới thành công');
    }

    public function show($id)
    {
        $listStatus = ['Deactivated', 'Activated'];
        $post = Post::getByIdWithTag($id);
        if (!$post) {
            return abort(404);
        }
        if ($post['tag'] != null) {
            $tag = [];
            foreach ($post['tag'] as $itemTag) {
                $tag[] = $itemTag['name'];
            }
            $post['tag'] = implode(',', $tag);
        }

        $listTournament = Tournament::getList();
        $getListTournamentOrderByTime = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->get();
        $tournamentLatest = Tournament::query()->orderBy('time', 'desc')->orderBy('created_at', 'desc')->first();
        $tournamentWithAhtletic = Athletic::getTournamentWithAthletic($tournamentLatest->id);

        return view('cms/post/edit', compact('post', 'listTournament', 'getListTournamentOrderByTime', 'tournamentLatest', 'tournamentWithAhtletic', 'listStatus'));
    }


    public function edit($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:400',
            'description' => 'required|string|max:400',
            'content' => 'required',
            'format_type' => 'required',
        ], [
            'name.required' => 'Tên bài viết không được để trống',
            'name.max' => 'Tên bài viết không được vượt quá 255 ký tự',
            'description.required' => 'Mô tả bài viết không được để trống',
            'description.max' => 'Mô tả bài viết không được quá 400 ký tự',
            'content.required' => 'Nội dung bài viết không được để trống',
            'format_type.required' => 'Định dạng bài không được để trống'
        ]);

        $post = Post::getById($id);
        if (!$post) {
            return abort(404);
        }

        $tags = explode(',', $request->tag);
        $params = [
            'name' => $request['name'],
            'description' => $request['description'],
            'content' => $request['content'],
            'status' => $request['status'],
            'upload_by' => 1,
            'post_source' => $request['post_source'],
            'tournament_id' => (int)$request['tournament'],
            'order' => $request['order'],
            'slug' => $request['slug'],
            'thumbnail' => $request['thumbnail'],
            'format_type' => $request['format_type'],
            'date_post' => Carbon::parse('now')->format('Y-m-d H:i:s'),
        ];
//        dd($params);
        if ($request['thumbnail'] == null) {
            $params['thumbnail'] = $post->thumbnail;
        }
        if (Post::getNameSlug($request->slug) !== null) {
            $params['slug'] = $request->slug . '-' . rand(1, 100);
        }

        
        $post = Post::updatedPost($id, $params, $tags);
        if($request->submit == 'save') {
            flash(__('suabaivietthanhcong'))->success();

            return redirect()->route('post.list');
        }
        if($request->submit == 'apply') {
            return back()->with('message',__('suabaivietthanhcong'));
        }

       
    }

    public function destroyPost($id)
    {
        $post = Post::getById($id);
        if (!$post) {
            return abort(404);
        }
        Post::destroyPost($id);
        return back();
    }

    public function destroyTag(Request $request)
    {
        if (!Tag::getById($request->id)) {
            return abort(404);
        }
        Tag::destroyTag($request->id);

        return back();
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('plugin/ckfinder/userfiles/'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('plugin/ckfinder/userfiles/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
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


        $post = Post::getNameSlug($slug);
        

        return view('cms/post/detail', compact('post', 'listBanner', 'tour', 'tourId'));
    }
}
