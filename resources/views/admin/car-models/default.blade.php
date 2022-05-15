@extends('admin.layout.app')

@section('title','  انتخاب پیشفرض مدل خودرو')

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
                                <i class="la la-plus"></i>انتخاب پیشفرض مدل خودرو
                            </span>
                        <span class="mr-5"> پیشفرض: <span class="text-primary">{{ $carModels->count() == 1 ? $carModels->first()->title : $carModels->where('default', 1)->first()->title }}</span></span>
                        <a href="{{ route('admin.car-models.index') }}"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            مشاهده مدل های خودرو
                        </a>

                        <a href="{{ route('admin.car-models.default') }}"
                           class="btn btn-primary d-flex align-items-center ml-0 mt-2 mr-2">
                            انتخاب پیشفرض
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8">
                                <form action="{{ route('admin.car-models.default.update') }}" method="POST">
                                    @csrf
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="carModel">مدل خودرو</label>
                                                <select class="custom-select" id="carModel" name="carModel" required>
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    @foreach($carModels as $car)
                                                        <option value="{{$car->id}}" @if($car->default == 1) selected @endif>{{$car->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button name="add"
                                                    class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                    id="add">
                                                افزودن مدل خودرو
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



