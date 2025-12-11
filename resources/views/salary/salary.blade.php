@extends('layouts.master')

@section('title')
    Salary Generate
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{action('Salary\SalaryController@month_save')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="input-group mb-10">
                    <input class="form-control date_pic" name="monthName" placeholder="Pick Any Date Of the month" type="text">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Add Month</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-6"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h6 class="panel-title">Bill Generate</h6>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-condensed table-hover datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Month</th>
                            <th>Total Salary</th>
                            <th>Salary Amount</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($table as $row)
                            <tr>
                                <td>{{$row->salaryMonthID}}</td>
                                <td>{{date("F, Y", strtotime($row->monthName)) }}</td>
                                @php
                                    $amount = 0;
                                    $total_salary = $row->salary()->get();
                                    foreach($total_salary as $val){
                                        $amount += $val->amount;
                                    }
                                @endphp
                                <td>{{count($total_salary)}}</td>
                                <td>{{money($amount)}}</td>
                                <td class="text-right white_sp">
                                    <a class="btn btn-xs btn-success no-padding mr-5" href="{{action('Salary\SalaryController@generate_print', ['id' => $row->salaryMonthID])}}" title="Print Salary Sheet"><i class="icon-printer"></i></a>
                                    <a class="btn btn-xs btn-info no-padding mr-5" href="{{action('Salary\SalaryController@details', ['id' => $row->salaryMonthID])}}" title="Salary Generate & Edit"><i class="icon-wrench2"></i></a>
                                    <a class="btn btn-xs btn-danger no-padding" href="{{action('Salary\SalaryController@del_month', ['id' => $row->salaryMonthID])}}" onclick="return confirm('Are you sure to delete?')" title="Delete Salary"><i class="icon-bin"></i></a>
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
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script type="text/javascript">

        $(function () {
            $('.date_pic').daterangepicker({
                singleDatePicker: true,
                //showDropdowns: true,
                locale: {
                    format: 'MMMM, YYYY'
                }
            });
        });


        $(function () {
            $('.datatable').DataTable({
                order: [[ 0, "desc" ]],
                columnDefs: [
                    { orderable: false, "targets": [4] }//For Column Order
                ]
            });
        });

    </script>

@endsection