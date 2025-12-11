@section('box')

    <!-- Basic modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-file-plus"></i> Add New Bank Account</h5>
                </div>

                <form action="{{action('Bank\BankInfoController@save')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Bank name</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="name" placeholder="Bank name" type="text" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Account Number</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="accountNo" placeholder="Account Number" type="text" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Branch Name</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="branch" placeholder="Branch name" type="text">
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Contact Number</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="contact" placeholder="Contact Number" type="text">
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
                    <h5 class="modal-title"><i class="icon-pencil7"></i> Edit Bank Account</h5>
                </div>

                <form action="{{action('Bank\BankInfoController@edit')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="ediID" name="id">

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Bank name</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="name" placeholder="Bank name" type="text" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Account Number</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="accountNo" placeholder="Account Number" type="text" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Branch Name</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="branch" placeholder="Branch name" type="text">
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Contact Number</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="contact" placeholder="Contact Number" type="text">
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

@endsection