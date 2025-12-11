@extends('layouts.general')
@extends('box.salary.details')
@section('title')
    Month Details
@endsection

@section('back-url')
    <div class="col-xs-6"><a href="{{ action('Salary\SalaryController@index') }}" class="btn btn-danger btn-xs heading-btn"><i class="icon-arrow-left16 position-left"></i> Go Back</a></div>
    <div class="col-xs-6">
        <a href="{{action('Salary\SalaryController@generate_print', ['id' => $months->salaryMonthID])}}" class="btn btn-success btn-labeled pull-right"><b><i class="icon-printer"></i></b> Print Billing Sheet</a>
        <button type="button" id="bill_generate" class="btn btn-primary btn-labeled pull-right mr-5"><b><i class="icon-cogs"></i></b> Bill Generate</button>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="icon-calendar"></i> Month Details [{{date("F, Y", strtotime($months->monthName)) }}]</h4>
                </div>
                <div class="panel-body">
                    <form id="generate_form" action="{{action('Salary\SalaryController@generate')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="salaryMonthID" value="{{$months->salaryMonthID}}">
                        <table class="table table-bordered table-condensed table-hover datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Contact</th>
                                <th>Salary</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($table as $row)

                                <tr>
                                    @php
                                        $due = 0;
                                        if($row->balance < 0){
                                            $due = $row->balance;
                                        }
                                        $salary = $row->salary()->where('salaryMonthID', $months->salaryMonthID)->first();
                                    @endphp

                                    @if($salary != null)
                                        @if($row->employeeID == $salary->employeeID)
                                            <td></td>
                                        @else
                                            <td><input type="checkbox" name="marks[]" value="{{$row->employeeID}}" checked="checked" /></td>
                                        @endif
                                    @else
                                        <td><input type="checkbox" name="marks[]" value="{{$row->employeeID}}" checked="checked" /></td>
                                    @endif
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->contact}}</td>
                                    <td>{{money($row->salary)}}</td>
                                    <td>{{money($row->balance)}}</td>
                                    @if($salary != null)
                                        @if($row->employeeID == $salary->employeeID)
                                            <td class="white_sp">
                                                <span class="mr-5 text-muted text-size-mini">{{money($salary->amount)}}</span>
                                                <button class="btn btn-xs btn-success no-padding mr-5 ediBtn" data-name="{{$row->name}}" data-amount="{{$salary->amount}}" data-id="{{$salary->salaryID}}" data-toggle="modal" data-target="#ediModal" type="button" title="Edit Salary"><i class="icon-pencil5"></i></button>
                                                <a class="btn btn-xs btn-danger no-padding" href="{{action('Salary\SalaryController@generate_del', ['id' => $salary->salaryID])}}" onclick="return confirm('Are you sure to delete?')" title="Delete Salary"><i class="icon-bin"></i></a>
                                            </td>
                                        @else
                                            <td><input class="editAmount" type="number" step="any" min="0" name="salaryAmount[{{$row->employeeID}}]" value="{{$row->salary}}"></td>
                                        @endif
                                    @else
                                        <td><input class="editAmount" type="number" step="any" min="0" name="salaryAmount[{{$row->employeeID}}]" value="{{$row->salary}}"></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $(function () {
            $('#bill_generate').click(function () {

                if(confirm("Are you sure to generate bill?")){
                    $('#generate_form').submit();
                }

            });
        });

        $(function () {

            $('.ediBtn').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var amount = $(this).data('amount');

                $('#ediID').val(id);
                $('#employeeName').html(name);
                $('#ediModal [name=amount]').val(amount);
            });

        });

    </script>
@endsection