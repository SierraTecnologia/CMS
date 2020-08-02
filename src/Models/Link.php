<?php

namespace SierraTecnologia\Cms\Models;

use SierraTecnologia\Cms\Models\CmsModel;
use SierraTecnologia\Cms\Models\Menu;
use SierraTecnologia\Cms\Models\Page;
use Translation\Traits\HasTranslations;

class Link extends CmsModel
{
    use HasTranslations;

    public $table = 'links';

    public $primaryKey = 'id';

    protected $guarded = [];

    public $rules = [
        'name' => 'required',
    ];

    protected $fillable = [
        'name',
        'external',
        'page_id',
        'menu_id',
        'external_url',
    ];

    public $with = [
        'page'
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
