@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Purchase</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Purchase</li>
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
              <form id="add_purchase_form" action="{{url('update',$purchase_data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row" x-data="handler()">
                    <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Ref No.</label>
                              <input type="text" class="form-control" name="ref_no" placeholder="Ref. No." value="{{$purchase_data->ref_no}}" disabled="">
                            </div>
                          </div>
                    <div class="col-md-4">
                    <div class="form-group">
                                    <label>Dealer Name</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="contact_id" required="">
                                      <option value="">Select</option>
                                      @foreach($data as $supplier)
                                      <option value="{{$supplier->id}}" @php if($purchase_data->contact_id == $supplier->id) echo 'selected'; @endphp>{{$supplier->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Date</label>
                              <input type="date" class="form-control" name="transaction_date" placeholder="date" required="" value="{{$purchase_data->transaction_date}}">
                            </div>
                          </div>

                        <table class="table table-bordered table-striped" id="edit_purchase_form_table">
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
                              @php
                              $i=1;
                              @endphp
                              @foreach($purchaseLine_data as $purchaseLine_datas)
                             
                                <tr class="var_row">
                                  <td><div class="form-group"><input  type="text" name="purchase[{{$i}}][product_name]" class="form-control"  placeholder="Item" required value="{{$purchaseLine_datas->product_name}}"></div></td>
                                  <td><div class="form-group"><input  type="number" id="total_qty_{{$i}}" name="purchase[{{$i}}][quantity]" class="form-control product_quantity"   required value="{{$purchaseLine_datas->quantity}}"></div></td>
                                  <td><div class="form-group"><input  type="number" id="total_prchase_price_{{$i}}" name="purchase[{{$i}}][purchase_price]" class="form-control purchase_price"   required value="{{$purchaseLine_datas->purchase_price}}"> </div></td><td><div class="form-group"><input  type="text"  name="purchase[{{$i}}][final_purchase_price]" value="{{$purchaseLine_datas->purchase_price * $purchaseLine_datas->quantity}}" class="form-control final_purchase_price"   disabled></div></td><td> <a type="button" class="btn bg-gradient-danger btn-sm" onclick="removeField(this)"><i class="las la-trash"></i></a><input type="hidden" name="row_count"  value="{{$i}}"></td>
                                </tr>
                          @php
                          $i++;
                          @endphp
                          @endforeach
                            </tbody>
                            <tfoot>
                               <tr>
                                 <td colspan="8" class="text-right"><button type="button" class="btn btn-info" onclick="addNewField({{$i}})"><i class="las la-plus"></i>  Add Row</button></td>
                              </tr>
                            </tfoot>
                          </table>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Net Total Amount</label>
                              <input type="text" class="form-control" id="final_total1" placeholder="final amount"  disabled="" value="{{$purchase_data->final_total}}">
                              <input type="hidden" class="form-control" value="{{$purchase_data->final_total}}" id="final_total" name="final_total">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Advance</label>
                              <input type="text" class="form-control" value="{{$purchase_data->advance}}" name="advance" placeholder="Advance">
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
