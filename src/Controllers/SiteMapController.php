<?php

namespace SierraTecnologia\Cms\Controllers;

use SierraTecnologia\Cms\Services\CmsService;
use Illuminate\Http\Response;

class SiteMapController extends SierraTecnologiaCmsController
{
    protected $service;

    public function __construct(CmsService $service)
    {
        parent::construct();

        $this->service = $service;
    }

    public function index()
    {
        $items = $this->service->collectSiteMapItems();

        $contents = view('cms::site-map', compact('items'));

        return new Response($contents, 200, [
            'Content-Type' => 'application/xml;charset=UTF-8',
        ]);
    }
}
