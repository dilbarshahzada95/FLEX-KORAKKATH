@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Purchase</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Purchase</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
            <div class="card-body">

              @if(session()->has('message'))
                 <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
                    <div class="row" x-data="handler()">
                    <div class="col-md-4">
                     <div class="form-group">
                                    <label>Supplier Name</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="contact_id">
                                      <option value="">Select</option>
                                      @foreach($data as $supplier)
                                      <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                      @endforeach
                                    </select>
                                    </select>
                                  </div>
                    </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Date From</label>
                              <input type="date" class="form-control" id="datefrom"  placeholder="Date From">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Date To</label>
                              <input type="date" class="form-control" id="dateto" placeholder="Date To">
                            </div>
                          </div>
                    </div>
                </div>
                    <div class="card-footer pt-0 mb-5">
                      <button class="btn btn-primary" onclick="report();">Submit</button>
                      <button class="btn btn-danger">Cancel</button>
                    </div>
              <div class="card-body">
                <table id="purchase" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SN. No.</th>
                    <th>Transaction Date</th>
                    <th>Ref. No.</th>
                    <th>Dealer Name</th>
                    <th>Total Amount</th>
                    <th>Advance</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
               
                </table>
              </div>
            </div>
        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- /.content -->


 @endsection
  @section('script')

  <script src="{{ asset('js/purchase.js') }}"></script>
  @endsection