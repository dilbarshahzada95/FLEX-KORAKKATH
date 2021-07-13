@extends('layouts.dashboard')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Flex Korakkath</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
   
    <section class="content">
      <div class="container-fluid">
        <div class="dashboard">

          <div class="main-dashboard">
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white d-flex align-items-center">
                  <div class="icon">
                  <i class="las la-user-tie"></i>
                  </div>
                  <div class="inner">
                    <p>Customer</p>
                    <h3>150</h3>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white d-flex align-items-center">
                  <div class="icon">
                  <i class="las la-code-branch"></i>
                  </div>
                  <div class="inner">
                    <p>Supplier</p>
                    <h3>148</h3>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white d-flex align-items-center">
                  <div class="icon">
                  <i class="las la-luggage-cart"></i>
                  </div>
                  <div class="inner">
                    <p>Purchase</p>
                    <h3>845</h3>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white d-flex align-items-center">
                  <div class="icon">
                  <i class="las la-chart-bar"></i>
                  </div>
                  <div class="inner">
                    <p>Sale</p>
                    <h3>47859</h3>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white d-flex align-items-center">
                  <div class="icon">
                    <i class="las la-file-invoice-dollar"></i>
                  </div>
                  <div class="inner">
                    <p>Expense</p>
                    <h3>4445</h3>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white d-flex align-items-center">
                  <div class="icon">
                  <i class="las la-user-alt"></i>
                  </div>
                  <div class="inner">
                    <p>Employee</p>
                    <h3>1478</h3>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white d-flex align-items-center">
                  <div class="icon">
                  <i class="las la-rupee-sign"></i>
                  </div>
                  <div class="inner">
                    <p>Salary</p>
                    <h3>10,000</h3>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white d-flex align-items-center">
                  <div class="icon">
                  <i class="lab la-gg"></i>
                  </div>
                  <div class="inner">
                    <p>Balance</p>
                    <h3>7856</h3>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Income & Expense</h3>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- /.d-flex -->
    
                    <div class="position-relative mb-4">
                      <canvas id="sales-chart" height="200"></canvas>
                    </div>
    
                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Income
                      </span>
    
                      <span>
                        <i class="fas fa-square text-light-grey"></i> Expense
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Sale & Purchase</h3>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- /.d-flex -->
    
                    <div class="position-relative mb-4">
                      <canvas id="loan-chart" height="200"></canvas>
                    </div>
    
                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Sale
                      </span>
    
                      <span>
                        <i class="fas fa-square text-light-grey"></i> Purchase
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 </div>
 @endsection



