<?php

namespace App\Http\Controllers\API\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\PublicImageStorage;
use App\Services\ImageService;

class ImageController extends Controller
{
    public function update(Task $task, Request $request)
    {
        $this->authorize('update', $task);

        $request->validate([
            'image' => 'required|image|max:2048|dimensions:min_width=150,min_height=150'
        ]);

        PublicImageStorage::delete(PublicImageStorage::getPathFromUrl($task->image));
        PublicImageStorage::delete(PublicImageStorage::getPathFromUrl($task->thumbnail));

        $thumbnailUrl = null;
        $imageUrl = null;

        if ($request->hasFile('image')) {
            $thumbnailPath = PublicImageStorage::store($request->image, 'thumbnails');

            ImageService::createThumbnail(storage_path("app/public/$thumbnailPath"));

            $imageUrl = Storage::url(PublicImageStorage::store($request->image));
            $thumbnailUrl = Storage::url($thumbnailPath);
        }

        $task->updateImage(
            $thumbnailUrl,
            $imageUrl
        );

        return response()->json([
            'errors' => null,
            'result' => $task
        ]);
    }

    public function destroy(Task $task)
    {
        $this->authorize('update', $task);
        
        PublicImageStorage::delete(PublicImageStorage::getPathFromUrl($task->image));
        PublicImageStorage::delete(PublicImageStorage::getPathFromUrl($task->thumbnail));

        $task->updateImage(
            null,
            null
        );

        return response()->json([
            'errors' => null,
            'result' => $task
        ]);
    }
}
