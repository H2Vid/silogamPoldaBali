<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;
use App\Libraries\CMS;

class UploadImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return CMS::adminIsLoggedIn();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image' => 'required|file|mimetypes:image/*|max:' . (fileUploadMaxFilesize(config('cms.max_filesize.image')) / 1024),
        ];
    }
}