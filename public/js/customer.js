$( document ).ready(function() {
    report();
  });
function report(){
    var manageTable = $('#customer_tbl').DataTable();
    manageTable.destroy();
    manageTable= $("#customer_tbl").DataTable({
      "ajax": {
                "url": 'customer_data',
                'type': "GET",
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

 

    $("#createcustomerForm").unbind('submit').on('submit', function () {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success: function (response) {
                 report();
                  if (response.success = true) {
                    
                   $('#addcustomer').modal('hide');
                   $("#createcustomerForm")[0].reset();
                   $("#messages").append('<div class="alert alert-success" role="alert">'+response.messages+'</div>');
                }
                else{
                    $('#addcustomer').modal('hide');
                    $("#createcustomerForm")[0].reset();
                    $("#messages").append('<div class="alert alert-success" role="alert">'+response.messages+'</div>');
                }
               setTimeout(function () {
                    $('#messages').html("");
                }, 2000);
            }
        });

        return false;
    });

    function edit_customer(id){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
        });
         $.ajax({
            url: 'edit_contcats_data/' + id,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $("#edit_name").val(response.name);
                $("#edit_mobile").val(response.mobile);
                $("#edt_gst_no").val(response.gst_no);
                $("#edit_bank").val(response.bank);
                $("#edit_branch").val(response.branch);
                $("#edit_acc_no").val(response.account_no);
                $("#edit_ifsc").val(response.ifsc);
                $("#edit_address").val(response.address);
                // submit the edit from 
                $("#updatecustomerform").unbind('submit').bind('submit', function () {
                    var form = $(this);

                    // remove the text-danger
                    $(".text-danger").remove();

                    $.ajax({
                        url: form.attr('action') + '/' + id,
                        type: form.attr('method'),
                        data: form.serialize(), // /converting the form data into array and sending it to server
                        dataType: 'json',
                        success: function (response) {
                         report();
                      if (response.success = true) {
                        
                       $('#edit').modal('hide');
                       $("#updatecustomerform")[0].reset();
                       $("#messages").append('<div class="alert alert-success" role="alert">'+response.messages+'</div>');
                        }
                        else{
                            $('#edit').modal('hide');
                            $("#updatecustomerform")[0].reset();
                            $("#messages").append('<div class="alert alert-success" role="alert">'+response.messages+'</div>');
                        }
                       setTimeout(function () {
                            $('#messages').html("");
                        }, 2000);
                                }
                            });

                            return false;
                        });
            }
        });
    }

 $(document).on('click', '#delete', function (e) {

    e.preventDefault();
    var id = $(this).data('id');
    
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "POST",
                url: 'delete_contacts/' + id,
                success: function (data) {
                report();   
                swal("Successfully deleted!", {
                icon: "success",
                });
                }         
            });
          
        } 
        });
 
});


        