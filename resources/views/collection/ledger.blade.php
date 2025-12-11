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
                    <div class="text-center">
                        {{ $table->links() }}
                    </div>
                    

                    <table class="table table-bordered table-condensed table-hover datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Area</th>
                            <th>Collector</th>
                            <th class="text-right">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table as $row)
                            <tr>
                                <td>{{$row->cusTransactionID}}</td>
                                <td>{{pub_date_time($row->created_at)}}</td>
                                <td>{{$row->customer['name'] or ''}}</td>
                                <td>{{$row->customer['contact'] or ''}}</td>
                                <td>{{$row->customer->area['name'] or ''}}</td>
                                <td>{{$row->user['name'] or ''}}</td>
                                <td class="text-right">{{money($row->amountIN)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $table->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">

        $(function () {

            $('.datatable').DataTable({
                order: [[ 0, "desc" ]]
            });

        });

    </script>

@endsection