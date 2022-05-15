@extends('admin.layout.app')

@section('title','  ویرایش نوع خودرو')

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
                                <i class="la la-plus"></i>ویرایش نوع خودرو
                            </span>
                        <a href="{{ route('admin.car-types.index') }}"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            مشاهده انواع خودرو
                        </a>
                        <a href="{{ route('admin.car-types.default') }}"
                           class="btn btn-primary d-flex align-items-center ml-0 mt-2 mr-2">
                            انتخاب پیشفرض
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8">
                                <form action="{{ route('admin.car-types.update', ['car_type' => $carType->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">عنوان نوع خودرو</label>
                                                <input class="form-control" value="{{ $carType->title }}" name="title" id="title" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cars">نوع وسیله نقلیه</label>
                                                <select class="custom-select" id="cars" name="cars" required>
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    @foreach($cars as $car)
                                                        <option value="{{$car->id}}" @if($carType->car_id == $car->id) selected @endif>{{$car->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button name="add"
                                                    class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                    id="add">
                                                ویرایش نوع خودرو
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



