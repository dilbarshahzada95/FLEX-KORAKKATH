@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Supplier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Supplier</li>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsupplier" data-keyboard="false" data-backdrop="static">
                        Add Supplier<i class="las la-plus"></i>
                      </button>
                </div>
                 <div id="messages"></div>
                <div class="modal fade" id="addsupplier">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-header modal-heading">
                              <h4>Add SUpplier</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true"><i class="las la-times" style="color: #007be8;"></i></span>
                                </button>
                              </div>
                            <section class="content">
                                <div class="container-fluid">
                                  
                                  <div class="card card-primary" style="box-shadow: none;">
                                                <form id="createsupplierForm" method="post" action="{{url('add-supplier')}}">
                                                  @csrf
                <div class="card-body row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Supplier Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Supplier Name">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile" placeholder="Mobile Number">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">GST No.</label>
                        <input type="text" class="form-control" name="gst_no" placeholder="GST No.">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Bank Name</label>
                        <input type="text" class="form-control" name="bank" placeholder="Bank Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Bank Branch</label>
                        <input type="text" class="form-control" name="branch" placeholder="Bank Branch">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Account Number</label>
                        <input type="text" class="form-control" name="account_no" placeholder="Account Number">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">IFSC Code</label>
                        <input type="text" class="form-control" name="ifsc" placeholder="IFSC Code">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <textarea class="form-control" rows="3" name="address" placeholder="Type Here.."></textarea>
                      </div>
                    </div>


                    </div>
                    <div class="card-footer pt-0 mb-5">
                      <button class="btn btn-primary">Submit</button>
                      <button class="btn btn-danger">Cancel</button>
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
                <table id="supplier" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                     <th>Sl.no</th>
                    <th>Supplier Name</th>
                    <th>Mobile No.</th>
                    <th>GST No.</th>
                    <th>Account Number</th>
                    <th>Address</th>
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

  <!-- Button trigger modal -->
                  
                <div class="modal fade" id="edit">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-header modal-heading">
                              <h4>Edit Supplier</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true"><i class="las la-times" style="color: #007be8;"></i></span>
                                </button>
                              </div>
                            <section class="content">
                                <div class="container-fluid">
                                  
                                  <div class="card card-primary" style="box-shadow: none;">
                                                <form id="updatesupplierform" method="post" action="{{url('update_supplier')}}">
                <div class="card-body row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Customer Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Customer Name">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <input type="text" class="form-control" id="edit_mobile" name="edit_mobile" placeholder="Mobile Number">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">GST No.</label>
                        <input type="text" class="form-control" id="edt_gst_no" name="edt_gst_no" placeholder="GST No.">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Bank Name</label>
                        <input type="text" class="form-control" id="edit_bank" name="edit_bank" placeholder="Bank Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Bank Branch</label>
                        <input type="text" class="form-control" id="edit_branch" placeholder="Bank Branch">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Account Number</label>
                        <input type="text" class="form-control" id="edit_acc_no" placeholder="Account Number">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">IFSC Code</label>
                        <input type="text" class="form-control" id="edit_ifsc" placeholder="IFSC Code">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <textarea class="form-control" rows="3" id="edit_address" name="edit_address" placeholder="Type Here.."></textarea>
                      </div>
                    </div>


                    </div>
                    <div class="card-footer pt-0 mb-5">
                      <button class="btn btn-primary">Submit</button>
                      <button class="btn btn-danger">Cancel</button>
                    </div>
              </form>
  <!-- Modal -->
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection
  @section('script')

  <script src="{{ asset('js/supplier.js') }}"></script>
  @endsection
