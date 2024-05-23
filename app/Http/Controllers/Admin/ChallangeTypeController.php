<?php

namespace App\Http\Controllers\Admin;
use App\ChallangeType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChallangeTypeController extends Controller
{
    public function index()
    {
        $d['title'] = "Challange Type";
        $d['challangesType'] = ChallangeType::paginate(10);
        return view('admin.challange-type.index',$d);
    }
    public function store(Request $request)
    {
        // code...
        $request->validate([
            'name' => 'required',
            'logo' => 'mimes:png,jpg,jpeg',
        ]);
        
        
        $newOrOld = ChallangeType::updateOrcreate([
            'id'    => $request->id,
        ],[
            'name'  => $request->name,
            'description'  => $request->description,
        ]);
        if($request->file('logo')) {
            $file = $request->file('logo');
            $imageName = $this->UpdateImage($file, 'assets/logo');
            $newOrOld->image = $imageName;
            $newOrOld->save();
        }
        $msg = isset($request->id)?'Challange Updated Successfully':'Challange Created Successfully';
        return redirect()->route('admin.challange-type.index')->with('msg', $msg);
    }

    public function create()
    {
        // code...
        return view('admin.challange-type.edit');
    }

    public function edit($id)
    {
        // code...
        $d['type'] = ChallangeType::where('id',$id)->first();
        return view('admin.challange-type.edit',$d);
    }

    public function destroy($id)
    {
        //
        $data = ChallangeType::find($id);
        $data->delete();
        $msg = 'Challange Type Deleted Successfully';
        return redirect()->route('admin.challange-type.index')->with('msg', $msg);
    }
}
