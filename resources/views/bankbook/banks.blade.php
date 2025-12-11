@extends('layouts.master')
@extends('box.bankbook.banks')

@section('title')
    Bank Account
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <p><button type="button" class="btn btn-primary btn-labeled" data-toggle="modal" data-target="#myModal"><b><i class="icon-file-plus"></i></b> New Bank Account</button></p>
        </div>
        <div class="col-md-6"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h6 class="panel-title">All Bank Account</h6>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-condensed table-hover datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Bank Name</th>
                            <th>Account Number</th>
                            <th>Branch</th>
                            <th>Contact</th>
                            <th>Balance</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table as $row)
                            <tr>
                                <td>{{$row->bankID}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{ac_type($row->accountNo)}}</td>
                                <td>{{$row->branch}}</td>
                                <td>{{$row->contact}}</td>
                                <td>{{money($row->balance)}}</td>
                                <td class="text-right">
                                    <button class="btn btn-xs btn-success no-padding mr-5 ediBtn" d
                                            data-name="{{$row->name}}"
                                            data-account="{{$row->accountNo}}"
                                            data-branch="{{$row->branch}}"
                                            data-contact="{{$row->contact}}"
                                            data-id="{{$row->bankID}}"
                                            data-toggle="modal" data-target="#ediModal" title="Edit"><i class="icon-pencil5"></i></button>
                                    <a class="btn btn-xs btn-danger no-padding" href="{{action('Bank\BankInfoController@del', ['id' => $row->bankID])}}" onclick="return confirm('Are you sure to delete?')" title="Delete"><i class="icon-bin"></i></a>
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
            $('.ediBtn').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var account = $(this).data('account');
                var branch = $(this).data('branch');
                var contact = $(this).data('contact');
                //var opening = $(this).data('opening');


                $('#ediID').val(id);
                $('#ediModal [name=name]').val(name);
                $('#ediModal [name=accountNo]').val(account);
                $('#ediModal [name=branch]').val(branch);
                $('#ediModal [name=contact]').val(contact);
                //$('#ediModal [name=openingBalance]').val(opening);
            });
        });


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