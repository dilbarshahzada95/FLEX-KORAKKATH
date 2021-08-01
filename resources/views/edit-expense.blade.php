@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Expense</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Expense</li>
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
                                      <form action="{{url('expense_update',$expense_data->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="transaction_date"  value="{{$expense_data->transaction_date}}" required="" placeholder="DOB">
                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                    <label>Expense Category</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="category_id" required="">
                                      @foreach($data as $dat)
                                      <option value="{{$dat->id}}" @php if($expense_data->category_id == $dat->id) echo 'selected'; @endphp>{{$dat->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                            <div class="form-group">
                                    <label>Expense For</label>
                                    <input type="text" class="form-control" name="expense_for"  value="{{$expense_data->expense_for}}" placeholder="Expense For">
                                  </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" required=""  value="{{$expense_data->amount}}" name="amount" placeholder="Amount">
                                  </div>
                                            </div>
                              
                                            </div>

                                        <div class="card-footer pt-0">
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                       
                                        </div>
                                      </form>
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

