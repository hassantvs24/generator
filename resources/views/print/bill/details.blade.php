@extends('layouts.print')

@section('title')
    Print Billing Sheet {{date("F, Y", strtotime($months->monthName)) }}
@endsection

@section('content')

    <!-- invoice template -->

<div class="bg-white border-radius p-5">
    <div class="row hidden-print">
        <div class="col-xs-6 mt-10"><h6 class="m-5"><i class="icon-printer"></i> Print Billing Sheet</h6></div>
        <div class="col-xs-6 mt-10 text-right">
            <button type="button" class="btn btn-danger btn-xs heading-btn" onclick="history.go(-1)"><i class="icon-arrow-left16 position-left"></i> Go Back</button>
            <button type="button" class="btn btn-success btn-xs heading-btn" onclick="window.print()"><i class="icon-printer position-left"></i> Print</button>
        </div>
        <div class="col-xs-12"><hr class="mt-10 mb-10" /></div>
    </div>


        <div class="row">
            <div class="col-xs-12"><h5 class="text-center no-margin">Billing Sheet</h5></div>
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
                <table id="sortingTable" class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="p-5 pt-0 pb-0 no-padding-top">Customer</th>
                        <th class="p-5 pt-0 pb-0 ">Contact</th>
                        <th class="p-5 pt-0 pb-0 ">Area</th>
                        <th class="p-5 pt-0 pb-0 ">Light</th>
                        <th class="p-5 pt-0 pb-0 ">Fan</th>
                        <th class="p-5 pt-0 pb-0 ">Computer</th>
                        <th class="p-5 pt-0 pb-0 ">Printer</th>
                        <th class="p-5 pt-0 pb-0 ">Stabilizer</th>
                        <th class="p-5 pt-0 pb-0  text-right">Due</th>
                        <th class="p-5 pt-0 pb-0  text-right">Bill</th>
                    </tr>
                    </thead>
                    <tbody class="text-size-mini">
                    @php
                        //$totalDue = 0;
                        $totalBill = 0;
                    @endphp

                    @foreach($table as $row)
                        @php
                            $due = 0;
                            if($row->services->customers['balance'] < 0){
                                $due = $row->services->customers['balance'];
                            }
                        @endphp
                        <tr>
                            <td class="p-5 pt-0 pb-0 ">{{$row->services->customers['name'] or ''}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->services->customers['contact'] or ''}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->services->customers->area['name'] or ''}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->services['light'] or ''}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->services['fan'] or ''}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->services['computer'] or ''}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->services['printer'] or ''}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->services['stabilizer'] or ''}}</td>
                            <td class="p-5 pt-0 pb-0  text-right">{{money_abs($due)}}</td>
                            <td class="p-5 pt-0 pb-0  text-right">{{money($row->amount)}}</td>
                        </tr>
                        @php
                            //$totalDue += $due;
                            $totalBill += $row->amount;
                        @endphp
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="p-5 pt-0 pb-0  text-right" colspan="9">Total</th>
                            <th class="p-5 pt-0 pb-0  text-right">{{money($totalBill)}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

</div>



@endsection


@section('script')

    <script type="text/javascript" src="{{asset('public/js/jquery.tablesorter.min.js')}}"></script>

    <script type="text/javascript">

        {
            $("#sortingTable").tablesorter();
        }

    </script>

@endsection