<?php

namespace BrandStudio\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use BrandStudio\Page\Page;

use BrandStudio\Page\Http\Resources\PageResource;

class PageController extends Controller
{

    public function index(Request $request)
    {

    }

    public function show(Request $request, $page)
    {
        $page = Page::active()->whereSlug($page)->first();
        if (!$page) {
            $page = Page::where('slug', 'home')->firstOrFail();
        }
        return response()->json(new PageResource($page));
    }



}
