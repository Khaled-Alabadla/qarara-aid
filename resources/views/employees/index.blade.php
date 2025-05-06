@extends('layouts.master')
@section('title', 'عرض الموظفين')

@section('css')
    <!-- Internal Data table css -->
    <link href="/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatable/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatable/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatable/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
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
                <h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة الموظفين</span>
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
                        <h4 class="card-title mg-b-0">الموظفين</h4>
                        @can('employees.create')
                            <a href="https://qarara-aid.vercel.app/employees/create" class="btn btn-primary">إضافة موظف جديد</a>
                        @endcan
                    </div>

                    {{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Bordered Table.. <a href="">Learn more</a></p> --}}
                </div>
                <div class="col-3 mb-3">
                    <div class="col-md-4">
                        <select id="pageLength" class="form-control">
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="-1">الكل</option>
                        </select>
                    </div>
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
                                    <th class="border-bottom-0">الاسم</th>
                                    <th class="border-bottom-0">رقم الهوية</th>
                                    <th class="border-bottom-0">المركز الوظيفي</th>
                                    <th class="border-bottom-0">الحالة</th>
                                    <th class="border-bottom-0"> اسم الزوجة</th>
                                    <th class="border-bottom-0"> رقم هوية الزوجة</th>

                                    <th class="border-bottom-0">عدد الأفراد </th>
                                    <th cla\ss="border-bottom-0">رقم الجوال</th>
                                    @if (auth()->user()->can('employees.create') ||
                                            auth()->user()->can('employees.delete') ||
                                            auth()->user()->can('employees.attachments.index') ||
                                            auth()->user()->can('employees.employee.attachments.index'))
                                        <th>العمليات</th>
                                    @endif

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->identity_number }}</td>
                                        <td>{{ $employee->position }}</td>
                                        <td>{{ $employee->status }}</td>
                                        <td>{{ $employee->wife_name }}</td>
                                        <td>{{ $employee->wife_identity_number }}</td>
                                        <td>{{ $employee->family_size }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        @if (auth()->user()->can('employees.create') ||
                                                auth()->user()->can('employees.delete') ||
                                                auth()->user()->can('employees.attachments.index') ||
                                                auth()->user()->can('employees.employee.attachments.index'))
                                            <td class="d-flex" style="gap: 3px">
                                                @if (auth()->id() != $employee->id && auth()->user()->can('employees.update'))
                                                    <a href="https://qarara-aid.vercel.app/employees/{{ $employee->id }}/edit"
                                                        class="btn btn-primary-gradient btn-sm d-flex justify-content-center align-items-center">
                                                        تعديل</i></a>
                                                @endif

                                                @if (auth()->id() != $employee->id && auth()->user()->can('employees.delete'))
                                                    <a class="btn btn-danger-gradient btn-sm d-flex justify-content-center align-items-center"
                                                        data-target="#modaldemo1" data-toggle="modal" href=""
                                                        data-id="{{ $employee->id }}">حذف</a>
                                                @endif
                                                @if (auth()->user()->can('employees.attachments.index') ||
                                                        (auth()->user()->can('employees.employee.attachments.index') && Auth::id() == $employee->id))
                                                    <a href="https://qarara-aid.vercel.app/employees/{{ $employee->id }}/attachments"
                                                        class="btn btn-primary-gradient btn-sm d-flex justify-content-center align-items-center">المرفقات</i></a>
                                                @endcan
                                        </td>
                                    @endif

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
<script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatable/js/responsive.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/js/jquery.dataTables.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatable/js/jszip.min.js"></script>
<script src="/assets/plugins/datatable/js/pdfmake.min.js"></script>
<script src="/assets/plugins/datatable/js/vfs_fonts.js"></script>
<script src="/assets/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="/assets/plugins/datatable/js/buttons.print.min.js"></script>
<script src="/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatable/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/js/table-data.js"></script>

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
<script>
    $(document).ready(function() {
        // Retrieve saved page length or default to 10
        let savedLength = parseInt(localStorage.getItem('pageLength')) || 10;

        // Check if DataTable is already initialized, destroy if necessary
        if ($.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable().destroy(); // Destroy existing DataTable instance
        }

        // Initialize DataTable
        let table = $('#example').DataTable({
            pageLength: savedLength, // Default or saved page length
            lengthMenu: [ // Define the dropdown options
                [10, 25, 50, -1], // Values
                [10, 25, 50, "الكل"] // Displayed options
            ],
            responsive: true,
            dom: 'Bfrtip',
            buttons: ['excel', 'colvis']
        });

        // Set the default dropdown value
        $('#pageLength').val(savedLength);

        // Update DataTable and save user preference on dropdown change
        $('#pageLength').on('change', function() {
            let length = parseInt($(this).val(), 10) || 10; // Ensure valid integer
            table.page.len(length === -1 ? table.data().length : length).draw(); // Handle "all rows"
            localStorage.setItem('pageLength', length); // Save preference
        });
    });
</script>


@endsection
