@extends('layouts.general')
@extends('box.collection.payment_details')
@section('title')
    Bill Payment
@endsection

@section('back-url')
    <div class="col-xs-6"><a href="{{ action('CollectorController@index') }}" class="btn btn-danger btn-xs heading-btn"><i class="icon-arrow-left16 position-left"></i> Go Back</a></div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="icon-clipboard3"></i> Bill Payment</h4>
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
                                                            <th class="text-bold">Area</th>
                                                            <td class="text-primary">{{$table->area['name']}}</td>
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
                                                            <th class="text-bold">Device Number</th>
                                                            <td class="text-teal">{{$table->device}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Cable Number</th>
                                                            <td class="text-violet">{{$table->cable}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-bold">Color</th>
                                                            <td class="text-indigo">{{$table->color}}</td>
                                                        </tr>
                                                    </table>

                                                    @php
                                                        $i = 1;
                                                        $service = $table->service()->where('status', 'Active')->orderBy('servicesID', 'DESC')->get();
                                                    @endphp
                                                    @foreach($service as $row)
                                                        <table class="table table-bordered table-condensed table-hover">
                                                            <tr>
                                                                <td colspan="2" class="bg-brown"><h5 class="text-center no-margin">Service #{{$i}}</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Package</th>
                                                                <td>{{$row->package['name']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Light</th>
                                                                <td>{{$row->light}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Fan</th>
                                                                <td>{{$row->fan}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Computer</th>
                                                                <td>{{$row->computer}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Printer</th>
                                                                <td>{{$row->printer}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Stabilizer</th>
                                                                <td>{{$row->stabilizer}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Register Date</th>
                                                                <td>{{pub_date($row->created_at)}} <small class="text-muted text-size-mini">({{$row->updated_at->diffForHumans()}})</small></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Billing Amount</th>
                                                                <td class="text-violet">{{money($row->billingAmount)}}</td>
                                                            </tr>
                                                        </table>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="panel panel-bordered">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-xs-4 text-center">
                                                                    <p class="no-margin text-muted">Due Amount</p>
                                                                    @if($table->balance < 0)
                                                                        <h2 class="no-margin text-danger">{{money_abs($table->balance)}}</h2>
                                                                    @endif
                                                                </div>
                                                                <div class="col-xs-4 text-center">
                                                                    <p class="no-margin text-muted">Paid Amount</p>
                                                                    <h4 class="no-margin text-success paid_show">{{0}}</h4>
                                                                </div>
                                                                <div class="col-xs-4 text-center">
                                                                    <p class="no-margin text-muted">Remaining Amount</p>
                                                                    <h4 class="no-margin text-violet remain_show">{{abs($table->balance)}}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-4 mt-20">
                                                                    <form action="{{action('Collection\NewCollectionController@payment')}}" method="post" enctype="multipart/form-data">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="customerID" value="{{$table->customerID}}">
                                                                        <input type="hidden" name="backUrl" value="collector">
                                                                        <div class="input-group">
                                                                            <span class="input-group-btn">
                                                                                <button class="btn btn-success btn-icon" type="button"><i class="icon-calendar"></i></button>
                                                                            </span>
                                                                            <select multiple="multiple" name="month[]" class="form-control select2">
                                                                                @php
                                                                                    $time = strtotime(date('1/1/Y'));
                                                                                @endphp

                                                                                @for($i = -6; $i<12; $i++)

                                                                                    @if(date('M y', strtotime('last month')) == date('M y', strtotime("+".$i." month", $time)))

                                                                                        @php
                                                                                            $s = 'selected';
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $s = '';
                                                                                        @endphp
                                                                                    @endif
                                                                                    <option value="{{date('M y', strtotime("+".$i." month", $time))}}" {{$s}}>{{date('M y', strtotime("+".$i." month", $time))}}</option>
                                                                                @endfor

                                                                            </select>
                                                                        </div><br>
																		<div class="input-group">
                                                                            <span class="input-group-btn">
                                                                                <button class="btn btn-info btn-icon" type="button"><i class="icon-calendar"></i></button>
                                                                            </span>
                                                                            <input type="text" name="customDate" class="form-control date_pick" placeholder="Custom Date">
                                                                        </div><br>
                                                                        <div class="input-group">
                                                                            <span class="input-group-btn">
                                                                                <button class="btn btn-primary btn-icon" type="button"><i class="icon-cash3"></i></button>
                                                                            </span>
                                                                            <input class="form-control set_amount" placeholder="Paid Amount" name="amount" value="{{abs($table->balance)}}" type="number" min="0.01" step="any" required>
                                                                        </div><br>
                                                                        
                                                                        <div class="form-group">
                                                                            <label><input id="genMale" type="checkbox" name="sendSms" value="yes"> Send SMS?</label>
                                                                         </div><br>

                                                                        <div class="text-right">
                                                                            <button class="btn btn-success" type="submit"><i class="icon-paperplane"></i> Payment</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            <!-- Complain -->
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <form action="{{action('Customer\CustomerController@complain')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="customerID" value="{{$table->customerID}}">
                                                                        <div class="modal-body">

                                                                            <div class="form-group in_show" style="display: block">
                                                                                <label class="col-lg-6 control-label text-bold">Write Customer Complain</label>
                                                                                <div class="col-lg-12">
                                                                                    <textarea rows="4" class="form-control" name="descriptions" placeholder="Write Customer Complain here ....."></textarea>
                                                                                </div>
                                                                            </div><br>
                                                                            <div style="height: 120px;"></div>

                                                                        </div>

                                                                        <div class="text-right">
                                                                            <button type="submit" class="btn btn-primary mr-20"><i class="icon-checkmark4"></i> Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h3 class="m-0">Customer Complain List</h3>
                                                                    <table class="table table-bordered table-condensed table-hover">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Date</th>
                                                                            <th>Complain Description</th>
                                                                            <th class="text-right">Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @php
                                                                            $complain = $table->complain()->orderBy('complainID', 'DESC')->get();
                                                                        @endphp
                                                                        @foreach($complain as $row)
                                                                            <tr>
                                                                                <td>{{pub_date($row->created_at)}}<br>
                                                                                    <small class="text-muted text-size-mini">({{$row->created_at->diffForHumans()}})</small>
                                                                                </td>
                                                                                <td>{{$row->descriptions}}</td>
                                                                                <td class="text-right">
                                                                                    <a class="btn btn-xs {{($row->status == 'Incomplete' ? 'text-danger':'text-success')}} no-padding" href="{{action('Customer\CustomerController@complain_status', ['id' => $row->complainID])}}" onclick="return confirm('Are you sure to change status?')" title="">{{$row->status}}</a>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <!-- /Complain -->

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
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/pickers/daterangepicker.js')}}"></script>

    <script type="text/javascript">



        $(function () {
            chang_amount();

            $('.set_amount').on('change keyup keydown', function () {
                chang_amount();
            });
        });

        $(function () {
            $(".select2").select2({
                multiple: true,
            });
        });

        $(function () {
            $('.date_pick').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
        });


        function chang_amount() {
            var due = "{{abs($table->balance)}}";
            var amount = $('.set_amount').val();

            var remain = Number(due) - Number(amount);

            $('.paid_show').html(amount);
            $('.remain_show').html(remain);

        }

    </script>
@endsection