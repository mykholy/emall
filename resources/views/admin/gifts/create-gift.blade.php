@extends('admin.layouts.app', ['title' => 'New Gift'])

@section('css')
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.gifts.index')}}">{{__('admin.gift')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.create')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.create_gift')}}</h4>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.gifts.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('admin.name')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif"
                                       id="name" placeholder="name" value="{{old('name')}}"
                                       name="name">
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif


                            </div>

                            <div class="form-group">
                                <label for="description">{{__('admin.description')}} <span class="text-danger">*</span></label>
                                <textarea name="description" id="description"
                                          class="form-control @if($errors->has('description')) is-invalid @endif"
                                          placeholder="Description">{{old('description')}}</textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="started_at">{{__('admin.started_at')}}</label>
                                <input type="datetime-local" id="started_at" min="{{now()->format('Y-m-d\TH:i')}}"
                                       value="{{now()->format('Y-m-d\TH:i')}}" name="started_at"
                                       class="form-control @if($errors->has('started_at')) is-invalid @endif">
                                @if($errors->has('started_at'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('started_at') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="expired_at">{{__('admin.expired_at')}}</label>
                                <input type="datetime-local" id="expired_at" min="{{now()->format('Y-m-d\TH:i')}}"
                                       value="{{now()->addDays(1)->format('Y-m-d\TH:i')}}" name="expired_at"
                                       class="form-control @if($errors->has('expired_at')) is-invalid @endif">
                                @if($errors->has('expired_at'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expired_at') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="product_ids">{{__('admin.products')}} <span class="text-danger">*</span></label>
                                <select class="form-control @if($errors->has('product_ids')) is-invalid @endif " name="product_ids[]" id="product_ids" multiple>
                                    <option disabled>{{__('admin.select_products')}}</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('product_ids'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('product_ids') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="text-right">
                                <button type="submit"
                                        class="btn btn-success waves-effect waves-light">{{__('admin.save')}}</button>
                                <a type="button" href="{{route('admin.gifts.index')}}"
                                   class="btn btn-danger waves-effect waves-light m-l-10">{{__('admin.cancel')}}
                                </a>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {

            $('#expired_at').datetimepicker({
                format: 'DD/MM/YYYY',
                locale: 'en',
                min: (new Date()).toString()
            }) ;
            $('#started_at').datetimepicker({
                format: 'DD/MM/YYYY',
                locale: 'en',
                min: (new Date()).toString()
            })
        });
    </script>
@endsection
