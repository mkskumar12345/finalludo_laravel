<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KycDocument;
use App\SiteSetting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Str; 
use App\User;

class KycDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title'] = 'Kyc Documents';
        $query = KycDocument::query();
        if($request->search)
        {
            $query = $query->where('name','LIKE',"%".$request->search."%");
        }
        $data['kycDocuments'] = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.kycDocuments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = 'Add KycDocument';
        return view('admin.kycDocuments.create', $data);
    }

    public function updateStatus($id, $action)
    {
        $validActions = ['Approved', 'Rejected'];

        if (!in_array($action, $validActions)) {
            return redirect()->back()->with('error', 'Invalid action.');
        }

        $kycDocument = KYCDocument::findOrFail($id);

        if ($action === 'Approved') {
            
            $userId = $kycDocument->user_id;
            $user = User::findOrFail($userId);
            $user->is_play = true;
            $user->save();
            
            $kycDocument->status = 'Approved';
            $message = 'KYC document approved successfully.';
        } else {
            $kycDocument->status = 'Rejected';
            $message = 'KYC document rejected successfully.';
        }

        $kycDocument->save();

        return redirect()->back()->with('success', $message);
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

        KycDocument::updateOrCreate(['id' => $request->id], $data);

        if(isset($request->id)) {
            $msg = 'KycDocument Updated.';
        } else {
            $msg = 'KycDocument Added.';
        }
        return redirect()->route('admin.kyc-documents.index')->with('msg', $msg);
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
        $data['urls'] = KycDocument::take(4)->get();
        $data['page'] = $page = KycDocument::where('slug', $id)->first();
        $data['title'] = ($page->name)??(($site_title)??'KycDocument');

        return view('admin.kycDocuments.show', $data);
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
        $data['title'] = 'Edit KycDocument';
        $data['page'] = KycDocument::where('id', $id)->first();
        return view('admin.kycDocuments.create', $data);
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
        KycDocument::where('id' , $id)->delete();
        return redirect()->route('admin.kycd-documents.index')->with('msg', 'Kyc Document Deleted Successfully');
    }


    public function deleteUser($user)
    {
        # code...
        User::where(function($query) use ($user){
            $query->where('id', $user)->orWhere('phone', $user);
        })->delete();

        $data['logo'] = SiteSetting::where('name','logo')->pluck('value')->first();
        // $site_title = SiteSetting::where('name','site_title')->pluck('value')->first();
        $data['urls'] = KycDocument::take(4)->get();
        // $data['page'] = ''; //$page = KycDocument::where('slug', $id)->first();
        $data['title'] = 'User Deleted'; //($page->name)??(($site_title)??'KycDocument');

        return view('admin.kycDocuments.show', $data);
    }
}
