<?php
session_start();
include('../tools/conn.php');
include('../tools/function.php');
?>

<div class="container-fluid p-3">
    <div class="row">
        
            <div class="col-md-6">
                <!-- row 1-->
                <div class="row">
                    <!-- report One -->
                    <div class="col-md-12">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header text-whitw">
                                    <button class="accordion-button collapsed bg-secondary text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accordian1" aria-expanded="false" aria-controls="accordian1">
                                        Total Transactions
                                    </button>
                                </h2>
                                <div id="accordian1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">

                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <input type="date" id="transaction_date1" name="transaction_date1" value="<?php echo date('Y-m-d'); ?>" class="form-control">

                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" id="transaction_date2" name="transaction_date2" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 130px; font-size:12px;" class="btn btn-primary  btn_pending_transactions">Pending</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 107px; font-size:12px;" class="btn btn-primary  btn_pending_transactions_bydate">Pending By Date</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 122px; font-size:12px;" class="btn btn-primary  btn_complete_transactions">Completed</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 100px; font-size:12px;" class="btn btn-primary  btn_complete_transactions_bydate">Completed By Date</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 143px; font-size:12px;" class="btn btn-primary  btn_all_transactions">All</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 122px; font-size:12px;" class="btn btn-primary  btn_all_transactions_bydate">All By Date</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report One -->

                    <!-- report two -->
                    <div class="col-md-12 mt-3">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header text-white">
                                    <button class="accordion-button collapsed bg-secondary text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accordian2" aria-expanded="false" aria-controls="accordian2">
                                        Transactions By Customer
                                    </button>
                                </h2>
                                <div id="accordian2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12 mt-3">
                                                <select name="transaction_customers" id="transaction_customers" class="form-control text-secondary fw-bold">
                                                    <option selected disabled>Select Customers</option>
                                                    <?php
                                                    get_dropdown("transaction_customer");
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <input type="date" id="transaction_custdate1" name="transaction_custdate1" value="<?php echo date('Y-m-d'); ?>" class="form-control">

                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <input type="date" id="transaction_custdate2" name="transaction_custdate2" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 110px; font-size:12px;" class="btn btn-primary btn_transactions_by_customer_sent">Customer Sent</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 88px; font-size:12px;" class="btn btn-primary btn_transactions_by_customer_sent_date">Customer Sent By Date</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 112px; font-size:12px;" class="btn btn-primary  btn_transactions_by_customer_get">Customer Get</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 90px; font-size:12px;" class="btn btn-primary  btn_transactions_by_customer_get_date">Customer Get By Date</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 97px; font-size:12px;" class="btn btn-primary  btn_transactions_by_all_customer_sent">All Customers Sent</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 78px; font-size:12px;" class="btn btn-primary  btn_transactions_by_all_customer_sent_date">All Customers Sent By Date</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 101px; font-size:12px;" class="btn btn-primary  btn_transactions_by_all_customer_get">All Customers Get</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 81px; font-size:12px;" class="btn btn-primary  btn_transactions_by_all_customer_get_date">All Customers Get By Date</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report Two -->

                    <!-- report Six-->
                    <div class="col-md-12 mt-3">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header text-white">
                                    <button class="accordion-button collapsed bg-secondary text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accordian6" aria-expanded="false" aria-controls="accordian6">
                                        Expense Charged / Expense Paid
                                    </button>
                                </h2>
                                <div id="accordian6" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 mt-1">
                                                <select name="expense_charged_paid" id="expense_charged_paid" class="form-control text-secondary fw-bold">
                                                    <option selected disabled>Select Expense</option>
                                                    <?php
                                                    get_dropdown("ex_charge");
                                                    ?>
                                                </select>
                                            </div>
                                             <div class="col-md-6 mt-1">
                                                <select name="expense_month" id="expense_month" class="form-control text-secondary fw-bold">
                                                    <option selected disabled>Select Month</option>
                                                    <option value="1">January</option>                        
                                                    <option value="2">February</option>                        
                                                    <option value="3">March</option>                        
                                                    <option value="4">April</option>                        
                                                    <option value="5">May</option>                        
                                                    <option value="6">June</option>                        
                                                    <option value="7">July</option>                        
                                                    <option value="8">August</option>                        
                                                    <option value="9">September</option>                        
                                                    <option value="10">October</option>                        
                                                    <option value="11">November</option>                        
                                                    <option value="12">December</option>                        
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 123px; font-size:12px;" class="btn btn-primary btn_all_charged">All Charged</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 135px; font-size:12px;" class="btn btn-primary btn_all_paid">All Paid</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 95px; font-size:12px;" class="btn btn-primary  btn_all_charged_by_month">All Charged By Month</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 107px; font-size:12px;" class="btn btn-primary  btn_all_paid_by_month">All Paid By Month</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 112px; font-size:12px;" class="btn btn-primary  btn_single_charged">Single Charged</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 124px; font-size:12px;" class="btn btn-primary  btn_single_paid">Single Paid</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 84px; font-size:12px;" class="btn btn-primary  btn_single_charged_by_month">Single Charged By Month</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 96px; font-size:12px;" class="btn btn-primary  btn_single_paid_by_month">Single Paid By Month</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report Six-->
                     <!-- report Seven -->
                    <div class="col-md-12 mt-3">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header text-white">
                                    <button class="accordion-button collapsed bg-secondary text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accordian7" aria-expanded="false" aria-controls="accordian7">
                                        All Employees
                                    </button>
                                </h2>
                                <div id="accordian7" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12 mt-1">
                                                <select name="c" id="comb_employee" class="form-control text-secondary fw-bold">
                                                    <option selected disabled>Select Employee</option>
                                                    <?php
                                                    get_dropdown("employee");
                                                    ?>
                                                </select>
                                            </div>
                                             
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 110px; font-size:12px;" class="btn btn-primary btn_all_employee ">All Employee</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 107px; font-size:12px;" class="btn btn-primary btn_single_employee">Single Employee</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report Seven -->

                    <!-- report Nine -->
                    <div class="col-md-12 mt-3">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header text-white">
                                    <button class="accordion-button collapsed bg-secondary text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accordian9" aria-expanded="false" aria-controls="accordian9">
                                        Income Statemt
                                    </button>
                                </h2>
                                <div id="accordian9" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <input type="date" id="Income_statement_date1" name="Income_statement_date1" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <input type="date" id="Income_statement_date2" name="Income_statement_date2" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>
                                             
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 68px; font-size:14px;" class="btn btn-primary Income_statement_by_date ">Income Statement By Date</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 102px; font-size:12px;" class="btn btn-primary Income_statement">Income Statement</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report Nine -->

                </div>
                <!-- end row 1-->
            </div>
         <!-- row 2-->
            <div class="col-md-6">
                <div class="row">
                    <!-- report three -->
                    <div class="col-md-12">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header text-whitw">
                                    <button class="accordion-button collapsed bg-secondary text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accordian3" aria-expanded="false" aria-controls="accordian3">
                                        Total Payments
                                    </button>
                                </h2>
                                <div id="accordian3" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">

                                        <div class="row justify-content-center">
                                            <div class="col-md-12 mt-3">
                                                <select name="payment_customers" id="payment_customers" class="form-control text-secondary fw-bold">
                                                    <option selected disabled>Select Customers</option>
                                                    <?php
                                                    get_dropdown("payment_customers");
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" id="paymentsdate1" name="paymentsdate1" value="<?php echo date('Y-m-d'); ?>" class="form-control">

                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" id="paymentsdate2" name="paymentsdate2" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 98px; font-size:12px;" class="btn btn-primary  btn_payment_by_customer">By Customer</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 83px; font-size:12px;" class="btn btn-primary  btn_payment_by_customer_date">By Customer Date</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 103px; font-size:12px;" class="btn btn-primary  btn_payment_by_date">All By Date</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 125px; font-size:12px;" class="btn btn-primary  btn_payment_all">All</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report three -->

                    <!-- report four -->
                    <div class="col-md-12 mt-3">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header text-whitw">
                                    <button class="accordion-button collapsed bg-secondary text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accordian4" aria-expanded="false" aria-controls="accordian4">
                                        Employee Salary
                                    </button>
                                </h2>
                                <div id="accordian4" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">

                                        <div class="row justify-content-center">
                                            <div class="col-md-6 mt-1">
                                                <select name="salary_charge_employee" id="salary_charge_employee" class="form-control text-secondary fw-bold">
                                                    <option selected disabled>Select Employee</option>
                                                    <?php
                                                    get_dropdown("salary_charge_employee");
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-1">
                                                <select name="salary_charge_month" id="salary_charge_month" class="form-control text-secondary fw-bold">
                                                    <option selected disabled>Select Month</option>
                                                    <option value="1">January</option>                        
                                                    <option value="2">February</option>                        
                                                    <option value="3">March</option>                        
                                                    <option value="4">April</option>                        
                                                    <option value="5">May</option>                        
                                                    <option value="6">June</option>                        
                                                    <option value="7">July</option>                        
                                                    <option value="8">August</option>                        
                                                    <option value="9">September</option>                        
                                                    <option value="10">October</option>                        
                                                    <option value="11">November</option>                        
                                                    <option value="12">December</option>                        
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 118px; font-size:12px;" class="btn btn-primary  btn_salarychare_by_employee">By Employee</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 101px; font-size:12px;" class="btn btn-primary  btn_salarychare_by_employee_month">By Employee Month</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 118px; font-size:12px;" class="btn btn-primary  btn_salarychare_by_month">All By Month</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 145px; font-size:12px;" class="btn btn-primary  btn_salarychare_all">All</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report four -->

                    <!-- report five -->
                    <div class="col-md-12 mt-3">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header text-whitw">
                                    <button class="accordion-button collapsed bg-secondary text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accordian5" aria-expanded="false" aria-controls="accordian5">
                                        Employee Salary Payment
                                    </button>
                                </h2>
                                <div id="accordian5" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">

                                        <div class="row justify-content-center">
                                            <div class="col-md-6 mt-1">
                                                <select name="salary_payment_employee" id="salary_payment_employee" class="form-control text-secondary fw-bold">
                                                    <option selected disabled>Select Employee</option>
                                                    <?php
                                                    get_dropdown("salary_payment_employee");
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-1">
                                                <select name="salary_payment_month" id="salary_payment_month" class="form-control text-secondary fw-bold">
                                                    <option selected disabled>Select Month</option>
                                                    <option value="1">January</option>                        
                                                    <option value="2">February</option>                        
                                                    <option value="3">March</option>                        
                                                    <option value="4">April</option>                        
                                                    <option value="5">May</option>                        
                                                    <option value="6">June</option>                        
                                                    <option value="7">July</option>                        
                                                    <option value="8">August</option>                        
                                                    <option value="9">September</option>                        
                                                    <option value="10">October</option>                        
                                                    <option value="11">November</option>                        
                                                    <option value="12">December</option>                        
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 118px; font-size:12px;" class="btn btn-primary  btn_salarypayment_by_employee">By Employee</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 101px; font-size:12px;" class="btn btn-primary  btn_salarypayment_by_employee_month">By Employee Month</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 118px; font-size:12px;" class="btn btn-primary  btn_salarypayment_by_month">All By Month</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 145px; font-size:12px;" class="btn btn-primary  btn_salarypayment_all">All</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report five -->

                    <!-- report Eight -->
                    <div class="col-md-12 mt-3">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header text-white">
                                    <button class="accordion-button collapsed bg-secondary text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accordian8" aria-expanded="false" aria-controls="accordian8">
                                        All Customers
                                    </button>
                                </h2>
                                <div id="accordian8" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12 mt-1">
                                                <select name="comb_customers" id="comb_customers" class="form-control text-secondary fw-bold">
                                                    <option selected disabled>Select Customer</option>
                                                    <?php
                                                    get_dropdown("customer");
                                                    ?>
                                                </select>
                                            </div>
                                             
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 110px; font-size:12px;" class="btn btn-primary btn_all_customer ">All Customers</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 107px; font-size:12px;" class="btn btn-primary btn_single_customer">Single Customer</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report Eight -->

                    <!-- report Ten -->
                    <div class="col-md-12 mt-3">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header text-white">
                                    <button class="accordion-button collapsed bg-secondary text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accordian10" aria-expanded="false" aria-controls="accordian10">
                                        Balance Sheet
                                    </button>
                                </h2>
                                <div id="accordian10" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <input type="date" id="balance_sheet_date1" name="balance_sheet_date1" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <input type="date" id="balance_sheet_date2" name="balance_sheet_date2" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>
                                             
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 108px; font-size:14px;" class="btn btn-primary btn_balance_sheet ">Balance Sheet</button>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <button type="button" style="padding: 10px 90px; font-size:12px;" class="btn btn-primary btn_balance_sheet_by_date">Balance Sheet By Date</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report Ten -->
                </div>
            </div>
            <!-- end row 2-->   
  
    </div>

</div>