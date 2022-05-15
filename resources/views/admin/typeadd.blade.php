@extends('admin.layout.app')

@section('title','  افزودن کاربری')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        @if($save==1)
            <div class="alert alert-success fade in alert-dismissible show">
                مورد استفاده مورد نظر افزوده شد
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    @endif
        <!------------giftlist-------------->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="boxtitle">
                            <span class="d-flex align-items-center">
                                <i class="la la-plus"></i>افزودن کاربری
                            </span>
                        <a href="/admin/usage/list"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            مشاهده کاربری ها
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8">
                                <form action="#" method="post">
                                    @csrf
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rank">نوع وسیله نقلیه</label>
                                                <select class="custom-select" id="car_id" name="car_id">
                                                    <option>انتخاب کنید</option>
                                                    @foreach($cars as $car)
                                                        <option value="{{$car->id}}">{{$car->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="typename"> نوع کاربری</label>
                                                <input class="form-control" name="typename" id="typename">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="typeIncrease">نوع درصد افزایش</label>
                                                <select class="custom-select" id="typeIncrease" name="typeIncrease">
                                                    <option>انتخاب کنید</option>
                                                    <option value="1">ثابت</option>
                                                    <option value="2">ضریبی</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Increase"> میزان افزایش</label>
                                                <input class="form-control" name="Increase" id="Increase">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button
                                                class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                id="add">
                                                افزودن نوع کاربری
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



