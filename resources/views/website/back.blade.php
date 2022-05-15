@extends('website.layout.app')

@section('title','درباره ما')

@section('style')
<style>
    .ct {
        text-align: center;
    }
    .ct span {
        color: #4a4;
        font-size: 27px;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="detailsbox">
            <div class="detailsboxheader">
                <a href="/" class="backpage">
                    <i class="la la-angle-right"></i>
                    صفحه نخست
                </a>
                <span class="detailsboxname d-block text-center">
                    تایید پرداخت
                </span>
            </div>
            <div class="p-5"><p class="text-justify">
                <p style="text-align: center">از انتخاب بیمه باش کمال تشکر را داریم بیمه صادر شده برای شما ارسال خواهد شد.</p>
                <p class="ct" >شماره تراکنش : <span >{{$verifySaleReferenceId}}</span></p>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>

    </script>
@endsection



