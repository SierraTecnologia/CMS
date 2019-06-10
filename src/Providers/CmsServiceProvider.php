<?php

namespace SierraTecnologia\Cms\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use SierraTecnologia\Cms\Services\BlogService;
use SierraTecnologia\Cms\Services\CryptoService;
use SierraTecnologia\Cms\Services\EventService;
use SierraTecnologia\Cms\Services\ModuleService;
use SierraTecnologia\Cms\Services\PageService;
use SierraTecnologia\Cms\Services\CmsService;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Cms', \SierraTecnologia\Cms\Facades\CmsServiceFacade::class);
        $loader->alias('PageService', \SierraTecnologia\Cms\Facades\PageServiceFacade::class);
        $loader->alias('EventService', \SierraTecnologia\Cms\Facades\EventServiceFacade::class);
        $loader->alias('CryptoService', \SierraTecnologia\Cms\Facades\CryptoServiceFacade::class);
        $loader->alias('ModuleService', \SierraTecnologia\Cms\Facades\ModuleServiceFacade::class);
        $loader->alias('BlogService', \SierraTecnologia\Cms\Facades\BlogServiceFacade::class);
        $loader->alias('FileService', \SierraTecnologia\Cms\Services\FileService::class);

        $this->app->bind('CmsService', function ($app) {
            return new CmsService();
        });

        $this->app->bind('PageService', function ($app) {
            return new PageService();
        });

        $this->app->bind('EventService', function ($app) {
            return App::make(EventService::class);
        });

        $this->app->bind('CryptoService', function ($app) {
            return new CryptoService();
        });

        $this->app->bind('ModuleService', function ($app) {
            return new ModuleService();
        });

        $this->app->bind('BlogService', function ($app) {
            return new BlogService();
        });
    }
}
