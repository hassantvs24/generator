@extends('layouts.print')

@section('title')
    Payment Slip
@endsection

@section('content')

    <!-- invoice template -->

    <div class="bg-white border-radius p-5">
        <div class="row hidden-print">
            <div class="col-xs-6 mt-10"><h6 class="m-5"><i class="icon-printer"></i> Print Salary Sheet</h6></div>
            <div class="col-xs-6 mt-10 text-right">
                <a href="{{url($backUrl)}}" class="btn btn-danger btn-xs heading-btn"><i class="icon-arrow-left16 position-left"></i> Go Back</a>
                <button type="button" class="btn btn-success btn-xs heading-btn" onclick="window.print()"><i class="icon-printer position-left"></i> Print</button>
            </div>
            <div class="col-xs-12"><hr class="mt-10 mb-10" /></div>
        </div>

        <div>
            <div class="border-bottom">
                <p class="no-margin text-size-mini">{{config('naz.company')}}</p>
                <p class="no-margin text-size-mini">{{config('naz.address')}}</p>
                <p class="no-margin text-size-mini">MB: {{config('naz.contact')}}</p>
            </div>

            <div>
                <p class="no-margin text-size-mini">Date: {{$customDate}}</p>
                <p class="no-margin text-size-mini">Client No: #{{invoice_n($customerID)}}</p>
                <p class="no-margin text-size-mini">Client Name: {{$customerName}}</p>
                <p class="no-margin text-size-mini">Address: {{$address}}</p>
                <p class="no-margin text-size-mini">Month: {{$monthName}}</p>
                <p class="no-margin text-size-mini">Package: {{$package}}</p>
                <p class="no-margin text-size-mini">Due: {{money($due)}}</p>
                <p class="no-margin text-size-mini">Total: {{money($amount)}}</p>
            </div>
        </div>

        <div class="hidden-print">
            <div>
            <textarea id="printText" rows="20" class="form-control hidden-print">{{config('naz.company')}}&#10;{{config('naz.address')}}&#10;MB: {{config('naz.contact')}}&#10;-----------------------------&#10;Date: {{$customDate}}&#10;Client No: #{{invoice_n($customerID)}}&#10;Client Name: {{$customerName}}&#10;Address: {{$address}}&#10;Month: {{$monthName}}&#10;Package: {{$package}}&#10;Due: {{money($due)}}&#10;Total: {{money($amount)}}&#10;&#10;-----</textarea>
            </div>
            <div>
            <button class="btn btn-info btn-block" id="copyBtn" onclick="copy()"><i class="icon-copy3"></i> Copy text</button>
            </div>
        </div>


    </div>



@endsection

@section('style')
    <style type="text/css">
        @media print {
            @page {
                size: 58mm 68mm !important;
            }

            .container{
                padding: 0px !important;
                height: 68mm !important;
                width: 58mm !important;

            }

            .content{
                padding: 0px !important;
                height: 68mm !important;
                width: 58mm !important;
                border: 1px dotted black;
            }

            html, body{
                padding: 0px !important;
                margin: 0px;
                height: 68mm !important;
                width: 58mm !important;
                overflow: hidden !important;
            }

            .text-size-mini{
                font-size: 7pt !important;
            }
        }
    </style>
@endsection

