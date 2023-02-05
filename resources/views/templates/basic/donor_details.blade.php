@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $breadcrumb = getContent('breadcrumb.content', true);
@endphp
<div class="profile-header dark--overlay bg_img" style="background-image: url({{getImage('assets/images/frontend/breadcrumb/'. @$breadcrumb->data_values->background_image, '1920x1440')}});">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="donor-profile">
					<div class="donor-profile__thumb">
						<img src="{{getImage('assets/images/donor/'. $donor->image, imagePath()['donor']['size'])}}" alt="@lang('image')">
					</div>
					<div class="donor-profile__content">
						<h3 class="donor-profile__name">{{__($donor->name)}}</h3>
						<p><i class="las la-map-marker-alt mt-2"></i> @lang('Location') : {{__($donor->location->name)}}, {{__($donor->city->name)}}</p>
						<ul class="d-flex flex-wrap align-items-center donor-card__social justify-content-center mt-1">
                            <li><a href="{{__(@$donor->socialMedia->facebook)}}" target="_blank" tabindex="-1"><i class="lab la-facebook-f"></i></a></li>
                            <li><a href="{{__(@$donor->socialMedia->twitter)}}" target="_blank" tabindex="-1"><i class="lab la-twitter"></i></a></li>
                            <li><a href="{{__(@$donor->socialMedia->linkedinIn)}}" target="_blank" tabindex="-1"><i class="lab la-linkedin-in"></i></a></li>
                            <li><a href="{{__(@$donor->socialMedia->instagram)}}" tabindex="-1"><i class="lab la-instagram"></i></a></li>
                        </ul>
					</div>
				</div>
			</div>
		</div>
		<div class="blood-donor-info-area">
			<div class="row justify-content-center">
				<div class="col-xl-3 col-lg-4">
					<div class="dono-info-item d-flex align-items-center justify-content-center">
						<h5 class="text-white me-3"><i class="las la-tint"></i> @lang('Blood Group') : </h5>
						<p class="text--base">{{__($donor->blood->name)}}</p>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 mt-lg-0 mt-3">
					<div class="dono-info-item d-flex align-items-center justify-content-center">
						<h5 class="text-white me-3"><i class="las la-calendar-check"></i> @lang('Last Donate') : </h5>
						<p class="text--base">{{showDateTime($donor->last_donate, 'd M Y')}}</p>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 mt-lg-0 mt-3">
					<div class="dono-info-item d-flex align-items-center justify-content-center">
						<h5 class="text-white me-3"><i class="las la-clipboard-list"></i> @lang('Total Donate') : </h5>
						<p class="text--base">{{__($donor->total_donate)}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="pt-100 pb-50 shade--bg">
	<div class="container">
		<div class="row gy-4">
			<div class="col-lg-8 pe-lg-5">
				<h3>@lang('Donor Details')</h3>
				<p class="mt-2">{{__($donor->details)}}</p>
				<div class="mt-4">
					@php 
	                    echo advertisements('820x213') 
	                @endphp
				</div>
				<ul class="caption-list-two mt-4">
					<li>
						<span class="caption">@lang('Name')</span>
						<span class="value">{{__($donor->name)}}</span>
					</li>
					<li>
						<span class="caption">@lang('Gender')</span>
						<span class="value">@if($donor->gender == 1) @lang('Male') @else @lang('Female') @endif</span>
					</li>
					<li>
						<span class="caption">@lang('Date of Birth')</span>
						<span class="value">{{showDateTime($donor->birth_date, 'd M Y')}}</span>
					</li>
					<li>
						<span class="caption">@lang('Age')</span>
						<span class="value">{{Carbon\Carbon::parse($donor->birth_date)->age}} @lang('Years')</span>
					</li>
					<li>
						<span class="caption">@lang('Religion')</span>
						<span class="value">{{__($donor->religion)}}</span>
					</li>
					<li>
						<span class="caption">@lang('Email')</span>
						<span class="value">{{__($donor->email)}}</span>
					</li>
					<li>
						<span class="caption">@lang('Phone')</span>
						<span class="value">{{__($donor->phone)}}</span>
					</li>
					<li>
						<span class="caption">@lang('Profession')</span>
						<span class="value">{{__($donor->profession)}}</span>
					</li>
					
					<li>
						<span class="caption">@lang('Address')</span>
						<span class="value">{{__($donor->address)}}</span>
					</li>
				</ul>

				<div class="mt-4">
					@php 
	                    echo advertisements('820x213') 
	                @endphp
				</div>
	         
			</div>
			<div class="col-lg-4">
				<div class="custom--card section--bg2">
					<div class="card-header">
						<h5 class="text-white">@lang('Contact with Donor')</h5>
					</div>
					<div class="card-body">
						<form method="POST" action="{{route('donor.contact')}}" class="contact-donor-form">
							@csrf
							<input type="hidden" name="donor_id" value="{{$donor->id}}">
							<div class="form-group">
								<input type="text" name="name" value="{{old('name')}}" class="form--control form-control-md" placeholder="@lang('Enter name')" maxlength="80" required="">
							</div>
							<div class="form-group">
								<input type="email" name="email" value="{{old('email')}}" class="form--control form-control-md" placeholder="@lang('Enter email')" maxlength="80" required="">
							</div>
							<div class="form-group">
								<textarea name="message" class="form--control" placeholder="@lang('Message')" maxlength="500" required="">{{old('message')}}</textarea>
							</div>
							<button type="submit" class="btn btn--base w-100">@lang('Message Now')</button>
						</form>
					</div>
				</div>
				 <div class="mt-4">
				 	@php 
	                    echo advertisements('416x554') 
	                @endphp
				 </div>
			</div>
		</div>
	</div>
</section>
@endsection