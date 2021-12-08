jQuery( document ).ready(function() {
	jQuery('input[name="amount_choice"]').change(function(){
		var value = jQuery( 'input[name="amount_choice"]:checked' ).val();
		if(value == "custom") {
			jQuery('input[name="amount"]').css('display','block');
			jQuery('input[name="fieldamount"]').css('display','none');
		} else {
			jQuery('input[name="amount"]').css('display','none');
			jQuery('input[name="fieldamount"]').css('display','block');
		}
	});


	var value = jQuery( 'input[name="amount_choice"]:checked' ).val();
	if(value == "custom") {
		jQuery('input[name="amount"]').css('display','block');
		jQuery('input[name="fieldamount"]').css('display','none');
	} else {
		jQuery('input[name="amount"]').css('display','none');
		jQuery('input[name="fieldamount"]').css('display','block');
	}


	var qty_choice = jQuery( 'input[name="qty_choice"]:checked' ).val();
	if(qty_choice == "custom") {
		jQuery('input[name="quantity"]').css('display','block');
		jQuery('input[name="fieldquantity"]').css('display','none');
	} else {
		jQuery('input[name="quantity"]').css('display','none');
		jQuery('input[name="fieldquantity"]').css('display','block');
	}


	jQuery('input[name="qty_choice"]').change(function() {
		var qty_choice = jQuery( 'input[name="qty_choice"]:checked' ).val();
		if(qty_choice == "custom") {
			jQuery('input[name="quantity"]').css('display','block');
			jQuery('input[name="fieldquantity"]').css('display','none');
		} else {
			jQuery('input[name="quantity"]').css('display','none');
			jQuery('input[name="fieldquantity"]').css('display','block');
		}
	});



    jQuery('body').on('click','.addcolumn',function(){
    	//jQuery(".ocscw_chart_tbl tr .first_col").after('<td><a class="addcolumn"><img src= " '+ ocscw_object_name + '/includes/images/plus.png"></a><a class="deletecolumn"><img src= " '+ ocscw_object_name + '/includes/images/delete.png"></a></td>');

        var td = jQuery(this).closest('td');
        var indexa = td.index();
        jQuery('.ococf7_tbl tr:first td:nth-child('+(indexa+1)+')').after('<td><a class="addcolumn"><img src= " '+ CF7WPAY_name + '/includes/images/plus-circular-button_1.png"></a><a class="deletecolumn"><img src= " '+ CF7WPAY_name + '/includes/image/minus.png"></a></td>');
        


        jQuery(".ococf7_tbl tr").not(':first').each(function(index){
            jQuery(this).find('td:nth-child('+(indexa+1)+')').after("<td><input type='text' name='dis[]'></td>");     
        });
        var total_row = cfway_count_row();
        var total_column = cfway_count_col();
        jQuery('input[name="totalrow"]').val(total_row);
        jQuery('input[name="totalcol"]').val(total_column);
    });


    jQuery('body').on('click','.addrow',function(){
    	var total_column = cfway_count_col();
        let row = jQuery('<tr></tr>');
        var column = "";
        for (col = 1; col <= total_column; col++) {
            column += '<td><label>price</label><input type="text" name="prices[]"></td>';
             column += '<td><label>Quantity</label><input type="text" name="qunty[]"></td>';
              column += '<td><label>Description</label><input type="text" name="dis[]"></td>';
        }
        column += '<td><a class="addrow"><img src= " '+ CF7WPAY_name + '/includes/image/plus-circular-button_1.png"></a><a class="deleterow"><img src= " '+ CF7WPAY_name + '/includes/image/minus.png"></a></td>';
        row.append(column);
        jQuery(this).closest('tr').after(row);


    	//jQuery(".ocscw_chart_tbl").append(jQuery(".ocscw_chart_tbl tr:nth-child(2)").clone());
        var total_row = cfway_count_row();
        var total_column = cfway_count_col();
        jQuery('input[name="totalrow"]').val(total_row);
        jQuery('input[name="totalcol"]').val(total_column);
    });


    function cfway_count_col(){
    	var colCount = 0;
	    jQuery('.ococf7_tbl tr:nth-child(1) td').each(function () {
	       	colCount++;
	    });
	    return colCount - 1;
    }


    function cfway_count_row(){
    	var rowCount = jQuery('.ococf7_tbl tr').length;
    	return rowCount - 1;
    }


    jQuery("body").on('click', '.deletecolumn', function(){
        var td = jQuery(this).closest('td');
        var indexa = td.index();
        jQuery(this).closest('table').find('tr').each(function() {
            this.removeChild(this.cells[ indexa ]);
        });
        var total_row = cfway_count_row();
        var total_column = cfway_count_col();
        jQuery('input[name="totalrow"]').val(total_row);
        jQuery('input[name="totalcol"]').val(total_column);
        return false;
    });


    jQuery("body").on('click', '.deleterow', function(){
        jQuery(this).parent().parent().remove();
        var total_row = cfway_count_row();
        var total_column = cfway_count_col();
        jQuery('input[name="totalrow"]').val(total_row);
        jQuery('input[name="totalcol"]').val(total_column);
        return false;
    });


// 
//jQuery(document).ready(function(){
//     var maxField = 10; //Input fields increment limitation
//     var addButton = jQuery('.add_button'); //Add button selector
//     var wrapper = jQuery('.field_wrapper'); //Input field wrapper
//     var fieldHTML = '<div class="custom_product"><label>Price Code</label><input type="text" name="price[]"><a href="javascript:void(0);" class="remove_button"><img src="'+ CF7WPAY_name +'/includes/image/minus.png"/></a></div>'; //New input field html 
//     var x = 1; //Initial field counter is 1
    
//     //Once add button is clicked
//     jQuery(addButton).click(function(){
//         //Check maximum number of input fields
//         if(x < maxField){ 
//             x++; //Increment field counter
//            jQuery(wrapper).append(fieldHTML); //Add field html
//         }
//     });
    
//     //Once remove button is clicked
//     jQuery(wrapper).on('click', '.remove_button', function(e){
//         e.preventDefault();
//         jQuery(this).parent('div').remove(); //Remove field html
//         x--; //Decrement field counter
//     });
});