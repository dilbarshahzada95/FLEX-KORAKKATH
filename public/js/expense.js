$( document ).ready(function() {
    report();
  });
  function report(){
    var category_id=$("#category_id").val();
    // alert(category_id)
    var datefrom=$("#datefrom").val();
    var dateto=$("#dateto").val();
    var manageTable = $('#expense_table').DataTable();
    manageTable.destroy();
    manageTable= $("#expense_table").DataTable({
      "ajax": {
                "url": 'expesne_data',
                'type': "GET",
                'data':{category_id:category_id,datefrom:datefrom,dateto:dateto},
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
                url: 'delete_expense/' + id,
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