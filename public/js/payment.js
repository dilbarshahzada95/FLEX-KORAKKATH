

$( document ).ready(function() {
    report();
  });
  function report(){
    var type=$("#type").val();
    var type_id=$("#type_id").val();
    
    var manageTable = $('#payment_table').DataTable();
    manageTable.destroy();
    manageTable= $("#payment_table").DataTable({
      "ajax": {
                "url": 'fetchBalancePayment',
                'type': "GET",
                'data':{type_id:type_id},
               },  
      lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']],
     "order": [[0, 'asc']],         
       dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: ':visible:not(:eq(5))'
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:not(:eq(5))'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:not(:eq(5))'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible:not(:eq(5))'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible:not(:eq(5))'
                    }
                }],
      });
}

    function getNamedData(type) {

        $.ajax({

            url: 'name_data/'+type,
            dataType: 'json',
            success: function (response) {
                $("#type_id").empty();
                var len = response.length;
                $("#type_id").append(
                        " <option  value=''>Please Select</option>"
                        );
                for (var i = 0; i < len; i++) {
                    var id = response[i].id;
                    var actual_name = response[i].name;
                    $("#type_id").append(
                            " <option  value='" + id + "'>" + actual_name + "</option>"
                            );

                }
            }
        });
    }


    $(document).on('click', '#pay', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
         $.ajax({

            url: 'total_balance/'+id,
            dataType: 'json',
            success: function (response) {
                $("#balance_amount").empty();
                $("#balance_amount").val(response);
                $("#balance_amount1").val(response);
                var balance_total=$("#balance_amount1").val();
                if(balance_total <= 0){
                $('#Amount').prop('disabled', true);
                }
            }
        });

      $("#payment_form").unbind('submit').on('submit', function () {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
             url: 'pay_amount/' + id,
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success: function (response) {
                 report();
                  if (response.success = true) {
                    
                   $('#payment_modal').modal('hide');
                   $("#payment_form")[0].reset();
                      swal("Payment Successfully Done!", {
                      icon: "success",
                      });
                }
                else{
                    $('#payment_modal').modal('hide');
                    $("#payment_form")[0].reset();
                    swal("Payment faild!", {
                      icon: "error",
                      });
                }
              
            }
        });

        return false;
    });
});


