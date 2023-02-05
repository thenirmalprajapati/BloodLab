@extends('admin.layouts.app')
@section('panel')
    @if(@json_decode($general->sys_version)->version > systemDetails()['version'])
        <div class="row">
            <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h3 class="card-title"> @lang('New Version Available') <button class="btn btn--dark float-right">@lang('Version') {{json_decode($general->sys_version)->version}}</button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark">@lang('What is the Update ?')</h5>
                        <p><pre  class="f-size--24">{{json_decode($general->sys_version)->details}}</pre></p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(@json_decode($general->sys_version)->message)
        <div class="row">
            @foreach(json_decode($general->sys_version)->message as $msg)
              <div class="col-md-12">
                  <div class="alert border border--primary" role="alert">
                      <div class="alert__icon bg--primary"><i class="far fa-bell"></i></div>
                      <p class="alert__message">@php echo $msg; @endphp</p>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
              </div>
            @endforeach
        </div>
    @endif

    <div class="row mt-50 mb-none-30">
        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--10 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-user-tie"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $don['all'] }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Donor')</span>
                    </div>
                    <a href="{{ route('admin.donor.index') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--18 b-radius--10 box-shadow">
                <div class="icon">
                   <i class="las la-user-circle"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $don['pending']  }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Pending Donor')</span>
                    </div>
                    <a href="{{ route('admin.donor.pending') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-users-cog"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $don['approved'] }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Approved Donor')</span>
                    </div>

                    <a href="{{route('admin.donor.approved')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--14 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-user-injured"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $don['banned'] }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Banned Donor')</span>
                    </div>

                    <a href="{{ route('admin.donor.banned') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--19 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="las la-tint"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{__($blood)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Blood Group')</span>
                    </div>
                    <a href="{{route('admin.blood.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--3 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{__($city)}}</span>
                        <span class="currency-sign">{{__($general->cur_text)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total City')</span>
                    </div>
                    <a href="{{route('admin.city.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="las la-location-arrow"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{__($locations)}}</span>
                        <span class="currency-sign">{{__($general->cur_text)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Location')</span>
                    </div>
                    <a href="{{route('admin.location.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--15 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="lab la-adversal"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{__($ads)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Advertisement')</span>
                    </div>

                    <a href="{{route('admin.ads.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
    </div>


     <div class="row mt-50 mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Name - Profession')</th>
                                    <th>@lang('Email - Phone')</th>
                                    <th>@lang('Blood Group - Location')</th>
                                    <th>@lang('Religion - Address')</th>
                                    <th>@lang('Gender - Age')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Last Update')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($donors as $donor)
                                <tr>
                                    <td data-label="@lang('Name - Profession')">
                                        <span>{{__($donor->name)}}</span><br>
                                        <span>{{__($donor->profession)}}</span>
                                    </td>
                                    <td data-label="@lang('Email - Phone')">
                                        <span>{{__($donor->email)}}</span><br>
                                        <span>{{__($donor->phone)}}</span>
                                    </td>
                                    <td data-label="@lang('Blood Group - Location')">
                                        <span>{{__($donor->blood->name)}}</span><br>
                                        <span>{{__($donor->location->name)}}</span>
                                    </td>
                                    <td data-label="@lang('Religion - Address')">
                                        <span>{{__($donor->religion)}}</span><br>
                                        <span>{{__($donor->address)}}</span>
                                    </td>

                                    <td data-label="@lang('Gender - Age')">
                                        <span>@if($donor->gender == 1) @lang('Male') @else @lang('Female') @endif</span><br>
                                        <span>{{Carbon\Carbon::parse($donor->birth_date)->age}} @lang('Years')</span>
                                    </td>

                                    <td data-label="@lang('Status')">
                                        @if($donor->status == 1)
                                            <span class="badge badge--success">@lang('Active')</span>
                                        @elseif($donor->status == 2)
                                            <span class="badge badge--danger">@lang('Banned')</span>
                                        @else
                                            <span class="badge badge--primary">@lang('Pending')</span>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Last Update')">
                                        {{ showDateTime($donor->updated_at) }}<br> {{ diffForHumans($donor->updated_at) }}
                                    </td>

                                    <td data-label="@lang('Action')">
                                        @if($donor->status == 2)
                                            <a href="javascript:void(0)" class="icon-btn btn--success ml-1 approved" data-toggle="tooltip" data-original-title="@lang('Approve')" data-id="{{$donor->id}}"><i class="las la-check"></i></a> 
                                        @elseif($donor->status == 1)
                                            <a href="javascript:void(0)" class="icon-btn btn--danger ml-1 cancel" data-toggle="tooltip" data-original-title="@lang('Banned')" data-id="{{$donor->id}}"><i class="las la-times"></i></a> 
                                        @elseif($donor->status == 0)
                                            <a href="javascript:void(0)" class="icon-btn btn--success ml-1 approved" data-toggle="tooltip" data-original-title="@lang('Approve')" data-id="{{$donor->id}}"><i class="las la-check"></i></a> 
                                            <a href="javascript:void(0)" class="icon-btn btn--danger ml-1 cancel" data-toggle="tooltip" data-original-title="@lang('Banned')" data-id="{{$donor->id}}"><i class="las la-times"></i></a> 
                                        @endif
                                        <a href="{{route('admin.donor.edit', $donor->id)}}" class="icon-btn btn--primary ml-1"><i class="las la-pen"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">@lang('Data not found')</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



<div class="modal fade" id="approvedby" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Approval Confirmation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{route('admin.donor.approved.status')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to approved this donor?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="cancelBy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Banned Confirmation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('admin.donor.banned.status') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to banned this donor?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('script')
    <script>
        'use strict';
        $('.approved').on('click', function () {
            var modal = $('#approvedby');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
        $('.cancel').on('click', function () {
            var modal = $('#cancelBy');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
    </script>
@endpush