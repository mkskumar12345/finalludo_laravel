<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use DB;

class FundRequestController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        $d['title'] = 'Fund Request List';
        $d['data']  = Transaction::join('users','users.id','transactions.user_id')->where('transactions.transaction_type','add_money')
            ->orderBy('id','desc')
            ->select('users.name as user_name','transactions.*')->paginate(20);
        return view('admin.fundRequest.index',$d);
    }

    public function store(Request $request)
    {
        // code...
        try {
            DB::beginTransaction();

            $tranction = Transaction::where('id',$request->id)->first();

            if ($request->status == 'Accepted') {
                $tranction->status = "SUCCESS";
                User::where('id', $tranction->user_id)
                    ->increment('wallet', $tranction->amount); 
            } else {
                $tranction->status = "REJECTED";
                // $tranction->delete();
            }
            $tranction->save();

            DB::commit();
            $msg = 'Amount '.$request->status.' successfully';
            return redirect()->route('admin.fund-request.index')->with('msg',$msg);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.fund-request.index')->with('msg',$e->getMessage());
        }
    }

    public function destroy($id)
    {
        # code...
        $tranction = Transaction::where('id',$id)->delete();
        return redirect()->route('admin.fund-request.index')->with('msg','Delete successfully');
    }
}
