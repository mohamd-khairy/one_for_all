<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HelperTrait;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use HelperTrait;

    public function get_categories()
    {
        $data = $this->get(Category::class);
        return responseSuccess(CategoryResource::collection($data));
    }

    public function get_sub_categories()
    {
        $page_size = request('page_size') ?? 10;
        $category_id = request('category_id') ?? null;
        if ($category_id) {
            $conditions = ['parent_id' => $category_id];
            $data = Category::where($conditions)->paginate($page_size);

        } else {
            $categories_id = Category::where('parent_id', null)->pluck('id');
            $data = Category::whereIn('parent_id', $categories_id)->paginate($page_size);
        }
        $data->data = CategoryResource::collection($data);
        return responseSuccess($data);
    }
}
