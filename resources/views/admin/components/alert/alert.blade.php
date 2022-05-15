@if(\Session::has('success'))
    @component('admin.components.alert.ui_alert', ['type' => "success"])
        {{\Session::get('success')}}
    @endcomponent
@endif

@if($errors->any())
    @foreach ($errors->all() as $error)
        @component('admin.components.alert.ui_alert', ['type' => "danger"])
            {{$error}}
        @endcomponent
    @endforeach
@endif