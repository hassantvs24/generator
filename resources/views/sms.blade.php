@extends('layouts.master')

@section('title')
    Send SMS
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat border-top-success">
                <div class="panel-heading">
                    <h6 class="panel-title">All Due List</h6>
                </div>

                <div class="panel-body">
                    <form id="action_form" action="{{action('SmsController@sms_send')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                        {{csrf_field()}}
                        <div class="text-right mb-15">
                            <div class="form-group">
                                <p><textarea name="sms" cols="30" rows="5" placeholder="SMS Text">
Dear User
Please Pay your monthly bill for avoid disconnection.
Thank you from THREE STAR
                                    </textarea></p>

                                <button id="send_sms" type="button" class="btn btn-xs btn-primary">Send SMS</button>
                            </div>


                        </div>

                        <table class="table table-bordered table-condensed table-hover datatable" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Area</th>
                                <th>Service</th>
                                <th>Due</th>
                                <th class="text-right"><input type="checkbox" class="form-control input-group-xs" id="all_check" name=""></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($table as $row)
                                <tr>
                                    <td>{{$row->customerID}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->contact}}</td>
                                    <td>{{$row->area['name']}}</td>
                                    @php
                                        $service_count = $row->service()->where('status', 'Active')->count();
                                    @endphp
                                    <td>{{$service_count}}</td>
                                    <td>{{money_abs($row->balance)}}</td>
                                    <td class="text-right">
                                        <input type="checkbox" name="customerID[]" value="{{$row->customerID}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">

        $(function () {

            $('#all_check').change(function () {
                if(this.checked) {
                    $('#myTable input[type=checkbox]').prop('checked', true);
                }else{
                    $('#myTable input[type=checkbox]').prop('checked', false);
                }
            });

            $('#send_sms').click(function () {
                if (confirm("Do you send sms to selected contacts?") === true) {
                    var input_val = $('#myTable input[type=checkbox]:checked').serialize();
                    if(input_val.length > 0){
                        $('#action_form').submit();
                    }else{
                        alert('No contact select! Please, select minimum 1 contact.')
                    }
                }
            });

/*            $('.datatable').DataTable({
                order: [[ 0, "desc" ]],
                columnDefs: [
                    { orderable: false, "targets": [6] }//For Column Order
                ]
            });*/

        });

    </script>

@endsection