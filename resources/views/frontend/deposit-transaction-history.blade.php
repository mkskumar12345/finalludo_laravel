@extends('layouts.frontend')
@section('content')

         @if(count($transaction)>0)
         @foreach($transaction as $item)
            <div class="w-100 py-3 d-flex align-items-center list-item">
                <div class="center-xy list-date mx-2">
                    <div>{{ date('d M', strtotime($item->created_at)) }}</div>
                    <small>{{ date('h:i A', strtotime($item->created_at)) }}</small>
                </div>
                <div class="list-divider-y"></div>
                <div class="mx-3 d-flex list-body">
                    <div class="d-flex align-items-center"></div>
                    <div class="d-flex flex-column font-8">
                        {{ $item->title ?? 'Add Money' }}.
                        <div class="games-section-headline">Order ID: {{ $item->order_id ?? '' }}</div>
                    </div>
                </div>
                <div class="right-0 d-flex align-items-end pr-3 flex-column">
                    <div class="d-flex float-right font-8">
                        <div class="ml-1 mb-1">
                            <img height="21px" width="21px" src="{{ url('assets/front/images/global-rupeeIcon.png') }}" alt="">
                        </div>
                        <span class="pl-1 " style="@if($item->type == 'debit') color:red; @endif @if($item->type == 'credit') color:green; @endif">
                            <b>₹{{ number_format((float) $item->amount ?? 0, 2) }}</b>
                        </span>
                    </div>
                    <span class="pl-1" style="font-size: 10px; opacity: 0.5px;">
                        @if(!empty($item->closing_balance))
                            Closing balance: ₹{{ number_format((float) $item->closing_balance ?? 0, 2) }}
                        @else
                            -
                        @endif
                    </span>
                </div>
            </div>
        @endforeach

         {{$transaction->links()}}
      @else
        <div class="cxy flex-column px-4 text-center" style="margin-top: 70px;"><img src="images/no-data.jpg"
               width="280px" alt="">
            <div class="games-section-title mt-4" style="font-size: 1.2em;">No transactions yet!</div>
            <div class="games-section-headline mt-2" style="font-size: 0.85em;">Seems like you haven’t done any activity
               yet</div>
         </div> 
      </div>
      @endif
     
@endsection
