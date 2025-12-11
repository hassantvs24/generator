@section('box')

    <!-- Basic modal -->
    <div id="ediDueModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-calculator3"></i> Edit Paid Amount</h5>
                </div>

                <form action="{{action('Salary\SheetController@payment_edit')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{csrf_field()}}
                    <input type="hidden" id="ediIDBal" name="id">
                    <input type="hidden" name="transactionType">
                    <div class="modal-body">

                        <div class="form-group in_show" style="display: block">
                            <label class="col-lg-3 control-label">Paid Amount</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="amount" placeholder="Paid Amount" type="number" step="any" min="0" value="0" required>
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

@endsection