<?php

namespace SierraTecnologia\Cms\Models;

use SierraTecnologia\Cms\Models\CmsModel;
use SierraTecnologia\Cms\Services\Normalizer;
use Translation\Traits\HasTranslations;
use Illuminate\Support\Carbon;

class Promotion extends CmsModel
{
    use HasTranslations;

    public $table = 'promotions';

    public $primaryKey = 'id';

    protected $guarded = [];

    public $rules = [
        'slug' => 'required',
    ];

    protected $appends = [
        'translations',
        'is_published',
    ];

    protected $fillable = [
        'slug',
        'details',
        'published_at',
        'finished_at',
    ];

    protected $dates = [
        'published_at' => 'Y-m-d H:i',
        'finished_at' => 'Y-m-d H:i',
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }

    public function getDetailsAttribute($value)
    {
        return new Normalizer($value);
    }

    public function getPublishedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(config('app.timezone'));
    }

    public function getFinishedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(config('app.timezone'));
    }

    public function getIsPublishedAttribute()
    {
        $published = Carbon::parse($this->published_at)->timezone(config('app.timezone'));
        $finished = Carbon::parse($this->finished_at)->timezone(config('app.timezone'));

        return Carbon::now(config('app.timezone'))->between($published, $finished);
    }
}
