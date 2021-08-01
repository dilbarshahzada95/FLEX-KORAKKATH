@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Quotation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Quotation</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="card card-primary">
              <form action="{{route('quotation.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row" x-data="handler()">
                    <div class="col-md-4">
                    <div class="form-group">
                                    <label>Customer Name</label>
                                  <select class="form-control select2bs4" style="width: 100%;" name="contact_id">
                                      <option value="">Select </option>
                                      @foreach($data as $customer)
                                      <option value="{{$customer->id}}">{{$customer->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                          </div>
                         <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Date</label>
                              <input type="date" class="form-control" name="transaction_date" placeholder="date">
                            </div>
                          </div>

                        <table class="table table-bordered table-striped" id="quotation_form_table">
                            <thead class="thead-theme">
                             <tr>
                               <th>Item</th>
                               <th>Quantity</th>
                               <th>Rate</th>
                               <th>Prize</th>
                               <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                             
                            </tbody>
                            <tfoot>
                               <tr>
                                 <td colspan="8" class="text-right"><button type="button" class="btn btn-info" onclick="addNewField(1)"><i class="las la-plus"></i>  Add Row</button></td>
                              </tr>
                            </tfoot>
                          </table>
                                  <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Net Total Amount</label>
                              <input type="text" class="form-control" id="final_total1" placeholder="final amount"  disabled="">
                              <input type="hidden" class="form-control" id="final_total" name="final_total">
                            </div>
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
    <!-- /.content -->


  </div>

 

  @endsection
  @section('script')

  <script src="{{ asset('js/quotaion.js') }}"></script>
  @endsection