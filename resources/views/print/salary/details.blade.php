@extends('layouts.print')

@section('title')
    Print Salary Sheet {{date("F, Y", strtotime($months->monthName)) }}
@endsection

@section('content')

    <!-- invoice template -->

    <div class="bg-white border-radius p-5">
        <div class="row hidden-print">
            <div class="col-xs-6 mt-10"><h6 class="m-5"><i class="icon-printer"></i> Print Salary Sheet</h6></div>
            <div class="col-xs-6 mt-10 text-right">
                <button type="button" class="btn btn-danger btn-xs heading-btn" onclick="history.go(-1)"><i class="icon-arrow-left16 position-left"></i> Go Back</button>
                <button type="button" class="btn btn-success btn-xs heading-btn" onclick="window.print()"><i class="icon-printer position-left"></i> Print</button>
            </div>
            <div class="col-xs-12"><hr class="mt-10 mb-10" /></div>
        </div>


        <div class="row">
            <div class="col-xs-12"><h5 class="text-center no-margin">Salary Sheet</h5></div>
        </div>
        <div class="row">
            <div class="col-xs-6"><b class="no-margin">Month: </b>{{date("F, Y", strtotime($months->monthName)) }}</div>
            <div class="col-xs-6 text-right"><b class="no-margin">Date: </b>{{date("d/m/Y") }}</div>
        </div>
        <div class="row">
            <div class="col-xs-12"><hr class="mt-10 mb-10" /></div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="p-5 pt-0 pb-0 no-padding-top">Employee</th>
                        <th class="p-5 pt-0 pb-0 ">Contact</th>
                        <th class="p-5 pt-0 pb-0 ">Designation</th>
                        <th class="p-5 pt-0 pb-0 ">Balance</th>
                        <th class="p-5 pt-0 pb-0 ">Salary</th>
                    </tr>
                    </thead>
                    <tbody class="text-size-mini">
                    @php
                        $totalSalary = 0;
                    @endphp

                    @foreach($table as $row)
                        <tr>
                            <td class="p-5 pt-0 pb-0 ">{{$row->employee['name']}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->employee['contact']}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->employee['position']}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->employee['balance']}}</td>
                            <td class="p-5 pt-0 pb-0  text-right">{{money($row->amount)}}</td>
                        </tr>
                        @php
                            //$totalDue += $due;
                            $totalSalary += $row->amount;
                        @endphp
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="p-5 pt-0 pb-0  text-right" colspan="4">Total</th>
                        <th class="p-5 pt-0 pb-0  text-right">{{money($totalSalary)}}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>



@endsection