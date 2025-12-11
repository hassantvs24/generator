@extends('layouts.general')
@extends('box.edi_colector_customer')
@section('title')
    View Due Customer
@endsection

@section('back-url')
    <div class="col-xs-4"><a class="btn btn-danger btn-xs heading-btn" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-arrow-left16 position-left"></i> Logout</a></div>
    <div class="col-xs-8 text-right"><i class="icon-user position-left"></i> {{ isset(Auth::user()->name) ? Auth::user()->name : 'User name' }}</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="icon-user-tie"></i> View Due Customer</h4>
                </div>
                <div class="panel-body">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-xs-6 text-bold text-violet">Total Collection: {{$counts}}</div>
                            <div class="col-xs-6 text-bold text-danger text-right">Total Amount Collection: {{money($amount)}}</div>
                        </div>

                        <table class="table table-bordered table-condensed table-hover datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Area</th>
                                <th>Service</th>
                                <th>Due</th>
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
                                    @php
                                        $service_count = $row->service()->where('status', 'Active')->count();
                                    @endphp
                                    <td>{{$service_count}}</td>
                                    <td>{{money_abs($row->balance)}}</td>
                                    <td class="text-right">
                                        <a href="{{action('CollectorController@payment_details', ['id' => $row->customerID])}}" class="btn btn-xs btn-info no-padding mr-5" title="Payment Details"><i class="icon-wrench"></i></a>
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
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

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


            </script>

    <script type="text/javascript">

        $(function () {

            $('.datatable').DataTable({
                order: [[ 0, "desc" ]],
                paging: false,
                columnDefs: [
                    { orderable: false, "targets": [6] }//For Column Order
                ]
            });

        });


    </script>
@endsection