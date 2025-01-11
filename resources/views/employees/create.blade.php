@extends('layouts.master')
@section('title', 'إضافة موظف جديد')

@section('css')
<!-- Internal Select2 css -->
 <!--- Internal Select2 css-->
 <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
 <!---Internal Fileupload css-->
 <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
 <!---Internal Fancy uploader css-->
 <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
 <!--Internal Sumoselect css-->
 <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
 <!--Internal  TelephoneInput css-->
 <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضاقة موظف</span>
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
                            <form class="form-horizontal" action="{{ route('employees.store') }}" method="POST">
                                @csrf
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">اسم الموظف الرباعي</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" value="{{ old('name', '') }}" class="form-control" name="name"  >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">رقم الهوية</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" value="{{ old('identity_number', '') }}" class="form-control" name="identity_number" >
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
                                                <option></option>
                                                <option value="مثبت" {{ old('position') == 'مثبت' ? 'selected' : '' }}>مثبت</option>
                                                <option value="عضو مجلس" {{ old('position') == 'عضو مجلس' ? 'selected' : '' }}>عضو مجلس</option>
                                                <option value="عقد" {{ old('position') == 'عقد' ? 'selected' : '' }}>عقد</option>
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
                                                <option value="متزوج" {{ old('status') == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                                                <option value="أعزب" {{ old('status') == 'أعزب' ? 'selected' : '' }}> أعزب</option>
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
                                            <input type="text" value="{{ old('wife_name', '') }}" class="form-control" name="wife_name"  >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">رقم هوية الزوجة</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" value="{{ old('wife_identity_number', '') }}" class="form-control" name="wife_identity_number" >
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
                                            <input type="email" value="{{ old('email', '') }}" class="form-control" name="email" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">كلمة المرور</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control" name="password" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">عدد أفراد الأسرة</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="family_size" value="{{ old('family_size', '') }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">رقم الجوال</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone', '') }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">الصورة الشخصية</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                                data-height="70" />
                                        </div><br>
                                    </div>
                                </div>
                                
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
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
@endsection