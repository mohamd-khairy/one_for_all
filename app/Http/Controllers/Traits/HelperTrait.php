<?php

namespace App\Http\Controllers\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

trait HelperTrait
{
    public function filters($filters)
    {
        $conditions = [];
        foreach ($filters as $filter) {
            if (request($filter)) {
                $conditions[$filter] = request($filter);
            }
        }
        return $conditions;
    }

    public function paginate($model, $with = [], $page_size = 10)
    {
        return $model::with($with)->paginate($page_size);
    }

    public function get($model, $with = [])
    {
        return $model::with($with)->get();
    }

    public function getBy($model, $conditions = [], $with = [])
    {
        return $model::with($with)->where($conditions)->orderBy('id', 'desc')->get();
    }

    public function getByPaginate($model, $conditions = [], $with = [], $page_size = 10)
    {
        return $model::with($with)->where($conditions)->orderBy('id', 'desc')->paginate($page_size);
    }

    public function getSpeseficeColum($model, $colum, $conditions = [])
    {
        return $model::where($conditions)->pluck($colum);
    }

    public function getMultiColum($model, $colums = [], $conditions = [])
    {
        return $model::where($conditions)->get($colums);
    }

    public function add($model, $input)
    {
        $data = $input;
        $item = $model::create($data);
        return $item;
    }

    public function create($model, $input)
    {
        return $model::create($input);
    }

    public function put($model, $conditions, $input)
    {
        $data = $input;
        $item = $model::where($conditions)->first();

        $item->update($data);

        return $item;
    }

    public function find($model, $conditions)
    {
        return $model::where($conditions)->first();
    }

    public function findWith($model, $conditions, $with = [], $withCount = [])
    {
        return $model::with($with)->withCount($withCount)->where($conditions)->first();
    }

    public function delete($model, $conditions)
    {
        $row = $model::where($conditions)->first();
        $row->delete();
        return $row;
    }


    public function upload($image)
    {
        // $path = $image->hashName($folder . '/' . Auth::user()->id);
        // $image = Image::make($image)->fit(300);
        // Storage::put($path, (string) $image->encode());
        // return $url = Storage::url($path);

        $image_name = time() . rand(1, 100000) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $image_name);
        return 'images/' . $image_name;
    }

    public function deleteImage($path)
    {
        // $file = explode('public/', $path);
        // $file_name = end($file);
        File::delete(public_path($path));
        // File::delete($file_name);
    }



    public function upload_image($image)
    {
        if (!$image) {
            return null;
        }

        $image_name = time() . rand(1, 100000) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $image_name);

        return 'images/' . $image_name;
    }
}
