function addNewField(val) {
 if(val){
 
            var id = $("#quotation_form_table tbody  tr:last input[name=row_count]").val();
            
            if (id == undefined) {
                var r_count = 1;
            } else {
                var r_count = parseInt(id) + 1;
              
            }
            var html = '';
            html='<tr class="var_row">'+'<td><div class="form-group"><input  type="text" name="purchase['+r_count+'][product_name]" class="form-control"  placeholder="Item" required></div></td>';
            html+=' <td><div class="form-group"><input  type="number" id="total_qty_'+r_count+'" name="purchase['+r_count+'][quantity]" class="form-control product_quantity"  value="0.00" required></div></td>';  
            html+='<td><div class="form-group"><input  type="number" id="total_prchase_price_'+r_count+'" name="purchase['+r_count+'][purchase_price]" class="form-control purchase_price"  value="0.00" required> </div></td>' ;            
              html+='<td><div class="form-group"><input  type="text"  name="purchase['+r_count+'][final_purchase_price]" class="form-control final_purchase_price"  placeholder="0.00" disabled></div></td><td> <a type="button" class="btn bg-gradient-danger btn-sm" onclick="removeField(this)"><i class="las la-trash"></i></a><input type="hidden" name="row_count"  value="' + r_count + '"></td></tr>';
            var count_table_tbody_tr = $("#quotation_form_table tbody tr").length;
                    if (count_table_tbody_tr >= 1) {
                        $("#quotation_form_table tbody tr:last").after(html);
                    } else {
    
                        $("#quotation_form_table tbody").html(html);
                    }
          }
 }

  // Rmove row
 function removeField(val) {
  $(val).closest('.var_row').remove();
  var total_amount = 0;
  $(".final_purchase_price").each(function () {
  total_amount += +$(this).val();
  });
  total_amount = total_amount.toFixed(2);
  $('#final_total1').val(total_amount);
    $('#final_total').val(total_amount);
  }
  // endremove
  // calculation by qty
  $(document).on('change', 'input.product_quantity', function (e) {
  var qty = $(this).val();
  var tr_obj = $(this).closest('tr');
  var product_price = tr_obj.find('input.purchase_price').val();
  var total = 0, total_amount = 0;
  total = (parseFloat(product_price) * parseInt(qty));
  total = total.toFixed(2);
  tr_obj.find('.final_purchase_price').val(total);
  $(".final_purchase_price").each(function () {
      total_amount += +$(this).val();
  });
  total_amount = total_amount.toFixed(2);
  $('#final_total1').val(total_amount);
    $('#final_total').val(total_amount);
  // alert(qty);
  });
  // end calculation by qty
  // calculation by purchase price
  $(document).on('change', 'input.purchase_price', function (e) {
  var product_price = $(this).val();
  var tr_obj = $(this).closest('tr');
  var qty = tr_obj.find('input.product_quantity').val();
  var total = 0, total_amount = 0;
  total = (parseFloat(product_price) * parseInt(qty));
  total = total.toFixed(2);
  tr_obj.find('.final_purchase_price').val(total);
  $(".final_purchase_price").each(function () {
      total_amount += +$(this).val();
  });
  total_amount = total_amount.toFixed(2);
  $('#final_total1').val(total_amount);
  $('#final_total').val(total_amount);
  // alert(qty);
  });
  // end calculation by purchase price
  // form validation
  $(document).ready(function(){
  $('#add_purchase_form').on('submit', function(e){
  e.preventDefault();
  var price_total=$('#final_total1').val();
  if (price_total <= 0) {
      return false;
  }else{
      this.submit();
  }
  });
  });
// end form validation


$( document ).ready(function() {
    report();
  });
  function report(){
    var contact_id=$("#contact_id").val();
    var datefrom=$("#datefrom").val();
    var dateto=$("#dateto").val();
    var manageTable = $('#quotation_table').DataTable();
    manageTable.destroy();
    manageTable= $("#quotation_table").DataTable({
      "ajax": {
                "url": 'quotaton_data',
                'type': "GET",
                'data':{contact_id:contact_id,datefrom:datefrom,dateto:dateto},
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
                url: 'delete_transactions/' + id,
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

// edit purchase
function editAddNewField(val) {
   
 if(val){
 
            var id = $("#edit_quotation_form_table tbody  tr:last input[name=row_count]").val();
            
            if (id == undefined) {
                var r_count = 1;
            } else {
                var r_count = parseInt(id) + 1;
              
            }
            var html = '';
            html='<tr class="var_row">'+'<td><div class="form-group"><input  type="text" name="purchase['+r_count+'][product_name]" class="form-control"  placeholder="Item" required></div></td>';
            html+=' <td><div class="form-group"><input  type="number" id="total_qty_'+r_count+'" name="purchase['+r_count+'][quantity]" class="form-control product_quantity"  value="0.00" required></div></td>';  
            html+='<td><div class="form-group"><input  type="number" id="total_prchase_price_'+r_count+'" name="purchase['+r_count+'][purchase_price]" class="form-control purchase_price"  value="0.00" required> </div></td>' ;            
              html+='<td><div class="form-group"><input  type="text"  name="purchase['+r_count+'][final_purchase_price]" class="form-control final_purchase_price"  placeholder="0.00" disabled></div></td><td> <a type="button" class="btn bg-gradient-danger btn-sm" onclick="removeField(this)"><i class="las la-trash"></i></a><input type="hidden" name="row_count"  value="' + r_count + '"></td></tr>';
            var count_table_tbody_tr = $("#edit_quotation_form_table tbody tr").length;
                    if (count_table_tbody_tr >= 1) {
                        $("#edit_quotation_form_table tbody tr:last").after(html);
                    } else {
    
                        $("#edit_quotation_form_table tbody").html(html);
                    }
          }
 }
