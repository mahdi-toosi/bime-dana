@extends('admin.layout.app')

@section('title','  انتخاب پیشفرض')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        <!------------giftlist-------------->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="boxtitle">
                            <span class="d-flex align-items-center">
                                <i class="la la-plus"></i>انتخاب پیشفرض نوع خودرو
                            </span>
                        <span class="mr-5"> پیشفرض: <span class="text-primary">{{ $carTypes->where('default', 1)->first()->title }}</span></span>
                        <a href="{{ route('admin.car-types.index') }}"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            مشاهده انواع خودرو
                        </a>
                        <a href="{{ route('admin.car-types.create') }}"
                           class="btn btn-primary d-flex align-items-center ml-0 mt-2 mr-2">
                            افزودن نوع خودرو
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8">
                                <form action="{{ route('admin.car-types.default.update') }}" method="POST">
                                    @csrf
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="carType">نوع وسیله نقلیه</label>
                                                <select class="custom-select" id="carType" name="carType" required>
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    @foreach($carTypes as $car)
                                                        <option value="{{$car->id}}" @if($car->default == 1) selected @endif>{{$car->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button name="add"
                                                    class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                    id="add">
                                                انتخاب پیشفرض
                                                <i class="la la-plus"></i>
                                            </button>

                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection



