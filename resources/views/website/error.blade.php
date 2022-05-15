@extends('website.layout.app')

@section('title','پرداخت')

@section('style')
    <style>
        header, footer {
            display: none;
        }

        main {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            }
        i
        {
            font-size: 55px;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="text-center">
            <i class="la la-times text-danger"></i>
            <p class="text-center">
                پرداخت با موفقیت انجام نشد
            </p>
            <a href="bank://error" class="btn btn-outline-danger mt-2">
                بازگشت به اپلیکیشن
            </button>
        </div>

    </div>
@endsection

@section('script')
    <script src="{{asset('website/js/select2.min.js')}}"></script>
    <script src="{{asset('website/js/persian-date.min.js')}}"></script>
    <script src="{{asset('website/js/persian-datepicker.min.js')}}"></script>

@endsection



