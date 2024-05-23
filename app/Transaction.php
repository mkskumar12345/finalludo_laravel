<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $table = 'transactions';
    protected $fillable = [
        'type',
        'user_id',
        'amount',
        'transactions_id',
        'screen_shot',
        'status',
        'description',
        'payment_gatway',
        'transaction_type',
        'addition_status',
        'number',
        'isAdmin',
        'withdrawal_upi_id',
        'withdrawal_method',
        'title',
        'closing_balance',
        'deposit_status',
        'externalId',
        'orderId',
        'bankRef',
        'payStatus',
        'paymentResponse',
        'mobileNo',
        'payeeName',
        'account_number',
        'ifsc_code',
        'PaymentReferenceId',
        'Message',
        'BankUTRNO',
        'CHMOD',
        'TransactionTime',
        'UpdatedTime',
    ];
    

    protected $dates = [
        'updated_at',
        'created_at',
    ];

}
