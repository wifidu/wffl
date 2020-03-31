<?php

/*
 * @author weifan
 * Tuesday 31st of March 2020 08:22:53 AM
 */

namespace App\Http\Controllers\Api;

use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Str;

class ImagesController extends Controller
{
    public function store(ImageRequest $request, ImageUploadHandler $uploader, Image $image)
    {
        $user = $request->user();

        $size = 'avatar' == $request->type ? 416 : 1024;

        $result = $uploader->save($request->image, Str::plural($request->type), $user->id, $size);

        $image->path    = $result['path'];
        $image->type    = $request->type;
        $image->user_id = $user->id;
        $image->save();

        return new ImageResource($image);
    }
}
