<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index() {
        $settings = Setting::first();
        // dd($settings);
        return view('setting.index', ['settings'=>$settings]);
    }

    public function update(Request $request) {
        // try {
            $validator = Validator::make($request->all(), [
                'url' => 'required',
                'company_name' => 'required',
                'system_title' => 'required',
                'login_page_title' => 'required',
                'copyrights' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $params = $request->only('url', 'company_name', 'system_title', 'login_page_title', 'copyrights');

            if ($request->hasFile('favicon')) {
                if ($request->input('old_favicon')) {
                    $path = public_path($request->old_favicon);
                    $isExists = File::exists($path);
                    if($isExists)
                    {
                        unlink(public_path($request->old_favicon));
                    }
                }

                $favicon = 'favicon.' . $request->favicon->getClientOriginalExtension();

                $request->favicon->move(public_path('uploads/logos/'), $favicon);
                $favicon_photo = 'uploads/logos/' . $favicon;
                $params['favicon'] = $favicon_photo;
            }

            if ($request->hasFile('logo')) {
                if ($request->input('old_logo')) {
                    $path = public_path($request->old_logo);
                    $isExists = File::exists($path);
                    if($isExists)
                    {
                        unlink(public_path($request->old_logo));
                    }
                }
                $logo = 'logo.' . $request->logo->getClientOriginalExtension();

                $request->logo->move(public_path('uploads/logos/'), $logo);
                $logo_photo = 'uploads/logos/' . $logo;
                $params['logo'] = $logo_photo;
            }

            Setting::whereId(1)->update($params);

            $notification = array(
                'message' => 'Settings updated successfully!',
                'alert-type' => 'success'
            );

            return Redirect::to('/setting')->with($notification);
        // } catch (\Throwable $th) {
        //     $notification = array(
        //         'message' => 'Sorry can`t update settings!',
        //         'alert-type' => 'error'
        //     );

        //     return Redirect::to('/setting')->with($notification);
        // }
    }
}
