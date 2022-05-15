@extends('admin.layout.app')

@section('title','  افزودن گروه تعرفه ای')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        @if($save==1)
        <div class="alert alert-success fade in alert-dismissible show">
            گروه تعرفه ای مورد نظر افزوده شد
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
                                <i class="la la-plus"></i>افزودن گروه تعرفه ای
                            </span>
                        <a href="/admin/plan/list"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            مشاهده تعرفه ها
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8">
                                <form action="#" method="post">
                                    @csrf
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="price">گروه تعرفه</label>
                                                <input class="form-control " name="name" id="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rank">نوع وسیله نقلیه</label>
                                                <select class="custom-select" id="rank" name="car_id">
                                                    <option>انتخاب کنید</option>
                                                    @foreach($cars as $car)
                                                    <option value="{{$car->id}}">{{$car->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price"> قیمیت پایه (ریال)</label>
                                                <input class="form-control number" name="base_price" id="base_price">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="acc"> حوادث راننده</label>
                                                <input class="form-control number" name="driver_price" id="driver_price">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mulct"> جرائم روزانه عدم تمدید</label>
                                                <input class="form-control number" name="daily_penalty" id="daily_penalty">
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <button name="add"
                                                class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                id="add">
                                                افزودن تعرفه
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
    <script>

        function itpro(Number)
        {
            Number=Number.replace(/[^0-9.]/g, '');
            Number+= '';

            Number= Number.replace(',', ''); Number= Number.replace(',', ''); Number= Number.replace(',', '');
            Number= Number.replace(',', ''); Number= Number.replace(',', ''); Number= Number.replace(',', '');
            x = Number.split('.');
            y = x[0];
            z= x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(y))
                y= y.replace(rgx, '$1' + ',' + '$2');
            return y+ z;
        }
        $('.number').keyup(function(){
            $(this).val(itpro($(this).val()));
        });
    </script>


@endsection



