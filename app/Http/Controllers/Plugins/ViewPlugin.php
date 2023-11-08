<?php

namespace App\Http\Controllers\Plugins;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use Illuminate\Http\Request;

class ViewPlugin extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Plugin $plugin)
    {
        $plugin->load('brand');
        return response()->json($plugin);
    }
}
