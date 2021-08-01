@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
            
            <!-- /.card-header -->
            <div class="card-body">
                <div class="add-btn d-flex mb-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employee_modal" data-keyboard="false" data-backdrop="static">
                        Add Employee<i class="las la-plus"></i>
                      </button>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" id="employee_modal">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-header modal-heading">
                              <h4>Add Employee</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true"><i class="las la-times" style="color: #007be8;"></i></span>
                                </button>
                              </div>
                            <section class="content">
                                <div class="container-fluid">
                                  
                                  <div class="card card-primary" style="box-shadow: none;">
                                      <form id="employee_form" action="{{url('insert-employee')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Name</label>
                                                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" required="">
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Date f joining</label>
                                                    <input type="date" class="form-control" name="date_of_joining" required="">
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mobile No.</label>
                                                    <input type="text" class="form-control" name="mob" placeholder="Mobile No." required="">
                                                  </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Address</label>
                                                   <textarea class="form-control" rows="3" name="address" required="" placeholder="Address."></textarea>
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Adhaar Card No.</label>
                                                    <input type="text" class="form-control" name="aadar_no" placeholder="Adhaar Card No." required="">
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Card No.</label>
                                                    <input type="text" class="form-control" required="" name="idcard_no" placeholder="ID Card No.">
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Choose Image</label>
                                                   <input type="file" class="form-control" id="image" required="" name="image">
                                                      
                                                  </div>
                                            </div>
                                            </div>

                                        <div class="card-footer">
                                          <button  class="btn btn-primary">Submit</button>
                                          <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-danger">Cancel</button>
                                        </div>
                                      </form>
                                    </div>
                                </div>
                                <!-- /.container-fluid -->
                              </section>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>


 <div class="modal fade" tabindex="-1" role="dialog" id="edit_employee_modal">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-header modal-heading">
                              <h4>Edit Employee</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true"><i class="las la-times" style="color: #007be8;"></i></span>
                                </button>
                              </div>
                            <section class="content">
                                <div class="container-fluid">
                                  
                                  <div class="card card-primary" style="box-shadow: none;">
                                      <form id="edit_employee_form" action="{{url('update-employee')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Name</label>
                                                    <input type="text" class="form-control" id="edit_name" placeholder="Name" name="edit_name" required="">
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Date of resigning</label>
                                                    <input type="date" class="form-control" name="date_of_resigning" id="date_of_resigning" required="">
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mobile No.</label>
                                                    <input type="text" class="form-control" name="edit_mob" placeholder="Mobile No." required="" id="edit_mob">
                                                  </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Address</label>
                                                   <textarea class="form-control" rows="3" name="edit_address" required="" placeholder="Address." id="edit_address"></textarea>
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Adhaar Card No.</label>
                                                    <input type="text" class="form-control" name="edit_aadar_no" placeholder="Adhaar Card No." required="" id="edit_aadar_no">
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Card No.</label>
                                                    <input type="text" class="form-control" required="" name="edit_idcard_no" placeholder="ID Card No." id="edit_idcard_no">
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Choose Image</label>
                                                   <input type="file" class="form-control" id="edit_images"  name="edit_images">
                                                      
                                                  </div>
                                                  <div id="edit_image"></div>
                                            </div>
                                            </div>

                                        <div class="card-footer">
                                          <button  class="btn btn-primary">Submit</button>
                                          <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-danger">Cancel</button>
                                        </div>
                                      </form>
                                    </div>
                                </div>
                                <!-- /.container-fluid -->
                              </section>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                
                  <!-- END -->
              <table id="employee_table" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th>SI No.</th>
                  <th>Name</th>
                  <th>Date of joining</th>
                  <th>Date of Resigning</th>
                  <th>Mob</th>
                  <th>Address</th>
                  <th>Adhaar Card No.</th>
                  <th>ID Card No.</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

</div>
  @endsection
  @section('script')

  <script src="{{ asset('js/employee.js') }}"></script>
  @endsection