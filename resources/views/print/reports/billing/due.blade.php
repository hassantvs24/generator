@extends('layouts.print')

@section('title')
    Customer Due List
@endsection

@section('content')

    <!-- invoice template -->

    <div class="bg-white border-radius p-5">
        <div class="row hidden-print">
            <div class="col-xs-6 mt-10"><h6 class="m-5"><i class="icon-printer"></i> Customer Due List</h6></div>
            <div class="col-xs-6 mt-10 text-right">
                <button type="button" class="btn btn-danger btn-xs heading-btn" onclick="history.go(-1)"><i class="icon-arrow-left16 position-left"></i> Go Back</button>
                <button type="button" class="btn btn-success btn-xs heading-btn" onclick="window.print()"><i class="icon-printer position-left"></i> Print</button>
            </div>
            <div class="col-xs-12"><hr class="mt-10 mb-10" /></div>
        </div>


        <div class="row">
            <div class="col-xs-12"><h5 class="text-center no-margin">Customer Due List</h5></div>
        </div>
        <div class="row">
            <div class="col-xs-8"><b class="no-margin">Area: </b>{{$area->name or ''}}</div>
            <div class="col-xs-4 text-right"><b class="no-margin">Report Date: </b>{{date("d/m/Y") }}</div>
        </div>
        <div class="row">
            <div class="col-xs-12"><hr class="mt-10 mb-10" /></div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-condensed" id="sortingTable">
                    <thead>
                    <tr>
                        <th class="p-5 pt-0 pb-0 no-padding-top">#</th>
                        <th class="p-5 pt-0 pb-0 ">Name</th>
                        <th class="p-5 pt-0 pb-0 ">Contact</th>
                        <th class="p-5 pt-0 pb-0 ">Area</th>
                        <th class="p-5 pt-0 pb-0 ">Service</th>
                        <th class="p-5 pt-0 pb-0 text-right">Due</th>
                    </tr>
                    </thead>
                    <tbody class="text-size-mini">
                    @php
                        $balance = 0;
                        $i = 0;
                    @endphp
                    @foreach($table as $row)

                        <tr>
                            <td class="p-5 pt-0 pb-0 ">{{$row->customerID}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->name}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->contact}}</td>
                            <td class="p-5 pt-0 pb-0 ">{{$row->area['name'] or ''}}</td>
                            @php
                                $service_count = $row->service()->where('status', 'Active')->count();
                                $balance += abs($row->balance);
                            @endphp
                            <td class="p-5 pt-0 pb-0 ">{{$service_count}}</td>
                            <td class="p-5 pt-0 pb-0  text-right">{{money_abs($row->balance)}}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="p-5 pt-0 pb-0  text-center" colspan="2">Number of due</th>
                            <th class="p-5 pt-0 pb-0  text-center">{{$i}}</th>
                            <th class="p-5 pt-0 pb-0  text-right" colspan="2">Total Due</th>
                            <th class="p-5 pt-0 pb-0  text-right">{{money($balance)}}</th>
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