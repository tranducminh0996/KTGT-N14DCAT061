<?php


namespace App\Http\Requests;


class GalleryRequest extends Request
{
    public function rules()
    {
        return [
            'file'  => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'tournament_id' => 'required|integer',
        ];
    }
}
