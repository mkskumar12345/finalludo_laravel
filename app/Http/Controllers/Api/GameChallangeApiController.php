<?php

namespace App\Http\Controllers\Api;

use App\GameChallange;
use App\Http\Controllers\Controller;
use App\Helper\ResponseBuilder;
use App\Helper\Helper;
use App\User;
use App\ChallangeResult;
use App\ChallangeType;
use App\Log;
use App\Transaction;
use App\DeviceToken;
use App\SiteSetting;
use App\Income;
use App\ReferUsers;
use App\WalletData;
use App\Events\CreateBettel;
use App\Events\DeleteBettel;
use App\Events\Playbettel;
use App\Events\DenyChallenge;
use App\Events\StartChallenge;
use App\Events\CancelReqBettel;
use App\Http\Resources\Admin\ChallangeCollection;
use App\Http\Resources\Admin\ChallangeResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;

use DB;

class GameChallangeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function challangeTypeList()
    {
       try {

           $types = ChallangeType::get();
           if(count($types)==0)
           {
                return ResponseBuilder::successMessage('Challange type empty',$this->success);
           }
           $data = [];
            foreach ($types as $type) {
                // code...
                $data[] = [
                    'id'  => $type->id,
                    'name' => $type->name,
                    'description' => $type->description??'',
                ];
            }
            return ResponseBuilder::success($data,'Challange type list');
       } catch (Exception $e) {
           return ResponseBuilder::error($e->getMessage(), $this->serverError);
       }
    }


    public function store(Request $request)
    {
        // return $request;
       
        if(!Auth::check()){
            return response()->json(['status' => false, 'message' => 'unauthorized' , 'data' => null]);
        }
        // return response()->json(['status' => false, 'message' => 'Game in maintenance mode. We will be back soon' , 'data' => []]);
        $ChallangeType = ChallangeType::where('slug',$request->challange_type)->first();
        if(!$ChallangeType){
            return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => []]);
        }

        
        $SiteSettingLive = SiteSetting::where('name','is_live')->first();
        if(!isset($SiteSettingLive) || empty($SiteSettingLive)){
            $isLive = 0;
        }else{
            $isLive =  $SiteSettingLive->value; 
        }
        if($isLive==0){
            return response()->json(['status' => false, 'message' => 'Game in maintenance mode. We will be back soon' , 'data' => []]);
        }
        $user = Auth::user();
        $user_id = $user->id;
		if($user_id == 32){
			 
		}
        $GameChallange = GameChallange::where(function ($query) use ($user_id) {
							$query->where('challenge_accepted_by', $user_id)
								->orWhere('challenge_created_by', $user_id);
							})
							->whereIn('status', ['accepted', 'challange_created', 'in_review'])
							->get();
        if(count($GameChallange)>0){
            return response()->json(['status' => false, 'message' => 'Please wait until your previous challenge is not completed' , 'data' => null]);
        }

        if($user->is_play == 0){
            return response()->json(['status' => false, 'message' => 'You kyc not updated so please update to play game' , 'data' => null]);
        }
       
        //if(empty($roomCodeData)){
           // return response()->json(['status' => false, 'message' => 'Something went wrong with system' , 'data' => null]);

        //}

        $validator = Validator::make($request->all(), [
            'id'       => 'nullable|exists:game_challenge,id',
            'amount' => 'required|numeric|not_in:0',
            // 'room_code' => 'required|numeric',
        ]);
        if ($request->amount % 50 != 0) {
            return response()->json(['status' => false, 'message' => 'Enter valid amount' , 'data' => null]);

          }
        // $roomCodeData = !empty($request->room_code) ? $request->room_code : $roomCodeData;
        $SiteSetting = SiteSetting::where('name','min_bid_amount')->first();
        $SiteSetting2 = SiteSetting::where('name','max_bid_amount')->first();
        if(!$SiteSetting){
            $SiteSettingValue = 50;
        }else{
            $SiteSettingValue = $SiteSetting->value;
        }
        // return $SiteSetting2;
        if(!$SiteSetting2){
            $SiteSettingValue2 = 10000;
        }else{
            $SiteSettingValue2 = $SiteSetting2->value;
        }
        // return $SiteSetting2;
        if($SiteSettingValue > $request->amount){
            return response()->json(['status' => false, 'message' => "Minimum bet is $SiteSettingValue" , 'data' => null]);
        }
         if($SiteSettingValue2 < $request->amount){
            return response()->json(['status' => false, 'message' => "Maximum bet is $SiteSettingValue2" , 'data' => null]);
        }
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first() , 'data' => null]);
        }
        $challenges = GameChallange::whereIn('status', ['accepted','challange_created','in_review'])
            ->where(function ($query) use($user_id){
                $query->where('challenge_created_by',$user_id)
                ->orWhere('challenge_accepted_by',$user_id);
            })
            ->get();
        // mk
        // if(count($challenges)>0)
        // {
        //     return response()->json(['status' => false, 'message' => 'Please wait until your previous challenge is not completed' , 'data' => null]);
        // }

        if(!isset($request->id))
        {
            // mk
            // if(count($challenges)>0)
            // {
            //     return response()->json(['status' => false, 'message' => 'Please wait until your previous challenge is not completed' , 'data' => null]);
            // }
            if($request->amount  > ($user->wallet + $user->deposit_amount))
            {
              return response()->json(['status' => false, 'message' => 'Insufficient balance' , 'data' => null]);

            }
        }

        try {
            DB::beginTransaction();
            if($user->deposit_amount >= $request->amount){
                $user->deposit_amount  = $user->deposit_amount - $request->amount;
                $user->save();
                $walletAmount = 0;
                $depositAmount = $request->amount;
            }elseif($user->deposit_amount < $request->amount && $user->deposit_amount > 0){
                $currantBalancec = $user->deposit_amount;
                $user->deposit_amount  = $user->deposit_amount - $request->amount;
                $user->wallet = $user->wallet - ($request->amount - $currantBalancec);
                $user->deposit_amount = 0;
                $user->save();

                $walletAmount = $request->amount - $currantBalancec;
                $depositAmount = $currantBalancec;

            }elseif($user->wallet >= $request->amount ){
                $user->wallet = $user->wallet - $request->amount;
                $user->save();

                $walletAmount = $request->amount;
                $depositAmount = 0;

            }else{
                return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => null]);
            }
            //if($ChallangeType->id=='5'){
               // $roomCodeData = null;
            //}
            $challenge = GameChallange::updateOrCreate([
                'id' => $request->id
            ],[
                'challenge_name' => Auth::user()->name ?? 'Guest User',
                'challenge_type'  => $ChallangeType->id,
                'amount'          => $request->amount,
                'challenge_created_by' => $user_id,
                'winning_amount'  => $this->winningAmount($request->amount),
                'status'         => 'challange_created',
                'room_code'      => null,
                'slug'      => Str::random(30),
            ]);
            WalletData::create([
                'user_id' => Auth::user()->id,
                'challange_id' => $challenge->id,
                'wallet' => $walletAmount,
                'deposit' => $depositAmount,
            ]);
            if(!isset($request->id))
            {
                ChallangeResult::create(['challange_id' => $challenge->id]);
                // User::where('id', $user_id)->decrement('wallet', $request->amount);
            }
            // $tokens = DeviceToken::where('user_id','!=', $user_id)->pluck('device_token')->toArray();
            $myWalletBalance = number_format(($user->wallet  + $user->deposit_amount ),2);
            DB::commit();
            $returnData  = [
                'id' => $challenge->id,
                'cname' => $challenge->challenge_name,
                'amount' => $challenge->amount,
            ];
          $createBettelPuser = [
                'id' => $challenge->id,
                'c_id' => $challenge->challenge_created_by,
                'cname' => $challenge->createBy->name??'Guest User',
                'oname' => $challenge->acceptedBy->name ?? 'Guest User',
                'amount' => $challenge->amount,
                'status' => $challenge->status,
                'o_id' => $challenge->challenge_accepted_by,
                'prize' => $challenge->winning_amount,
                'challenge_type' => $request->challange_type,
                'c_image' => !empty($challenge->createBy->profile_image) ? url($challenge->createBy->profile_image) : url('/assets/front/images/avatar.png'),
                'o_image' => !empty($challenge->acceptedBy->profile_image) ? url($challenge->acceptedBy->profile_image) : url('/assets/front/images/avatar.png'),
            ];
            event(new CreateBettel($createBettelPuser));
            // event(new App\Events\CreateBettel($createBettelPuser));
            return response()->json(['status' => true, 'message' => 'Battle created' ,'myWalletBalance' => $myWalletBalance ,'data' => $returnData]);

        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
            return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => null]);
        }
       
        
    }


    public function challangeList(Request $request)

    {
        // return $request;
        //
        try
        {
            
            $user = Auth::user();
            
            $ChallangeType = ChallangeType::where('slug',$request->getGameType)->first();
            if(!$ChallangeType){
                return response()->json(['status' => true, 'message' => 'Something went wrong' , 'data' => []]);

            }

            $data['myChallenges'] = GameChallange::where('status','!=','complete')->where('challenge_type',$ChallangeType->id)->take(200)->orderBy('id','desc')->get()->map( function($data){
                return [
                    'id' => $data->id,
                    'c_id' => $data->challenge_created_by,
                    'cname' => $data->createBy->name??'Guest User',
                    'oname' => $data->acceptedBy->name ?? 'Guest User',
                    'amount' => $data->amount,
                    'status' => $data->status,
                    'o_id' => $data->challenge_accepted_by,
                    'prize' => $data->winning_amount,
                    'requested' => $data->requested,
                    'c_image' => !empty($data->createBy->profile_image) ? url($data->createBy->profile_image) : url('/assets/front/images/avatar.png'),
                    'o_image' => !empty($data->acceptedBy->profile_image) ? url($data->acceptedBy->profile_image) : url('/assets/front/images/avatar.png'),
                ];
            });
            $data['challengeRunning'] = GameChallange::where('status','running')->where('challenge_type',$ChallangeType->id)->orderBy('id','desc')->take(1)->get()->map( function($data){
                 return [
                     'id' => $data->id,
                     'c_id' => $data->challenge_created_by,
                     'cname' => $data->createBy->name??'Guest User',
                     'oname' => $data->acceptedBy->name ?? 'Guest User',
                     'amount' => $data->amount,
                     'status' => $data->status,
                     'o_id' => $data->challenge_accepted_by,
                     'prize' => $data->winning_amount,
                     'requested' => $data->requested,
                 ];
             });

            $data['challengeinreview'] = GameChallange::orWhere('challenge_accepted_by',Auth::user()->id)->orWhere('challenge_created_by',Auth::user()->id)->where('challenge_type',$ChallangeType->id)->orderBy('id','desc')->take(3)->get();
             $html = '';
             foreach($data['challengeinreview'] as $item){
               if($item->status=='running' || $item->status=='in_review'){
                $userID = $item->challenge_created_by == Auth::user()->id ? $item->challenge_accepted_by : $item->challenge_created_by;
                $user = User::where('id',$userID)->first(); 
                $profilePic = !empty($user->profile_image) ? url($user->profile_image) : url('/assets/front/images/avatar.png');
                $gameURL = url('game-details',$item->slug);
                if($item->challenge_type == $ChallangeType->id){
                $html .= '
                <li class="list-group-item appear-from-left p-0"style="border: none !important;margin-top: 9px;">
                   <div class=" card">
                      <div class="d-flex align-items-center justify-content-between card-header">
                      <span class="text-capitalize">running challenge with</span><span class="text-success fw-bold"><b>Rs '.$item->amount.'</b></span></div>
                      <div class="d-flex align-items-center justify-content-between card-body bet__cover">
                         <div class="d-flex align-items-center flex-grow-1">
                            <div class="d-flex align-items-center">
                               <div class="rounded-circle me-2" style="height: 24px; width: 24px;">
                               <img class="cover__image" src="'.$profilePic.'" alt="avatar"></div>
                               <span class="fw-semibold text-truncate text-start ml-2" style="width: 100px;font-size: 13px;"><b>'.$user->name.'</b></span>
                            </div>
                         </div>
                         <a href="'.$gameURL.'" ><div class="d-flex align-items-center"><button class="btn btn-success playChallange btn-sm" type="button">View</button></div> </a>
                      </div>
                   </div>
                </li>';}
               }
             }
             
             $data['myRunnungCallenge'] = $html;
            // return $data['challenges'];
            // if(empty($challange))
            // {   $data['myChallenges'] = [];
            //     return response()->json(['status' => true, 'message' => 'No data' , 'data' => $data]);
            // }

            // $this->response = new ChallangeCollection($challange);




            $runningChalllanges = '';
            $rand = rand(10,40);
            for ($i=0; $i < 25 ; $i++) { 
               $runningChalllanges .= '<li class="p-0 overflow-hidden appear-from-left apped_data">
               <div class="my-1 card pb-2"><div class="text-start">
               <div class="d-flex align-items-center justify-content-between card-header bet_header">
               <div class="d-flex align-items-center"><div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="62-add-spiner">
                <img class="cover__image" src="/assets/front/images/avatar.png"></div><span class="fw-semibold text-truncate" style="width: 100px; font-size: 13px;"><b class="ml-2">'.Helper::generateName().'</b></span>
                </div><div><img src="/assets/front/images/vs.c153e22fa9dc9f58742d.webp" height="40" alt="vs"></div><div class="d-flex flex-row-reverse align-items-center">
                <div class=" rounded-circle me-2" style="height: 24px; width: 24px;" id="62-add-spiner"><img class="cover__image" src="/assets/front/images/avatar.png">
                </div><span class=" fw-semibold text-truncate" style="width: 100px; font-size: 13px;"><b class="ml-2">'.Helper::generateName().'</b></span></div></div>
                <div class="d-flex align-items-center justify-content-center pt-3"><span class="text-success fw-bold"><b>Rs '.Helper::randomPrice().'</b></span></div>
                </div></div></li>';
            }
            
            $data['runningChalllanges'] = $runningChalllanges;

            return response()->json(['status' => true, 'message' => 'list' , 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => $data]);

            //throw $th;
        }

    }
    public function denyChallenge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ch_id'       => 'required|exists:game_challenge,id',
        ]);
    
        if ($validator->fails()) {
            return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
        }
        try
        {
           $user = Auth::user();
           $myChallenges = GameChallange::where('id',$request->ch_id)->where('status','requested')->first();
           if(!$myChallenges){
            return response()->json(['status' => false, 'message' => 'Battle not found' , 'data' => null]);
           }
           $reqUser = User::where('id',$myChallenges->challenge_accepted_by)->first();
           $WalletData = WalletData::where('user_id',$reqUser->id)->where('challange_id',$myChallenges->id)->first();
           if(!empty($WalletData) && ($WalletData->wallet+ $WalletData->deposit) == $myChallenges->amount){
               $reqUser->wallet = $reqUser->wallet + $WalletData->wallet;
               $reqUser->deposit_amount = $reqUser->deposit_amount + $WalletData->deposit;
               $reqUser->save();
               $WalletData->delete();
           }else{
               $reqUser->wallet = $reqUser->wallet + $myChallenges->amount;
               $reqUser->save();
           }

           $myChallenges->status = 'challange_created';
           $myChallenges->challenge_accepted_by = null;
           $myChallenges->save();

           $data['ch_id'] = $myChallenges->id;
           $createBettelPuser = [
            'id' => $myChallenges->id,
            'c_id' => $myChallenges->challenge_created_by,
            'cname' => $myChallenges->createBy->name??'Guest User',
            'oname' => $myChallenges->acceptedBy->name ?? 'Guest User',
            'amount' => $myChallenges->amount,
            'status' => $myChallenges->status,
            'o_id' => $myChallenges->challenge_accepted_by,
            'prize' => $myChallenges->winning_amount,
            'challenge_type' => $request->challange_type,
            'c_image' => !empty($myChallenges->createBy->profile_image) ? url($myChallenges->createBy->profile_image) : url('/assets/front/images/avatar.png'),
            'o_image' => !empty($myChallenges->acceptedBy->profile_image) ? url($myChallenges->acceptedBy->profile_image) : url('/assets/front/images/avatar.png'),
        ];
        event(new DenyChallenge($createBettelPuser));
            return response()->json(['status' => true, 'message' => 'success' , 'data' => $data]);
        } catch (\Throwable $th) {
            return ResponseBuilder::error("Something went wrong", $this->serverError);
            //throw $th;
        }

    }
    public function challengeRequesting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ch_id'       => 'required|exists:game_challenge,id',
        ]);
        if ($validator->fails()) {
            return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
        }
        try
        {
           $user = Auth::user();
           $user_id = $user->id;
           $challenges = GameChallange::whereIn('status', ['accepted','challange_created','in_review'])
           ->where(function ($query) use($user_id){
               $query->where('challenge_created_by',$user_id)
               ->orWhere('challenge_accepted_by',$user_id);
           })
           ->get();
       if(count($challenges)>0)
       {
       return response()->json(['status' => false, 'message' => 'Please wait until your previous challenge is not completed' , 'data' => null]);
       }

           $myChallenges = GameChallange::where('id',$request->ch_id)->where('status','challange_created')->first();
           if(!$myChallenges){
            return response()->json(['status' => false, 'message' => 'Battle not found' , 'data' => null]);
           }
           if($myChallenges->amount  > ($user->wallet + $user->deposit_amount))
           {
             return response()->json(['status' => false, 'message' => 'Insufficient balance' , 'data' => null]);

           }
           DB::beginTransaction();
           if($user->deposit_amount >= $myChallenges->amount){
                $user->deposit_amount  = $user->deposit_amount - $myChallenges->amount;
                $user->save();

                $walletAmount = 0;
                $depositAmount = $myChallenges->amount;

            }elseif($user->deposit_amount < $myChallenges->amount && $user->deposit_amount > 0){
                $currantBalancec = $user->deposit_amount;
                $user->deposit_amount  = $user->deposit_amount - $myChallenges->amount;
                $user->wallet = $user->wallet - ($myChallenges->amount - $currantBalancec);
                $user->deposit_amount = 0;
                $user->save();

                $walletAmount = $myChallenges->amount - $currantBalancec;
                $depositAmount = $currantBalancec;

            }elseif($user->wallet >= $myChallenges->amount ){
                $user->wallet = $user->wallet - $myChallenges->amount;
                $user->save();

                $walletAmount = $myChallenges->amount;
                $depositAmount = 0;

            }else{
                return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => null]);
            }

           $myChallenges->status = 'requested';
           $myChallenges->challenge_accepted_by = $user->id;
           $myChallenges->save();
           $data['ch_id'] = $myChallenges->id;
           WalletData::create([
                'user_id' => Auth::user()->id,
                'challange_id' => $myChallenges->id,
                'wallet' => $walletAmount,
                'deposit' => $depositAmount,
            ]);
            DB::commit();
           $createBettelPuser = [
            'id' => $myChallenges->id,
            'c_id' => $myChallenges->challenge_created_by,
            'cname' => $myChallenges->createBy->name??'Guest User',
            'oname' => $myChallenges->acceptedBy->name ?? 'Guest User',
            'amount' => $myChallenges->amount,
            'status' => $myChallenges->status,
            'o_id' => $myChallenges->challenge_accepted_by,
            'prize' => $myChallenges->winning_amount,
            'challenge_type' => $request->challange_type,
            'c_image' => !empty($myChallenges->createBy->profile_image) ? url($myChallenges->createBy->profile_image) : url('/assets/front/images/avatar.png'),
            'o_image' => !empty($myChallenges->acceptedBy->profile_image) ? url($myChallenges->acceptedBy->profile_image) : url('/assets/front/images/avatar.png'),
        ];
        event(new Playbettel($createBettelPuser));
            return response()->json(['status' => true, 'message' => 'success' , 'data' => $data]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => $data]);

            // return ResponseBuilder::error("", $this->serverError);
            //throw $th;
        }

    }
    public function cancelChallengeReq(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ch_id'       => 'required|exists:game_challenge,id',
        ]);
        if ($validator->fails()) {
            return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
        }
        try
        {
           $user = Auth::user();
           $myChallenges = GameChallange::where('id',$request->ch_id)->where('status','requested')->first();
           if(!$myChallenges){
            return response()->json(['status' => false, 'message' => 'Battle not found' , 'data' => null]);
           }
           $reqUser = User::where('id',$myChallenges->challenge_accepted_by)->first();
           $WalletData = WalletData::where('user_id',$reqUser->id)->where('challange_id',$myChallenges->id)->first();
           DB::beginTransaction();
            if(!empty($WalletData) && ($WalletData->wallet+ $WalletData->deposit) == $myChallenges->amount){
                $reqUser->wallet = $reqUser->wallet + $WalletData->wallet;
                $reqUser->deposit_amount = $reqUser->deposit_amount + $WalletData->deposit;
                $reqUser->save();
                $WalletData->delete();

            }else{
                $reqUser->wallet = $reqUser->wallet + $myChallenges->amount;
                $reqUser->save();
            }
           
           $myChallenges->status = 'challange_created';
           $myChallenges->challenge_accepted_by = null;
           $myChallenges->save();
           $data['ch_id'] = $myChallenges->id;
           $createBettelPuser = [
            'id' => $myChallenges->id,
            'c_id' => $myChallenges->challenge_created_by,
            'cname' => $myChallenges->createBy->name??'Guest User',
            'oname' => $myChallenges->acceptedBy->name ?? 'Guest User',
            'amount' => $myChallenges->amount,
            'status' => $myChallenges->status,
            'o_id' => $myChallenges->challenge_accepted_by,
            'prize' => $myChallenges->winning_amount,
            'challenge_type' => $request->challange_type,
            'c_image' => !empty($myChallenges->createBy->profile_image) ? url($myChallenges->createBy->profile_image) : url('/assets/front/images/avatar.png'),
            'o_image' => !empty($myChallenges->acceptedBy->profile_image) ? url($myChallenges->acceptedBy->profile_image) : url('/assets/front/images/avatar.png'),
        ];
        DB::commit();
        event(new CancelReqBettel($createBettelPuser));
            return response()->json(['status' => true, 'message' => 'success' , 'data' => $data]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => $data]);

            // return ResponseBuilder::error("", $this->serverError);
            //throw $th;
        }

    }
    public function acceptChallenge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ch_id'       => 'required|exists:game_challenge,id',
        ]);
    
        if ($validator->fails()) {
            return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
        }
        try
        {
           $user = Auth::user();
           $myChallenges = GameChallange::where('id',$request->ch_id)->where('status','requested')->first();
           if(!$myChallenges){
            return response()->json(['status' => false, 'message' => 'Battle not found' , 'data' => null]);
           }
           $myChallenges->status = 'running';
           $myChallenges->save();
           $data['ch_id'] = $myChallenges->id;
           $createBettelPuser = [
            'id' => $myChallenges->id,
            'c_id' => $myChallenges->challenge_created_by,
            'cname' => $myChallenges->createBy->name??'Guest User',
            'oname' => $myChallenges->acceptedBy->name ?? 'Guest User',
            'amount' => $myChallenges->amount,
            'status' => $myChallenges->status,
            'o_id' => $myChallenges->challenge_accepted_by,
            'prize' => $myChallenges->winning_amount,
            'challenge_type' => $request->challange_type,
            'c_image' => !empty($myChallenges->createBy->profile_image) ? url($myChallenges->createBy->profile_image) : url('/assets/front/images/avatar.png'),
            'o_image' => !empty($myChallenges->acceptedBy->profile_image) ? url($myChallenges->acceptedBy->profile_image) : url('/assets/front/images/avatar.png'),
            'redirect_url' => url('/game-details',$myChallenges->slug),
        ];
        event(new StartChallenge($createBettelPuser));
            return response()->json(['status' => true, 'message' => 'success' , 'data' => $data]);
        } catch (\Throwable $th) {
            return ResponseBuilder::error("Something went wrong", $this->serverError);
            //throw $th;
        }

    }


    // public function acceptChallange(Request $request)
    // {
        
    //     if(!Auth::check()){
    //         return ResponseBuilder::error("User not found", $this->unauthorized);
    //     }
    //     $user = Auth::user();
    //     $user_id = $user->id;
        
    //     $validator = Validator::make($request->all(), [
    //         'challange_id'       => 'required|exists:game_challenge,id',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return ResponseBuilder::error($validator->errors()->first(), $this->badRequest);
    //     }

    //     if($user->is_play == 0){
    //         return ResponseBuilder::error("You are not allowed to play game",$this->badRequest);
    //     }

    //     try
    //     {
    //         DB::beginTransaction();
    //         $challagne = GameChallange::where('id',$request->challange_id)->first();
    //         if($user_id == $challagne->challenge_created_by)
    //         {
    //             return ResponseBuilder::successMessage("You can't accept your own challange", $this->success);
    //         }

    //         if($user->wallet<$challagne->amount){
    //             return ResponseBuilder::error("You don't have enough money to accept this challange",$this->badRequest);
    //         }

    //         if($challagne->status !== 'challange_created')
    //         {
    //             if($challagne->challenge_accepted_by == $user_id)
    //             {
    //                 return ResponseBuilder::successMessage("You already accept this challange", $this->success);
    //             }
    //             return ResponseBuilder::successMessage("This challange is accepted by someone", $this->success);
    //         }
    //         User::where('id',$user_id)->decrement('wallet',$challagne->amount);
    //         $challagne->challenge_accepted_by = $user_id;
    //         $challagne->status = 'accepted';
    //         $challagne->save();
    //         Transaction::create([
    //             'user_id'  => $user_id,
    //             'amount'  => $challagne->amount,
    //             'transaction_type'  => 'challange_dr',
    //             'addition_status'  => 'approve',
    //             'status'  => 'success',
    //         ]);
    //         Log::create([
    //             'user_id'   => $user_id,
    //             'action'    =>'dr',
    //             'amount'    => $challagne->amount,
    //             'description' => 'You accepted challagne for '.$challagne->amount,
    //         ]);
    //         DB::commit();

    //         // creator msg
    //         $title = 'Challange accepted';
    //         $msg = $this->userInfo($user_id)->name.' '.'is accepted your challagne'.$challagne->challenge_name;
    //         $this->notify($this->getDeviceToken($challagne->challenge_created_by),$title,$msg);
    //         //acceptor msg
    //         $msg1 = 'You successfully accepted '.$this->userInfo($challagne->challenge_created_by)->name.' challagne '.$challagne->challenge_name;
    //         $this->notify($this->getDeviceToken($user_id),$title,$msg1);

    //         return ResponseBuilder::successMessage("Challange accepted successfully", $this->success);
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return ResponseBuilder::error("Something went wrong".$th->getMessage().' at: '.$th->getLine(), $this->serverError);
    //         //throw $th; 
            
    //     }
    // }


    public function challangeHistory()
    {
        
        try {
            if(!Auth::check())
            {
                return ResponseBuilder::error("User not authorized", $this->unauthorized);
            }
            $user_id = Auth::user()->id;
            $challenges = GameChallange::leftJoin('users as uc','uc.id','game_challenge.challenge_created_by')
                ->leftJoin('users as ua','ua.id','game_challenge.challenge_accepted_by')
                ->join('challange_type','challange_type.id','game_challenge.challenge_type')
                // ->where('game_challenge.status',$status)
                ->where(function ($query) use($user_id) {
                    $query->where('game_challenge.challenge_created_by',$user_id)
                    ->orWhere('game_challenge.challenge_accepted_by',$user_id);
                })
                ->select('ua.name as a_name','uc.name as c_name','game_challenge.*','challange_type.name as type_name')
                ->get();
            if(count($challenges) == 0) {
                return ResponseBuilder::successMessage('No data found', $this->success);
            }
            $this->response = new ChallangeCollection($challenges);
            return ResponseBuilder::success($this->response,"All challange history");
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseBuilder::error($th->getMessage(), $this->serverError);
        }
    }

 
    public function deleteChallange(Request $request)
    {
        $user_id = Auth::user()->id;
        try {
        $challenges = GameChallange::where('challenge_created_by',$user_id)->where('id',$request->ch_id)->first();
        if(!$challenges)
        {
            return response()->json(['status' => false, 'message' => 'No challagne found' , 'data' => null]);

        }
        if($challenges->status != 'challange_created')
        {
            return response()->json(['status' => false, 'message' => "You can't delete this challange now" , 'data' => null]);
        }
        $authData = Auth::user();
        $WalletData = WalletData::where('user_id',Auth::user()->id)->where('challange_id',$challenges->id)->first();
        if(!empty($WalletData) && ($WalletData->wallet+ $WalletData->deposit)==$challenges->amount){
            $authData->wallet = $authData->wallet + $WalletData->wallet;
            $authData->deposit_amount = $authData->deposit_amount + $WalletData->deposit;
            $WalletData->delete();
        }else{
            $authData->wallet = $authData->wallet + $challenges->amount;
        }

        $authData->save();
        $data = $challenges->delete();
        $myWalletBalance = number_format((Auth::user()->wallet ?? 0) + (Auth::user()->deposit_amount ?? 0),2);

        $createBettelPuser = [
            'id' => $challenges->id,
            'c_id' => $challenges->challenge_created_by,
            'cname' => $challenges->createBy->name??'Guest User',
            'oname' => $challenges->acceptedBy->name ?? 'Guest User',
            'amount' => $challenges->amount,
            'status' => $challenges->status,
            'o_id' => $challenges->challenge_accepted_by,
            'prize' => $challenges->winning_amount,
            'challenge_type' => $request->challange_type,
            'c_image' => !empty($challenges->createBy->profile_image) ? url($challenges->createBy->profile_image) : url('/assets/front/images/avatar.png'),
            'o_image' => !empty($challenges->acceptedBy->profile_image) ? url($challenges->acceptedBy->profile_image) : url('/assets/front/images/avatar.png'),
        ];
        event(new DeleteBettel($createBettelPuser));

        if($data)
        return response()->json(['status' => true, 'message' => "Battel deleted" ,'myWalletBalance' => $myWalletBalance ,'data' => $challenges->id]);

        } catch (\Throwable $th) {
        return response()->json(['status' => false, 'message' => "Something went wrong" , 'data' => null]);

        }
    }

    public function markResult(Request $request)
    {
        // code...
        // dd($request->image);
        if(!Auth::check())
        {
            return response()->json(['status' => false, 'message' => 'User not found' , 'data' => null]);

        }
        $user = Auth::user();

        $validator = Validator::make($request->all(),[
            'challange_id'      => 'required|exists:game_challenge,slug',
            'result'            => 'required|in:winner,looser',
            'image'             => 'required_if:result,winner|mimes:jgp,png,jpeg'
        ]);
        if($validator->fails())
        {
            return response()->json(['status' => false, 'message' => $validator->errors()->first() , 'data' => null]);
        }
        try {
            // DB::beginTransaction();
            $challagne = GameChallange::where('slug',$request->challange_id)->first();
            if($challagne->status=='complete'){
                return response()->json(['status' => false, 'message' => 'challange already completed' , 'data' => null]);
            }
            $admin_income = ((2*$challagne->amount) - $this->winningAmount($challagne->amount));
            $income = [
                'challange_id' => $challagne->id,
                'challange_amount' => $challagne->amount,
                'income'            => $admin_income,
            ];

            $transaction = new Transaction;
            $transaction->amount = $challagne->winning_amount;
            $transaction->transaction_type = 'win_battle';
            $transaction->addition_status = 'approve';
            $transaction->transactions_id =  Helper::generateTransactionID();
            $transaction->status = 'success';

            //lost transction 

            $transactionLost = new Transaction;
            $transactionLost->amount = $challagne->amount;
            $transactionLost->transaction_type = 'lost_battel';
            $transactionLost->addition_status = 'approve';
            $transactionLost->transactions_id =  Helper::generateTransactionID();
            $transactionLost->status = 'success';
            $transactionLost->type = 'debit';

            $challagneCreatorName = $challagne->createBy->name ?? 'Guest User';
            $challagneAcceptorName = $challagne->acceptedBy->name ?? 'Guest User';

            if($challagne->challenge_created_by == $user->id)
            {
                $c_id = $user->id;
                $resultAcceptor = ChallangeResult::where('challange_id',$challagne->id)
                                ->pluck('acceptor_action')->first();

                ChallangeResult::updateOrCreate([
                    'challange_id'       => $challagne->id,
                ],[
                    'creator_action'        => $request->result,
                    'creator_image'         => !empty($request->image)  ? $this->challangeImage($request->image) : '',
                    'creator_time'          => Carbon::now(),
                ]);

                if(!empty($resultAcceptor)){
                    if(($resultAcceptor == 'looser') && ($request->result == 'winner')){
                        $challagne->who_win = $c_id;
                        $challagne->status = 'complete';
                        $useraccount = User::where('id',$c_id)->increment('wallet',$challagne->winning_amount);
                        Income::create($income);
                        $cloneBall = User::where('id',$c_id)->first();
                        $transaction->user_id = $c_id;
                        $transaction->type = 'credit';
                        $transaction->title	 = "Won Against $challagneAcceptorName";
                        $transaction->closing_balance = ($cloneBall->wallet ?? 0) + ($cloneBall->deposit_amount ?? 0);
                        $transaction->save();

                        $transactionLost->title	 = "Lost Against $challagneCreatorName";
                        $transactionLost->closing_balance = ($challagne->acceptedBy->wallet ?? 0) + ($challagne->acceptedBy->deposit_amount ?? 0);
                        $transactionLost->user_id = $challagne->acceptedBy->id;
                        $transactionLost->save();


                    }
                    elseif(($resultAcceptor == 'winner') && ($request->result == 'looser'))
                    {
                        $challagne->who_win = $challagne->challenge_accepted_by;
                        $challagne->status = 'complete';
                        $useraccount = User::where('id',$challagne->challenge_accepted_by)
                                        ->increment('wallet',$challagne->winning_amount);
                        Income::create($income);
                        $cloneBall = User::where('id',$challagne->challenge_accepted_by)->first();
                        $transaction->type = 'credit';
                        $transaction->title	 = "Won Against $challagneCreatorName";
                        $transaction->user_id = $challagne->challenge_accepted_by;
                        $transaction->closing_balance = ($cloneBall->wallet ?? 0) + ($cloneBall->deposit_amount ?? 0);
                        $transaction->save();
                        $transactionLost->title	 = "Lost Against $challagneAcceptorName";

                        $transactionLost->closing_balance = ($user->wallet ?? 0) + ($user->deposit_amount ?? 0);
                        $transactionLost->user_id = $user->id;
                        $transactionLost->save();

                    }
                    else{
                        $challagne->status = 'in_review';
                    }
                }
                else
                {
                    $challagne->status = 'in_review';
                }

            }
            elseif($challagne->challenge_accepted_by == $user->id)
            {
                $resultCreator = ChallangeResult::where('challange_id',$challagne->id)
                                ->pluck('creator_action')->first();
                ChallangeResult::updateOrCreate([
                    'challange_id'       => $challagne->id,
                ],[
                    'acceptor_action'      => $request->result,
                    'acceptor_image'    =>   !empty($request->image)  ? $this->challangeImage($request->image) : '',
                    'acceptor_time'        => Carbon::now(),
                ]);

                if(!empty($resultCreator)){
                    if(($resultCreator == 'looser') && ($request->result == 'winner')){

                     

                        $challagne->who_win = $challagne->challenge_accepted_by;
                        $challagne->status = 'complete';
                        $useraccount = User::where('id',$challagne->challenge_accepted_by)
                                    ->increment('wallet',$challagne->winning_amount);
                        Income::create($income);
                        $cloneBall = User::where('id',$challagne->challenge_accepted_by)->first();
                        $transaction->user_id = $challagne->challenge_accepted_by;
                        $transaction->type = 'credit';
                        $transaction->title	 = "Won Against $challagneCreatorName";
                        $transaction->closing_balance = ($cloneBall->wallet ?? 0) + ($cloneBall->deposit_amount ?? 0);
                        $transaction->save();

                       

                        $transactionLost->closing_balance = ($challagne->createBy->wallet ?? 0) + ($challagne->createBy->deposit_amount ?? 0);
                        $transactionLost->user_id = $challagne->createBy->id;
                        $transactionLost->title	 = "Lost Against $challagneAcceptorName";
                        $transactionLost->save();

                    }
                    elseif(($resultCreator == 'winner') && ($request->result == 'looser'))
                    {
                        $challagne->who_win = $challagne->challenge_created_by;
                        $challagne->status = 'complete';
                        $useraccount = User::where('id',$challagne->challenge_created_by)
                                        ->increment('wallet',$challagne->winning_amount);
                        Income::create($income);
                        $cloneBall = User::where('id',$challagne->challenge_created_by)->first();
                        $transaction->user_id = $challagne->challenge_created_by;
                        $transaction->type = 'credit';
                        $transaction->title	 = "Won Against $challagneAcceptorName";
                        $transaction->closing_balance = ($cloneBall->wallet ?? 0) + ($cloneBall->deposit_amount ?? 0);
                        $transaction->save();

                        $transactionLost->title	 = "Lost Against $challagneCreatorName";
                        $transactionLost->closing_balance = ($challagne->acceptedBy->wallet ?? 0) + ($challagne->acceptedBy->deposit_amount ?? 0);
                        $transactionLost->user_id = $challagne->acceptedBy->id;
                        $transactionLost->save();
                    }
                    else{
                        $challagne->status = 'in_review';
                    }
                }
                else
                {
                    $challagne->status = 'in_review';
                }


                
            }else{
                return response()->json(['status' => false, 'message' => 'You have no access to post result' , 'data' => null]);

            }
            if(isset($transaction) && isset($transaction->user_id) && !empty($transaction->user_id)){
                $ReferUsers = ReferUsers::where('user_id',$transaction->user_id)->first();                       
                if(!empty($ReferUsers) && !empty($ReferUsers->refer_by)){
                    $refer = SiteSetting::where('name','refer_amount')->pluck('value')->first();
                    if(!$refer){
                        $refer = 2;  
                    }
                    $referAmount = ($challagne->amount*$refer)/100;
                    $referUser = User::where('id',$ReferUsers->refer_by)->first();
                    if(!empty($referUser)){
                        $referUser->increment('wallet',$referAmount);
                        $referUser->save();
                        $transaction2 = new Transaction;
                        $transaction2->amount = $referAmount;
                        $transaction2->transaction_type = 'earn_refer';
                        $transaction2->addition_status = 'approve';
                        $transaction2->title	 = 'Earn by refer';
                        $transaction2->user_id = $ReferUsers->refer_by;
                        $transaction2->status = 'success';
                        $transaction2->transactions_id =  Helper::generateTransactionID();
                        $transaction2->type = 'credit';
                        $transaction2->closing_balance = ($referUser->wallet ?? 0) + ($referUser->deposit_amount ?? 0);
                        $transaction2->save();
                        $ReferUsers->amount =$ReferUsers->amount + $referAmount;
                        $ReferUsers->save();
                    }
                }
            }   

            $challagne->save();
            // DB::commit();
            return response()->json(['status' => true, 'message' => 'Result Updated successfully' , 'data' => null]);

        } catch (Exception $e) {
            // DB::rollback();
            return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => null]);
        }
    }

    public function cencelChallange(Request $request)
    {
        // code...
        // return $request;
        if(!Auth::check())
        {
            return response()->json(['status' => false, 'message' => 'User not found' , 'data' => null]);

        }
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'challange_id'    => 'required|exists:game_challenge,slug',
             'reason'          => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first() , 'data' => null]);

        }
        try
        {
            $challagne = GameChallange::where('slug',$request->challange_id)->where('status','!=','complete')->where('status','!=','cancel')->first();
            $challagneData =  ChallangeResult::where('challange_id',$challagne->id)->first();
            // if($challagne->status == 'running'){

                $trasn = Transaction::where('user_id',Auth::user()->id)->where('transaction_type','cancel_refund')->orderBy('id','desc')->first();
                $current_time = Carbon::now()->toDateTimeString();
                if(!empty($trasn)){
                    $xx =  date('Y-m-d H:i:s', strtotime($current_time));
                    $xx2 =  date('Y-m-d H:i:s', strtotime($trasn->created_at));
                    $start = Carbon::parse($xx2);
                    $end = Carbon::parse($xx);
                    $total = $start->diffInSeconds($end);
                }else{
                    $total = 40; 
                }

            if($total > 30 && !empty($challagne)){
                    if($challagne->challenge_created_by == $user->id && $challagneData->cencal_creator == false){
                        $challagneData->cencal_creator = 1;
                        $challagneData->cencal_creator_reason = $request->reason;
                        $challagneData->creator_cancel_time = Carbon::now();
                        $challagneData->save();
                        $challagne->status = 'in_review';
                        $challagne->save();
                        if($challagneData->cencal_acceptor == 1 && $challagneData->cencal_creator == 1){
        
                            
                            $user1 = User::where('id',$challagne->challenge_accepted_by)->first();

                            $WalletData1 = WalletData::where('user_id',$challagne->challenge_accepted_by)->where('challange_id',$challagne->id)->first();

                            if(!empty($WalletData1) && ($WalletData1->wallet+ $WalletData1->deposit) == $challagne->amount){
                                $user1->wallet = $user1->wallet + $WalletData1->wallet;
                                $user1->deposit_amount = $user1->deposit_amount + $WalletData1->deposit;
                                $user1->save();
                                $WalletData1->delete();

                            }else{
                                User::where('id',$challagne->challenge_accepted_by)->increment('wallet',$challagne->amount);
                            }

                            $challagneCreatorName = $challagne->createBy->name ?? 'Guest User';
                            Transaction::create([
                            'user_id'  => $challagne->challenge_accepted_by,
                            'amount'  => $challagne->amount,
                            'transaction_type'  => 'cancel_refund',
                            'transactions_id'  => Helper::generateTransactionID(),
                            'addition_status'  => 'approve',
                            'title'  => "Cancelled Against $challagneCreatorName",
                            'status'  => 'success',
                            'type'  => 'credit',
                            'closing_balance'  => ($user1->wallet ?? 0) + ($user1->deposit_amount ?? 0),
        
                            ]);

                            $WalletData = WalletData::where('user_id',$challagne->challenge_created_by)->where('challange_id',$challagne->id)->first();
                            $user2 = User::where('id',$challagne->challenge_created_by)->first();

                            if(!empty($WalletData) && ($WalletData->wallet+ $WalletData->deposit) == $challagne->amount){
                                $user2->wallet = $user2->wallet + $WalletData->wallet;
                                $user2->deposit_amount = $user2->deposit_amount + $WalletData->deposit;
                                $user2->save();
                                $WalletData->delete();

                            }else{
                                User::where('id',$challagne->challenge_created_by)->increment('wallet',$challagne->amount);
                            }

                            $challagneAcceptorName = $challagne->acceptedBy->name ?? 'Guest User';

                            Transaction::create([
                            'user_id'  => $challagne->challenge_created_by,
                            'amount'  => $challagne->amount,
                            'transaction_type'  => 'cancel_refund',
                            'addition_status'  => 'approve',
                            'title'  => "Cancelled Against $challagneAcceptorName",
                            'status'  => 'success',
                            'transactions_id'  => Helper::generateTransactionID(),
                            'type'  => 'credit',
                            'closing_balance'  => ($user2->wallet ?? 0) + ($user2->deposit_amount ?? 0),
        
                            ]);
        
                            $challagne->status = 'cancel';
                            $challagne->update();
                            return response()->json(['status' => true, 'message' => 'Challange cancel successfully' , 'data' => null]);
        
                        }
        
                    }elseif($challagne->challenge_accepted_by == $user->id && $challagneData->cencal_acceptor == false){
                        $challagneData->cencal_acceptor = 1;
                        $challagneData->cencal_acceptor_reason = $request->reason;
                        $challagneData->acceptor_cancel_time = Carbon::now();
                        $challagneData->save();
                        $challagne->status = 'in_review';
                        $challagne->save();
                        if($challagneData->cencal_creator == 1 && $challagneData->cencal_acceptor == 1){
        
                            $user2 = User::where('id',$challagne->challenge_accepted_by)->first();
                            $WalletData2 = WalletData::where('user_id',$challagne->challenge_accepted_by)->where('challange_id',$challagne->id)->first();

                            if(!empty($WalletData2) && ($WalletData2->wallet+ $WalletData2->deposit) == $challagne->amount){
                                $user2->wallet = $user2->wallet + $WalletData2->wallet;
                                $user2->deposit_amount = $user2->deposit_amount + $WalletData2->deposit;
                                $user2->save();
                                $WalletData2->delete();

                            }else{
                                User::where('id',$challagne->challenge_accepted_by)->increment('wallet',$challagne->amount);
                            }

                            Transaction::create([
                            'user_id'  => $challagne->challenge_accepted_by,
                            'amount'  => $challagne->amount,
                            'transaction_type'  => 'cancel_refund',
                            'addition_status'  => 'approve',
                            'title'  => 'Challange cancel refund',
                            'status'  => 'success',
                            'type'  => 'credit',
                            'transactions_id'  => Helper::generateTransactionID(),
                            'closing_balance'  => ($user2->wallet ?? 0) + ($user2->deposit_amount ?? 0),
                            ]);
        
                            
                            $user3 = User::where('id',$challagne->challenge_created_by)->first();
                            $WalletData23 = WalletData::where('user_id',$challagne->challenge_created_by)->where('challange_id',$challagne->id)->first();

                            if(!empty($WalletData23) && ($WalletData23->wallet+ $WalletData23->deposit) == $challagne->amount){
                                $user3->wallet = $user3->wallet + $WalletData23->wallet;
                                $user3->deposit_amount = $user3->deposit_amount + $WalletData23->deposit;
                                $user3->save();
                                $WalletData23->delete();

                            }else{
                                User::where('id',$challagne->challenge_created_by)->increment('wallet',$challagne->amount);
                            }

                            Transaction::create([
                            'user_id'  => $challagne->challenge_created_by,
                            'amount'  => $challagne->amount,
                            'transaction_type'  => 'cancel_refund',
                            'addition_status'  => 'approve',
                            'title'  => 'Challange cancel refund',
                            'status'  => 'success',
                            'type'  => 'credit',
                            'transactions_id'  => Helper::generateTransactionID(),
                            'closing_balance'  => ($user3->wallet ?? 0) + ($user3->deposit_amount ?? 0),
                            ]);
        
                            $challagne->status = 'cancel';
                            $challagne->update();
                            return response()->json(['status' => true, 'message' => 'Challange cancel successfully' , 'data' => null]);
        
                        }
                    }else{
                        return response()->json(['status' => false, 'message' => 'Unable to process request at this time' , 'data' => null]);
                    }
                }else{
                    return response()->json(['status' => false, 'message' => 'Request failed. try again in 30 seconds' , 'data' => null]);
                }
               
                 return response()->json(['status' => true, 'message' => 'Challange cancel successfully' , 'data' => null]);
            // }else{

            // }

        }catch(Exception $e){
            return response()->json(['status' => false, 'message' => 'Something went wrong' , 'data' => null]);
        }
        

    }

    public function singleChallange($id)
    {
        // code...
        if(!Auth::check())
        return ResponseBuilder::error('User not found',$this->unauthorized);
        try {
            
            $challagne = GameChallange::join('users as uc','uc.id','game_challenge.challenge_created_by')
            ->leftJoin('users as ua','ua.id','game_challenge.challenge_accepted_by')
            ->leftJoin('challanges_result','game_challenge.id','challanges_result.challange_id')
            ->leftJoin('challange_type','challange_type.id','game_challenge.challenge_type')
            ->where('game_challenge.id',$id)
            ->select('ua.name as a_name','uc.name as c_name','game_challenge.*','challange_type.name as type_name','challanges_result.*')->first();
            if($challagne == null)
            return ResponseBuilder::error('Data not found',$this->badRequest);

            $this->response = new ChallangeResource($challagne);
            return ResponseBuilder::success($this->response,'Single challange');

        } catch (Exception $e) {
            return ResponseBuilder::error(__($e->getMessage()),$this->serverError);
        }
    }

}