<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function($data) {
            return [
                'id'                        =>(string)$data->id,
                'name'                      =>$data->user_name,
                'amount'                    =>(string)$data->amount,
                'transactions_id'           =>(string)$data->transactions_id,
                'status'                    =>(isset($data->status))?$data->status:'',
                'screenshort'               =>($data->screen_shot && !empty($data->screen_shot)) ? url('assets/transaction',$data->screen_shot):'',
                'transaction_type'          =>$data->transaction_type,
                'payment_gatway'            =>$data->payment_gatway,
                'date'                      => Carbon::parse($data->created_at)->format('d M, Y'),
            ];
        });
    }
}
