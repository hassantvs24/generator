@extends('layouts.master')
@extends('box.cashbook')

@section('title')
    Cashbook
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <p>
                <button type="button" class="btn btn-success btn-labeled" data-toggle="modal" data-target="#myModalIn"><b><i class="icon-file-plus"></i></b> Cash In</button>
                <button type="button" class="btn btn-danger btn-labeled" data-toggle="modal" data-target="#myModalOut"><b><i class="icon-file-minus"></i></b> Cash Out</button>
            </p>
        </div>
        <div class="col-md-6">
            <h3 class="no-margin text-right text-indigo">Total Cashbook Balance: <span class="text-danger">{{money($amountIn - $amountOut)}}</span></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h6 class="panel-title">All Transactions</h6>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-condensed table-hover datatable">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th class="text-right">Cash IN</th>
                            <th class="text-right">Cash OUT</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table as $row)
                            <tr>
                                <td>{{pub_date($row->created_at)}}</td>
                                @php
                                    $descriptions = unserialize($row->descriptions);
                                    $description = $descriptions['description'];
                                @endphp
                                <td>{{$description}}</td>
                                <td class="text-right">{{money($row->amountIN)}}</td>
                                <td class="text-right">{{money($row->amountOut)}}</td>
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
            $('.ediBtn').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#ediID').val(id);
                $('#ediModal [name=name]').val(name);
            });
        });

        $(function () {

            $('.datatable').DataTable({
                order: [[ 0, "desc" ]],
                columnDefs: [
                    //{ orderable: false, "targets": [2] }//For Column Order
                ]
            });

        });

        $(function () {
            $('.date_pick').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
        });

    </script>

@endsection