@extends('layouts.general')
@extends('box.salary.payment_details')
@section('title')
    Bill Payment
@endsection

@section('back-url')
    <div class="col-xs-6"><a href="{{ action('Salary\DetailsController@index') }}" class="btn btn-danger btn-xs heading-btn"><i class="icon-arrow-left16 position-left"></i> Go Back</a></div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="icon-clipboard3"></i> Salary Payment Details</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-flat border-top-success">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <table class="table table-bordered  table-condensed table-hover">
                                                        <tr>
                                                            <td colspan="2" class="text-center bg-grey-400 pt-15 pb-15">
                                                                <img class="img-thumbnail" src="{{ck_file('general', 'public/upload', $table->primaryPhoto)}}" alt="Customer Photo">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Name</th>
                                                            <td class="text-danger">{{$table->name}}</td>

                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Contact</th>
                                                            <td class="text-danger">{{$table->contact}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Father Name</th>
                                                            <td class="text-muted">{{$table->fatherName}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Mother Name</th>
                                                            <td class="text-muted">{{$table->motherName}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">NID</th>
                                                            <td class="text-violet">{{$table->nid}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Category</th>
                                                            <td class="text-muted">{{$table->category['name']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Birthday</th>
                                                            <td class="text-muted">{{pub_date($table->dob)}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Address</th>
                                                            <td class="text-muted">{{$table->address}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Designation</th>
                                                            <td class="text-indigo">{{$table->position}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Salary</th>
                                                            <td class="text-pink">{{money($table->salary)}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-8">

                                                    <div class="row">
                                                        <div class="col-md-6"><h5><i class="icon-arrow-right15"></i> Salary Payment History</h5></div>
                                                        <div class="col-md-6">
                                                            <h5 class="text-violet text-right">Balance: {{money($table->balance)}}</h5>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <table class="table table-bordered  table-condensed table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Paid Amount</th>
                                                                    <th class="text-right">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                    $transaction = $table->transaction()->orderBy('empTransactionID', 'DESC')
                                                                    ->where('descriptions', 'like', '%Salary%Monthly Salary Payment%')
                                                                    ->where('transactionType', 'OUT')
                                                                    ->get();
                                                                @endphp
                                                                @foreach($transaction as $row)
                                                                    <tr>
                                                                        <td>{{pub_date($row->created_at)}}</td>
                                                                        <td>{{money($row->amountOut)}}</td>
                                                                        <td class="text-right">
                                                                            <button class="btn btn-xs btn-success no-padding mr-5 ediBtnBalance"
                                                                                    data-id="{{$row->empTransactionID}}"
                                                                                    data-out="{{$row->amountOut}}"
                                                                                    data-types="{{$row->transactionType}}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#ediDueModal"
                                                                                    title="Edit"><i class="icon-pencil5"></i></button>
                                                                            <a class="btn btn-xs btn-danger no-padding" href="{{action('Salary\SheetController@payment_del', ['id' => $row->empTransactionID])}}" onclick="return confirm('Are you sure to delete?')" title="Delete"><i class="icon-bin"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        //**********Edit Balance Transaction*********
        $(function () {
            $('.ediBtnBalance').click(function () {
                var id = $(this).data('id');
                var ins = $(this).data('out');
                var types = $(this).data('types');

                $('#ediIDBal').val(id);
                $('#ediDueModal [name=transactionType]').val(types);
                $('#ediDueModal [name=amount]').val(ins);

            });
        });
        //**********/Edit Balance Transaction*********

    </script>
@endsection