@section('box')

    <!-- Basic modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-file-plus"></i> Add New Service/Package for Billing</h5>
                </div>

                <form action="{{action('Customer\CustomerController@service_save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{csrf_field()}}
                    <input type="hidden" name="customerID" value="{{$table->customerID}}">
                    <input type="hidden" name="other" value="0">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Select Package</label>
                            <div class="col-lg-9">
                                <select class="form-control service_select" name="packageID">
                                    @foreach($package as $row)
                                        <option value="{{$row->packageID}}" data-amount="{{$row->packageAmount}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Billing Amount</label>
                            <div class="col-lg-9">
                                <input class="form-control billing_amount" name="billingAmount" placeholder="Billing Amount" type="number" step="any" min="0" value="0" required>
                            </div>
                        </div><br>


                        <div class="form-group">
                            <label class="col-lg-3 control-label">Light</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="light" placeholder="Light" min="0" max="999" value="0" type="number">
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Fan</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="fan" placeholder="Fan" min="0" max="999" value="0" type="number">
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Computer</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="computer" placeholder="Computer" min="0" max="999" value="0" type="number">
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Printer</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="printer" placeholder="Printer" min="0" max="999" value="0" type="number">
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Stabilizer</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="stabilizer" placeholder="Stabilizer" min="0" max="999" value="0" type="number">
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


    <!-- Basic Edi modal -->
    <div id="ediModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-pencil7"></i> Edit Service/Package for Billing</h5>
                </div>

                <form action="{{action('Customer\CustomerController@service_edi')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="ediIDP" name="id">
                    <input type="hidden" name="customerID" value="{{$table->customerID}}">
                    <input type="hidden" name="other" value="0">

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Select Package</label>
                            <div class="col-lg-9">
                                <select class="form-control service_select2" name="packageID">
                                    @foreach($package as $row)
                                        <option value="{{$row->packageID}}" data-amount="{{$row->packageAmount}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Billing Amount</label>
                            <div class="col-lg-9">
                                <input class="form-control billing_amount2" name="billingAmount" placeholder="Billing Amount" type="number" step="any" min="0" value="0" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Light</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="light" placeholder="Light" min="0" max="999" value="0" type="number">
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Fan</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="fan" placeholder="Fan" min="0" max="999" value="0" type="number">
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Computer</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="computer" placeholder="Computer" min="0" max="999" value="0" type="number">
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Printer</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="printer" placeholder="Printer" min="0" max="999" value="0" type="number">
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Stabilizer</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="stabilizer" placeholder="Stabilizer" min="0" max="999" value="0" type="number">
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
    <!-- /basic Edi modal -->


    <!-- Basic modal -->
    <div id="dueModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-calculator3"></i> Balance Adjustment</h5>
                </div>

                <form action="{{action('Customer\CustomerController@balance_adjust')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{csrf_field()}}
                    <input type="hidden" name="customerID" value="{{$table->customerID}}">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Balance Type</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="balanceType">
                                    <option value="Adjustment">Adjustment</option>
                                    <option value="Opening">Opening</option>
                                    <option value="Advanced">Advanced Payment</option>
                                </select>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Balance Due (-)</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="due_balance" placeholder="Balance Due" type="number" step="any" min="0" value="0" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Balance Add (+)</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="add_balance" placeholder="Balance Add" type="number" step="any" min="0" value="0" required>
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
    <div id="ediDueModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-calculator3"></i> Edit Balance Adjustment</h5>
                </div>

                <form action="{{action('Customer\CustomerController@balance_edi_adjust')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{csrf_field()}}
                    <input type="hidden" id="ediIDBal" name="id">
                    <input type="hidden" name="transactionType">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Balance Type</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="balanceType">
                                    <option value="Adjustment">Adjustment</option>
                                    <option value="Opening">Opening</option>
                                    <option value="Advanced">Advanced Payment</option>
                                </select>
                            </div>
                        </div><br>

                        <div class="form-group out_show" style="display: block">
                            <label class="col-lg-3 control-label">Balance Due (-)</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="due_balance" placeholder="Balance Due" type="number" step="any" min="0" value="0" required>
                            </div>
                        </div>

                        <div class="form-group in_show" style="display: block">
                            <label class="col-lg-3 control-label">Balance Add (+)</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="add_balance" placeholder="Balance Add" type="number" step="any" min="0" value="0" required>
                            </div>
                        </div>

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
    <div id="complainModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-bubble-lines3"></i> Customer Complain Box</h5>
                </div>

                <form action="{{action('Customer\CustomerController@complain')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{csrf_field()}}
                    <input type="hidden" name="customerID" value="{{$table->customerID}}">
                    <div class="modal-body">

                        <div class="form-group in_show" style="display: block">
                            <label class="col-lg-6 control-label">Write Customer Complain</label>
                            <div class="col-lg-12">
                                <textarea rows="4" class="form-control" name="descriptions" placeholder="Write Customer Complain here ....."></textarea>
                            </div>
                        </div><br>
                        <div style="height: 120px;"></div>

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