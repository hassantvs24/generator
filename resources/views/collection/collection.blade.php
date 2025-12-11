@extends('layouts.master')

@section('title')
    New Collection
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h6 class="panel-title">All Due List</h6>
                </div>

                <div class="panel-body">

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
                                    <a href="{{action('Collection\NewCollectionController@payment_details', ['id' => $row->customerID])}}" class="btn btn-xs btn-info no-padding mr-5" title="Payment Details"><i class="icon-wrench"></i></a>
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