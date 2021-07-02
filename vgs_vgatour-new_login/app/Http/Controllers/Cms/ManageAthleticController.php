<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Athletic;
use App\Models\AthleticTimeline;
use App\Traits\AwsTrait;
use Illuminate\Http\Request;
use App\Http\Requests\AthleticRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse as JsonResponse;

class ManageAthleticController extends Controller
{
    use AwsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $listAthletic = Athletic::leftJoin('exel_countries', 'exel_countries.id', 'country')
            ->select('vgatour_athletic.*', 'exel_countries.name as country_name')
            ->orderBy('first_name')
            ->paginate(20);

        return view('cms.manage_athletic.index', compact('listAthletic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AthleticRequest $request)
    {
        
            $data = $request->all();

            $athletic = new Athletic($data);
            $sizes = config('image.athletic');

            if ($request->has('avatar')) {

                $athletic->avatar = $this->uploadImage($request->avatar, 'avatar', 'athletic', $sizes['width'], $sizes['height']);
                $parseUrl = parse_url($athletic->avatar);
                $athletic->avatar = $parseUrl['path'];
            }
            if ($athletic->getByCode($request->vga_id)) {
                throw new HttpResponseException(response()->json(
                    [
                        'error' => ['vga_id' => "Mã VGA đã tồn tại."],
                        'status_code' => 422,
                    ],
                    JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                ));
            } else {
                $athletic->code_athletic = 'PRO' . $request->vga_id;
                $athletic->status = 1;
                $result = $athletic->save();
            }

            if ($result && $athletic) {
                
            } else {
                throw new HttpResponseException(response()->json(
                    [
                        'error' => ['error' => "Đã xảy ra lỗi, vui lòng thử lại."],
                        'status_code' => 422,
                    ],
                    JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                ));
            }
        
        

        // return redirect()->route('manage_athletic.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $athletic = Athletic::leftJoin('exel_countries', 'exel_countries.id', 'vgatour_athletic.country')
            ->where('vgatour_athletic.id', $id)
            ->select('vgatour_athletic.*', 'exel_countries.name as country')
            ->first();

        $listTimeline = AthleticTimeline::join('vgatour_athletic', 'vgatour_athletic.id', 'vgatour_athletic_timeline.athletic_id')
            ->where('vgatour_athletic.id', $id)
            ->orderBy('vgatour_athletic_timeline.stt_view', 'asc')
            ->orderBy('vgatour_athletic_timeline.time_event', 'asc')
            ->orderBy('vgatour_athletic_timeline.created_at')
            ->get();

        return view('cms.manage_athletic.template.content_modal_edit_athletic', compact('athletic', 'listTimeline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approveAthletic()
    {
        return view('cms.manage_athletic.approve_athletic');
    }

    public function advertiseAthletic()
    {
    }

    public function removeAthletic()
    {
    }

    public function addViewTimeline()
    {

        return view('cms.manage_athletic.template.item_timeline');
    }

    public function storeTimeline(Request $request)
    {


        $dataForm = $request->all();

        $data = array();
        foreach ($dataForm["time_event"] as $key => $event) {

            $data[] = array(
                'athletic_id' => $request->athletic_id,
                'stt_view' => $dataForm['stt_view'][$key],
                'time_event' => $dataForm['time_event'][$key],
                'title' => $dataForm['title'][$key],
                'content' => $dataForm['content'][$key]
            );
        }

        $result = AthleticTimeline::insert($data);

        if ($result) {
            flash(__('taomoihoatdongvandongvienthanhcong'))->success();
        } else {
            flash(__('taomoihoatdongvandongvienthatbai'))->error();
        }

        return redirect()->route('manage_athletic.index');
    }
}
