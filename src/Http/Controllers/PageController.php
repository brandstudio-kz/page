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

    public function show(Request $request, Page $page)
    {
        return response()->json(new PageResource($page));
    }



}
