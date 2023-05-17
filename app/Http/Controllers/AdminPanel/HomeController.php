<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        return view("admin.index");
    }

    public function setting()
    {
        $data = Setting::first();
        if($data===null)
        {
            $data = new Setting();
            $data->title = "Project Title";
            $data->save();
            $data = Setting::first();
        }

        return view("admin.setting", [
            'data'=>$data
        ]);
    }

    public function settingUpdate(Request $request)
    {
        $data = Setting::first();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->company = $request->company;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->fax = $request->fax;
        $data->email = $request->email;
        $data->facebook = $request->facebook;
        $data->instagram = $request->instagram;
        $data->twitter = $request->twitter;
        $data->youtube = $request->youtube;
        $data->github = $request->github;
        $data->contact = $request->contact;
        $data->aboutus = $request->aboutus;
        $data->references = $request->references;
        $data->status = $request->status;

        $data->save();

        return redirect()->route('admin.setting', [
            'data' => $data,
        ]);
    }
}
