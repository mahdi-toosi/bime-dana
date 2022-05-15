@extends('admin.layout.app')

@section('title','  لیست کاربری')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">


        <!------------giftlist-------------->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="boxtitle">
                        <i class="la la-file-alt"></i> کاربری های ثبت شده
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row" id="filter">
                            <div class="col-12 mb-4">
                                <input class="form-control" id="myInput" type="text" placeholder="جست و جو ..">
                            </div>
                            @foreach($usages as $usage)
                            <div class="col-lg-3 col-sm-6 mb-3">
                                <div class="itemsbox flex-column">
                                    <ul class="w-100 p-1">
                                        <li class="d-flex justify-content-between mb-1">
                                            <span class="text-muted f-12">نوع وسیله نقله</span>
                                            <span class="itemsname text-success">{{$usage->car->name}}</span>
                                        </li>
                                        <li class="d-flex justify-content-between mb-1">
                                            <span class="text-muted f-12">نوع کاربری</span>
                                            <span class="itemsname">{{$usage->name}}</span>
                                        </li>
                                        <li class="d-flex justify-content-between mb-1">
                                            <span class="text-muted f-12">نوع درصد افزایش</span>
                                            <span class="itemsname">@if($usage->type==1) ثابت
                                            @else
                                            ضریبی
                                            @endif
                                            </span>
                                        </li>
                                        <li class="d-flex justify-content-between mb-1">
                                            <span class="text-muted f-12">میزان  افزایش</span>
                                            <span class="itemsname">
                                                @if($usage->type==1)
                                                    {{number_format($usage->percentage,0)}}
                                                @else
                                                    {{$usage->percentage."%"}}
                                                @endif

                                            </span>
                                        </li>
                                    </ul>
                                    <div class="w-100">
                                        <button data-id="{{$usage->id}}" class="btn btn-danger w-100 deleteitem"><i
                                                class="la la-trash-o"></i></button>
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
                html: "آیا از حذف مورد استفاده مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.value) {
                    axios.post('/admin/usage/delete',{id:$(this).attr('data-id')}).then(function(){


                    Swal.fire(
                        'حذف شد!',
                        'Your file has been deleted.',
                        'success'
                    ),
                        Swal.fire('عملیات موفق', 'مورد استفاده با موفقیت حذف شد', 'success');
                    $this.parents('.col-lg-3.col-sm-6').remove();
                    })
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



