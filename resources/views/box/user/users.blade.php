@section('box')

    <!-- Basic modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-file-plus"></i> Add New User</h5>
                </div>

                <form action="{{action('Users\UsersController@save')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Name</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="name" placeholder="User name" type="text" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Email</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="email" placeholder="User Email" type="email" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Type</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="userType">
                                    <option value="Collector">Collector</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Accounts">Accounts</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="password" placeholder="User Password" type="password" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Re-Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="password_confirmation" placeholder="User Re-Password" type="password" required>
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
                    <h5 class="modal-title"><i class="icon-pencil7"></i> Edit User</h5>
                </div>

                <form action="{{action('Users\UsersController@edit')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="ediID" name="id">

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Name</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="name" placeholder="User name" type="text" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Email</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="email" placeholder="User Email" type="email" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Type</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="userType">
                                    <option value="Collector">Collector</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Accounts">Accounts</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="password" placeholder="User Password" type="password" required>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Re-Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="password_confirmation" placeholder="User Re-Password" type="password" required>
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