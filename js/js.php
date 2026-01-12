<script>

$(document).ready(function(){

    $(document).on("click", ".get_form", function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('href'),
            method: 'GET',
            success: function (ress) {
                $(".content_all").html(ress);
            }
        });
    });

    $(document).on("submit", "#gen_form", function (e) {
        e.preventDefault();
        form_data = new FormData(this);
        // alert(form_data);
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: form_data,
            processData: false,
            contentType: false,
            success: function (ress) {
                var response = ress.split("|");
                if ($.trim(response[0]) === "success") {
                    swal("", response[1], "success");
                    $("#gen_modal").modal('hide');
                } else {
                    swal("", response[1], "warning");
                }
            }

        });
    });

    $(document).on("click", "#btn_edit", function (e) {
        e.preventDefault();
        let id = $(this).val();
        let setcol = $(this).attr('mysetcol');
        let table = $(this).attr('mytable');

        let sql = "SELECT * FROM " + table + " WHERE " + setcol + " = '" + id + "'";

        $.post("tools/search.php", { sql: sql }, function (response) {
            var data = response.split(",");
            let i = 1;

            $("#gen_form").find("input, select").each(function () {
                if ($(this).hasClass("sp") || $(this).hasClass("get_image_path") ) {
                    // Skip
                } else if ($(this).hasClass("num")) {
                    $(this).val(data[0]);
                } else if ($(this).hasClass("oper")) {
                    $(this).val("update");
                } else {
                    $(this).val(data[i]);
                    i++;
                }
            });


            // Show the modal after filling the form
            $("#gen_modal").modal('show');

            // Optional: Toggle save/update buttons
            $("#btn_update").removeClass("hide");
            $("#btn_save").addClass("hide");
        });
    });

    $(document).on("click", "#btn_update", function (e) {
        e.preventDefault();
        form_data = $("#gen_form").serialize();
        // alert(form_data);
        $.ajax({
            url: "tools/insertpage.php",
            type: 'post',
            data: form_data,
            success: function (ress) {
                var updateres = ress.split("|");
                if ($.trim(updateres[0]) === "success") {
                    swal("", updateres[1], "success");
                    $("#gen_modal").modal('hide');
                } else {
                    swal("", updateres[1], "warning");
                }
            }

        });
    });

    $(document).on("click", "#btn_delete", function (e) {
        e.preventDefault();
        let id = $(this).val();
        let setcol = $(this).attr('mysetcol');
        let table = $(this).attr('mytable');

        let sql = "SELECT * FROM " + table + " WHERE " + setcol + " = '" + id + "'";

        $.post("tools/search.php", { sql: sql }, function (response) {
            var data = response.split(",");
            let i = 1;

            $("#gen_form").find("input, select").each(function () {
                if ($(this).hasClass("sp")) {
                    // Skip
                } else if ($(this).hasClass("num")) {
                    $(this).val(data[0]);
                } else if ($(this).hasClass("oper")) {
                    $(this).val("delete");
                } else {
                    $(this).val(data[i]);
                    i++;
                }
            });
            $("#deleteModal").modal('show');
        });
    });


    $(document).on("click", "#confirmDelete", function (e) {
            e.preventDefault();
            $("#deleteModal").modal('hide');
            form_data = $("#gen_form").serialize();
            // alert(form_data);
            $.ajax({
                url: "tools/insertpage.php",
                type: 'post',
                data: form_data,
                success: function (ress) {
                    var delres = ress.split("|");
                    if ($.trim(delres[0]) === "success") {
                        swal("", delres[1], "success");
                        $("#gen_modal").modal('hide');
                    } else {
                        swal("", delres[1], "warning");
                    }
                }

            });
        });
   
$(document).on("click", "#btn_view", function (e) {
    e.preventDefault();

    let id = $(this).val();
        // let setcol = $(this).attr('mysetcol');
        // let table = $(this).attr('mytable');

    let sql = "SELECT t.image FROM transaction t where t.ord_id=" + id;

    $.post("tools/search.php", { sql: sql }, function (response) {
        // Clear previous images
        $("#imageGallery").html("");

        if ($.trim(response) === "") {
            $("#imageGallery").html("<p class='text-muted'>No images found.</p>");
        } else {
            // Assuming images are returned as comma-separated values
            let images = response.split(",");

            images.forEach(function (img) {
                if (img.trim() !== "") {
                    $("#imageGallery").append(
                        `<img src="${img.trim()}" 
                              class="m-2 border rounded" 
                              style="width:150px; height:auto; object-fit:cover;">`
                    );
                }
            });
        }

        $("#imageModal").modal("show");
    });
});


$(document).on("keyup", ".search", function (e) {
    var text = $(this).val();
    var action = $(this).attr('action');
    var data = "text="+text+"&action="+action;
    var width = $(this).width();
    var ul = $(this).next();
    ul.css('width',width);
    ul.removeClass('hide');
    if(text == ""){
        ul.addClass('hide');
    }
    
    $.post("tools/get_pro.php",data,function(ress) {
        ul.html(ress);
    })

$(document).on("click", ".li_pro", function (e) {
    var name = $(this).text();
    var id_pro = $(this).attr('id');
    // var ul = $()
    $(".ul_pro").addClass('hide');
    $(".sp_class").val(id_pro);
    $(".search").val(name);
    // alert(id_pro);
});

});

$(document).on("keyup", ".view", function (e) {
    var text = $(this).val();
    var action = $(this).attr('action');
    var data = "text="+text+"&action="+action;
    var width = $(this).width();
    var ul = $(this).next();
    ul.css('width',width);
    ul.removeClass('hide');
    if(text == ""){
        ul.addClass('hide');
    }
    
    $.post("tools/get_view.php",data,function(ress) {
        ul.html(ress);
    })

$(document).on("click", ".li_view", function (e) {
    var name = $(this).text();
    var id_pro = $(this).attr('id');
    // var ul = $()
    $(".ul_pro").addClass('hide');
    $(".view_sp").val(id_pro);
    $(".view").val(name);
    // alert(id_pro);
});

});

$(document).on("change", ".sender_state", function (e) {
    var val = $(this).val();
    if(val == "Old"){
        $(".sender_old").removeClass("d-none");
        $(".sender_detail").addClass("d-none");
    }else if(val == "New"){
        $(".sender_old").addClass("d-none");
        $(".sender_detail").removeClass("d-none");
    }
    

});

$(document).on("change", ".res_state", function (e) {
    var val = $(this).val();
    if(val == "Old"){
        $(".receiver_old").removeClass("d-none");
        $(".receiver_detail").addClass("d-none");
    }else if(val == "New"){
        $(".receiver_old").addClass("d-none");
        $(".receiver_detail").removeClass("d-none");
    }

});

$(document).on("change", ".get_salary", function (e) {
    // alert()
    var sal_id = $(this).val();
    var sql = "SELECT s.amount from salary_change s where s.sal_ch_id =" + sal_id;
    $.post("tools/search.php", { sql: sql }, function (response) {
    //  alert(response);
            var data = response.split(",");
            $(".set_salary").val(Number(data[0]));
            $(".set_salary").attr("readonly", true);
            // swal("", data[0], "success");
    });
});

$(document).on("click", ".btn_pending_transactions_bydate", function (e) {
    var date1 = $("#transaction_date1").val();
    var date2 = $("#transaction_date2").val();
    var qry =" call rep_transactions_pending_by_date('"+date1 +"','"+date2+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_pending_transactions", function (e) {
    var qry =" call rep_transactions_pending()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_all_transactions", function (e) {
    var qry =" call rep_transactions_all()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_all_transactions_bydate", function (e) {
    var date1 = $("#transaction_date1").val();
    var date2 = $("#transaction_date2").val();
    var qry =" call rep_transactions_all_by_date('"+date1 +"','"+date2+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_complete_transactions", function (e) {
    var qry =" call rep_transactions_complete()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_complete_transactions_bydate", function (e) {
    var date1 = $("#transaction_date1").val();
    var date2 = $("#transaction_date2").val();
    var qry =" call rep_transactions_complete_by_date('"+date1 +"','"+date2+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});


$(document).on("click", ".btn_transactions_by_customer_sent", function (e) {
    var cust = $("#transaction_customers").val();
    var qry =" call rep_transactions_by_customer_sent('"+cust +"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_transactions_by_customer_sent_date", function (e) {
    var date1 = $("#transaction_custdate1").val();
    var date2 = $("#transaction_custdate2").val();
    var cust = $("#transaction_customers").val();
    var qry =" call rep_transactions_customer_sent_by_date('"+cust +"','"+date1+"','"+date2+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_transactions_by_customer_get", function (e) {
    var cust = $("#transaction_customers").val();
    var qry =" call rep_transactions_by_customer_get('"+cust +"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_transactions_by_customer_get_date", function (e) {
    var date1 = $("#transaction_custdate1").val();
    var date2 = $("#transaction_custdate2").val();
    var cust = $("#transaction_customers").val();
    var qry =" call rep_transactions_by_customer_get_date('"+cust +"','"+date1+"','"+date2+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_transactions_by_all_customer_sent", function (e) {
    var qry =" call rep_transactions_sent_all_customers()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_transactions_by_all_customer_sent_date", function (e) {
    var date1 = $("#transaction_custdate1").val();
    var date2 = $("#transaction_custdate2").val();
    var qry =" call rep_transactions_sent_all_customers_by_date('"+date1+"','"+date2+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_transactions_by_all_customer_get", function (e) {
    var qry =" call rep_transactions_get_all_customers()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_transactions_by_all_customer_get_date", function (e) {
    var date1 = $("#transaction_custdate1").val();
    var date2 = $("#transaction_custdate2").val();
    var qry =" call rep_transactions_get_all_customers_by_date('"+date1+"','"+date2+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_payment_by_customer", function (e) {
    var date1 = $("#paymentsdate1").val();
    var date2 = $("#paymentsdate2").val();
    var cust = $("#payment_customers").val();
    var qry =" call rep_payment_by_customer('"+cust+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_payment_by_customer_date", function (e) {
    var date1 = $("#paymentsdate1").val();
    var date2 = $("#paymentsdate2").val();
    var cust = $("#payment_customers").val();
    var qry =" call rep_payment_by_customer_date('"+cust+"','"+date1+"','"+date2+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_payment_all", function (e) {
    var qry =" call rep_payment_all()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_payment_by_date", function (e) {
    var date1 = $("#paymentsdate1").val();
    var date2 = $("#paymentsdate2").val();
    var qry =" call rep_payment_by_date('"+date1+"','"+date2+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_salarychare_by_employee", function (e) {
    var emp = $("#salary_charge_employee").val();
    var qry =" call rep_salary_change_by_emp('"+emp+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_salarychare_by_employee_month", function (e) {
    var emp = $("#salary_charge_employee").val();
    var month = $("#salary_charge_month").val();
    var qry =" call rep_salary_change_by_emp_month('"+emp+"','"+month+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_salarychare_by_month", function (e) {
    var month = $("#salary_charge_month").val();
    var qry =" call rep_salary_change_by_month('"+month+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_salarychare_all", function (e) {
    var qry =" call rep_salary_change_all()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});


$(document).on("click", ".btn_salarypayment_by_employee", function (e) {
    var emp = $("#salary_payment_employee").val();
    var qry =" call rep_salary_payment_by_employee('"+emp+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_salarypayment_by_employee_month", function (e) {
    var emp = $("#salary_payment_employee").val();
    var month = $("#salary_payment_month").val();
    var qry =" call rep_salary_payment_by_employee_month('"+emp+"','"+month+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_salarypayment_by_month", function (e) {
    var month = $("#salary_payment_month").val();
    var qry =" call rep_salary_payment_all_by_month('"+month+"')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_salarypayment_all", function (e) {
    var qry =" call rep_salary_payment_all()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_all_charged", function (e) {
    var qry =" call rep_expense_charge_all()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_all_charged_by_month", function (e) {
    var month = $("#expense_month").val();
    var qry =" call rep_expense_charge_all_by_month('" + month + "')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_all_paid", function (e) {
    var qry =" call rep_expense_payment_all()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_all_paid_by_month", function (e) {
    var month = $("#expense_month").val();
    var qry =" call rep_expense_payment_all_by_month('" + month + "')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_single_charged", function (e) {
    var expense = $("#expense_charged_paid").val();
    var qry =" call rep_expense_charge_single('" + expense + "')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_single_charged_by_month", function (e) {
    var expense = $("#expense_charged_paid").val();
    var month = $("#expense_month").val();
    var qry =" call rep_expense_charge_single_by_month('" +expense+ "','"+ month + "')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_single_paid", function (e) {
    var expense = $("#expense_charged_paid").val();
    var qry =" call rep_expense_payment_single('" + expense + "')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_single_paid_by_month", function (e) {
    var expense = $("#expense_charged_paid").val();
    var month = $("#expense_month").val();
    var qry =" call rep_expense_payment_single_by_month('" +expense+ "','"+ month + "')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});


$(document).on("click", ".btn_all_employee", function (e) {
    var qry =" call rep_employee_all()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_single_employee", function (e) {
    var employee = $("#comb_employee").val();
    var qry =" call rep_employee_single('" + employee + "')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_all_customer", function (e) {
    var qry =" call rep_customer_all()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_single_customer", function (e) {
    var customer = $("#comb_customers").val();
    var qry =" call rep_customer_single('" + customer + "')";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".Income_statement_by_date", function (e) {
    var date1 = $("#Income_statement_date1").val();
    var date2 = $("#Income_statement_date2").val();
    var qry = date1 +","+ date2;
    $.post("forms/income_statement.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".Income_statement", function (e) {
    var qry = "all";
    $.post("forms/income_statement.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_balance_sheet_by_date", function (e) {
    var date1 = $("#balance_sheet_date1").val();
    var date2 = $("#balance_sheet_date2").val();
    var qry = date1 +"','"+ date2;
    $.post("forms/balance_sheet.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".btn_balance_sheet", function (e) {
    var qry = "all";
    $.post("forms/balance_sheet.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", "#btn_transactions_invoice", function (e) {
    var qry = $(this).val();
    // alert(qry);
    $.post("forms/transaction_invoice.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", "#btn_payment_invoice", function (e) {
    var qry = $(this).val();
    // alert(qry);
    $.post("forms/payment_invoice.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".today_transactions", function (e) {
    var qry =" call rep_transactions_today()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".today_amount_sent", function (e) {
    var qry =" call rep_transactions_today_amount_sent()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".today_profit", function (e) {
    var qry =" call rep_transactions_today_profit()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});

$(document).on("click", ".pending_transactions", function (e) {
    var qry =" call rep_transactions_today_transactions()";
    $.post("tools/get_report.php",{ sql: qry },function(ress) {
        $("#report_here").html(ress);
        $("#modal_report").modal("show");
    })
});





function printData() {
        var divToPrint = document.getElementById("rpt_show_PRINT");
        newWin = window.open("");
        newWin.document.write("<style> .table th { padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: blue;color: white; } </style>" + divToPrint.outerHTML);
        newWin.print();
        newWin.close();

    }

    
    $('#btn_prt_dt_rpt').click(function () {

        printData();
    })

    });

</script>