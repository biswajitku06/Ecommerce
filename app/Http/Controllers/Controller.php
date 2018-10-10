<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Category;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function categories()
    {
        $maincategories=Category::where(['parent_id'=>0])->get();
        return $maincategories;
    }

    public static function getBanner()
    {
        $getBanner=Banner::where('status',2)->get();
        return $getBanner;
    }
}
