<?php

namespace SierraTecnologia\Cms\Models;

use SierraTecnologia\Cms\Models\CmsModel;
use Translation\Traits\HasTranslations;

class Widget extends CmsModel
{
    use HasTranslations;

    public $table = 'widgets';

    public $primaryKey = 'id';

    protected $guarded = [];

    public $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    protected $appends = [
        'translations',
    ];

    protected $fillable = [
        'name',
        'slug',
        'content',
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }
}
