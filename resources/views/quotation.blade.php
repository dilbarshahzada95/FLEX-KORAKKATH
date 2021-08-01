@extends('layouts.dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quotation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Quotation</li>
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
                <table id="quotation_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SN. No.</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Total Amount</th>
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


  </div>


  @endsection
  @section('script')

  <script src="{{ asset('js/quotaion.js') }}"></script>
  @endsection