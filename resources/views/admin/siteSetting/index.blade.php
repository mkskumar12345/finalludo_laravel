@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            Site Settings
        </h4>
    </div>
    <div class="card-body">
        <form action="{{ route("admin.site-seting.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('logo') ? 'has-error' : '' }}">
                        <label class="form-label" for="logo">Select Logo</label>
                        <input type="file" id="logo" name="logo" placeholder="{{ __('logo') }}" class="form-control"
                            value="{{ old('logo', isset($setting['logo']) ? $setting['logo'] : '') }}">
                        @if($errors->has('logo'))
                        <p class="help-block">
                            {{ $errors->first('logo') }}
                        </p>
                        @endif
                        @isset($setting['logo']) <img class="image mt-2" src="{{url('/assets/logo')}}/{{$setting['logo']}}"
                            width="120"> @endisset
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('favicon') ? 'has-error' : '' }}">
                        <label class="form-label" for="favicon">Select Favicon</label>
                        <input type="file" id="favicon" name="favicon" placeholder="{{ __('favicon') }}"
                            class="form-control"
                            value="{{ old('favicon', isset($setting['favicon']) ? $setting['favicon'] : '') }}">
                        @if($errors->has('favicon'))
                        <p class="help-block">
                            {{ $errors->first('favicon') }}
                        </p>
                        @endif
                        @isset($setting['favicon']) <img class="image mt-2"
                            src="{{url('/assets/favicon')}}/{{$setting['favicon']}}" width="120"> @endisset
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('deposit_qr') ? 'has-error' : '' }}">
                        <label class="form-label" for="deposit_qr">Payment QR</label>
                        <input type="file" id="deposit_qr" name="deposit_qr" placeholder="{{ __('deposit_qr') }}"
                            class="form-control"
                            value="{{ old('deposit_qr', isset($setting['deposit_qr']) ? $setting['deposit_qr'] : '') }}">
                        @if($errors->has('deposit_qr'))
                        <p class="help-block">
                            {{ $errors->first('deposit_qr') }}
                        </p>
                        @endif
                        @isset($setting['deposit_qr']) <img class="image mt-2"
                            src="{{url('/assets/logo')}}/{{$setting['deposit_qr']}}" width="120"> @endisset
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('site_title') ? 'has-error' : '' }}">
                        <label class="form-label" for="siteTitle">{{ __('Site Title') }}</label>
                        <input type="text" id="siteTitle" name="site_title" placeholder="{{ __('Site Title') }}"
                            class="form-control"
                            value="{{ old('site_title', isset($setting['site_title']) ? $setting['site_title'] : '') }}"
                            required>
                        @if($errors->has('site_title'))
                        <p class="help-block">
                            {{ $errors->first('site_title') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('site_address') ? 'has-error' : '' }}">
                        <label class="form-label" for="site_address">{{ __('Address') }}</label>
                        <input type="text" id="site_address" name="site_address" placeholder="{{ __('Address') }}"
                            class="form-control"
                            value="{{ old('site_address', isset($setting['site_address']) ? $setting['site_address'] : '') }}"
                            required>
                        @if($errors->has('site_address'))
                        <p class="help-block">
                            {{ $errors->first('site_address') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('contact') ? 'has-error' : '' }}">
                        <label class="form-label" for="contact">{{ __('Contact') }}</label>
                        <input type="text" id="contact" name="contact" placeholder="{{ __('Contact') }}"
                            class="form-control"
                            value="{{ old('contact', isset($setting['contact']) ? $setting['contact'] : '') }}">
                        @if($errors->has('contact'))
                        <p class="help-block">
                            {{ $errors->first('contact') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" placeholder="{{ __('Email') }}" class="form-control"
                            value="{{ old('email', isset($setting['email']) ? $setting['email'] : '') }}">
                        @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group mb-3 {{ $errors->has('min_bid_amount') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('Min Bid Amount') }}</label>
                        <input type="number" id="email" name="min_bid_amount" placeholder="{{ __('Min Bid Amount') }}" class="form-control"
                            value="{{ old('min_bid_amount', isset($setting['min_bid_amount']) ? $setting['min_bid_amount'] : '') }}">
                        @if($errors->has('min_bid_amount'))
                        <p class="help-block">
                            {{ $errors->first('min_bid_amount') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('max_bid_amount') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('Max Bid Amount') }}</label>
                        <input type="number" id="email" name="max_bid_amount" placeholder="{{ __('Max Bid Amount') }}" class="form-control"
                            value="{{ old('max_bid_amount', isset($setting['max_bid_amount']) ? $setting['max_bid_amount'] : '') }}">
                        @if($errors->has('max_bid_amount'))
                        <p class="help-block">
                            {{ $errors->first('max_bid_amount') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('min_withdrawl_amount') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('Min withdrawal amount') }}</label>
                        <input type="number" id="email" name="min_withdrawl_amount" placeholder="{{ __('Min withdrawl amount') }}" class="form-control"
                            value="{{ old('min_withdrawl_amount', isset($setting['min_withdrawl_amount']) ? $setting['min_withdrawl_amount'] : '') }}">
                        @if($errors->has('min_withdrawl_amount'))
                        <p class="help-block">
                            {{ $errors->first('min_withdrawl_amount') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('max_withdrawal_amount') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('Max withdrawal amount') }}</label>
                        <input type="number" id="email" name="max_withdrawal_amount" placeholder="{{ __('Max withdrawal amount') }}" class="form-control"
                            value="{{ old('max_withdrawal_amount', isset($setting['max_withdrawal_amount']) ? $setting['max_withdrawal_amount'] : '') }}">
                        @if($errors->has('max_withdrawal_amount'))
                        <p class="help-block">
                            {{ $errors->first('max_withdrawal_amount') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('min_deposit_amount') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('Min deposit amount') }}</label>
                        <input type="number" id="email" name="min_deposit_amount" placeholder="{{ __('Min deposit amount') }}" class="form-control"
                            value="{{ old('min_deposit_amount', isset($setting['min_deposit_amount']) ? $setting['min_deposit_amount'] : '') }}">
                        @if($errors->has('min_deposit_amount'))
                        <p class="help-block">
                            {{ $errors->first('min_deposit_amount') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('max_deposit_amount') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('Max deposit amount') }}</label>
                        <input type="number" id="email" name="max_deposit_amount" placeholder="{{ __('Max deposit amount') }}" class="form-control"
                            value="{{ old('max_deposit_amount', isset($setting['max_deposit_amount']) ? $setting['max_deposit_amount'] : '') }}">
                        @if($errors->has('max_deposit_amount'))
                        <p class="help-block">
                            {{ $errors->first('max_deposit_amount') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('service_fee') ? 'has-error' : '' }}">
                        <label class="form-label" for="linked-in">Service Fee (In %)</label>
                        <input type="number" id="service_fee" name="service_fee" placeholder="Service fee in percentage"
                            class="form-control"
                            value="{{ old('service_fee', isset($setting['service_fee']) ? $setting['service_fee'] : '') }}">
                        @if($errors->has('service_fee'))
                        <p class="help-block">
                            {{ $errors->first('service_fee') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('service_fee') ? 'has-error' : '' }}">
                        <label class="form-label" for="linked-in">Refer Commission (In %)</label>
                        <input type="number" id="refer_amount" name="refer_amount" placeholder="Service fee in percentage"
                            class="form-control"
                            value="{{ old('refer_amount', isset($setting['refer_amount']) ? $setting['refer_amount'] : '') }}">
                        @if($errors->has('refer_amount'))
                        <p class="help-block">
                            {{ $errors->first('refer_amount') }}
                        </p>
                        @endif
                    </div>
                <!-- </div> -->
<!-- 
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('send_otp') ? 'has-error' : '' }}">
                        <label class="form-label" for="linked-in">Service Fee (In %)</label>
                        <select id="send_otp" name="send_otp" class="form-control">
                            <option value="yes" {{ ( (isset($setting['send_otp']) && $setting['send_otp'] == 'yes') ? 'selected' : '') }}>Yes</option>
                            <option value="no" {{ ( (isset($setting['send_otp']) && $setting['send_otp'] == 'no') ? 'selected' : '') }}>No</option>
                        </select>  
                        @if($errors->has('send_otp'))
                        <p class="help-block">
                            {{ $errors->first('send_otp') }}
                        </p>
                        @endif
                    </div> -->
                </div>

            </div>
            <!-- <hr>
            <h4 class="card-title mb-3 mt-4">UPI Payment ID</h4> -->
            <div class="row">
                <!--<div class="col-md-6">-->
                <!--    <div class="form-group mb-3 {{ $errors->has('upi_name') ? 'has-error' : '' }}">-->
                <!--        <label class="form-label" for="email">{{ __('Max deposit amount') }}</label>-->
                <!--        <input type="text" id="email" name="upi_name" placeholder="{{ __('UPI Name') }}" class="form-control"-->
                <!--            value="{{ old('upi_name', isset($setting['upi_name']) ? $setting['upi_name'] : '') }}">-->
                <!--        @if($errors->has('upi_name'))-->
                <!--        <p class="help-block">-->
                <!--            {{ $errors->first('upi_name') }}-->
                <!--        </p>-->
                <!--        @endif-->
                <!--    </div>-->
                <!--</div>-->
                <!-- <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('upi_id') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('UPI ID') }}</label>
                        <input type="text" id="email" name="upi_id" placeholder="{{ __('UPI ID') }}" class="form-control"
                            value="{{ old('upi_id', isset($setting['upi_id']) ? $setting['upi_id'] : '') }}">
                        @if($errors->has('upi_id'))
                        <p class="help-block">
                            {{ $errors->first('upi_id') }}
                        </p>
                        @endif
                    </div>
                </div> -->
            </div>
            <!-- <hr>
            <h4 class="card-title mt-4 mb-3">Bank Details</h4> -->
            <!-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('account_holder_name') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('A/C Holder Name') }}</label>
                        <input type="text" id="email" name="account_holder_name" placeholder="{{ __('A/C Holder Name') }}" class="form-control"
                            value="{{ old('account_holder_name', isset($setting['account_holder_name']) ? $setting['account_holder_name'] : '') }}">
                        @if($errors->has('account_holder_name'))
                        <p class="help-block">
                            {{ $errors->first('account_holder_name') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('account_number') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('A/C Number') }}</label>
                        <input type="text" id="email" name="account_number" placeholder="{{ __('A/C Number') }}" class="form-control"
                            value="{{ old('account_number', isset($setting['account_number']) ? $setting['account_number'] : '') }}">
                        @if($errors->has('account_number'))
                        <p class="help-block">
                            {{ $errors->first('account_number') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('ifsc_code') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('IFSC CODE') }}</label>
                        <input type="text" id="email" name="ifsc_code" placeholder="{{ __('IFSC CODE') }}" class="form-control"
                            value="{{ old('ifsc_code', isset($setting['ifsc_code']) ? $setting['ifsc_code'] : '') }}">
                        @if($errors->has('ifsc_code'))
                        <p class="help-block">
                            {{ $errors->first('ifsc_code') }}
                        </p>
                        @endif
                    </div>
                </div>
            </div> -->
            <hr>
            <h4 class="card-title mt-4 mb-3">General Settings</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('is_withdrawal') ? 'has-error' : '' }}">
                        <label class="form-label" for="is_withdrawal">{{ __('Active Withdrawal') }} On/Off</label>
                        <select name="is_withdrawal" id="is_withdrawal" class="form-control" required>
                            <option value="1" {{ isset($setting['is_withdrawal'])?($setting['is_withdrawal'] == 1? 'selected' : ''):'' }}>On</option>
                            <option value="0" {{ isset($setting['is_withdrawal'])?($setting['is_withdrawal'] == 0? 'selected' : ''):'' }}>Off</option>
                        </select>
                        @if($errors->has('is_withdrawal'))
                        <p class="help-block">
                            {{ $errors->first('is_withdrawal') }}
                        </p>
                        @endif
                    </div>
                </div>
            <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('is_live') ? 'has-error' : '' }}">
                        <label class="form-label" for="email">{{ __('Is Live') }}</label>
                        <select name="is_live" class="form-control" required>
                            <option value="1" {{ isset($setting['is_live'])?($setting['is_live'] == 1? 'selected' : ''):'' }}>YES</option>
                            <option value="0" {{ isset($setting['is_live'])?($setting['is_live'] == 0? 'selected' : ''):'' }}>NO</option>
                        </select>
                        @if($errors->has('is_live'))
                        <p class="help-block">
                            {{ $errors->first('is_live') }}
                        </p>
                        @endif
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label class="form-label" for="image">{{ __('image') }}</label>
                        <input type="file" id="image" name="image" placeholder="{{ __('Image') }}" class="form-control"
                            value="{{ old('image', isset($setting['image']) ? $setting['image'] : '') }}">
                        @if($errors->has('image'))
                        <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                        @endif
                        @isset($setting['image']) <img class="image mt-2" style="margin-left: 10px" src="{{url('/assets/image')}}/{{$setting['image']}}"
                            width="120"> @endisset
                    </div>
                </div> -->
                </div>
            <hr>
            <!-- <h4 class="card-title mt-4 mb-3">App Links</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('app_link') ? 'has-error' : '' }}">
                        <label class="form-label" for="website_title">{{ __('App Link') }}</label>
                        <input type="url" id="website_title" name="app_link" placeholder="{{ __('App link') }}"
                            class="form-control"
                            value="{{ old('app_link', isset($setting['app_link']) ? $setting['app_link'] : '') }}">
                        @if($errors->has('app_link'))
                        <p class="help-block">
                            {{ $errors->first('app_link') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('app_link_playstore') ? 'has-error' : '' }}">
                        <label class="form-label" for="website_title">{{ __('Play Store Link') }}</label>
                        <input type="url" id="website_title" name="app_link_playstore" placeholder="{{ __('link') }}"
                            class="form-control"
                            value="{{ old('app_link_playstore', isset($setting['app_link_playstore']) ? $setting['app_link_playstore'] : '') }}">
                        @if($errors->has('app_link_playstore'))
                        <p class="help-block">
                            {{ $errors->first('app_link_playstore') }}
                        </p>
                        @endif
                    </div>
                </div>
            </div> -->
            <!-- <hr> -->
            <!-- <h4 class="card-title mt-4 mb-3">SEO</h4> -->
                <!-- <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3 {{ $errors->has('website_title') ? 'has-error' : '' }}">
                            <label class="form-label" for="website_title">{{ __('Website Title') }}</label>
                            <input type="text" id="website_title" name="website_title" placeholder="{{ __('Website Title') }}"
                                class="form-control"
                                value="{{ old('website_title', isset($setting['website_title']) ? $setting['website_title'] : '') }}">
                            @if($errors->has('website_title'))
                            <p class="help-block">
                                {{ $errors->first('website_title') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3 {{ $errors->has('meta_title') ? 'has-error' : '' }}">
                            <label class="form-label" for="meta_title">{{ __('Meta Title') }}</label>
                            <input type="text" id="meta_title" name="meta_title" placeholder="{{ __('Meta Title') }}"
                                class="form-control"
                                value="{{ old('meta_title', isset($setting['meta_title']) ? $setting['meta_title'] : '') }}">
                            @if($errors->has('meta_title'))
                            <p class="help-block">
                                {{ $errors->first('meta_title') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3 {{ $errors->has('meta_desc') ? 'has-error' : '' }}">
                            <label class="form-label" for="meta_desc">{{ __('Meta Description') }}</label>
                            <textarea type="text" id="meta_desc" name="meta_desc" placeholder="{{ __('Meta Description') }}"
                                class="form-control">{{ old('meta_desc', isset($setting['meta_desc']) ? $setting['meta_desc'] : '') }}</textarea>
                            @if($errors->has('meta_desc'))
                            <p class="help-block">
                                {{ $errors->first('meta_desc') }}
                            </p>
                            @endif
                        </div>
                    </div>
            </div>
            <hr> -->
            <h4 class="card-title mb-3 mt-4">How to play</h4>
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-3 {{ $errors->has('video_link') ? 'has-error' : '' }}">
                        <label class="form-label" for="facebook">{{ __('Video Link') }}</label>
                        <input type="url" id="facebook" name="video_link" placeholder="{{ __('Video Link') }}"
                            class="form-control"
                            value="{{ old('video_link', isset($setting['video_link']) ? $setting['video_link'] : '') }}">
                        @if($errors->has('video_link'))
                        <p class="help-block">
                            {{ $errors->first('video_link') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label class="form-label" for="facebook">{{ __('Home Page Message') }}</label>
                        <textarea id="ckeditor" class="form-control " name="home_page_message">{{ old('home_page_message', isset($setting['home_page_message']) ? $setting['home_page_message'] : '') }}</textarea>
                    </div>
                </div>
            </div>
            <hr>
            <h4 class="card-title mt-4 mb-3">Social Links</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('telegram') ? 'has-error' : '' }}">
                        <label class="form-label" for="telegram">{{ __('Telegram') }}</label>
                        <input type="text" id="facebook" name="telegram" placeholder="{{ __('Telegram') }}"
                            class="form-control"
                            value="{{ old('telegram', isset($setting['telegram']) ? $setting['telegram'] : '') }}">
                        @if($errors->has('telegram'))
                        <p class="help-block">
                            {{ $errors->first('telegram') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('whataApp') ? 'has-error' : '' }}">
                        <label class="form-label" for="whataApp">{{ __('WhataApp') }}</label>
                        <input type="text" id="whataApp" name="whataApp" placeholder="{{ __('WhataApp') }}"
                            class="form-control"
                            value="{{ old('whataApp', isset($setting['whataApp']) ? $setting['whataApp'] : '') }}">
                        @if($errors->has('whataApp'))
                        <p class="help-block">
                            {{ $errors->first('whataApp') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 {{ $errors->has('support_email') ? 'has-error' : '' }}">
                        <label class="form-label" for="support_email">{{ __('Support Email') }}</label>
                        <input type="text" id="support_email" name="support_email" placeholder="{{ __('Support Email') }}"
                            class="form-control"
                            value="{{ old('support_email', isset($setting['support_email']) ? $setting['support_email'] : '') }}">
                        @if($errors->has('instagram'))
                        <p class="help-block">
                            {{ $errors->first('instagram') }}
                        </p>
                        @endif
                    </div>
                </div>
                
            </div>
     
            <div>
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection