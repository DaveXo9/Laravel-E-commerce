<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use App\Services\ImageUploadService;


class SettingController extends Controller
{
    public function __construct(private ImageUploadService $imageUploadService)
    {
        
    }
    public function index() {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        if ($request->has('site_logo') && ($request->file('site_logo') instanceof UploadedFile)) {

            if (config('settings.site_logo') != null) {
                $this->imageUploadService->deleteOne(config('settings.site_logo'));
            }
            $logo = $this->imageUploadService->uploadOne($request->file('site_logo'), 'img');
            Setting::set('site_logo', $logo);

        } elseif ($request->has('site_favicon') && ($request->file('site_favicon') instanceof UploadedFile)) {

            if (config('settings.site_favicon') != null) {
                $this->imageUploadService->deleteOne(config('settings.site_favicon'));
            }
            $favicon = $this->imageUploadService->uploadOne($request->file('site_favicon'), 'img');
            Setting::set('site_favicon', $favicon);

        } else {

            $keys = $request->except('_token');

            foreach ($keys as $key => $value)
            {
                Setting::set($key, $value);
            }
        }
        return $this->responseRedirectBack('Settings updated successfully.', 'success');
    }
}
