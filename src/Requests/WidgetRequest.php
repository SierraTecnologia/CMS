<?php

namespace SierraTecnologia\Cms\Requests;

use Auth;
use Gate;
use SierraTecnologia\Cms\Models\Widget;
use Illuminate\Foundation\Http\FormRequest;

class WidgetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (config('app.env') !== 'testing') {
            return Gate::allows('cms', Auth::user());
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Widget::$rules;
    }
}
