@extends('layouts.master')
@section('title', 'إضافة مسؤول جديد')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المسؤولين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضاقة مسؤول</span>
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
                            <form class="form-horizontal" action="{{ route('admins.store') }}" method="POST">
                                @csrf
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">الاسم</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control select2" name="id">
                                                <option label="اختر موظف">
                                                @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" >{{ $employee->name }}</option>  
                                                @endforeach
                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">الصلاحية</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control select2-no-search" name="role">
                                                <option label="اختر الصلاحية">
                                                </option>
                                                <option value="admin">
                                                    مسؤول
                                                </option>
                                                <option value="super_admin">
                                                    مشرف أعلى
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="mb-4 main-content-label">Name</div> --}}
                                
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">إضافة</button>
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