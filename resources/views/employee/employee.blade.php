@extends('layouts.master')
@extends('box.employee.employee')

@section('title')
    Employee List
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <p><button type="button" class="btn btn-primary btn-labeled" data-toggle="modal" data-target="#myModal"><b><i class="icon-file-plus"></i></b> Add New Employee</button></p>
        </div>
        <div class="col-md-6"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h6 class="panel-title">All Employee List</h6>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-condensed table-hover datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Designation</th>
                            <th>Address</th>
                            <th>Salary</th>
                            <th>Balance</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table as $row)
                            <tr>
                                <td>{{$row->employeeID}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->contact}}</td>
                                <td>{{$row->position}}</td>
                                <td>{{$row->address}}</td>
                                <td>{{money($row->salary)}}</td>
                                <td>{{money($row->balance)}}</td>
                                <td class="text-right white_sp">
                                    <button class="btn btn-xs btn-success no-padding mr-5 ediBtn"
                                            data-id="{{$row->employeeID}}"
                                            data-name="{{$row->name}}"
                                            data-father="{{$row->fatherName}}"
                                            data-mother="{{$row->motherName}}"
                                            data-contact="{{$row->contact}}"
                                            data-dob="{{pub_date($row->dob)}}"
                                            data-nid="{{$row->nid}}"
                                            data-address="{{$row->address}}"
                                            data-position="{{$row->position}}"
                                            data-salary = "{{$row->salary}}"
                                            data-photo="{{ck_file('general', 'public/upload', $row->primaryPhoto)}}"

                                            data-toggle="modal"
                                            data-target="#ediModal"
                                            title="Edit"><i class="icon-pencil5"></i></button>
                                    <a class="btn btn-xs btn-danger no-padding" href="{{action('EmployeeController@del', ['id' => $row->employeeID])}}" onclick="return confirm('Are you sure to delete?')" title="Delete"><i class="icon-bin"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/pickers/daterangepicker.js')}}"></script>


    <script type="text/javascript">

        $(function () {
            $('.ediBtn').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var father = $(this).data('father');
                var mother = $(this).data('mother');
                var contact = $(this).data('contact');
                var dob = $(this).data('dob');
                var nid = $(this).data('nid');
                var address = $(this).data('address');
                var position = $(this).data('position');
                var photo = $(this).data('photo');
                var salary = $(this).data('salary');

                $('#ediID').val(id);
                $('#ediModal [name=name]').val(name);
                $('#ediModal [name=fatherName]').val(father);
                $('#ediModal [name=motherName]').val(mother);
                $('#ediModal [name=contact]').val(contact);
                $('#ediModal [name=dob]').val(dob);
                $('#ediModal [name=nid]').val(nid);
                $('#ediModal [name=address]').val(address);
                $('#ediModal [name=position]').val(position);
                $('#ediModal [name=salary]').val(salary);
                $('.previewEdi').attr('src', photo);

                $('.area_select2').select2();
                $('.category_select2').select2();

            });
        });



        $(function () {
            $('.maxlength').maxlength({
                placement: 'top'
                // threshold: ($('.maxlength').attr('maxlength') - ($('.maxlength').attr('maxlength')-5))
            });
        });

        $(function () {
            $('.date_pic').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
        });

        $(function () {
            $("#inputFile").change(function () {
                imgPrev(this , '.preview');
            });

            $("#inputFileEdi").change(function () {
                imgPrev(this , '.previewEdi');
            });

        });


        $(function () {

            $('.datatable').DataTable({
                order: [[ 0, "desc" ]],
                columnDefs: [
                    { orderable: false, "targets": [7] }//For Column Order
                ]
            });

        });



    </script>

@endsection