<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentBanner;
use App\Traits\AwsTrait;
use App\Traits\ResponseTrait;
use App\Traits\TourTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class BannerHomeController extends Controller
{

    use AwsTrait, ResponseTrait, TourTrait;

    public function index(Request $request)
    {
        $tourAll = Tournament::all()->pluck('name', 'id')->toArray();


        $tourId = $request->tour_id;

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
            ->select('vgatour_tournament_banner.*', 'vgatour_admin.name', 'vgatour_tournament.name as name_tour')
            ->get();


        return view('cms.banner.index', compact('listBanner', 'tourId', 'tour', 'tourAll'));
    }

    public function update(Request $request, $id)
    {
        if ($request->has('tag_position')) {

            $listPositionChange = array_unique($request->tag_position);

            foreach ($listPositionChange as $position) {

                $tagBanner = 'banner_' . $position;
                $tagType = 'type_' . $position;
                $tagLink = 'link_' . $position;

                $listFile = $request->$tagBanner;
                $listType = $request->$tagType;
                $listLink = $request->$tagLink;

                foreach ($listFile as $key => $file) {


                    $banner = new TournamentBanner();
                    $banner->tour_id = $id;
                    $banner->type = $listType[$key];
                    $banner->url = $listLink[$key];

                    $url = $this->uploadImage($file, $position, 'banner_home');

                    $parseUrl = parse_url($url);
                    $banner->link_image = $parseUrl['path'];
                    
                    $banner->upload_by = auth()->user()->id;

                    $banner->save();

                }
            }
        }

        flash(__('thembannerthanhcong'))->success();
        
        return redirect()->route('banner_home.index', ['tour_id' => $id]);

    }
    protected function uploadImage($file, $nameFolder, $tag)
    {

        $nameImage = $file->getClientOriginalName();

        $imageName = 'image_' . md5($nameImage) . time() . '.' . $file->getClientOriginalExtension();

        $pathImage = $file->getRealPath();

        $image = $this->resizeImage($pathImage);

        if (!file_exists(public_path('image/' . $tag . '/' . $nameFolder))) {
            mkdir(public_path('image/' . $tag . '/' . $nameFolder), 666, true);
        }

        $resultImage = $image->save(public_path('image/' . $tag . '/' . $nameFolder . '/' . $imageName));

        //                $pathResize = $resultImage->dirname . '\\' . $resultImage->basename;

        //                $result = $this->handlePutObjectToAsw($imageName, $pathResize);

        //todo: up lên amz thì sửa link lại
        return asset('image/' . $tag . '/' . $nameFolder . '/' . $imageName);
    }

    public function resizeImage($path, $width = 1300, $height = 960)
    {

        $image_resize = Image::make($path);

        $width = $image_resize->width();
        $height = $image_resize->height();

        if ($width > $height) {
            $image_resize->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image_resize->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        return $image_resize;
    }

    public function updateStatusBanner(Request $request)
    {

        $banner_id = $request->banner_id;

        $banner = TournamentBanner::find($banner_id);

        if ($banner !== null) {

            if (in_array($banner->type, [1, 6, 8])) { //nhưng loại banner chỉ show 1 cái

                $olderBanner = TournamentBanner::where('type', $banner->type)->where('tour_id', $banner->tour_id)->where('status', 1)->first();

                if ($olderBanner) {
                    $olderBanner->update(['status' => 0]);
                }
            }

            $banner->status = $request->status;

            $result = $banner->save();

            if ($result) {
                $response = $this->handleResponse(0, 0, array('message' => __('thaydoitrangthaibannerthanhcong')));
            } else {
                $response = $this->handleResponse(1, 1, array('message' => __('thaydoitrangthaibannerthatbai')));
            }
        } else {

            $response = $this->handleResponse(1, 1, array('message' => __('thaydoitrangthaibannerthatbai')));
        }

        return $response;
    }

    public
    function addViewUpload(Request $request)
    {
        $pos = $request->pos;
        $type = $request->type;

        return view('cms.banner.template.view_upload_banner', compact('pos', 'type'));
    }
    public function deleteBannerHome(Request $request)
    {
        $id = $request->delete_id;
        $del = TournamentBanner::where('id', $id)->delete();
        if ($del == 1) return 'okela';
        else return "Xoa khong thanh cong!";
    }
}
