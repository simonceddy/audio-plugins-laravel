<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class ViewBrand extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Brand $brand)
    {
        $brand->load('plugins');
        return response()->json($brand);
    }
}
