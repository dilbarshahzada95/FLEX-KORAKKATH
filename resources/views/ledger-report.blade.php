<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledger</title>
      <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('style/assets/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/css/style.css')}}">
        <!-- Line icons -->
        <link rel="stylesheet" href="{{asset('style/assets/css/line-awesome.css')}}">
        <link rel="stylesheet" href="{{asset('style/assets/css/line-awesome.min.css')}}">
</head>
<body>
    <div class="page-content container">
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-10 offset-lg-1">
 <!--                    <div class="row">
                        <div class="offset-md-10 page-tools text-right float-right">
                            <div class="action-buttons">
                                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                                    <i class="las la-print text-primary-m1 text-120 w-2"></i>
                                    Print
                                </a>
                                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                                    <i class="mr-1 las la-file-pdf text-danger-m1 text-120 w-2"></i>
                                    Pdf
                                </a>
                            </div>
                        </div>
                    </div> -->
                    <!-- .row -->
    
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="heading-text">
                                <h5 class="text-blue align-middle">Flex Korakkath</h5>
                                <h6 class="text-blue">Flex Korakkath</h6>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1"><i class="las la-phone-volume text-secondary"></i> <b class="text-600">7034323232</b></div>
                                <div class="my-1"><i class="las la-file-invoice-dollar text-secondary"></i> <b class="text-600">E454ERD5487FR</b></div>
                            </div>
                        </div>
                        <!-- /.col -->
    
                        <div class="ledger-report-text text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Ledger Report
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row report__Sec">
                        <div class="col-md-6">
                            <div class="name__Sec">
                                <h5>Name : {{$data[0]->contacts_name}}</h5>
                            </div>
                        </div>
                        <div class="col-md-6 float-right">
                            <div class="date__sec d-flex">
                                <h5>From : {{$date_from}}</h5>
                                <h5 class="pl-5">To : {{$date_to}}</h5>
                            </div>

                        </div>
                    </div>
    
                    <div class="">
                        <div class="col-md-12 p-0">
                            <table class="table table-borderless table-striped">
                                <thead>
                                  <tr class="bg-primary">
                                    <th scope="col">Date</th>
                                    <th scope="col">Debit</th>
                                    <th scope="col">Credit</th>
                                    <th scope="col">Balance</th>
                                   
                                  </tr>
                                </thead>
                                <tbody>
                                 @php
                                 $balance=0.00;
                                 $debit=0.00;
                                 $credit=0.00;
                                 $total_debit=0.00;
                                 $total_credit=0.00;
                                 @endphp  
                                 @foreach($data as $ledger_data)
                                 @if($ledger_data->payment_type == 'debit')
                                  @php
                                  $total_debit = $total_debit+ $ledger_data->amount;
                                  $debit=$ledger_data->amount;
                                  $credit=0.00; 
                                  @endphp
                                  @else
                                  @php
                                  $credit=$ledger_data->amount;
                                  $debit=0.00;
                                  $total_credit= $total_credit + $ledger_data->amount;
                                  @endphp
                                  @endif
                                  @php
                                  $balance=$total_credit - $total_debit;
                                  @endphp
                                   <tr>
                                    <td>{{$ledger_data->payment_date}}</td>
                                    <td>{{$debit}}</td>
                                    <td>{{$credit}}</td>
                                    <td>{{$balance}}</td>
                                    
                                  </tr>
                                 @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                      <td colspan="1"></td>
                                      <td><strong>{{$total_debit}}</strong></td>
                                      <td><strong>{{$total_credit}}</strong></td>
                                      <td><strong>{{$balance}}</strong></td>
                                      <td></td>
                                    </tr>
                                  </tfoot>
                              </table>
                        </div>

    
    
                        <div class="row mt-3 mb-5">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            </div>
    
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-right">
                                        <Strong>Balance</Strong>
                                    </div>
                                    <div class="col-5">
                                        <span class="text-150 text-success-d3 opacity-2">{{$total_credit - $total_debit}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>
</html>