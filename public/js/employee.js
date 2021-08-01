
    $("#employee_form").unbind('submit').on('submit', function () {
var image=$("#image").files[0].id;

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
                    
                   $('#employee_modal').modal('hide');
                   $("#employee_form")[0].reset();
                    swal("Successfully Registerd!", {
                      icon: "success",
                      });
                }
                else{
                    $('#employee_modal').modal('hide');
                    $("#employee_form")[0].reset();
                    swal("faild!", {
                      icon: "success",
                      });
                }
            
            }
        });

        return false;
    });

    $( document ).ready(function() {
    report();
    salary_report();
  });
function report(){
    var manageTable = $('#employee_table').DataTable();
    manageTable.destroy();
    manageTable= $("#employee_table").DataTable({
      "ajax": {
                "url": 'fetchEmployeeData',
                'type': "GET",
               },  
      lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']],
                "responsive": false, "lengthChange": false, "autoWidth": false,
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
                url: 'delete_employee/' + id,
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

function edit_employee(id){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
        });
         $.ajax({
            url: 'edit_employee_data/' + id,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $("#edit_name").val(response.name);
                $("#date_of_resigning").val(response.date_of_resigning);
                $("#edit_mob").val(response.mob);
                $("#edit_address").val(response.address);
                $("#edit_aadar_no").val(response.aadar_no);
                $("#edit_idcard_no").val(response.idcard_no);
                $("#edit_image").append('<img src="storage/'+ response.image+'" style="width: 80px;" alt="" >');
              
                // submit the edit from 
                $("#edit_employee_form").unbind('submit').bind('submit', function () {
                   
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
                        
                       $('#edit_employee_modal').modal('hide');
                       $("#edit_employee_form")[0].reset();
                        swal("Successfully Updated!", {
                          icon: "success",
                          });
                       }
                        else{
                            $('#edit_employee_modal').modal('hide');
                            $("#edit_employee_form")[0].reset();
                             swal("faild!", {
                              icon: "success",
                              });
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


    $("#salary_form").unbind('submit').on('submit', function () {
      var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success: function (response) {
                 salary_report();
                  if (response.success = true) {
                    
                   $('#salary_modal').modal('hide');
                   $("#salary_form")[0].reset();
                    swal("Successfully Paid!", {
                      icon: "success",
                      });
                }
                else{
                    $('#salary_modal').modal('hide');
                    $("#salary_form")[0].reset();
                    swal("faild!", {
                      icon: "success",
                      });
                }
            
            }
        });

        return false;
    });



    function salary_report(){
    var manageTable = $('#salary_table').DataTable();
    manageTable.destroy();
    manageTable= $("#salary_table").DataTable({
      "ajax": {
                "url": 'fetchSalaryData',
                'type': "GET",
               },  
      lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']],
                "responsive": false, "lengthChange": false, "autoWidth": false,
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

$(document).on('click', '#deletee', function (e) {

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
                url: 'delete_salary/' + id,
                success: function (data) {
                salary_report();   
                swal("Successfully deleted!", {
                icon: "success",
                });
                }         
            });
          
        } 
        });
 
});