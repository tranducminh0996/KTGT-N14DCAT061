<?php


namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;


trait FileTrait
{
    protected $number = 0;

    protected function handleReductionSizeOfFile($path) {
        $fileSize = File::size($path);
        // Log::info('Showing user profile for user: ', $fileSize);
        $defaultSize = (int) env('GOLFERVN_SIZE_IMAGE', 50000);
        $defaultQuality = (int) env('GOLFERVN_RESIZE_QUALITY', 50);
        if ($this->number != 0) $defaultQuality = $defaultQuality - $this->number;
        if ($fileSize > $defaultSize && $defaultQuality > 50) {
            $this->number += 10;
            $image = Image::make($path);
            $image->save($path, $defaultQuality);
            //Log::debug("________LOG_2________");
            //Log::debug("default_quality: ". $defaultQuality);
            //Log::debug("number_quality: ". $this->number);
            //Log::debug("file_size: ".$fileSize);
            $this->handleReductionSizeOfFile($path);
        } else {
            return $path;
        }
        return $path;
    }

    protected function handleCreateImageThumbnail($path, $day, $timestamp, $folderName, $extension, $nameFile) {
        $nameFileThumbnail = $timestamp . "_thumbnail." . $extension;
        $pathThumbnail = public_path('uploads/'. $day ."/" . $folderName . '/thumbnail');
        $this->handleCheckDirectory($pathThumbnail);
        $pathThumbnailImage = $pathThumbnail."/".$nameFileThumbnail;
        $image = Image::make($path. "/" . $nameFile);
        $width = $image->width();
        $height = $image->height();
        if ($width > $height) {
            $image->orientate()->resize(960, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->orientate()->resize(null, 960, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $image->save($pathThumbnailImage);
        $filePathThumbnailImage = public_path('uploads/'.$day. "/" .$folderName.'/thumbnail/' . $nameFileThumbnail);
        $originalNameThumbnailImage = $this->handleRenderPathYearMonthDay(). "/" . $folderName ."/thumbnail/".$nameFileThumbnail;
        $filePath = $this->handleReductionSizeOfFile($filePathThumbnailImage);
        $linkImage = $this->handlePutObjectToAsw($originalNameThumbnailImage, $filePath);
        if (!is_null($linkImage)) {
            unset($image);
            @unlink($pathThumbnailImage);
        }
        return $linkImage;
    }

    protected function handleCreateImageSmall($path, $day, $timestamp, $folderName, $extension, $nameFile) {
        $nameImageSmall = $timestamp . "_small." . $extension;
        $pathThumbnail = public_path('uploads/'. $day . "/". $folderName .'/small');
        $this->handleCheckDirectory($pathThumbnail);
        $pathSmallImage = $pathThumbnail."/".$nameImageSmall;
        $image = Image::make($path. "/" . $nameFile);
        $width = $image->width();
        $height = $image->height();
        if ($width > $height) {
            $image->orientate()->resize(134, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->orientate()->resize(null, 134, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $image->save($pathSmallImage);
        $filePathSmallImage = public_path('uploads/'.$day. "/" . $folderName . '/small/' . $nameImageSmall);
        $originalNameSmallImage = $this->handleRenderPathYearMonthDay()."/" .$folderName. "/small/".$nameImageSmall;
        $filePath = $this->handleReductionSizeOfFile($filePathSmallImage);
        $linkImage = $this->handlePutObjectToAsw($originalNameSmallImage, $filePath);
        if (!is_null($linkImage)) {
            unset($image);
            @unlink($pathSmallImage);
        }
        return $linkImage;
    }

    protected function handleRenderPathYearMonthDay() {
        $year = Carbon::now()->format("Y");
        $month = Carbon::now()->format("m");
        $date = Carbon::now()->format("d");
        return $year. "/" . $month ."/". $date;
    }

    protected function handleCheckDirectory($path) {
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
    }
}
