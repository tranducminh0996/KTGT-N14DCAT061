<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function removeTag(Request $request)
    {
        if (!Tag::getById($request->id)) {
            return abort(404);
        }
        Tag::destroyTag($request->id);

        return back();
    }
}
