<?php

namespace SierraTecnologia\Cms\Models;

use SierraTecnologia\Cms\Models\CmsModel;
use Translation\Traits\HasTranslations;

class FAQ extends CmsModel
{
    use HasTranslations;

    public $table = 'faqs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public $rules = [
        'question' => 'required',
        'answer' => 'required',
    ];

    protected $appends = [
        'translations',
    ];

    protected $fillable = [
        'question',
        'answer',
        'is_published',
        'published_at',
    ];

    protected $dates = [
        'published_at'
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }
}
