<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use App\SiteSetting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Str; 
use App\User;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title'] = 'Page';
        $query = Page::query();
        if($request->search)
        {
            $query = $query->where('name','LIKE',"%".$request->search."%");
        }
        $data['pages'] = $query->paginate(10);

        return view('admin.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = 'Add Page';
        return view('admin.pages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description??'',
            'status' => $request->status,
        ];

        Page::updateOrCreate(['id' => $request->id], $data);

        if(isset($request->id)) {
            $msg = 'Page Updated.';
        } else {
            $msg = 'Page Added.';
        }
        return redirect()->route('admin.pages.index')->with('msg', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPage($id)
    {
        //
        
        $data['logo'] = SiteSetting::where('name','logo')->pluck('value')->first();
        $site_title = SiteSetting::where('name','site_title')->pluck('value')->first();
        $data['urls'] = Page::take(4)->get();
        $data['page'] = $page = Page::where('slug', $id)->first();
        $data['title'] = ($page->name)??(($site_title)??'Page');

        return view('admin.pages.show', $data);
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
        $data['title'] = 'Edit Page';
        $data['page'] = Page::where('id', $id)->first();
        return view('admin.pages.create', $data);
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
        Page::where('id' , $id)->delete();
        return redirect()->route('admin.pages.index')->with('msg', 'Page Deleted Successfully');
    }


    public function deleteUser($user)
    {
        # code...
        User::where(function($query) use ($user){
            $query->where('id', $user)->orWhere('phone', $user);
        })->delete();

        $data['logo'] = SiteSetting::where('name','logo')->pluck('value')->first();
        // $site_title = SiteSetting::where('name','site_title')->pluck('value')->first();
        $data['urls'] = Page::take(4)->get();
        // $data['page'] = ''; //$page = Page::where('slug', $id)->first();
        $data['title'] = 'User Deleted'; //($page->name)??(($site_title)??'Page');

        return view('admin.pages.show', $data);
    }
}
