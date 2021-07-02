<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;
use Intervention\Image\ImageManagerStatic as Image;

trait AwsTrait
{
    protected function handlePutObjectToAsw($originalName, $filePath)
    {
        $data = [
            'Bucket'     => env("AWS_BUCKET", "tridev"),
            'Key'        => $originalName,
            'SourceFile' => $filePath,
            'ACL' => 'public-read'
        ];
        try {
            $s3 = App::make('aws')->createClient('s3');
            $result = $s3->putObject($data);
            header("Content-Type: {$result['ContentType']}");
            $response = ($result['ObjectURL'] == "") ? null : $result['ObjectURL'];
            return $response;
        } catch (\Exception $exception) {
            throw new \Error($exception->getMessage());
        }
    }

    protected function handleDeleteObjectToAsw($originalName)
    {
        $data = [
            'Bucket'     => env("AWS_BUCKET", "tridev"),
            'Key'        => $originalName
        ];
        $s3 = App::make('aws')->createClient('s3');
        $result = $s3->deleteObject($data);
        header("Content-Type: {$result['ContentType']}");
        $response = ($result['ObjectURL'] == "") ? null : $result['ObjectURL'];
        return $response;
    }
    protected function uploadImage($file, $nameFolder, $tag, $width, $height)
    {

        $nameImage = $file->getClientOriginalName();

        $imageName = 'image_' . md5($nameImage) . time() . '.' . $file->getClientOriginalExtension();

        $pathImage = $file->getRealPath();

        $image = $this->resizeImage($pathImage, $width, $height);

        if (!file_exists(public_path('image/' . $tag . '/' . $nameFolder))) {
            mkdir(public_path('image/' . $tag . '/' . $nameFolder), 666, true);
        }

        $resultImage = $image->save(public_path('image/' . $tag . '/' . $nameFolder . '/' . $imageName));

        //                $pathResize = $resultImage->dirname . '\\' . $resultImage->basename;

        //                $result = $this->handlePutObjectToAsw($imageName, $pathResize);

        //todo: up lên amz thì sửa link lại
        return asset('image/' . $tag . '/' . $nameFolder . '/' . $imageName);
    }

    public function resizeImage($path, $width, $height)
    {

        $image_resize = Image::make($path)  ->resize($width, $height, function ($constraint) {
                                                                            $constraint->aspectRatio();
                                                                        });
                                            

        // $width = $image_resize->width();
        // $height = $image_resize->height();

        // if ($width > $height) {
        //     $image_resize->resize($width, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });
        // } else {
        //     $image_resize->resize(null, $height, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });
        // }
        return $image_resize;
    }
}
