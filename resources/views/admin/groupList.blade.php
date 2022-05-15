@extends('admin.layout.app')

@section('title','گروه ها')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">



        @if($insert==1)
        <div class="alert alert-success fade in alert-dismissible show">
            بیمه مورد نظر ثبت شد
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
                        <i class="la la-file-alt"></i> گروهای های ثبت شده
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 mb-3 align-items-center ltr">
                                <form method="post" action="/admin/car/save">
                                    @csrf
                                <div class="input-group mb-3">
                                    <input name="car_id" value="0" type="hidden">
                                    <input name="car_name" type="text" class="form-control" placeholder="نام گروه جدید"
                                           id="itemname">
                                    <div class="input-group-append addbuttons">
                                        <button class="btn btn-success" type="submit">ثبت</button>
                                    </div>
                                    <div class="input-group-append edditbuttons d-none">
                                        <button class="btn btn-primary " type="submit">ثبت</button>
                                        <button class="btn btn-danger cancleeddit" type="button">لغو</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="col-12"></div>
                            @foreach($cars as $car)
                            <div class="col-lg-3 col-sm-6">
                                <div class="itemsbox"  data-id="{{$car->id}}">
                                    <div>
                                        <span class="itemsboxname">{{$car->name}}</span>
                                    </div>
                                    <div data-id="">
                                        <button class="btn btn-danger deleteitem"><i class="la la-trash-o"></i>
                                        </button>
                                        <button class="btn btn-warning eddititem"><i class="la la-edit"></i>
                                        </button>

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
                html: "آیا از حذف گروه مطمئن هستید؟<br> با این کار تمام زیردسته های مربوط به این گروه حذف خواهند شد.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.value) {
                    axios.post('/admin/car/delete', {
                         id: $(this).parents('.itemsbox').attr('data-id')
                    })
                        .then(function (response) {
                            console.log(response);
                        })
                    Swal.fire(
                        'حذف شد!',
                        'Your file has been deleted.',
                        'success'
                    ),
                        Swal.fire('عملیات موفق', 'کلاس با موفقیت حذف شد', 'success');
                    $this.parents('.col-lg-3.col-sm-6').remove();
                }
            })
        });
        $('body').on("click", '.eddititem', function () {
            var cn = $(this).parents('.col-lg-3.col-sm-6').find('.itemsbox .itemsboxname').html();
            var dataid = $(this).parents('.itemsbox').attr('data-id');

            $('#itemname').val(cn);
            $('input[name=car_id]').val( dataid);
            $('.edditbuttons').removeClass('d-none').addClass('d-flex');
            $('.addbuttons').removeClass('d-flex').addClass('d-none');


            $(this).parents('.testperson').addClass("isEditing");
        });
        $('body').on("click", '.cancleeddit', function () {
            $('#itemname').val("");
            $('input[name=car_id]').val("0");
            $('.addbuttons').removeClass('d-none').addClass('d-flex');
            $('.edditbuttons').removeClass('d-flex').addClass('d-none');
            $('.edditbuttons .eddit').attr('data-id', 0);
        });
        $('body').on("click", '.edditbuttons .eddit', function () {
            let val = $('#itemname').val();
            const $this = $(this);
            if (val !== "") {
                $('.addbuttons').removeClass('d-none').addClass('d-flex');
                $('.edditbuttons').removeClass('d-flex').addClass('d-none');
                $('.edditbuttons .eddit').attr('data-id', 0);
                $('#itemname').val("");
            } else
                $('#itemname').addClass('error').attr('placeholder', 'خالی می باشد');
        });
    </script>
@endsection



