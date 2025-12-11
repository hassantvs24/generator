@extends('layouts.master')
@extends('box.customer.customer')

@section('title')
    Customer List
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <p><button type="button" class="btn btn-primary btn-labeled" data-toggle="modal" data-target="#myModal"><b><i class="icon-file-plus"></i></b> Add New Customer</button></p>
        </div>
        <div class="col-md-6"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h6 class="panel-title">All Customer List</h6>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-condensed table-hover datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Area</th>
                            <th>Address</th>
                            <th>Balance</th>
                            <th>Service</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table as $row)
                            <tr>
                                <td>{{$row->customerID}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->contact}}</td>
                                <td>{{$row->area['name']}}</td>
                                <td>{{$row->address}}</td>
                                <td>{{money($row->balance)}}</td>
                                @php
                                    $service_count = $row->service()->where('status', 'Active')->count();
                                @endphp
                                <td>{{$service_count}}</td>
                                <td class="text-right white_sp">
                                    <a href="{{action('Customer\CustomerController@details', ['id' => $row->customerID])}}" class="btn btn-xs btn-info no-padding mr-5" title="Service Setup & View Details"><i class="icon-wrench"></i></a>
                                    <button class="btn btn-xs btn-success no-padding mr-5 ediBtn"
                                            data-id="{{$row->customerID}}"
                                            data-name="{{$row->name}}"
                                            data-category="{{$row->customerCatID}}"
                                            data-area="{{$row->areaID}}"
                                            data-father="{{$row->fatherName}}"
                                            data-mother="{{$row->motherName}}"
                                            data-contact="{{$row->contact}}"
                                            data-dob="{{pub_date($row->dob)}}"
                                            data-nid="{{$row->nid}}"
                                            data-address="{{$row->address}}"
                                            data-photo="{{ck_file('general', 'public/upload', $row->primaryPhoto)}}"

                                            data-toggle="modal"
                                            data-target="#ediModal"
                                            title="Edit"><i class="icon-pencil5"></i></button>
                                    <!--<a class="btn btn-xs btn-danger no-padding" href="{{action('Customer\CustomerController@del', ['id' => $row->customerID])}}" onclick="return confirm('Are you sure to delete?')" title="Delete"><i class="icon-bin"></i></a>-->
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
            $('.area_select').select2();
            $('.category_select').select2();
        });

        $(function () {
            $('.ediBtn').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var category = $(this).data('category');
                var area = $(this).data('area');
                var father = $(this).data('father');
                var mother = $(this).data('mother');
                var contact = $(this).data('contact');
                var dob = $(this).data('dob');
                var nid = $(this).data('nid');
                var address = $(this).data('address');
                var photo = $(this).data('photo');

                $('#ediID').val(id);
                $('#ediModal [name=name]').val(name);
                $('#ediModal [name=customerCatID]').val(category);
                $('#ediModal [name=areaID]').val(area);
                $('#ediModal [name=fatherName]').val(father);
                $('#ediModal [name=motherName]').val(mother);
                $('#ediModal [name=contact]').val(contact);
                $('#ediModal [name=dob]').val(dob);
                $('#ediModal [name=nid]').val(nid);
                $('#ediModal [name=address]').val(address);
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