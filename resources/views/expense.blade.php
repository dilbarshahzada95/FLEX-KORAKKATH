@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Expense</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Expense</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
        <div class="card-body" style="box-shadow: none;">
                                  
                                        <div class="card-body row">
                                            <div class="col-md-4">
                                            <div class="form-group">
                                    <label>Expense Category</label>
                                <select class="form-control select2bs4" style="width: 100%;" id="category_id" >
                                      <option value="">Select</option>
                                      @foreach($data as $dat)
                                      <option value="{{$dat->id}}">{{$dat->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                            <div class="form-group">
                                    <label>Date From</label>
                                    <input type="date" class="form-control" id="datefrom" >
                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                    <label>Date To</label>
                                    <input type="date" class="form-control" id="dateto" >
                                  </div>
                                            </div>
                                            </div>

                                        <div class="card-footer pt-0">
                                          <button onclick="report();" class="btn btn-primary">Submit</button>
                                       
                                        </div>
                                   
                                    </div>
            <div class="card-body">
            <table id="expense_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI No.</th>
                  <th>Date</th>
                  <th>Expense Category</th>
                  <th>Expense For</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
            </tbody>
              </table>
            </div>

                
               
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                
                  <!-- END -->

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

  <script src="{{ asset('js/expense.js') }}"></script>
  @endsection
