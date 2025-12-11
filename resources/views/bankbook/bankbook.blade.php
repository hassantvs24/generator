@extends('layouts.master')
@extends('box.bankbook.bankbook')

@section('title')
    Expense
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <p>
                <button type="button" class="btn btn-success btn-labeled" data-toggle="modal" data-target="#myModalIn"><b><i class="icon-file-plus"></i></b> Deposit</button>
                <button type="button" class="btn btn-danger btn-labeled" data-toggle="modal" data-target="#myModalOut"><b><i class="icon-file-minus"></i></b> Withdraw</button>
            </p>
        </div>
        <div class="col-md-6">
            <h3 class="no-margin text-right text-indigo">Total Bank Balance: <span class="text-danger">{{money($amountIn - $amountOut)}}</span></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h6 class="panel-title">All Expense</h6>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-condensed table-hover datatable">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Bank</th>
                            <th>Descriptions</th>
                            <th>Deposit</th>
                            <th>Withdraw</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table as $row)
                            <tr>
                                <td>{{pub_date($row->created_at)}}</td>
                                <td>{{$row->bank['name']}} [{{ac_type($row->bank['accountNo'])}}]</td>
                                <td>{{$row->descriptions}}</td>
                                <td>{{money($row->amountIN)}}</td>
                                <td>{{money($row->amountOut)}}</td>
                                <td class="text-right">
                                    <button class="btn btn-xs btn-success no-padding mr-5 ediBtn{{$row->transactionType}}" data-descriptions="{{$row->descriptions}}"  data-amountin="{{$row->amountIN}}" data-amountout="{{$row->amountOut}}" data-bank="{{$row->bankID}}" data-id="{{$row->bankbookID}}" data-toggle="modal" data-target="#ediModal{{$row->transactionType}}" title="Edit"><i class="icon-pencil5"></i></button>
                                    <a class="btn btn-xs btn-danger no-padding" href="{{action('Bank\BankbookController@del', ['id' => $row->bankbookID])}}" onclick="return confirm('Are you sure to delete?')" title="Delete"><i class="icon-bin"></i></a>
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

            $('.ediBtnIN').click(function () {
                var id = $(this).data('id');
                var descriptions = $(this).data('descriptions');
                var amountin = $(this).data('amountin');
                var bank = $(this).data('bank');

                $('#ediIDIN').val(id);
                $('#ediModalIN [name=bankID]').val(bank);
                $('#ediModalIN [name=amountIN]').val(amountin);
                $('#ediModalIN [name=descriptions]').val(descriptions);
            });

            $('.ediBtnOUT').click(function () {
                var id = $(this).data('id');
                var descriptions = $(this).data('descriptions');
                var amountout = $(this).data('amountout');
                var bank = $(this).data('bank');

                $('#ediIDOUT').val(id);
                $('#ediModalOUT [name=bankID]').val(bank);
                $('#ediModalOUT [name=amountOut]').val(amountout);
                $('#ediModalOUT [name=descriptions]').val(descriptions);
            });

        });


        $(function () {

            $('.datatable').DataTable({
                order: [[ 0, "desc" ]],
                columnDefs: [
                    { orderable: false, "targets": [5] }//For Column Order
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