@section('box')

    <!-- Basic Edi modal -->
    <div id="ediModal" class="modal fade">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-pencil7"></i> Edit Customer</h5>
                </div>

                <form action="{{action('Customer\CustomerController@edit')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="ediID" name="id">

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Select Area*</label>
                                    <div class="col-lg-9">
                                        <select class="form-control area_select2" name="areaID">
                                            @foreach($area as $row)
                                                <option value="{{$row->areaID}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Select Category</label>
                                    <div class="col-lg-9">
                                        <select class="form-control category_select2" name="customerCatID">
                                            @foreach($category as $row)
                                                <option value="{{$row->customerCatID}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Customer name*</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="name" placeholder="Customer name" type="text" required>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Contact*</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="contact" placeholder="Customer Contact Number" type="text" required>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">NID No</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="nid" placeholder="National ID Number" type="number">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Address</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" placeholder="Customer Address.." name="address"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Father Name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="fatherName" placeholder="Father Name" type="text">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Mother Name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="motherName" placeholder="Mother Name" type="text">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Birth Day</label>
                                    <div class="col-lg-9">
                                        <input class="form-control date_pic" name="dob" placeholder="Customer Birth Day" type="text">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Customer Photo</label>
                                    <div class="col-lg-9">
                                        <input name="primaryPhoto" id="inputFileEdi" placeholder="Customer Photo" type="file" accept="image/*">
                                    </div>
                                </div><br>
                                <div class="text-center">
                                    <img class="img-thumbnail previewEdi" style="height: 150px;" alt="Customer Photo">
                                </div>

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
    <!-- /basic Edi modal -->

@endsection