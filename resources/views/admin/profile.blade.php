@extends('admin.layout.app')

@section('title',' پروفایل')

@section('style')

@endsection

@section('content')
    <div class="container-fluid" id="profile-page">
        @if($save==1)
        <div class="alert alert-success fade in alert-dismissible show">
            ویرایش اطلاعات با موفقیت انجام شد
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
                        <i class="la la-user"></i>ویرایش اطلاعات کاربری
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row">
                            <div
                                class="profile-page w-100 d-flex align-items-center justify-content-center flex-wrap p-4">
                                <form action="/admin/profile/edit" method="post" class="w-100">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="boxtitle">
                                                اطلاعات شخصی
                                            </div>

                                        </div>
                                        <div class="col-md-8 col-sm-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="name" class="text-danger"></label>
                                                    <input class="form-control" name="name" id="name" type="text"
                                                           placeholder="نام و نام خانوادگی" value="{{auth()->user()->name}}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="mobile" class="text-danger"></label>
                                                    <input class="form-control" name="phone" id="mobile"
                                                           type="text" placeholder="شماره همراه" value="{{auth()->user()->phone}}">
                                                </div>

                                                <div class="col-12">
                                                    <label for="addres" class="text-danger"></label>
                                                    <textarea class="form-control" name="address" id="addres"
                                                              placeholder="آدرس">{{auth()->user()->address}}</textarea>
                                                </div>
                                                <div class="col-12 text-left mt-3">
                                                    <button class="btn btn-success">ثبت اطلاعات</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                                <form action="/admin/profile/changepass" method="post" class="w-100">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6">

                                        </div>
                                        <div class="col-md-8 col-sm-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="boxtitle">
                                                        رمز عبور
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="pass" class="text-danger"></label>
                                                    <div class="form-group">
                                                        <input class="form-control" type="password" name="pass"
                                                               id="pass" placeholder="کلمه عبور جدید"
                                                               autocomplete="new-password">
                                                        <div class="passsee">
                                                            <i class="la la-eye-slash"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="reppass" class="text-danger"></label>
                                                    <input class="form-control" name="reppass" id="reppass"
                                                           type="text" placeholder="تکرار رمز عبور">

                                                </div>
                                                <div class="col-12 text-left mt-3">
                                                    <button class="btn btn-success">تغییر رمز عبور</button>
                                                </div>
                                            </div>
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
            var dataid = $(this).parent().attr('data-id');
            $('#itemname').val(cn);
            $('.edditbuttons .eddit').attr('data-id', dataid);
            $('.edditbuttons').removeClass('d-none').addClass('d-flex');
            $('.addbuttons').removeClass('d-flex').addClass('d-none');


            $(this).parents('.testperson').addClass("isEditing");
        });
        $('body').on("click", '.cancleeddit', function () {
            $('#itemname').val("");
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



