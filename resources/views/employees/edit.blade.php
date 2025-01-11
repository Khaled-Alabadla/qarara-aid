@extends('layouts.master')
@section('title', 'تعديل موظف ')

@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل موظف</span>
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
                            {{-- <div class="mb-4 main-content-label">Personal Information</div> --}}
                            <form class="form-horizontal" action="{{ route('employees.update', $employee->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">اسم الموظف الرباعي</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $employee->name) }}"  >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">رقم الهوية</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="identity_number"
                                            value="{{ old('identity_number', $employee->identity_number) }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">المركز الوظيفي</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control select2-no-search" name="position">
                                                <option value="مثبت" {{ old('position', $employee->position) == 'مثبت' ? 'selected' : '' }}>مثبت</option>
                                                <option value="عضو مجلس" {{ old('position', $employee->position) == 'عضو مجلس' ? 'selected' : '' }}>عضو مجلس</option>
                                                <option value="عقد" {{ old('position', $employee->position) == 'عقد' ? 'selected' : '' }}>عقد</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">الحالة الاجتماعية</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control select2-no-search" name="status">
                                                <option ></option>
                                                <option value="متزوج" {{ old('status', $employee->status) == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                                                <option value="أعزب" {{ old('status', $employee->status) == 'أعزب' ? 'selected' : '' }}> أعزب</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">اسم الزوجة الرباعي</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" value="{{ old('wife_name', $employee->wife_name) }}" class="form-control" name="wife_name"  >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">رقم هوية الزوجة</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" value="{{ old('wife_identity_number', $employee->wife_identity_number) }}" class="form-control" name="wife_identity_number" >
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="mb-4 main-content-label">Name</div> --}}
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">البريد الإلكتروني</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" value="{{ old('email', $employee->email??'') }}" class="form-control" name="email" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">عدد أفراد الأسرة</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="family_size" value="{{ old('family_size', $employee->family_size) }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">رقم الجوال</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $employee->phone) }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">تعديل</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection