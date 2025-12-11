@extends('layouts.master')

@section('title')
    New Salary
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h6 class="panel-title">All Payable List</h6>
                </div>

                <div class="panel-body">

                    <table class="table table-bordered table-condensed table-hover datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Designation</th>
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
                                <td>{{money($row->salary)}}</td>
                                <td>{{money($row->balance)}}</td>
                                <td class="text-right">
                                    <a href="{{action('Salary\DetailsController@payment_details', ['id' => $row->employeeID])}}" class="btn btn-xs btn-info no-padding mr-5" title="Salary Details"><i class="icon-wrench"></i></a>
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

    <script type="text/javascript">

        $(function () {

            $('.datatable').DataTable({
                order: [[ 0, "desc" ]],
                columnDefs: [
                    { orderable: false, "targets": [6] }//For Column Order
                ]
            });

        });

    </script>

@endsection