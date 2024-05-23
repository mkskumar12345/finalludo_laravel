<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ChallangeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->challange_id,
            'challange_name' => (string)$this->challenge_name,
            'challenge_type' => (string)$this->type_name,
            'challenge_created_id' => (string)$this->challenge_created_by,
            'challenge_created_name' => (string)$this->c_name,
            'challenge_accepted_id' => (string)$this->challenge_accepted_by,
            'challenge_accepted_name' => (string)$this->a_name,
            'winning_amount' => (string)$this->winning_amount,
            'status' => (string)$this->status,
            'room_code' => (string)$this->room_code,
            'who_cancel_first' => (string)$this->who_cancel,
            'acceptor_reason' => (string)$this->acceptor_reason,
            'creator_reason' => (string)$this->creator_reason,
            'creator_action' => (string)$this->creator_action,
            'creator_image' => isset($this->creator_image)?url('assets/challangeResult/'.$this->creator_image):'',
            'acceptor_action' => (string)$this->acceptor_action,
            'acceptor_image' => isset($this->acceptor_image)?url('assets/challangeResult/'.$this->acceptor_image):'',
            'creator_time' =>  isset($this->creator_time)?Carbon::parse($this->creator_time)->diffForHumans():'',
            'acceptor_time' => isset($this->acceptor_time)?Carbon::parse($this->acceptor_time)->diffForHumans():'',
        
        ];

    }
}
