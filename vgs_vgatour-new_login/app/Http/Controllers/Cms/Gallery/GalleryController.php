<?php


namespace App\Http\Controllers\Cms\Gallery;


use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Admin\Gallery;
use App\Models\Tournament;
use App\Traits\AwsTrait;
use App\Traits\FileTrait;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    use Response, AwsTrait, FileTrait;

    protected $tournamentModel;

    protected $galleryModel;

    public function __construct(Tournament $tournamentModel, Gallery $galleryModel)
    {
        $this->tournamentModel = $tournamentModel;
        $this->galleryModel = $galleryModel;
    }

    public function index(Request $request) {
        $action = $request->get("action", 0);
        switch ($action) {
            case 1:
                $limit = $request->get("limit", 10);
                $where = $request->only("tournament_id");
                $galleryQuery = $this->galleryModel->newQuery();
                if (!empty($where)) {
                    $galleryQuery->where($where);
                }
                $results = $galleryQuery->paginate($limit);
                $this->addData($results);
                return $this->getResponse();
            default:
                return view("cms.gallery.index");
        }
    }

    public function store(GalleryRequest $request) {
        try {
            $file = $request->file('file');
            $imageName = $file->getClientOriginalName();
            //Check image exits
            $image = $this->galleryModel->newQuery()->where("name_image", $imageName)->first("id");
            if (!is_null($image)) {
                $this->addData($imageName);
                $this->setMessage("Ảnh ".$imageName. " Đã tồn tại.");
                $this->setErrorCode(2);
                return $this->getResponse();
            }
            $tournamentModel = $this->tournamentModel->newQuery()->findOrFail($request->post('tournament_id'));
            $folderName = Str::slug($tournamentModel->name, "_");
            $filePath = $file->getPathname();
            $day = Carbon::now()->format("d-m-Y");
            $extension = $file->getClientOriginalExtension();
            $timestamp = Carbon::now()->timestamp;
            $numberOne = random_int(1,10000);
            $nameFile = $timestamp . "_" .$numberOne. "." . $extension;
            $originalName = $this->handleRenderPathYearMonthDay() . "/". $folderName . "/" . $nameFile;
            $linkImage = $this->handlePutObjectToAsw($originalName, $filePath);
            if (!is_null($linkImage)){
                $path = public_path('uploads/' .$day. "/". $folderName);
                $this->handleCheckDirectory($path);
                $pathClient = $day . "/" . $nameFile;
                $file->move($path, $pathClient);
                $linkImageThumbnail = $this->handleCreateImageThumbnail($path , $day, $timestamp, $folderName, $extension, $nameFile);
                $imageSmall = $this->handleCreateImageSmall($path, $day, $timestamp, $folderName, $extension, $nameFile);
                if (!is_null($linkImageThumbnail) && !is_null($imageSmall)) {
                    $result = $this->galleryModel->newQuery()->create([
                        "tournament_id" => $tournamentModel->id,
                        "name_image" => $imageName,
                        "img_url" => $linkImage,
                        "img_convert" => $linkImageThumbnail,
                        "img_resize" => $imageSmall,
                    ]);
                    if($result) {
                        $image = $path . "/". $folderName . "/" . $nameFile;
                        @unlink($image);
                    }
                    $this->setMessage("Thêm ảnh thành công.");
                    $this->setErrorCode(1);
                    return $this->getResponse();
                }
            }
            $this->setMessage("Đã có lỗi xảy ra, vui lòng thử lại.");
            $this->setErrorCode(0);
            return $this->getResponse();
        } catch (\Exception $exception) {
            $this->setMessage("Đã có lỗi xảy ra, vui lòng thử lại.");
            $this->setException($exception);
            $this->setErrorCode(0);
            return $this->getResponse();
        }
    }

    public function update() {
        try {

        } catch (\Exception $exception) {
            $this->setMessage("Đã có lỗi xảy ra, vui lòng thử lại.");
            $this->setException($exception);
            $this->setErrorCode(0);
            return $this->getResponse();
        }
    }
}
