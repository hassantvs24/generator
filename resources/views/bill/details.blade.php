@extends('layouts.general')
@extends('box.bill.details')
@section('title')
    Month Details
@endsection

@section('back-url')
    <div class="col-xs-6"><a href="{{ action('BillGenerateController@index') }}" class="btn btn-danger btn-xs heading-btn"><i class="icon-arrow-left16 position-left"></i> Go Back</a></div>
    <div class="col-xs-6">
        <a href="{{action('BillGenerateController@generate_print', ['id' => $months->billMonthID])}}" class="btn btn-success btn-labeled pull-right"><b><i class="icon-printer"></i></b> Print Billing Sheet</a>
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
                        <form id="generate_form" action="{{action('BillGenerateController@generate')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="billMonthID" value="{{$months->billMonthID}}">
                        <table class="table table-bordered table-condensed table-hover datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Area</th>
                                <th>Types</th>
                                <th>Package</th>
                                <th>Card</th>
                                <th>Contact</th>
                                <th>Due</th>
                                <th>Bill</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($table as $row)
                                @php
                                    $due = 0;
                                    if($row->customers['balance'] < 0){
                                        $due = $row->customers['balance'];
                                    }

                                $billing = $row->billing()->where('billMonthID', $months->billMonthID)->first();

                                @endphp
                                <tr>
                                    @if($billing != null)
                                        @if($row->servicesID == $billing->servicesID)
                                            <td></td>
                                        @else
                                            <td><input type="checkbox" name="marks[]" value="{{$row->servicesID}}" checked="checked" /></td>
                                        @endif
                                    @else
                                        <td><input type="checkbox" name="marks[]" value="{{$row->servicesID}}" checked="checked" /></td>
                                    @endif
                                    <td>{{$row->customers['name'] or ''}}</td>
                                    <td>{{$row->customers->area['name'] or ''}}</td>
                                    <td>{{$row->dishType}}</td>
                                    <td>{{$row->dishP}}</td>
                                    <td>{{$row->dishCard}}</td>
                                    <td>{{$row->customers['contact'] or ''}}</td>
                                    <td>{{money_abs($due)}}</td>
                                    <td>{{money($row->billingAmount)}}</td>

                                        @if($billing != null)
                                            @if($row->servicesID == $billing->servicesID)
                                                <td class="white_sp">
                                                    <span class="mr-5 text-muted text-size-mini">{{money($billing->amount)}}</span>
                                                    <button class="btn btn-xs btn-success no-padding mr-5 ediBtn" data-name="{{$row->customers['name']}}" data-amount="{{$billing->amount}}" data-id="{{$billing->billingID}}" data-toggle="modal" data-target="#ediModal" type="button" title="Edit Bill"><i class="icon-pencil5"></i></button>
                                                    <a class="btn btn-xs btn-danger no-padding" href="{{action('BillGenerateController@generate_del', ['id' => $billing->billingID])}}" onclick="return confirm('Are you sure to delete?')" title="Delete Bill"><i class="icon-bin"></i></a>
                                                </td>
                                            @else
                                                <td><input class="editAmount" type="number" step="any" min="0" name="billAmount[{{$row->servicesID}}]" value="{{$row->billingAmount}}"></td>
                                            @endif
                                        @else
                                            <td><input class="editAmount" type="number" step="any" min="0" name="billAmount[{{$row->servicesID}}]" value="{{$row->billingAmount}}"></td>
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
                $('#customerName').html(name);
                $('#ediModal [name=amount]').val(amount);
            });

        });

    </script>
@endsection