@extends('admin.layout.app')

@section('title','  افزودن مدل خودرو')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
    <!------------giftlist-------------->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="boxtitle">
                            <span class="d-flex align-items-center">
                                <i class="la la-plus"></i>افزودن مدل خودرو
                            </span>
                        <a href="{{ route('admin.car-models.index') }}"
                           class="btn btn-primary d-flex align-items-center justify-content-center mr-auto ml-0 mt-2">
                            مشاهده مدل های خودرو
                        </a>

                        <a href="{{ route('admin.car-models.default') }}"
                           class="btn btn-primary d-flex align-items-center ml-0 mt-2 mr-2">
                            انتخاب پیشفرض
                        </a>
                    </div>
                    <div class="container-fluid mt-2 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8">
                                <form action="{{ route('admin.car-models.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">عنوان مدل خودرو</label>
                                                <input class="form-control " name="title" id="title" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="carType">نوع خودرو</label>
                                                <select class="custom-select" id="carType" name="carType" required onchange="getPlans(this)">
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    @foreach($carTypes as $car)
                                                        <option value="{{$car->id}}">{{$car->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="plans">گروه تعرفه ای</label>
                                                <select class="custom-select" id="plans" name="plans" required>
                                                    <option value="" disabled selected>انتخاب کنید</option>
                                                    @foreach($plans as $plan)
                                                        <option value="{{$plan->id}}">{{$plan->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button name="add"
                                                    class="btn btn-success d-flex align-items-center justify-content-center mr-auto ml-0 mt-2"
                                                    id="add">
                                                افزودن مدل خودرو
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
    <script type="text/javascript">
        let plansSelect = document.getElementById('plans');
        const getPlans = (carType) => {
            fetch('/admin/car-types/' + carType.value + '/plans', {
                method: 'POST',
                body: carType.value,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .then(response => response.json())
            .then(plans => {
                plansSelect.innerHTML = '';
                plans.forEach(plan => {
                    createPlansUi(plan);
                })
            })
        }

        const createPlansUi = (plan) => {
            let option = `<option value="${plan.id}">${plan.name}</option>`;
            if (plansSelect !== undefined)
                plansSelect.innerHTML += option;
        }
    </script>
@endsection



