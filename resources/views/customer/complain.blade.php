@extends('layouts.master')

@section('title')
    Complain List
@endsection
@section('content')

    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h6 class="panel-title">All Complain List</h6>
                </div>

                <div class="panel-body">

                    <table class="table table-bordered table-condensed table-hover datatable">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Complain Descriptions</th>
                            <th>Status</th>
                            <th class="text-right">Del</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table as $row)
                            <tr>
                                <td>{{pub_date($row->created_at)}}<br>
                                    <small class="text-muted text-size-mini">({{$row->created_at->diffForHumans()}})</small>
                                </td>
                                <td>{{$row->descriptions}}</td>
                                <td>
                                    <a class="btn btn-xs {{($row->status == 'Incomplete' ? 'text-danger':'text-success')}} no-padding" href="{{action('Customer\CustomerController@complain_status', ['id' => $row->complainID])}}" onclick="return confirm('Are you sure to change status?')" title="">{{$row->status}}</a>
                                </td>
                                <td class="text-right"><a class="btn btn-xs btn-danger no-padding" href="{{action('Customer\CustomerController@complain_del', ['id' => $row->complainID])}}" onclick="return confirm('Are you sure to delete?')" title="Delete"><i class="icon-bin"></i></a></td>
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
                    { orderable: false, "targets": [3] }//For Column Order
                ]
            });

        });

    </script>

@endsection