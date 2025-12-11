<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html" />
    <meta name="author" content="nsjguigf" />

    <title>Slip No: #{{$slipNo}}</title>
    <style type="text/css">

        @font-face {
            font-family: myFirstFont;
            src: url({{asset('public/texgyrecursor-regular.otf')}});
        }

        .sizes{
            background-color: white !important;
            color: black !important;
            border: 4px dashed black !important;
            margin: 10px !important;
            padding: 3mm;
        }

        .m0{
            margin: 0px !important;
            padding: 0px !important;
            font-size: 22pt !important;
            /*font-variant: small-caps !important;
            font-family: myFirstFont;*/
        }

        .printBtn{
            padding: 20px 30px !important;
            background-color: darkolivegreen;
            color: white;
            float: right;
            font-size: xx-large;
        }


        .printBtn2{
            padding: 20px 30px !important;
            background-color: green;
            color: white;
            font-size: xx-large;
            margin-bottom: 15px !important;
        }

        .back{
            background-color: red;
            color: white;
            font-size: xx-large;
            float: left;
            text-align: center;
            padding: 20px 30px !important;
            display: block;
            text-decoration: none;

        }

        .hide{
            height: 80px;
            border-bottom: 1px dashed black;
            padding: 15px !important;
            margin-bottom: 15px !important;
        }

        .border_b{
            border-bottom: 4px dashed black !important;
            padding-bottom: 10px !important;
            margin-bottom: 10px !important;
        }

        @media print {


            .hide{
                display: none !important;

            }

            html, body{
                padding: 1px !important;
                margin: 0px;
            }



        }
    </style>
</head>

<body>

<div class="hide m0">
    <a class="back" href="{{url($backUrl)}}">Go Back</a>
    <button class="printBtn" type="button" onclick="window.print()">Print</button>
</div>

<div class="sizes">
    <div class="border_b">
        <p class="m0"><kbd>{{config('naz.company')}}</kbd></p>
        <p class="m0"><kbd>{{config('naz.address')}}</kbd></p>
        <p class="m0"><kbd>MB: {{config('naz.contact')}}</kbd></p>
    </div>
    <div class="m0">
        <p class="m0"><kbd>DATE: {{$customDate}}</kbd></p>
        <p class="m0"><kbd>CLIENT NO: #{{invoice_n($customerID)}}</kbd></p>
        <p class="m0"><kbd>CLIENT NAME: {{$customerName}}</kbd></p>
        <p class="m0"><kbd>ADDRESS: {{$address}}</kbd></p>
        <p class="m0"><kbd>MONTH: {{$monthName}}</kbd></p>
        <p class="m0"><kbd>PACKAGE: {{$package}}</kbd></p>
        <p class="m0"><kbd>DUE: {{money($due)}}</kbd></p>
        <p class="m0"><kbd>TOTAL: {{money($amount)}}</kbd></p>
    </div>
</div>


</body>
</html>