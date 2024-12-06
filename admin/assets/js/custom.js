$(document).ready(function () {

    alertify.set('notifier', 'position', 'top-right');

    $(document).on('click', '.increment', function () {
        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue)) {
            var qtyVal = currentValue + 1;
            $quantityInput.val(qtyVal);
            $quantityIncdec(productId, qtyVal);

        }

    });
    $(document).on('click', '.decrement', function () {
        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();

        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue) && currentValue > 1) {
            var qtyVal = currentValue - 1;
            $quantityInput.val(qtyVal);
            $quantityIncdec(productId, qtyVal);
        }

    });

    function $quantityIncdec(prodId, qty) {
        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'productIncDec': true,
                'product_id': prodId,
                'quantity': qty
            },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status == 200) {
                    // reload the current page
                    // window.location.reload();
                    $('#productArea').load(' #productContent');
                    alertify.success(res.message);
                } else {
                    $('#productArea').load(' #productContent');
                    alertify.error(res.message);

                }
            }

        });
    }

    // proceed to place order button click
    $(document).on('click', '.proceedToPlace', function () {

        var payment_mode = $('#payment_mode').val();
        var cphone = $('#cphone').val();
        if (payment_mode == '') {
            swal("Select Payment Mode", "Select your payment mode", "warning");
            return false;
        }
        if (cphone == '' && !$.isNumeric(cphone)) {
            swal("Enter Phone Number", "Enter Valid Phone Number", "warning");
            return false;
        }

        var data = {
            'proceedToPlaceBtn': true,
            'cphone': cphone,
            'payment_mode': payment_mode
        };

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: data,
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status == 200) {
                    window.location.href = "order-summary.php";
                } else if (res.status = 404) {
                    swal(res.message, res.message, res.status_type, {
                        buttons: {
                            catch: {
                                text: "Add Customer",
                                value: "catch"
                            },
                            cancel: "Cancel"
                        }
                    }).then((value) => {
                        switch (value) {

                            case "catch":
                                $('#c_phone').val(cphone);
                                $('#addCustomerModal').modal('show');
                                // console.log('Pop the customer add model');
                                break;
                            default:

                        }
                    });
                } else {
                    swal(res.message, res.message, res.status_type);
                }
            }

        });

    });

    // Add customer to customer table
    $(document).on('click', '.saveCustomer', function () {

        var c_name = $('#c_name').val();  
        var c_phone = $('#c_phone').val();  
        var c_email = $('#c_email').val();  

        if (c_name != '' && c_phone != '') {
            if ($.isNumeric(c_phone)) {
                var data = {
                    'saveCustomerBtn': true,
                    'name': c_name,
                    'phone': c_phone,
                    'email': c_email
                };
                $.ajax({
                    type: "POST",
                    url: "orders-code.php",
                    data: data,
                    success: function (response) {
                        var res = JSON.parse(response);
                        if (res.status == 200) {
                            swal(res.message, res.message, res.status_type);
                            $('#addCustomerModal').modal('hide');
                        } else if (res.status == 422) {
                            swal(res.message, res.message, res.status_type);
                        } else {
                            swal(res.message, res.message, res.status_type);
                        }
                    }
                });
            } else {
                swal("Please Enter a Valid Phone number", "", "warning");
            }
        } else {
            swal("Please Fill Required Fields", "These fields are mandatory", "warning");
        }
    });

    $(document).on('click', '#saveOrder', function () {
        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: { 'saveOrderBtn': true },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 200) {
                    swal(res.message, res.message, "success");
                    $('#orderPlaceSuccessMessage').text(res.message);
                    $('#orderSuccessModal').modal('show');

                } else {
                    swal(res.message, res.message, "error");
                }
            }
        });
    });

}); 
function printMyBillingArea(){
    var printContents = document.getElementById('myBillingArea').innerHTML;
    var popupWin = window.open('', '');
    popupWin.document.write('<html><title>----POS----</title>');
    popupWin.document.write('<body style="font-family:fangsong;">');
    popupWin.document.write(printContents);
    popupWin.document.write('</body></html>');
    popupWin.document.close;
    popupWin.print();
}
window.jsPDF = window.jspdf.jsPDF;
var docPDf = new jsPDF();
function downloadPDF(invoiceNo){
    var elementHTML = document.querySelector("#myBillingArea")
    docPDf.html(elementHTML,{
        callback: function(){
            docPDf.save(invoiceNo+'.pdf');
        },
        x: 15,
        y: 15,
        width: 170,
        windowWidth:650


    });
}