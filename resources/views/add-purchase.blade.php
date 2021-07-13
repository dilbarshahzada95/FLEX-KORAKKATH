@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Purchase</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Purchase</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="card card-primary">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
              <form id="add_purchase_form" action="{{url('add-purchase')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row" x-data="handler()">
                    <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Ref No.</label>
                              <input type="text" class="form-control" name="ref_no" placeholder="Ref. No.">
                            </div>
                          </div>
                    <div class="col-md-4">
                    <div class="form-group">
                                    <label>Dealer Name</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="contact_id" required="">
                                      <option value="">Select</option>
                                      @foreach($data as $supplier)
                                      <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Date</label>
                              <input type="date" class="form-control" name="transaction_date" placeholder="date" required="">
                            </div>
                          </div>

                        <table class="table table-bordered table-striped" id="purchase_form_table">
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
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Advance</label>
                              <input type="text" class="form-control" name="advance" placeholder="Advance">
                            </div>
                          </div>
                    </div>
                </div>
                    <div class="card-footer pt-0 mb-5">
                      <button class="btn btn-primary" type="submit">Submit</button>
                      <button class="btn btn-danger">Cancel</button>
                    </div>
              </form>
            </div>

        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- /.content -->


  @endsection
  @section('script')
  <script src='https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js'></script>
  <script src="{{ asset('js/purchase.js') }}"></script>
  @endsection











</body>
</html>
