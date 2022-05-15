@extends('admin.layout.app')

@section('title','مدل های خودرو')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        <!------------giftlist-------------->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="boxtitle">
                        <i class="la la-file-alt"></i> مدل های های ثبت شده
                        <a href="{{ route('admin.car-models.create') }}"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            افزودن مدل خودرو
                        </a>

                        <a href="{{ route('admin.car-models.default') }}"
                           class="btn btn-primary d-flex align-items-center ml-0 mt-2 mr-2">
                            انتخاب پیشفرض
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row">
                            <div class="col-12"></div>
                            @foreach($carModels as $car)
                                <div class="col-lg-3 col-sm-6 mb-3">
                                    <div class="itemsbox flex-column">
                                        <ul class="w-100 p-1">
                                            <li class="d-flex justify-content-between mb-1">
                                                <span class="text-muted f-12">عنوان مدل</span>
                                                <span class="itemsname text-success">
                                                    {{ $car->title }}
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between mb-1">
                                                <span class="text-muted f-12">نوع خودرو</span>
                                                <span class="itemsname">
                                                    {{ $car->carType->title }}
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between mb-1">
                                                <span class="text-muted f-12">گروه تعرفه ای</span>
                                                <span class="itemsname">
                                                    {{ $car->plan->name }}
                                                </span>
                                            </li>

                                            <li class="d-flex justify-content-between mb-1">
                                                <span class="text-muted f-12">وضعیت</span>
                                                @if($car->status == 1)
                                                    <span class="itemsname text-primary">
                                                    فعال
                                                </span>
                                                @else
                                                    <span class="itemsname text-danger">
                                                    غیرفعال
                                                </span>
                                                @endif
                                            </li>
                                        </ul>
                                        <div>
                                            <div class="inline-block">
                                                <form action="{{ route('admin.car-models.destroy', ['car_model' => $car->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger width-70-px"><i
                                                                class="la la-trash-o"></i></button>
                                                </form>
                                            </div>
                                            <div class="inline-block">
                                                <a href="{{ route('admin.car-models.edit', ['car_model' => $car->id]) }}">
                                                    <button class="btn btn-warning width-70-px"><i
                                                                class="la la-edit"></i></button>
                                                </a>
                                            </div>
                                            <div class="inline-block">
                                                @if($car->status == 1)
                                                    <form action="{{ route('admin.car-models.updateStatus', ['car_model' => $car->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button title="غیرفعال کردن" class="btn btn-info width-70-px"><i
                                                                    class="la la-times"></i></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.car-models.updateStatus', ['car_model' => $car->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button title="فعال کردن" class="btn btn-success width-70-px"><i
                                                                    class="la la-check"></i></button>
                                                    </form>
                                                @endif
                                            </div>
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



