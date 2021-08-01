$( document ).ready(function() {
    report();
  });
function report(){
     var type=$("#type").val();
    var type_id=$("#type_id").val();
     var datefrom=$("#datefrom").val();
    var dateto=$("#dateto").val();
    var manageTable = $('#ledger_report').DataTable();
    manageTable.destroy();
    manageTable= $("#ledger_report").DataTable({
      "ajax": {
                "url": 'get_ledger_data',
                'type': "GET",
                'data':{type_id:type_id,datefrom:datefrom,dateto:dateto},
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


   


        