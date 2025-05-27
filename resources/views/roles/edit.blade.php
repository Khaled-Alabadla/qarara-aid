@extends('layouts.master')
@section('title', 'تعديل الصلاحية')

@section('css')
    <!-- Internal Select2 css -->
    <link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
    <style>
        .form-check {
            margin-bottom: 7px
        }

        input[type="radio"],
        input[type="checkbox"] {
            position: relative !important;
        }

        .form-check-label {
            width: 40%
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الصلاحيات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                    الصلاحية</span>
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
                    <form class="form-horizontal" action="https://qarara-aid.vercel.app/roles/{{ $role->id }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">اسم الصلاحية </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" value="{{ old('name', $role->name) }}" class="form-control"
                                        name="name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">ما الذي يمكنه القيام به؟</label>
                                </div>
                                <div class="col-md-9">
                                    @foreach ($abilities as $ability => $ability_label)
                                        <div class="form-check d-flex align-items-center gap-3 mb-3 border-bottom pb-2"
                                            style="gap: 35px">
                                            <!-- Checkbox Input -->
                                            <input class="form-check-input" type="checkbox" id="{{ $ability }}"
                                                name="abilities[{{ $ability }}] " value="{{ $ability }}"
                                                @checked($role->abilities->contains('ability', $ability)) >

                                            <label class="form-check-label" for="{{ $ability }}">
                                                {{ $ability_label }}
                                            </label>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary waves-effect waves-light my-2">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="/assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Internal Select2.min js -->
    <script src="/assets/plugins/select2/js/select2.min.js"></script>
    <script src="/assets/js/select2.js"></script>
@endsection
