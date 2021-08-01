@extends('layouts.dashboard')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Expense Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Expense Category</li>
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
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#expensecategorymodal" data-keyboard="false" data-backdrop="static">
                        Add Expense Category<i class="las la-plus"></i>
                      </button>
                </div>
                
               
                  </div>

                  <div class="modal fade" id="expensecategorymodal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-header modal-heading">
                              <h4>Add Expense Category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true"><i class="las la-times" style="color: #007be8;"></i></span>
                                </button>
                              </div>
                            <section class="content">
                                <div class="container-fluid">
                                  
                                  <div class="card card-primary" style="box-shadow: none;">
                                      <form id="expensCategoryForm" action="{{route('expense-category.store')}}" method="post">
                                        @csrf
                                        <div class="card-body row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Category Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" required="">
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


                  <div class="modal fade" id="Edit_expense_category_modal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-header modal-heading">
                              <h4>Edit Expense Category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true"><i class="las la-times" style="color: #007be8;"></i></span>
                                </button>
                              </div>
                            <section class="content">
                                <div class="container-fluid">
                                  
                                  <div class="card card-primary" style="box-shadow: none;">
                                      <form id="updateexpensecategoryform" method="post" action="{{url('update_expense_category')}}">
                                        @csrf
                                        <div class="card-body row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Category Name</label>
                                                    <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Category Name" required="">
                                                  </div>
                                            </div>
                                            </div>

                                        <div class="card-footer">
                                          <button  class="btn btn-primary">Submit</button>
                                          <button data-dismiss="modal" aria-label="Close"  class="btn btn-danger">Cancel</button>
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
             <div class="card-body pt-0">
              <table id="expense_category_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI No.</th>
                  <th>Expense Category</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
        
               </tbody>
              </table></div>
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

  <script src="{{ asset('js/expense_category.js') }}"></script>
  @endsection
