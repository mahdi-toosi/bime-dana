@extends('admin.layout.app')

@section('title','  ویرایش گروه تعرفه ای')

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
                                <i class="la la-edit"></i>ویرایش گروه تعرفه ای
                            </span>
                        <a href="/admin/plan/list"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            مشاهده تعرفه ها
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8">
                                <form action="{{ route('plan.update', ['plan' => $plan->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="price">گروه تعرفه</label>
                                                <input class="form-control " name="name" required id="name" value="{{ $plan->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rank">نوع وسیله نقلیه</label>
                                                <select class="custom-select" required id="rank" name="car_id">
                                                    <option>انتخاب کنید</option>
                                                    @foreach($cars as $car)
                                                    <option value="{{$car->id}}" @if($plan->car_id == $car->id) selected @endif>{{$car->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price"> قیمیت پایه (ریال)</label>
                                                <input class="form-control number" required name="base_price" id="base_price" value="{{ $plan->base_price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="acc"> حوادث راننده</label>
                                                <input class="form-control number" required name="driver_price" id="driver_price" value="{{ $plan->driver_price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mulct"> جرائم روزانه عدم تمدید</label>
                                                <input class="form-control number" required name="daily_penalty" id="daily_penalty" value="{{ $plan->daily_penalty }}">
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <button name="add"
                                                class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                id="add">
                                                ویرایش تعرفه
                                                <i class="la la-edit"></i>
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



