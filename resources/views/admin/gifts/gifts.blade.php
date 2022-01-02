@extends('admin.layouts.app', ['title' => 'Gifts'])

@section('css')

@endsection

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        <x-alert></x-alert>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.gift')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.gift')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">

                                    {{ $gifts->links() }}

                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    <a type="button" href="{{route('admin.gifts.create')}}"
                                       class="btn btn-primary waves-effect waves-light mb-2 text-white">{{__('admin.create_gift')}}
                                    </a>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="thead-light">

                                <tr>
                                    <th>{{__('admin.image')}}</th>
                                    <th>{{__('admin.name')}}</th>
                                    <th>{{__('admin.description')}}</th>
                                    <th>{{__('admin.started_at')}}</th>
                                    <th>{{__('admin.expired_at')}}</th>
                                    <th>{{__('admin.status')}}</th>
                                    <th style="width: 82px;">{{__('admin.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($gifts as $gift)
                                    <tr>
                                        <td>
                                            <div>
                                                <img src="{{asset('storage/'.$gift->image_url)}}" style="object-fit: cover" alt="OOps"
                                                     height="40px"
                                                     width="40px">
                                            </div>
                                        </td>
                                        <td><span class="font-weight-bold">{{$gift->name}}</span></td>
                                        <td>{{$gift->description}}</td>

                                        <td>{{\Carbon\Carbon::parse($gift->started_at)->setTimezone(\App\Helpers\AppSetting::$timezone)->format('Y-m-d g:i A')}}</td>
                                        <td>{{\Carbon\Carbon::parse($gift->expired_at)->setTimezone(\App\Helpers\AppSetting::$timezone)->format('Y-m-d g:i A')}}</td>


                                        <td>@if($gift->is_active)
                                                <span class="bg-primary mr-1" style="border-radius: 50%;width: 8px;height: 8px;  display: inline-block;"></span>{{__('admin.active')}}
                                            @else
                                                <span class="bg-danger mr-1" style="border-radius: 50%;width: 8px;height: 8px;  display: inline-block;"></span>{{__('admin.deactive')}}

                                            @endif</td>

                                        <td>
                                            <a href="{{route('admin.gifts.show',['id'=>$gift->id])}}"
                                               style="font-size: 20px"> <i
                                                    class="mdi mdi-eye"></i></a>
                                            <a href="{{route('admin.gifts.edit',['id'=>$gift->id])}}"
                                               style="font-size: 20px"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>
    </div> <!-- container -->

@endsection

@section('script')

@endsection
