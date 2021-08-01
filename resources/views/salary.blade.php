@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Salary</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Salary</li>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#salary_modal" data-keyboard="false" data-backdrop="static">
                        Add Salary<i class="las la-plus"></i>
                      </button>
                </div>
                <div class="modal fade" id="salary_modal">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-header modal-heading">
                              <h4>Add Salary</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true"><i class="las la-times" style="color: #007be8;"></i></span>
                                </button>
                              </div>
                            <section class="content">
                                <div class="container-fluid">
                                  
                                  <div class="card card-primary" style="box-shadow: none;">
                                      <form id="salary_form" action="{{url('insert-salary')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>Employee Name</label>
                                                        <select class="form-control select2bs4" style="width: 100%;" required="" name="employee_id" id="employee_id"> 
                                                          <option value="">select</option>
                                                          @foreach($data as $dat)
                                                          <option value="{{$dat->id}}">{{$dat->name}}</option>
                                                        @endforeach
                                                        </select>
                                                      </div> 
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Date</label>
                                                    <input type="date" class="form-control" id="date" name="date" required="">
                                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                    <input type="text" class="form-control" id="salary" placeholder="Amount" name="salary" required="">
                                                  </div>
                                            </div>
                                            </div>

                                        <div class="card-footer">
                                          <button  class="btn btn-primary">Submit</button>
                                          <button type="button" data-dismiss="modal" aria-label="Close" type="submit" class="btn btn-danger">Cancel</button>
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
              <table id="salary_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI No.</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Amount</th>
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

  
  @endsection
  @section('script')

  <script src="{{ asset('js/employee.js') }}"></script>
  @endsection