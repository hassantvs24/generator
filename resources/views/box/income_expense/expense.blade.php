@section('box')

    <!-- Basic modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-file-plus"></i> New Expense</h5>
                </div>

                <form action="{{action('Expense\ExpenseController@save')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Select Category</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="inoutcatergoryID">
                                    @foreach($category as $row)
                                        <option value="{{$row->inoutcatergoryID}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Amount</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="amountOut" placeholder="Expense Amount" type="number" min="0" step="any" required>
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


    <!-- Basic Edi modal -->
    <div id="ediModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-pencil7"></i> Edit Expense</h5>
                </div>

                <form action="{{action('Expense\ExpenseController@edit')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="ediID" name="id">

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Select Category</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="inoutcatergoryID">
                                    @foreach($category as $row)
                                        <option value="{{$row->inoutcatergoryID}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Amount</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="amountOut" placeholder="Expense Amount" type="number" min="0" step="any" required>
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
    <!-- /basic Edi modal -->

@endsection