@extends('admin.layout.app')

@section('title',' لیست بیمه')

@section('style')
<style>
    .giftbox {

        box-shadow: 0px 0px 3px #bababa;
        padding: 3px;
        border-radius: 6px;
        width:100%;
        margin:10px auto;

    }
    p.f-12
    {
        min-height:60px;
    }
</style>
@endsection

@section('content')
    <div class="container-fluid">


        <!------------giftlist-------------->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="boxtitle">
                        <i class="la la-file-alt"></i> بیمه های ثبت شده
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row">
                            @foreach($insurances as $insurance)
                            <div class="col-lg-3 col-sm-6 d-flex">
                                <div class="giftbox flex-column">
                                    <div class="gift-details text-center flex-grow-1">
                                        <div class="gift-pic">
                                            <img src="{{asset($insurance->img)}}" height="70">
                                        </div>
                                        <span class="gift-name">{{$insurance->name}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between w-100 p-2">

                                        <div>{{$insurance->star}}
                                            <i class="la la-star text-warning"></i>
                                        </div>
                                    </div>
                                    <p class="w-100 f-12 text-justify p-2 flex-grow-1">
                                       {{$insurance->description}}
                                    </p>
                                    <div class="n w-100 mt-2 rounded align-items-center">
                                        <div class="btn-group ltr w-100">
                                            <a href="/admin/insurance/edit/{{$insurance->id}}" class="btn btn-warning eddit">
                                                ویرایش
                                            </a>
                                            <button data-id="{{$insurance->id}}" class="btn btn-danger deleteitem">
                                                حذف
                                            </button>
                                            <a href="/admin/cover/{{$insurance->id}}" class="btn btn-primary state">
                                                ضرایب پوشش
                                            </a>
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
    <script>
        $('body').on("click", '.deleteitem', function () {
            const $this = $(this);
            Swal.fire({
                title: 'حذف ',
                html: "آیا از حذف بیمه مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.value) {
                    axios.post('/admin/insurance/delete',{id:$(this).attr('data-id')}).then(function () {
                        Swal.fire(
                            'حذف شد!',
                            'Your file has been deleted.',
                            'success'
                        ),
                            Swal.fire('عملیات موفق', 'کلاس با موفقیت حذف شد', 'success');
                        $this.parents('.col-lg-3.col-sm-6').remove();
                    });

                }
            })
        });
    </script>


@endsection



