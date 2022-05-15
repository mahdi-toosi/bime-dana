@extends('admin.layout.app')

@section('title','انواع خودرو')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        <!------------giftlist-------------->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="boxtitle">
                        <i class="la la-file-alt"></i> لیست انواع خودرو
                        <a href="{{ route('admin.car-types.create') }}"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            افزودن نوع خودرو
                        </a>
                        <a href="{{ route('admin.car-types.default') }}"
                           class="btn btn-primary d-flex align-items-center ml-0 mt-2 mr-2">
                            انتخاب پیشفرض
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row">
                            <div class="col-12"></div>
                            @foreach($carTypes as $car)
                                <div class="col-lg-3 col-sm-6">
                                    <div class="itemsbox" data-id="{{$car->id}}">
                                        <div>
                                            <span class="itemsboxname">{{$car->title}}</span>
                                        </div>
                                        <div>
                                            <form action="{{ route('admin.car-types.destroy', ['car_type' => $car->id]) }}"
                                                  class="inline-block" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger deleteitem"><i class="la la-trash-o"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.car-types.edit', ['car_type' => $car->id]) }}">
                                                <button class="btn btn-warning eddititem"><i class="la la-edit"></i>
                                                </button>
                                            </a>
                                            @if($car->status == 1)
                                                <form action="{{ route('admin.car-types.updateStatus', ['car_type' => $car->id]) }}" class="inline-block" method="POST">
                                                    <button title="غیرفعال کردن" class="btn btn-info eddititem"><i class="la la-times"></i>
                                                        @csrf
                                                        @method('PUT')
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.car-types.updateStatus', ['car_type' => $car->id]) }}" method="POST" class="inline-block">
                                                    <button title="فعال کردن" class="btn btn-success eddititem"><i class="la la-check"></i>
                                                        @csrf
                                                        @method('PUT')
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection



