@extends('admin.layout.app')

@section('title','  ویرایش پوشش')

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
                                <i class="la la-edit"></i>ویرایش پوشش {{ $commitment->insurance->name }}
                            </span>
                        <a href="{{ url()->previous() }}"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            بازگشت
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8">
                                <form action="{{ route('cover.update', ['commitment' => $commitment->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">بیمه</label>
                                                <select class="form-control" required name="insurance" id="insurance">
                                                    <option value="{{ $commitment->insurance->id }}" selected>{{ $commitment->insurance->name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rank">گروه تعرفه</label>
                                                <select class="custom-select" required id="plan_id" name="plan_id">
                                                    <option>انتخاب کنید</option>
                                                    @foreach($plans as $plan)
                                                    <option value="{{$plan->id}}" @if($plan->id == $commitment->plan->id) selected @endif>{{$plan->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price"> سقف پوشش (به میلیون تومان)</label>
                                                <input class="form-control" required value="{{ $commitment->cover_price }}" name="cover_price" id="cover_price">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mulct">مبلغ افزایش پوشش هر سال</label>
                                                <input class="form-control number" required value="{{ $commitment->price }}" name="price" id="price">
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <button name="add"
                                                class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                id="add">
                                                ویرایش پوشش
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



