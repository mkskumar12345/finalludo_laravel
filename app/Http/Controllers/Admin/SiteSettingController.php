<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SiteSetting;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d['title'] = 'Site Setting';
        $d['setting'] = SiteSetting::Pluck('value','name')->toArray();
        return view('admin.siteSetting.index',$d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $settings = $request->except(['_token', 'logo', 'favicon']);
        foreach ($settings as $key => $value) {
            # code...
            SiteSetting::updateOrCreate(['name' => $key], [
                'value' => $value,
            ]);
        }

        if($request->file('logo')) {
            $file = $request->file('logo');
            $imageName = $this->UpdateImage($file, 'assets/logo');
            SiteSetting::updateOrCreate(['name' => 'logo'], [
                'value' => $imageName,
            ]);
        }
        if($request->file('deposit_qr')) {
            $file = $request->file('deposit_qr');
            $imageName = $this->UpdateImage($file, 'assets/logo');
            SiteSetting::updateOrCreate(['name' => 'deposit_qr'], [
                'value' => $imageName,
            ]);
        }
        if($request->file('favicon')) {
            $file = $request->file('favicon');
            $imageName = $this->UpdateImage($file, 'assets/favicon');
            SiteSetting::updateOrCreate(['name' => 'favicon'], [
                'value' => $imageName,
            ]);
        }
        if($request->file('image')) {
            $file = $request->file('image');
            $imageName = $this->UpdateImage($file, 'assets/image');
            SiteSetting::updateOrCreate(['name' => 'image'], [
                'value' => $imageName,
            ]);
        }

        return redirect()->back()->with('message', 'Updated Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
