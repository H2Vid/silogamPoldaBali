<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\UploadImageRequest;
use App\Http\Requests\CMS\UploadFileRequest;
use Storage;
use Exception;

class UploadController extends Controller
{
    public function image(UploadImageRequest $request)
    {
        $file = $this->request->file('image');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $nameonly = str_replace('.' . $extension, '', $filename);

        $size = $file->getSize();
        if ($size > (config('cms.max_filesize.image', 5) * 1024 * 1024)) {
            return response()->json([
                'type' => 'error',
                'message' => 'File too large'
            ], 400);
        }

        $path = 'default';
        if ($this->request->path) {
            try {
                $dpath = decrypt($this->request->path);
                if (is_string($dpath)) {
                    if (strlen($dpath) <= 30) {
                        $path = $dpath;
                    }
                }
            } catch (Exception $e) {
                // do nothing
            }
        }

        //check if file already exists
        $check_exists = Storage::exists($path . '/' . $nameonly . '.' . $extension);
        if ($check_exists) {
            $stored_name = $nameonly . '-' . substr(sha1(rand(1, 10000)), 0, 10) . '.' . $extension;
        } else {
            $stored_name = $nameonly . '.' . $extension;
        }

        $final_path = $file->storeAs($path, $stored_name);

        return [
            'url' => Storage::url(str_replace('\\', '/', $final_path)),
            'path' => str_replace('\\', '/', $final_path),
            'filename' => $stored_name,
        ];
    }

    public function file(UploadFileRequest $request)
    {
        $file = $this->request->file('file');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $nameonly = str_replace('.' . $extension, '', $filename);

        $path = 'default-files';
        if ($this->request->path) {
            try {
                $dpath = decrypt($this->request->path);
                if (is_string($dpath)) {
                    if (strlen($dpath) <= 30) {
                        $path = $dpath;
                    }
                }
            } catch (Exception $e) {
                // do nothing
            }
        }

        //check if file already exists
        $check_exists = Storage::exists($path . '/' . $nameonly . '.' . $extension);
        if ($check_exists) {
            $stored_name = $nameonly . '-' . substr(sha1(rand(1, 10000)), 0, 10) . '.' . $extension;
        } else {
            $stored_name = $nameonly . '.' . $extension;
        }

        $final_path = $file->storeAs($path, $stored_name);

        return [
            'url' => Storage::url(str_replace('\\', '/', $final_path)),
            'path' => str_replace('\\', '/', $final_path),
            'filename' => $stored_name,
        ];
    }

}