@extends('admin.layout.app')

@section('title',' افزودن بیمه')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        @if($save==1)
        <div class="alert alert-success fade in alert-dismissible show">
            بیمه مورد نظر افزوده شد
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
                                <i class="la la-plus"></i>افزودن بیمه
                            </span>
                        <a href="/admin/insurance/"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            مشاهده بیمه ها
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8">
                                <form action="/admin/insurance/create" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <input type="hidden" name="id" value="{{$ins->id}}">
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">نام بیمه</label>
                                                <input class="form-control" name="name" id="name" value="{{$ins->name}}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>لوگوی بیمه</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="customFile" id="customFile">
                                                    <label class="custom-file-label text-left" for="customFile">
                                                        انتخاب فایل</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="more">توضیحات بیمه</label>
                                                <textarea class="form-control" name="description" id="more"
                                                          rows="4">{{$ins->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="rank">امتیاز بیمه</label>
                                                <select class="custom-select" id="star" name="star">
                                                    <option>انتخاب کنید</option>
                                                    @for($i=1;$i<=5;$i++)
                                                    <option @if($i==$ins->star) selected @endif >{{$i}}</option>
                                                        @endfor

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button
                                                class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                id="add">
                                                افزودن بیمه
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



