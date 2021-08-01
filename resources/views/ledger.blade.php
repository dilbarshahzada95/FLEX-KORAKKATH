@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ledger</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ledger</li>
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
                                    <select class="form-control select2bs4" style="width: 100%;" onchange="getNamedData(this.value);">
                                      <option value="" >Select</option>
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
                              <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Date From</label>
                                                    <input type="date" class="form-control" value="@php echo date('Y-m-d'); @endphp"  id="datefrom" >
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Date To</label>
                                                    <input type="date" class="form-control" value="@php echo date('Y-m-d'); @endphp" id="dateto" >
                                                  </div>
                                            </div>

                            </div>
                            <div class="card-footer p-0">
                                          <button  class="btn btn-primary" onclick="report();">Submit</button>
                                          <button type="button" data-dismiss="modal" aria-label="Close" type="submit" class="btn btn-danger">Cancel</button>
                                        </div>
                         
                    </div>
                </div>


                  <!-- END -->
              <table id="ledger_report" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI No.</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Recieved</th>
                  <th>Balance</th>
                  <th>Report</th>
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

  
  @endsection
  @section('script')

  <script src="{{ asset('js/ledger.js') }}"></script>
  @endsection
