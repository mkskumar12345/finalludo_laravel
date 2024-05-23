<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use App\GameChallange;
use App\ReferUsers;
use Auth;
class UserResource extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request);
        $gameChallange =  GameChallange::where('challenge_accepted_by',Auth::user()->id)->orWhere('challenge_created_by',Auth::user()->id)->count();
        $referAmout = ReferUsers::where('refer_by',Auth::user()->id)->sum('amount');
        $referCount = ReferUsers::where('refer_by',Auth::user()->id)->count();
        $user_id = Auth::user()->id;
        $amount = GameChallange::where('who_win',Auth::user()->id)->sum('winning_amount');

        return [
            'id' => $this->id,
            'name' => (string)$this->name,
            'email' => (string)$this->email,
            'wallet' => (string)number_format($this->wallet,2), 
            'deposit_amount' =>  (string)number_format($this->deposit_amount,2),
            'total_wallet_amount' =>  (string)number_format(($this->deposit_amount+$this->wallet),2),
            'refer_code' => (string)$this->refer_code,
            'status' =>(string)$this->status,
            'phone' =>($this->phone)?$this->phone:'',
            'played_games' => $gameChallange ?? '0',
            'refer_count' => $referCount ?? '0',    
            'total_refer_amount' => number_format(($referAmout ?? 0),2),
            'refer_link' => url('register?refer-code='.$this->refer_code),
            'winning_amount' => number_format($amount,2),
            'profile_image' =>($this->profile_image)?url($this->profile_image):'',
        ];

    }
}
