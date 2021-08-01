@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payments</li>
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
                <div class="filter mb-5">
                    <div class="card-body p-0">
                   
                          <div class="card-body row p-0">
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="type" onchange="getNamedData(this.value);">
                                      <option selected="selected">Select</option>
                                      <option value="customer">Customer</option>
                                      <option value="supplier">Supplier</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="type_id">
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-4 pt-4 mt-2 pl-3">
                                <button  class="btn btn-primary" onclick="report();">Search</button>  
                              </div>
                            </div>
                         
                    </div>
                </div>


                  <!-- END -->
              <table id="payment_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI No.</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Recieved</th>
                  <th>Balance</th>
                  <th>Pay</th>
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

  <div class="modal fade" id="payment_modal">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-header modal-heading">
                              <h4>Pay Now</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true"><i class="las la-times" style="color: #007be8;"></i></span>
                                </button>
                              </div>
                            <section class="content">
                                <div class="container-fluid">
                                  
                                  <div class="card card-primary" style="box-shadow: none;">
                                      <form id="payment_form" method="post">
                                        @csrf
                                        <div class="card-body row">
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Balance Amount</label>
                                                    <input type="text" class="form-control" id="balance_amount"  disabled>
                                                         <input type="hidden" class="form-control" id="balance_amount1"  >
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Date</label>
                                                    <input type="date" class="form-control" name="transaction_date" placeholder="Date" required="">
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                    <input type="number" class="form-control" id="Amount" name="Amount" required="" >
                                                  </div>
                                            </div>
                                            </div>

                                        <div class="card-footer">
                                          <button  id="pay_button"class="btn btn-primary">Submit</button>
                                          <button data-dismiss="modal" aria-label="Close" type="submit" class="btn btn-danger">Cancel</button>
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



  @endsection
  @section('script')

  <script src="{{ asset('js/payment.js') }}"></script>
  @endsection