<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" class="was-validated" id="save-form">
                                        <div class="row p-sm-4">
                                            <div class="col-sm-12" style="order-right: 1px solid black; margin-top: 50px;">

                                                <div class="form-group row">
                                                    <label for="EmployeLabel"
                                                        class="col-sm-4 col-form-label "><strong>Department Name
                                                        </strong></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="empName" id="name"
                                                            id="EmployeLabel" class="form-control form_check_color_right"
                                                            placeholder="Department Name here..." required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="EmployeLabel"
                                                        class="col-sm-4 col-form-label "><strong>Department Type
                                                        </strong></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="empName" id="type"
                                                            id="EmployeLabel" class="form-control form_check_color_right"
                                                            placeholder="Department type here..." required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="saveData()">Save
                                                changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>