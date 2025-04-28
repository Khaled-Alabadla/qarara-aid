@extends('layouts.master')
@section('title', 'إضافة مساعدة جديدة')

@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">

    <style>
        .form-check {
            margin-bottom: 7px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            position: relative !important;
        }

        .form-check-label {
            width: 40%;
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between align-items-center">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المساعدات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضاقة
                    مساعدة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-horizontal" action="{{ route('assistances.store') }}" method="POST">
                        @csrf
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">نوع المساعدة</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" value="{{ old('type', '') }}" class="form-control" name="type">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">الكمية</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" value="{{ old('quantity', '') }}" class="form-control"
                                        name="quantity">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">الجهة المانحة</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control select2-no-search" name="donor_id">
                                        <option value=""></option>
                                        @foreach ($donors as $donor)
                                            <option value="{{ $donor->id }}"
                                                {{ old('donor_id') == $donor->id ? 'selected' : '' }}>{{ $donor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">تاريخ الوصول</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" name="date"
                                            value="{{ old('date', date('d/m/Y')) }}" placeholder="Day/Month/Year"
                                            type="text">
                                    </div><!-- wd-200 -->
                                </div>

                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">ملاحظات</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="notes" class="form-control" placeholder="أدخل أي ملاحظات" rows="3"> </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">الموظفين المستلمين</label>
                                </div>
                                <div class="col-md-9 ">
                                    <!-- Select All Checkbox -->
                                    <div
                                        class="form-check d-flex align-items-center justify-content-between gap-3 mb-3 border-bottom pb-2">

                                        <div class="form-check mb-3 d-flex align-items-center col-4">
                                            <input class="form-check-input ml-3" type="checkbox" id="select-all">
                                            <label class="form-check-label" for="select-all">تحديد الكل</label>
                                        </div>

                                        <!-- Search for Employees -->
                                        <div class="form-group col-6">
                                            <div class="row">
                                                <div class="w-100">
                                                    <input type="text" id="employeeSearch" class="form-control"
                                                        placeholder="ابحث عن الموظف بالاسم">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @foreach ($employees as $employee)
                                        <div
                                            class="form-check d-flex align-items-center justify-content-between gap-3 mb-3 border-bottom pb-2 employee-item">
                                            <!-- Checkbox Input -->
                                            <input class="form-check-input employee-checkbox" type="checkbox"
                                                id="employee-{{ $employee->id }}"
                                                name="employees[{{ $employee->id }}][selected]"
                                                value="{{ $employee->id }}"
                                                data-quantity-id="quantity-{{ $employee->id }}"
                                                {{ old("employees.$employee->id.selected") ? 'checked' : '' }}>

                                            <!-- Employee Name -->
                                            <label class="form-check-label employee-name"
                                                for="employee-{{ $employee->id }}">
                                                {{ $employee->name }}
                                            </label>

                                            <label for="quantity-{{ $employee->id }}">الكمية المستلمة</label>
                                            <!-- Quantity Input -->
                                            <input type="number" class="form-control employee-quantity"
                                                style="width: 20%" id="quantity-{{ $employee->id }}"
                                                name="employees[{{ $employee->id }}][quantity]" min="1"
                                                placeholder="الكمية"
                                                value="{{ old("employees.{$employee->id}.quantity", 0) }}"
                                                {{ old("employees.{$employee->id}.selected") ? '' : 'readonly' }}>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // Handle Select All functionality
        const selectAllCheckbox = document.getElementById('select-all');
        const employeeCheckboxes = document.querySelectorAll('.employee-checkbox');
        const quantityInputs = document.querySelectorAll('.employee-quantity');

        selectAllCheckbox.onclick = function() {
            const isChecked = selectAllCheckbox.checked;
            employeeCheckboxes.forEach((checkbox, index) => {
                checkbox.checked = isChecked;
                quantityInputs[index].readOnly = !isChecked;
                if (isChecked) {
                    quantityInputs[index].value = 1;
                } else {
                    quantityInputs[index].value = 0;
                }
            });
        };

        // Handle individual employee checkbox functionality
        employeeCheckboxes.forEach((checkbox, index) => {
            checkbox.onclick = function() {
                if (checkbox.checked) {
                    quantityInputs[index].readOnly = false;
                    quantityInputs[index].value = 1;
                } else {
                    quantityInputs[index].readOnly = true;
                    quantityInputs[index].value = 0;
                }
            };
        });

        // Handle employee search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('employeeSearch');
            const employeeItems = document.querySelectorAll('.employee-item');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();


                employeeItems.forEach((item) => {
                    const employeeName = item.querySelector('.employee-name').textContent
                        .toLowerCase();
                    // console.log(employeeName);     

                    if (employeeName.includes(searchTerm)) {
                        item.style.display = 'flex';
                        console.log(employeeName);

                    } else {
                        item.style.setProperty('display', 'none',
                            'important'); // Hide the item with !important
                    }
                });
            });
        });
    </script>
    <!-- jQuery -->

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>


@endsection
