@section('box')

    <!-- Basic modal -->
    <div id="myModalIn" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-file-plus"></i> Cash IN</h5>
                </div>

                <form action="{{action('CashbookController@cash_in')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Amount IN</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="amountIN" placeholder="Cash IN Amount" type="number" step="any" min="0" required>
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
                    <h5 class="modal-title"><i class="icon-file-minus"></i> Cash OUT</h5>
                </div>

                <form action="{{action('CashbookController@cash_out')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Amount OUT</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="amountOut" placeholder="Cash OUT Amount" type="number" step="any" min="0" required>
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



@endsection