@section('box')

    <!-- Basic modal -->
    <div id="myModalIn" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-file-plus"></i> Deposit</h5>
                </div>

                <form action="{{action('Bank\BankbookController@deposit')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Select Bank</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="bankID">
                                    @foreach($banks as $row)
                                        <option value="{{$row->bankID}}">{{$row->name}} [{{ac_type($row->accountNo)}}]</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Deposit</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="amountIN" placeholder="Deposit Amount" type="number" step="any" min="0" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Date</label>
                            <div class="col-lg-9">
                                <input class="form-control date_pick" name="created_at" placeholder="Custom Date" type="text" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Descriptions</label>
                            <div class="col-lg-9">
                                <textarea rows="3" name="descriptions" class="form-control" placeholder="Descriptions here ......"></textarea>
                            </div>
                        </div><br>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cancel-circle2"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="icon-checkmark4"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->



    <!-- Basic modal -->
    <div id="myModalOut" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-file-minus"></i> Withdraw</h5>
                </div>

                <form action="{{action('Bank\BankbookController@withdraw')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Select Bank</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="bankID">
                                    @foreach($banks as $row)
                                        <option value="{{$row->bankID}}">{{$row->name}} [{{ac_type($row->accountNo)}}]</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Withdraw Amount</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="amountOut" placeholder="Withdraw Amount" type="number" step="any" min="0" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Date</label>
                            <div class="col-lg-9">
                                <input class="form-control date_pick" name="created_at" placeholder="Custom Date" type="text" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Descriptions</label>
                            <div class="col-lg-9">
                                <textarea rows="3" name="descriptions" class="form-control" placeholder="Descriptions here ......"></textarea>
                            </div>
                        </div><br>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cancel-circle2"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="icon-checkmark4"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->



    <!-- Basic modal -->
    <div id="ediModalIN" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-file-plus"></i> Deposit</h5>
                </div>

                <form action="{{action('Bank\BankbookController@deposit_edi')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="ediIDIN" name="id">

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Select Bank</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="bankID">
                                    @foreach($banks as $row)
                                        <option value="{{$row->bankID}}">{{$row->name}} [{{ac_type($row->accountNo)}}]</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Deposit</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="amountIN" placeholder="Deposit Amount" type="number" step="any" min="0" required>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Descriptions</label>
                            <div class="col-lg-9">
                                <textarea rows="3" name="descriptions" class="form-control" placeholder="Descriptions here ......"></textarea>
                            </div>
                        </div><br>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cancel-circle2"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="icon-checkmark4"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->


    <!-- Basic modal -->
    <div id="ediModalOUT" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-file-minus"></i> Withdraw</h5>
                </div>

                <form action="{{action('Bank\BankbookController@withdraw_edi')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="ediIDOUT" name="id">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Select Bank</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="bankID">
                                    @foreach($banks as $row)
                                        <option value="{{$row->bankID}}">{{$row->name}} [{{ac_type($row->accountNo)}}]</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Withdraw Amount</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="amountOut" placeholder="Withdraw Amount" type="number" step="any" min="0" required>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Descriptions</label>
                            <div class="col-lg-9">
                                <textarea rows="3" name="descriptions" class="form-control" placeholder="Descriptions here ......"></textarea>
                            </div>
                        </div><br>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cancel-circle2"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="icon-checkmark4"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->



@endsection