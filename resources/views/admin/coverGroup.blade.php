@extends('admin.layout.app')

@section('title','  لیست گروه تعرفه ای')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">


        <!------------giftlist-------------->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="boxtitle">
                        <i class="la la-file-alt"></i> پوشش های ثبت شده برای {{$insurance->name}}
                        <a href="/admin/cover/create/{{$insurance->id}}"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            ثبت پوشش
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row" id="filter">
                            <div class="col-12 mb-4">
                                <input class="form-control" id="myInput" type="text" placeholder="جست و جو ..">
                            </div>
                            @foreach($covers as $cover)
                            <div class="col-lg-3 col-sm-6 mb-3">
                                <div class="itemsbox flex-column">
                                    <ul class="w-100 p-1">
                                        <li class="d-flex justify-content-between mb-1">
                                            <span class="text-muted f-12">گروه تعرفه</span>
                                            <span class="itemsname text-success">{{$cover->plan->name}}</span>
                                        </li>
                                        <li class="d-flex justify-content-between mb-1">
                                            <span class="text-muted f-12">سقف پوشش</span>
                                            <span class="itemsname">{{number_format($cover->cover_price,0)}} میلیون تومان</span>
                                        </li>
                                        <li class="d-flex justify-content-between mb-1">
                                            <span class="text-muted f-12">میزان افزایش سالانه</span>
                                            <span class="itemsname">{{number_format($cover->price,0)}} ریال</span>
                                        </li>


                                    </ul>
                                    <div class="w-100">
                                        <button data-id="{{$cover->id}}" class="btn btn-danger w-40 deleteitem"><i
                                                class="la la-trash-o"></i></button>

                                        <a href="{{ route('cover.edit', ['commitment' => $cover->id]) }}" class="btn btn-warning w-40 inline-block"><i
                                                    class="la la-edit"></i></a>
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
                html: "آیا از حذف پوشش مطمئن هستید؟.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.value) {
                    axios.post('/admin/cover/delete',{id:$(this).attr('data-id')}).then(function () {
                        Swal.fire(
                            'حذف شد!',
                            'Your file has been deleted.',
                            'success'
                        ),
                            Swal.fire('عملیات موفق', 'پوشش با موفقیت حذف شد', 'success');
                        $this.parents('.col-lg-3.col-sm-6').remove();
                    });

                }
            })
        });
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#filter .col-lg-3.col-sm-6.mb-3").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        })
    </script>


@endsection



