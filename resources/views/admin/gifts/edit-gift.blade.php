@extends('admin.layouts.app', ['title' => 'Edit Gift'])

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
                            <li class="breadcrumb-item active">{{__('admin.edit')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.edit_gift')}}</h4>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.gifts.update',['id'=>$gift->id])}}" method="post">
                            @csrf
                            {{method_field('PATCH')}}
                            {{--<input type="hidden" name="id" value="{{$category->id}}">--}}

                            <div class="form-group">
                                <label for="name">{{__('admin.name')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif"
                                       id="name" placeholder="name" value="{{$gift->name}}"
                                       name="name">
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif


                            </div>
                            <div class="form-group">
                                <label for="description">{{__('admin.description')}}</label>
                                <textarea name="description" id="description"
                                          class="form-control @if($errors->has('description')) is-invalid @endif"
                                          placeholder="Description">{{$gift->description}}</textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="started_at">{{__('admin.started_at')}}</label>
                                <input type="datetime-local" id="started_at"
                                       value="{{Carbon\Carbon::parse($gift->started_at)->format('Y-m-d\TH:i')}}"
                                       name="started_at"
                                       class="form-control @if($errors->has('started_at')) is-invalid @endif">
                                @if($errors->has('started_at'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('started_at') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="expired_at">{{__('admin.expired_at')}}</label>
                                <input type="datetime-local" id="expired_at"
                                       value="{{Carbon\Carbon::parse($gift->expired_at)->format('Y-m-d\TH:i')}}"
                                       name="expired_at"
                                       class="form-control @if($errors->has('expired_at')) is-invalid @endif">
                                @if($errors->has('expired_at'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expired_at') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group mb-3">
                                <label for="product_ids">{{__('admin.products')}} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @if($errors->has('product_ids')) is-invalid @endif "
                                        name="product_ids[]" id="product_ids" multiple>
                                    <option disabled>{{__('admin.select_products')}}</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}"
                                                @if(in_array($product->id,$gift->products->pluck('product_id')->toArray())) selected @endif>{{$product->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('product_ids'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('product_ids') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="is_active" id="is_active"
                                       @if($gift->is_active) checked @endif>
                                <label class="custom-control-label"
                                       for="is_active">{{__('admin.gift_activation')}}</label>
                            </div>


                            <div class="text-right">
                                <button type="submit"
                                        class="btn btn-success waves-effect waves-light">{{__('admin.update')}}</button>
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
    <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
@endsection
