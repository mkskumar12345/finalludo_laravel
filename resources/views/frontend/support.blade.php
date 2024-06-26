@extends('layouts.frontend')
@section('content')
<div class="cxy flex-column mx-4" style="margin-top: 70px;">
<img src="{{url('assets/front/images/support.jpg')}}" width="280px" alt="">
<div class="games-section-title mt-4 text-center" style="font-size: 1em;"><p>Support timing 24x7</p><p>  All Time Support </p></div>

</div>
<div class="container mt-2">
    <div class="row mr-2 ml-2"> <hr>
        <div class="col-6"><svg style="
            width: 11%;
            margin-right: 2px;
            fill: #0083ff;
            " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12.001 22C6.47813 22 2.00098 17.5228 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22ZM8.89113 13.1708L8.90378 13.1628C9.48351 15.0767 9.77337 16.0337 9.77337 16.0337C9.88564 16.3442 10.04 16.3996 10.2273 16.3743C10.4145 16.3489 10.5139 16.2476 10.6361 16.1297C10.6361 16.1297 11.0324 15.7472 11.825 14.9823L14.3759 16.8698C14.8407 17.1266 15.1763 16.9941 15.2917 16.4377L16.9495 8.61641C17.1325 7.88842 16.8115 7.59644 16.247 7.82754L6.51397 11.5871C5.84996 11.854 5.85317 12.2255 6.39308 12.3911L8.89113 13.1708Z"></path></svg>
            <b>Telegram</b></div>
        <div class="col-6" >
            <div style="float: right;">
                <b><a href="https://t.me/{{$telegram ?? ''}}">{{$telegram ?? ''}}</a></b>
            </div>
        </div>
        
        
    </div>


    <div class="row mr-2 ml-2"> <hr>
        <div class="col-6"><svg style="    width: 11%;
            margin-right: 2px;
            fill: green;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
<path d="M7.253 18.494l.724.423A7.953 7.953 0 0 0 12 20a8 8 0 1 0-8-8c0 1.436.377 2.813 1.084 4.024l.422.724-.653 2.401 2.4-.655zM2.004 22l1.352-4.968A9.954 9.954 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.954 9.954 0 0 1-5.03-1.355L2.004 22zM8.391 7.308c.134-.01.269-.01.403-.004.054.004.108.01.162.016.159.018.334.115.393.249.298.676.588 1.357.868 2.04.062.152.025.347-.093.537a4.38 4.38 0 0 1-.263.372c-.113.145-.356.411-.356.411s-.099.118-.061.265c.014.056.06.137.102.205l.059.095c.256.427.6.86 1.02 1.268.12.116.237.235.363.346.468.413.998.75 1.57 1l.005.002c.085.037.128.057.252.11.062.026.126.049.191.066a.35.35 0 0 0 .367-.13c.724-.877.79-.934.796-.934v.002a.482.482 0 0 1 .378-.127c.06.004.121.015.177.04.531.243 1.4.622 1.4.622l.582.261c.098.047.187.158.19.265.004.067.01.175-.013.373-.032.259-.11.57-.188.733a1.155 1.155 0 0 1-.21.302 2.378 2.378 0 0 1-.33.288 3.71 3.71 0 0 1-.125.09 5.024 5.024 0 0 1-.383.22 1.99 1.99 0 0 1-.833.23c-.185.01-.37.024-.556.014-.008 0-.568-.087-.568-.087a9.448 9.448 0 0 1-3.84-2.046c-.226-.199-.435-.413-.649-.626-.89-.885-1.562-1.84-1.97-2.742A3.47 3.47 0 0 1 6.9 9.62a2.729 2.729 0 0 1 .564-1.68c.073-.094.142-.192.261-.305.127-.12.207-.184.294-.228a.961.961 0 0 1 .371-.1z"></path>        </svg>
            <b>WhataApp</b></div>
        <div class="col-6" >
            <div style="float: right;">
                <b><a href="https://wa.me/{{$whataApp ?? ''}}">{{$whataApp ?? ''}}</a></b>
            </div>
        </div>
        
        
    </div>

    <div class="row mr-2 ml-2"> <hr>
        <div class="col-6"><svg style="    width: 11%;
            margin-right: 2px;
            fill: #c00909;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M21 3C21.5523 3 22 3.44772 22 4V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V19H20V7.3L12 14.5L2 5.5V4C2 3.44772 2.44772 3 3 3H21ZM8 15V17H0V15H8ZM5 10V12H0V10H5ZM19.5659 5H4.43414L12 11.8093L19.5659 5Z"></path>       </svg>
            <b>Email</b></div>
        <div class="col-6" >
            <div style="float: right;">
                <b><a href="mailto:{{$support_email ?? ''}}">{{$support_email ?? ''}}</a></b>
            </div>
        </div>
        
        
    </div>
</div>
@endsection

