<?php

namespace SierraTecnologia\Cms\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CmsEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saved: SierraTecnologia\Cms\Models\Blog' => [
            'SierraTecnologia\Cms\Models\Blog@afterSaved',
        ],
        'eloquent.saved: SierraTecnologia\Cms\Models\Page' => [
            'SierraTecnologia\Cms\Models\Page@afterSaved',
        ],
        'eloquent.saved: SierraTecnologia\Cms\Models\Event' => [
            'SierraTecnologia\Cms\Models\Event@afterSaved',
        ],
        'eloquent.saved: SierraTecnologia\Cms\Models\FAQ' => [
            'SierraTecnologia\Cms\Models\FAQ@afterSaved',
        ],
        'eloquent.saved: SierraTecnologia\Cms\Models\Translation' => [
            'SierraTecnologia\Cms\Models\Translation@afterSaved',
        ],
        'eloquent.saved: SierraTecnologia\Cms\Models\Widget' => [
            'SierraTecnologia\Cms\Models\Widget@afterSaved',
        ],

        'eloquent.created: SierraTecnologia\Cms\Models\Blog' => [
            'SierraTecnologia\Cms\Models\Blog@afterCreate',
        ],
        'eloquent.created: SierraTecnologia\Cms\Models\Page' => [
            'SierraTecnologia\Cms\Models\Page@afterCreate',
        ],
        'eloquent.created: SierraTecnologia\Cms\Models\Event' => [
            'SierraTecnologia\Cms\Models\Event@afterCreate',
        ],
        'eloquent.created: SierraTecnologia\Cms\Models\FAQ' => [
            'SierraTecnologia\Cms\Models\Event@afterCreate',
        ],
        'eloquent.created: SierraTecnologia\Cms\Models\Widget' => [
            'SierraTecnologia\Cms\Models\Widget@afterCreate',
        ],
        'eloquent.created: SierraTecnologia\Cms\Models\Link' => [
            'SierraTecnologia\Cms\Models\Link@afterCreate',
        ],

        'eloquent.deleting: SierraTecnologia\Cms\Models\Blog' => [
            'SierraTecnologia\Cms\Models\Blog@beingDeleted',
        ],
        'eloquent.deleting: SierraTecnologia\Cms\Models\Page' => [
            'SierraTecnologia\Cms\Models\Page@beingDeleted',
        ],
        'eloquent.deleting: SierraTecnologia\Cms\Models\Event' => [
            'SierraTecnologia\Cms\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: SierraTecnologia\Cms\Models\FAQ' => [
            'SierraTecnologia\Cms\Models\FAQ@beingDeleted',
        ],
        'eloquent.deleting: SierraTecnologia\Cms\Models\Translation' => [
            'SierraTecnologia\Cms\Models\Translation@beingDeleted',
        ],
        'eloquent.deleting: SierraTecnologia\Cms\Models\Widget' => [
            'SierraTecnologia\Cms\Models\Widget@beingDeleted',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot()
    {
        parent::boot();
    }
}
