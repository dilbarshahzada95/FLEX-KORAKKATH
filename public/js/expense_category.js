

$( document ).ready(function() {
   report();
  });

function report(){
     var manageTable = $('#expense_category_table').DataTable();
    manageTable.destroy();
    manageTable= $("#expense_category_table").DataTable({
      "ajax": {
                "url": 'get_expense_category',
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
 $("#expensCategoryForm").unbind('submit').on('submit', function () {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success: function (response) {
                
                  if (response.success = true) {
                    
                   $('#expensecategorymodal').modal('hide');
                   $("#expensCategoryForm")[0].reset();
                    swal("Successfully Done!", {
                      icon: "success",
                      });
                    report();
                }
                else{
                    $('#expensecategorymodal').modal('hide');
                    $("#expensCategoryForm")[0].reset();
                     swal(" faild!", {
                      icon: "success",
                      });
                }
             
            }
        });

        return false;
    });

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
                url: 'destroy/' + id,
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

  function edit_expense_category(id){
    
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
        });
         $.ajax({
            url: 'edit_expense_category/' + id,
            type: 'post',
            dataType: 'json',
            success: function (response) {
               
                $("#edit_name").val(response.name);
                
                // submit the edit from 
                $("#updateexpensecategoryform").unbind('submit').bind('submit', function () {
                    var form = $(this);

                    // remove the text-danger
                    $(".text-danger").remove();

                    $.ajax({
                        url: form.attr('action') + '/' + id,
                        type: form.attr('method'),
                        data: form.serialize(), // /converting the form data into array and sending it to server
                        dataType: 'json',
                        success: function (response) {
                         
                      if (response.success = true) {
                        report();
                       $('#Edit_expense_category_modal').modal('hide');
                       $("#updateexpensecategoryform")[0].reset();
                         swal("Successfully updated!", {
                            icon: "success",
                            });
                     }
                        else{
                            $('#Edit_expense_category_modal').modal('hide');
                            $("#updateexpensecategoryform")[0].reset();
                              swal("Updation faild!", {
                                    icon: "success",
                                    });
                        }
                    
                                }
                            });

                            return false;
                        });
            }
        });
    }