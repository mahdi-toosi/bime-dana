@extends('admin.layout.app')

@section('title','  افزودن گروه تعرفه ای')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        @if($save==1)
        <div class="alert alert-success fade in alert-dismissible show">
            پوشش مورد نظر افزوده شد
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
                                <i class="la la-plus"></i>افزودن پوشش برای {{$insurance->name}}
                            </span>
                        <a href="/admin/cover/{{$insurance->id}}"
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">بیمه</label>
                                                <select class="form-control " name="insurance" id="insurance">
                                                    <option value="{{$insurance->id}}" selected>{{$insurance->name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rank">گروه تعرفه</label>
                                                <select class="custom-select" id="plan_id" name="plan_id">
                                                    <option>انتخاب کنید</option>
                                                    @foreach($plans as $plan)
                                                    <option value="{{$plan->id}}">{{$plan->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price"> سقف پوشش (به میلیون تومان)</label>
                                                <input class="form-control" name="cover_price" id="cover_price">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mulct">مبلغ افزایش پوشش هر سال</label>
                                                <input class="form-control number" name="price" id="price">
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <button name="add"
                                                class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                id="add">
                                                افزودن پوشش
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



