@extends('layouts.master')
@section('title', 'عرض قائمة الموظفين وصلاحياتهم')

@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>
        thead tr th,
        tbody tr td {
            display: table-cell !important
        }

        table#example {
            width: 100% !important;
            margin: 0
        }

        .alert {
            /* visibility: visible; */
            transition: all 0.5s ease;
            /* margin: 0 !important */
        }

        .buttons-pdf {
            display: none !important
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">صلاحيات المستخدمين</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة الموظفين والصلاحيات المنسوبة إليهم</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">



        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"> صلاحيات الموظفين</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                    {{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Bordered Table.. <a href="">Learn more</a></p> --}}
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    {{-- <th class="border-bottom-0">#</th> --}}
                                    <th class="border-bottom-0">اسم الموظف</th>
                                    <th class="border-bottom-0"> الصلاحيات</th>
                                    @can('roles.users.update')
                                        <th class="border-bottom-0">العمليات</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                        <td>{{ $employee->name }}</td>
                                        <td>
                                            @foreach ($employee->roles as $role)
                                                <span class="badge bg-success p-2 text-white">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('roles.users.update')
                                                <a href="{{ route('employees.roles.edit', $employee->id) }}"
                                                    class="btn btn-primary-gradient btn-sm">تعديل الصلاحيات</i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف الموظف</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {{-- <h6>Modal Body</h6> --}}
                    <p>هل أنت متأكد من عملية الحذف؟</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn ripple btn-danger">حفظ التغييرات</button>
                    </form>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                </div>

            </div>
        </div>
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

    <script>
        // Function to hide alert after 5 seconds
        function hideAlert(id) {
            setTimeout(function() {
                let alertElement = document.getElementById(id);
                if (alertElement) {
                    // alertElement.style.visibility='hidden';
                    alertElement.style.opacity = 0;
                    alertElement.style.maxHeight = 0;
                    alertElement.style.padding = 0;
                    alertElement.style.marginBottom = 0
                }
            }, 5000);
        }

        @if (session('success'))
            hideAlert('success-alert');
        @endif
    </script>
    <script>
        $('#modaldemo1').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var employeeId = button.data('id'); // Extract the ID from data-* attributes
            var modal = $(this);
            modal.find('form').attr('action', '/employees/' + employeeId);
        });
    </script>
@endsection
