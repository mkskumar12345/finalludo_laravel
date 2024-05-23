<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChallangeCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function($data) {
            return [
                'id'                        =>(string)$data->id,
                'challange_name'            =>$data->challenge_name,
                'creator_id'                =>$data->challenge_created_by,
                'acceptor_id'               =>$data->challenge_accepted_by,
                'challenge_type'            =>(string)$data->type_name,
                'amount'                    =>(string)$data->amount,
                'challenge_created_by'      =>$data->c_name,
                'challenge_accepted_by'     =>(isset($data->a_name))?$data->a_name:'',
                'screenshort'               =>($data->screenshort && !empty($data->screenshort)) ? url('/assets/winnershort',$data->screenshort):'',
                'winning_amount'            =>$data->winning_amount,
                'status'                    =>$data->status,
                'room_code'                 => $data->room_code,
                'date'                      => Carbon::parse($data->created_at)->format('d M, Y'),
            ];
        });
    }
}
