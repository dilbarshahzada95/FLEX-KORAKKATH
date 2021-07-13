<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body{
            padding: 0;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }
        .content{
            padding-left: 50px;
        }
        p{
          margin: 0;
        }
        .table{
    display:table;
    width:100%;
    table-layout:fixed;
}
table{
  margin: 0;
}

    </style>
  </head>
  <body class="mt-5 mb-5" onload="window.print();">
      <h5 class="text-center">{{$type}}</h5>
      <div class="container">
          <div class="row">
              <div class="col-md-6 p-0">
                <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td>
                            <div class="d-flex align-items-center">
                            
                                <div class="content ">
                                    <h4>FLEX KORAKKATH</h4>
                                    <p>Wayanad Road,Karanthur,Kerala-673571</p>
                                </div>
                            </div>
                        </td>
                      </tr>
                      <tr style="height: 243px;"> 
                        <td>Bill To<br>
                       
                        <strong>{{$data[0]->name}}</strong>
                        <p>{{$data[0]->address}}</p>
                        <p>Contact No, : {{$data[0]->mobile}}</p>
                        
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <div class="col-md-6 p-0">
                <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td>
                          <p>Ref No.</p>
                          <p><Strong> {{$data[0]->ref_no}}</Strong></p>
                        </td>
                        <td>
                          <p>Date</p>
                          <p><Strong>{{$data[0]->transaction_date}}</Strong></p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <p>Due Date:</p>
                          <p><Strong>-</Strong></p>
                        </td>
                        <td>
                          <p>Transport Name</p>
                          <p><Strong>-</Strong></p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <p>Vehicle No.</p>
                          <p><Strong>-</Strong></p>
                        </td>
                        <td>
                          <p>Delivery Date</p>
                          <p><Strong>-</Strong></p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <p>Delivery Location</p>
                          <p><Strong>-</Strong></p>
                        </td>
                        <td>
                        </td>

                      </tr>
                      <tr>
                        <td>
                          <p>Ship To</p>
                          <p>-</p>
                        </td>
                        <td>
                        </td>

                      </tr>
                    </tbody>
                  </table>
              </div>
              <div class="col-md-12 p-0">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Item Name</th>
                      
                      <th scope="col">Quantity</th>
                      <th scope="col">Prize/Unit</th>
                      <th scope="col">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $i=1;
                    $subtotal=0;
                    @endphp
                    @foreach($data as $prod_list)

                    
                    <tr>
                      <th>{{$i}}</th>
                      <td>{{$prod_list->product_name}}</td>
                      <td>{{$prod_list->quantity}}</td>
                      <td>{{$prod_list->purchase_price}}</td>
                      <td>{{$prod_list->purchase_price * $prod_list->quantity}}</td>
                      
                    </tr>
                  @php
                    $i++;
                    @endphp
                @endforeach
         
                </table>

              </div>
            <div class="col-md-6 p-0">
              <table class="table table-bordered mb-0">
                <tbody>
                  <tr>
                    <td>
                      <p>Invoice amount in words</p>
                      <p><strong>Forty Two rupees and thirty two Paisa Only</strong></p>
                    </td>
                  </tr>
                  <tr style="height:194px;">
                    <td>
                      <p>Description</p>
                      <p><strong>-</strong></p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-6 p-0">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td>
                      <p class="pb-2"><strong>Amounts:</strong></p>
                      <div class="d-flex justify-content-between">
                        <p>Sub Total</p>
                        <p>₹ {{$prod_list->final_total}}</p>
                      </div>
                      <div class="d-flex justify-content-between">
                        <p>Discount</p>
                        <p>₹ -</p>
                      </div>
                      <div class="d-flex justify-content-between pb-2">
                        <p>Tax</p>
                        <p>₹ -</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between pb-2">
                        <p><strong>Total</strong></p>
                        <p><strong>₹ {{$prod_list->final_total}}</strong></p>
                      </div>
                      <div class="d-flex justify-content-between pb-2">
                        <p>Recieved</p>
                        <p>₹ {{$prod_list->advance}}</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between pb-2">
                        <p>Balance</p>
                        <p>₹ {{$prod_list->final_total - $prod_list->advance}}</p>
                      </div>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>

          

            <div class="col-md-12 mt-3">
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-bordered">
                    <tbody>
                      <tr style="height: 150px;">
                        <p><Strong>Terms & Conditions:</Strong></p>
                        <p>Thanks for doing Business with us!</p>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6">
                  <table class="table table-bordered">
                    <tbody>
                      <tr style="height: 150px;">
                        <td class="text-center">For FLEX KORAKKATH</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>