<?php

namespace SierraTecnologia\Cms\Services;

use SierraTecnologia\Cms\Services\BaseService;
use Illuminate\Support\Facades\Config;

class BlogService extends BaseService
{
    /**
     * Get templates as options
     *
     * @return array
     */
    public function getTemplatesAsOptions()
    {
        return $this->getTemplatesAsOptionsArray('blog');
    }
}
