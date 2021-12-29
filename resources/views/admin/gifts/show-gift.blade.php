@extends('admin.layouts.app', ['title' => 'Details Gift'])

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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.orders.index')}}">{{__('admin.gifts')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.details')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.details')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">{{$gift->name}} </h4>
                        <h4 class="sub-header mb-3">{{$gift->description}} </h4>

                        <div class="table-responsive">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{__('admin.product_name')}}</th>
                                    <th>{{__('admin.image')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($gift->products as $item)
                                    <tr>
                                        <td>{{$item->product->name}}</td>
                                        <td>
                                            <div>
                                                @if(count($item->product->productImages))
                                                    <img
                                                        src="{{asset('storage/'.$item['product']['productImages'][0]['url'])}}"
                                                        style="object-fit: cover" alt="OOps"
                                                        height="64px"
                                                        width="64px">
                                                @else
                                                    <img src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                         style="object-fit: cover" alt="OOps"
                                                         height="64px"
                                                         width="64px">
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                @if($gift->user_id)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">{{__('admin.winner_user')}}</h4>
                            <img width="50px" src="{{\App\Helpers\TextUtil::getImageUrl($gift->user->avatar_url,\App\Helpers\TextUtil::$PLACEHOLDER_AVATAR_URL)}}" alt="user-image"
                                 class="rounded-circle">
                            <span class="pro-user-name ml-1">
                               <a href="{{route('admin.users.edit',$gift->user->id)}}"> {{$gift->user->name}} </a>
                             </span>


                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">{{__('admin.random_draw')}}</h4>
                            <a type="button" href="{{route('admin.gifts.random_draw',$gift->id)}}" class="btn btn-primary waves-effect waves-light mb-2 text-white"> {{__('admin.random_draw')}}
                            </a>
                        </div>
                    </div>
                @endif

            </div>

        </div>

    </div> <!-- container -->

@endsection

@section('script')
@endsection
