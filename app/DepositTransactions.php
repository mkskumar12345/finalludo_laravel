<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositTransactions extends Model
{

    public $table = 'deposit_transactions';
    protected $fillable = [
        'user_id',
        'is_user_paid',
        'order_id',
        'payment_url',
        'upi_id_hash',
        'upi_txn_id',
        'amount',
        'status',
        'deposit_status',
        'client_txn_id',
        'ClientReferenceId',
        'PaymentReferenceId',
        'BankUTRNO',
        'Status',
        'Message',
        'CHMOD',
        'TRANSACTIONTIME',
        'Optional1',
        'Optional2',
        'Optional3',
        'Optional4',
    ];
    
    

    protected $dates = [
        'updated_at',
        'created_at',
    ];

}
