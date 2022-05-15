@extends('admin.layout.app')

@section('title','  افزودن نوع خودرو')

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
                                <i class="la la-plus"></i>افزودن نوع خودرو
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
                                <form action="{{ route('admin.car-types.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">عنوان نوع خودرو</label>
                                                <input class="form-control " name="title" id="title" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cars">نوع وسیله نقلیه</label>
                                                <select class="custom-select" id="cars" name="cars" required>
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    @foreach($cars as $car)
                                                        <option value="{{$car->id}}">{{$car->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button name="add"
                                                    class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                    id="add">
                                                افزودن نوع خودرو
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



