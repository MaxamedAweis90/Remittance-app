<?php

function get_dropdown($action){
    include "conn.php";
    $sql = "call get_dropdown_sp('$action')";
    $ress = $conn->query($sql);
    if($ress->num_rows > 0){
        while($row = $ress->fetch_array()){
            ?>
    <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
            <?php
        }
       
    } else{
        echo "<option>No data to display</option>";
    }
}

function get_sql($post){

    $tiro=count($post);
    $sql="call ";
    $i=1;
    foreach ($post as $key => $val) {
        if($i==1)
            $sql.="$val(";
        else if($i==$tiro)
            $sql.="'$val')";
        else
            $sql.="'$val',";
        $i++;
    }
    return $sql;
}

function viewTable($sql){
    include "conn.php";
    $result = $conn->query($sql);
    $fields = $result->fetch_fields();
    $setCol = $fields[0]->orgname;
    $tablename = $fields[0]->orgtable;
    ?> 
    <table
      id="basic-datatables"
      class="display table table-striped table-hover">
        <thead>
        <tr>
            <?php
            foreach ($fields as $index => $value) {
                // Only for the first column, check if name looks like an id column
                if ($index === 0) {
                    echo "<th>#</th>";
                } else {
                    echo "<th>" . htmlspecialchars($value->name) . "</th>";
                }
            }
            ?>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        while ($row = $result->fetch_array()) {
        ?>
        <tr>
            <?php 
            foreach ($row as $key => $value) {
                if (is_string($key)) {
                    // Check if the column might be an image
                    if (in_array(strtolower($key), ['image', 'img', 'photo']) && !empty($value)) {
                        echo "<td class='img-cell'>
                                <img src='" . htmlspecialchars($value) . "' alt='Image' 
                                     class='preview-trigger' 
                                     data-src='" . htmlspecialchars($value) . "' 
                                     style='width:60px; height:auto; border-radius:4px; cursor:zoom-in;'>
                              </td>";
                    }
                     else {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                }
            }                
            ?>
            <td>
    <?php if ($tablename === 'transactions') { ?>
        <button class="btn btn-info btn-sm" mysetcol="<?php echo $setCol; ?>" mytable="<?php echo $tablename; ?>" value="<?php echo $row[0]; ?>" id="btn_transactions_invoice">
            <i class="fa fa-print"></i>
        </button>
        <button class="btn btn-success btn-sm" mysetcol="<?php echo $setCol; ?>" mytable="<?php echo $tablename; ?>" value="<?php echo $row[0]; ?>" id="btn_view">
        <i class="fa fa-eye"></i>
    </button>
    <button class="btn btn-danger btn-sm" mysetcol="<?php echo $setCol; ?>" mytable="<?php echo $tablename; ?>" value="<?php echo $row[0]; ?>" id="btn_delete">
        <i class="fa fa-trash"></i>
    </button>
        
    <?php }else if ($tablename === 'payment') { ?>
        <button class="btn btn-info btn-sm" mysetcol="<?php echo $setCol; ?>" mytable="<?php echo $tablename; ?>" value="<?php echo $row[0]; ?>" id="btn_payment_invoice">
            <i class="fa fa-print"></i>
        </button>
        <button class="btn btn-success btn-sm" mysetcol="<?php echo $setCol; ?>" mytable="<?php echo $tablename; ?>" value="<?php echo $row[0]; ?>" id="btn_edit">
        <i class="fa fa-edit"></i>
    </button>
    <button class="btn btn-danger btn-sm" mysetcol="<?php echo $setCol; ?>" mytable="<?php echo $tablename; ?>" value="<?php echo $row[0]; ?>" id="btn_delete">
        <i class="fa fa-trash"></i>
    </button>
        
    <?php }else { ?>
    <button class="btn btn-success btn-sm" mysetcol="<?php echo $setCol; ?>" mytable="<?php echo $tablename; ?>" value="<?php echo $row[0]; ?>" id="btn_edit">
        <i class="fa fa-edit"></i>
    </button>
    <button class="btn btn-danger btn-sm" mysetcol="<?php echo $setCol; ?>" mytable="<?php echo $tablename; ?>" value="<?php echo $row[0]; ?>" id="btn_delete">
        <i class="fa fa-trash"></i>
    </button>
    <?php }?>
</td>

        </tr>
        <?php } ?>
    </tbody>
    </table>

    <?php
}


function get_report($report_sql){
    include "conn.php";
    // echo $report_sql;
    $results = $conn->query($report_sql);
    $fieldss = $results->fetch_fields();
    ?> 
    <table id="Reports_table">
        <thead>
        <tr>
            <?php
            foreach ($fieldss as $index => $value) {
               ?>
               <th><?php echo $value->name ?></th>
               <?php
               
            }
            ?>
            
            <?php
            ?>
        </tr>
    </thead>

    <tbody>
        <?php 
        while ($row = $results->fetch_array(MYSQLI_NUM)) {
        ?>
        <tr>
            <?php 
            foreach ($row as $key => $value) {
                ?>
                
                <td> <?php echo $value?> </td>
                <?php
                 
            }                
            ?>
            

        </tr>
        <?php } ?>
    </tbody>
    </table>

    <?php
}

function multiViewProcedurePlain($sql) {
    include "conn.php";

    if ($conn->multi_query($sql)) {
        do {
            if ($result = $conn->store_result()) {
                $fields = $result->fetch_fields();

                $firstCol = strtolower($fields[0]->name);
                $title = "Section";

                if (strpos($firstCol, 'asset') !== false) $title = "Assets";
                elseif (strpos($firstCol, 'liabilit') !== false) $title = "Liabilities";
                elseif (strpos($firstCol, 'expense') !== false) $title = "Expenses";
                elseif (strpos($firstCol, 'total') !== false) $title = "Totals";

                echo "<div class='section-title'>$title</div>";

                if ($title === "Totals") {
                    echo "<div class='totals'>";
                    $row = $result->fetch_assoc();
                    foreach ($row as $key => $value) {
                        echo "<div class='row'>$key: $value</div>";
                    }
                    echo "</div>";
                } else {
                    while ($row = $result->fetch_assoc()) {
                        $line = '';
                        foreach ($row as $value) {
                            $line .= str_pad($value, 25);
                        }
                        echo "<div class='entry'>$line</div>";
                    }
                }

                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());
    } else {
        echo "<div style='color:red;'>Error: " . $conn->error . "</div>";
    }
}


function generateIncomeStatementHTML($startDate, $endDate) {
    include "conn.php";
    // Function to fetch a single value from the 'Income_statement_by_date' stored procedure
    function fetchSingleValue($conn, $dataType, $startDate, $endDate) {
        $stmt = $conn->prepare("CALL Income_statement_by_date(?, ?, ?)");
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return 0;
        }
        $stmt->bind_param("sss", $dataType, $startDate, $endDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        
        while ($conn->more_results() && $conn->next_result()) {
            $dummyResult = $conn->use_result();
            if ($dummyResult instanceof mysqli_result) {
                $dummyResult->free();
            }
        }
        return $data ? $data['Amount'] : 0;
    }
    
    // Function to fetch all expense rows from the 'get_dynamic_expenses' stored procedure
    function fetchExpenses($conn, $startDate, $endDate) {
        $stmt = $conn->prepare("CALL get_dynamic_expenses(?, ?)");
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return [];
        }
        $stmt->bind_param("ss", $startDate, $endDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $expenses = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        
        while ($conn->more_results() && $conn->next_result()) {
            $dummyResult = $conn->use_result();
            if ($dummyResult instanceof mysqli_result) {
                $dummyResult->free();
            }
        }
        return $expenses;
    }


    // Fetch all necessary data
    $revenue = fetchSingleValue($conn, 'revenue', $startDate, $endDate);
    $expenses = fetchExpenses($conn, $startDate, $endDate);
    
    $totalExpenses = array_sum(array_column($expenses, 'amount'));
    $netIncomeLoss = $revenue - $totalExpenses;

    // Format currency
    $formatCurrency = function($amount) {
        return '$' . number_format($amount, 0);
    };

    // Determine if net income is a loss for styling
    $netIncomeLossPrefix = ($netIncomeLoss < 0) ? '- ' : '';
    $netIncomeLossValue = abs($netIncomeLoss);
    
    // Generate expense rows dynamically
    $expenseRows = '';
    foreach ($expenses as $expense) {
        $expenseRows .= '
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                <div style="flex-grow: 1; color: #333;">' . ucwords(str_replace('_', ' ', $expense['expense_name'])) . '</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500;">' . $formatCurrency($expense['amount']) . '</div>
            </div>';
    }

    $html = '
    <div style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.6; color: #333;   padding: 1.5rem; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
        <div style="display: flex; align-items: center; margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; margin: auto; color: #000;">Income Statement From '. $startDate .' To '. $endDate.'</h2>
        </div>

        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 1rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Revenue</div>
            
            <div style="display: flex; justify-content: space-between; font-weight: 500; color: #555; padding-bottom: 0.5rem;">
                <div style="flex-grow: 1;">Type</div>
                <div style="min-width: 80px; text-align: right;">Amount</div>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                <div style="flex-grow: 1;">Transaction Fees (Completed only)</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500;">' . $formatCurrency($revenue) . '</div>
            </div>
            <div style="display: flex; justify-content: space-between; padding-top: 0.5rem; font-weight: bold; border-top: 1px solid #ccc;">
                <div style="flex-grow: 1;">Total Revenue</div>
                <div style="min-width: 80px; text-align: right;">' . $formatCurrency($revenue) . '</div>
            </div>
        </div>

        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Expenses</div>

            <div style="display: flex; justify-content: space-between; font-weight: 500; color: #555; padding-bottom: 0.5rem;">
                <div style="flex-grow: 1;">Type</div>
                <div style="min-width: 80px; text-align: right;">Amount</div>
            </div>
            ' . $expenseRows . '
            <div style="display: flex; justify-content: space-between; padding-top: 0.5rem; font-weight: bold; border-top: 1px solid #ccc;">
                <div style="flex-grow: 1;">Total Expenses</div>
                <div style="min-width: 80px; text-align: right;">' . $formatCurrency($totalExpenses) . '</div>
            </div>
        </div>

        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Net Income (Loss)</div>
            
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0;">
                <div style="flex-grow: 1;">Net Loss</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500; color: #e74c3c;">' . $netIncomeLossPrefix . $formatCurrency($netIncomeLossValue) . '</div>
            </div>
        </div>
    </div>';

    $conn->close();
    return $html;
}


function generateIncomeStatement() {
    // Include the database connection file.
    include "conn.php";
    
    // Function to fetch a single value from the 'Income_statement' stored procedure
    function fetchSingleValue1($conn, $dataType) {
        // Prepare the stored procedure call. No date parameters.
        $stmt = $conn->prepare("CALL Income_statement(?)");
        if (!$stmt) {
            error_log("Prepare failed for Income_statement: " . $conn->error);
            return 0;
        }
        // Bind one parameter for the data type.
        $stmt->bind_param("s", $dataType);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        
        while ($conn->more_results() && $conn->next_result()) {
            $dummyResult = $conn->use_result();
            if ($dummyResult instanceof mysqli_result) {
                $dummyResult->free();
            }
        }
        return $data ? (float)$data['Amount'] : 0.0;
    }
    
    // Function to fetch all expense rows from the 'exepense_name' stored procedure
    function fetchExpenses1($conn) {
        // Prepare the stored procedure call. No parameters.
        $stmt = $conn->prepare("CALL exepense_name()");
        if (!$stmt) {
            error_log("Prepare failed for exepense_name: " . $conn->error);
            return [];
        }
        // No parameters to bind, so bind_param is removed.
        $stmt->execute();
        $result = $stmt->get_result();
        $expenses = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        
        while ($conn->more_results() && $conn->next_result()) {
            $dummyResult = $conn->use_result();
            if ($dummyResult instanceof mysqli_result) {
                $dummyResult->free();
            }
        }
        return $expenses;
    }

    // Fetch all necessary data
    $revenue = fetchSingleValue1($conn, 'revenue');
    $expenses = fetchExpenses1($conn);
    
    $totalExpenses = array_sum(array_column($expenses, 'amount'));
    $netIncomeLoss = $revenue - $totalExpenses;

    // Format currency
    $formatCurrency = function($amount) {
        return '$' . number_format($amount, 0);
    };

    // Determine if net income is a loss for styling
    $netIncomeLossPrefix = ($netIncomeLoss < 0) ? '- ' : '';
    $netIncomeLossValue = abs($netIncomeLoss);
    
    // Generate expense rows dynamically
    $expenseRows = '';
    foreach ($expenses as $expense) {
        $expenseRows .= '
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                <div style="flex-grow: 1; color: #333;">' . ucwords(str_replace('_', ' ', $expense['expense_name'])) . '</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500;">' . $formatCurrency($expense['amount']) . '</div>
            </div>';
    }

    $html = '
    <div style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.6; color: #333; padding: 1.5rem; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
        <div style="display: flex; align-items: center; margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; margin: auto; color: #000;">Income Statement</h2>
        </div>

        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 1rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Revenue</div>
            
            <div style="display: flex; justify-content: space-between; font-weight: 500; color: #555; padding-bottom: 0.5rem;">
                <div style="flex-grow: 1;">Type</div>
                <div style="min-width: 80px; text-align: right;">Amount</div>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                <div style="flex-grow: 1;">Transaction Fees (Completed only)</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500;">' . $formatCurrency($revenue) . '</div>
            </div>
            <div style="display: flex; justify-content: space-between; padding-top: 0.5rem; font-weight: bold; border-top: 1px solid #ccc;">
                <div style="flex-grow: 1;">Total Revenue</div>
                <div style="min-width: 80px; text-align: right;">' . $formatCurrency($revenue) . '</div>
            </div>
        </div>

        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Expenses</div>

            <div style="display: flex; justify-content: space-between; font-weight: 500; color: #555; padding-bottom: 0.5rem;">
                <div style="flex-grow: 1;">Type</div>
                <div style="min-width: 80px; text-align: right;">Amount</div>
            </div>
            ' . $expenseRows . '
            <div style="display: flex; justify-content: space-between; padding-top: 0.5rem; font-weight: bold; border-top: 1px solid #ccc;">
                <div style="flex-grow: 1;">Total Expenses</div>
                <div style="min-width: 80px; text-align: right;">' . $formatCurrency($totalExpenses) . '</div>
            </div>
        </div>

        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Net Income (Loss)</div>
            
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0;">
                <div style="flex-grow: 1;">Net Loss</div>
                <div style="min-width: 80px; text-align: right; font-weight: bolder; color: #550685ff;">' . $netIncomeLossPrefix . $formatCurrency($netIncomeLossValue) . '</div>
            </div>
        </div>
    </div>';

    $conn->close();
    return $html;
}



function generateBalanceSheetHTML($startDate, $endDate) {
    include "conn.php";

    // Helper function to fetch data for a specific balance sheet section
    function fetchDataForSection($conn, $type,$startDate ,$endDate) {
        // Check if the connection is valid
        if (!$conn || $conn->connect_error) {
            error_log("Database connection is not valid: " . ($conn ? $conn->connect_error : "Connection object is null."));
            return [];
        }
        
        $stmt = $conn->prepare("CALL rep_balance_sheet_date(?, ?, ?)");
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return [];
        }

        $stmt->bind_param("sss", $type,$startDate ,$endDate);

        if (!$stmt->execute()) {
            error_log("Execute failed for type '$type': " . $stmt->error);
            $stmt->close();
            return [];
        }

        $result = $stmt->get_result();
        if ($result === false) {
            error_log("Getting result set failed for type '$type': " . $stmt->error);
            $stmt->close();
            return [];
        }

        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        
        while ($conn->more_results() && $conn->next_result()) {
            $dummyResult = $conn->use_result();
            if ($dummyResult instanceof mysqli_result) {
                $dummyResult->free();
            }
        }
        return $data;
    }

    // Fetch data for all three sections
    $assets = fetchDataForSection($conn, 'assets',$startDate, $endDate);
    $liabilities = fetchDataForSection($conn, 'liabilities',$startDate, $endDate);
    $equity = fetchDataForSection($conn, 'equity',$startDate, $endDate);
    
    // Extract totals with checks to prevent warnings if arrays are empty
    $totalAssets = !empty($assets) ? end($assets)['amount'] : 0;
    $totalLiabilities = !empty($liabilities) ? end($liabilities)['amount'] : 0;
    $totalEquity = !empty($equity) ? end($equity)['amount'] : 0;

    // Format currency
    $formatCurrency = function($amount) {
        return '$' . number_format($amount, 0);
    };

    // Generate HTML for each section dynamically
    $assetsRows = '';
    foreach ($assets as $item) {
        $assetsRows .= '
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                <div style="flex-grow: 1; color: #333;">' . $item['type'] . '</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500;">' . $formatCurrency($item['amount']) . '</div>
            </div>';
    }

    $liabilitiesRows = '';
    foreach ($liabilities as $item) {
        $liabilitiesRows .= '
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                <div style="flex-grow: 1; color: #333;">' . $item['type'] . '</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500;">' . $formatCurrency($item['amount']) . '</div>
            </div>';
    }

    $equityRows = '';
    foreach ($equity as $item) {
        $equityRows .= '
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                <div style="flex-grow: 1; color: #333;">' . $item['type'] . '</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500;">' . $formatCurrency($item['amount']) . '</div>
            </div>';
    }
    
    // Main HTML structure
    $html = '
    <div style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.6; color: #333; padding: 1.5rem; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); ">
        <div style="display: flex; align-items: center; margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; margin: auto; color: #000;">Balance Sheet – ' . date('F d', strtotime($endDate)) . '</h2>
        </div>

        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 1rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Assets</div>
            <div style="display: flex; justify-content: space-between; font-weight: 500; color: #555; padding-bottom: 0.5rem;">
                <div style="flex-grow: 1;">Type</div>
                <div style="min-width: 80px; text-align: right;">Amount</div>
            </div>
            ' . $assetsRows . '
        </div>

        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Liabilities</div>
            <div style="display: flex; justify-content: space-between; font-weight: 500; color: #555; padding-bottom: 0.5rem;">
                <div style="flex-grow: 1;">Type</div>
                <div style="min-width: 80px; text-align: right;">Amount</div>
            </div>
            ' . $liabilitiesRows . '
        </div>
        
        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Equity</div>
            <div style="display: flex; justify-content: space-between; font-weight: 500; color: #555; padding-bottom: 0.5rem;">
                <div style="flex-grow: 1;">Type</div>
                <div style="min-width: 80px; text-align: right;">Amount</div>
            </div>
            ' . $equityRows . '
        </div>
        
        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Check</div>
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; font-weight: bold;">
                <div style="flex-grow: 1;">Assets = Liabilities + Equity</div>
                <div style="min-width: 80px; text-align: right; color: #27ae60;">' . $formatCurrency($totalAssets) . ' = ' . $formatCurrency($totalLiabilities) . ' + ' . $formatCurrency($totalEquity) . ' ✔</div>
            </div>
        </div>
    </div>';

    $conn->close();
    return $html;
}

function generateBalanceSheet() {
    include "conn.php";

    // Helper function to fetch data for a specific balance sheet section
    function fetchDataForSection1($conn, $type) {
        // Check if the connection is valid
        if (!$conn || $conn->connect_error) {
            error_log("Database connection is not valid: " . ($conn ? $conn->connect_error : "Connection object is null."));
            return [];
        }
        
        $stmt = $conn->prepare("CALL rep_balance_sheet(?)");
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return [];
        }

        $stmt->bind_param("s", $type);

        if (!$stmt->execute()) {
            error_log("Execute failed for type '$type': " . $stmt->error);
            $stmt->close();
            return [];
        }

        $result = $stmt->get_result();
        if ($result === false) {
            error_log("Getting result set failed for type '$type': " . $stmt->error);
            $stmt->close();
            return [];
        }

        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        
        while ($conn->more_results() && $conn->next_result()) {
            $dummyResult = $conn->use_result();
            if ($dummyResult instanceof mysqli_result) {
                $dummyResult->free();
            }
        }
        return $data;
    }

    // Fetch data for all three sections
    $assets = fetchDataForSection1($conn, 'assets');
    $liabilities = fetchDataForSection1($conn, 'liabilities');
    $equity = fetchDataForSection1($conn, 'equity');
    
    // Extract totals with checks to prevent warnings if arrays are empty
    $totalAssets = !empty($assets) ? end($assets)['amount'] : 0;
    $totalLiabilities = !empty($liabilities) ? end($liabilities)['amount'] : 0;
    $totalEquity = !empty($equity) ? end($equity)['amount'] : 0;

    // Format currency
    $formatCurrency = function($amount) {
        return '$' . number_format($amount, 0);
    };

    // Generate HTML for each section dynamically
    $assetsRows = '';
    foreach ($assets as $item) {
        $assetsRows .= '
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                <div style="flex-grow: 1; color: #333;">' . $item['type'] . '</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500;">' . $formatCurrency($item['amount']) . '</div>
            </div>';
    }

    $liabilitiesRows = '';
    foreach ($liabilities as $item) {
        $liabilitiesRows .= '
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                <div style="flex-grow: 1; color: #333;">' . $item['type'] . '</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500;">' . $formatCurrency($item['amount']) . '</div>
            </div>';
    }

    $equityRows = '';
    foreach ($equity as $item) {
        $equityRows .= '
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                <div style="flex-grow: 1; color: #333;">' . $item['type'] . '</div>
                <div style="min-width: 80px; text-align: right; font-weight: 500;">' . $formatCurrency($item['amount']) . '</div>
            </div>';
    }
    
    // Main HTML structure
    $html = '
    <div style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.6; color: #333; padding: 1.5rem; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); ">
        <div style="display: flex; align-items: center; margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; margin: auto; color: #000;">Balance Sheet </h2>
        </div>

        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 1rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Assets</div>
            <div style="display: flex; justify-content: space-between; font-weight: 500; color: #555; padding-bottom: 0.5rem;">
                <div style="flex-grow: 1;">Type</div>
                <div style="min-width: 80px; text-align: right;">Amount</div>
            </div>
            ' . $assetsRows . '
        </div>

        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Liabilities</div>
            <div style="display: flex; justify-content: space-between; font-weight: 500; color: #555; padding-bottom: 0.5rem;">
                <div style="flex-grow: 1;">Type</div>
                <div style="min-width: 80px; text-align: right;">Amount</div>
            </div>
            ' . $liabilitiesRows . '
        </div>
        
        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Equity</div>
            <div style="display: flex; justify-content: space-between; font-weight: 500; color: #555; padding-bottom: 0.5rem;">
                <div style="flex-grow: 1;">Type</div>
                <div style="min-width: 80px; text-align: right;">Amount</div>
            </div>
            ' . $equityRows . '
        </div>
        
        <div style="width: 100%;">
            <div style="font-size: 1.25rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;">Check</div>
            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; font-weight: bold;">
                <div style="flex-grow: 1;">Assets = Liabilities + Equity</div>
                <div style="min-width: 80px; text-align: right; color: #27ae60;">' . $formatCurrency($totalAssets) . ' = ' . $formatCurrency($totalLiabilities) . ' + ' . $formatCurrency($totalEquity) . ' ✔</div>
            </div>
        </div>
    </div>';

    $conn->close();
    return $html;
}


function generateBalanceSheet1($dateQuery) {
    include "conn.php";
    $dates = explode(",",$dateQuery);
    // echo "CALL belance_sheet3('$dateQuery','liabilities')";
    ?>
    <style>
        /* Main Report Card Container */
        .report-card {
            width: 100%;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 20px;
            box-sizing: border-box;
            
        }

        /* Header Section */
        .report-header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
        }

        .company-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            color: #1a2a47;
        }

        .report-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: #7f8c8d;
            margin: 3px 0 1px;
        }

        .report-date {
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            color: #adb5bd;
        }

        /* Body Sections */
        .section-box {
            margin-bottom: 15px;
            border-left: 4px solid #2980b9;
            padding-left: 15px;
            position: relative;
        }

        .liabilities-section {
            border-left-color: #e74c3c;
        }

        .equity-section {
            border-left-color: #27ae60;
        }

        .section-heading {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a2a47;
            margin-bottom: 8px;
        }

        .account-list {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .account-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            border-bottom: 1px solid #f0f3f5;
        }

        .account-name {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            color: #495057;
        }

        .account-amount {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #495057;
            font-size: 0.95rem;
        }

        /* Total Summary for each section */
        .total-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            padding-top: 10px;
            border-top: 1px solid #ced4da;
            margin-top: 10px;
            font-size: 1rem;
        }

        .total-label {
            color: #1a2a47;
        }

        .total-amount {
            color: #1a2a47;
        }

        /* Grand Total Section */
        .grand-total-section {
            margin-top: 20px;
            padding: 15px 0;
            border-top: 2px solid #6c757d;
        }

        .grand-total-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a2a47;
        }

        .grand-total-amount {
            font-size: 1.3rem;
            color: #2980b9;
            font-weight: 700;
        }
    </style>
    
    <div class="report-card">
        <header class="report-header">
            <h1 class="company-name">Himilo Transfer</h1>
            <p class="report-title">Balance Sheet</p>
            <p class="report-date">From <?php echo $dates[0]; ?> To <?php echo $dates[1]; ?></p>
        </header>
    
        <main class="report-body">
            <div class="section-box assets-section">
                <h2 class="section-heading">Assets</h2>
                <div class="account-list">
                    <?php
                    $result = $conn->query("CALL belance_sheet3('$dateQuery','assets')");
                        while ($row = $result->fetch_array()) {
                            ?>
                            <div class="account-item">
                                <span class="account-name">Cash In Bank</span>
                                <span class="account-amount">$<?php echo $row[0];?></span>
                            </div>
                            <!-- <div class="account-item">
                                <span class="account-name">Account Receivable</span>
                                <span class="account-amount">$/span>
                            </div> -->
                            <div class="total-summary">
                                <span class="total-label">Total Assetes</span>
                                <span class="total-amount">$<?php echo $row[2];?></span>
                            </div>
                            <?php } $conn->close();?>
                    
                    
                </div>
                
            </div>
    
            <div class="section-box liabilities-section">
                <h2 class="section-heading">Liabilities</h2>
                <div class="account-list">
                    <?php
                    include('conn.php');
                    $liability = $conn->query("CALL belance_sheet3('$dateQuery','liabilities')");
                    
                        while ($lia = $liability->fetch_array()) {
                            ?>
                            <div class="account-item">
                                <span class="account-name">Account Payable</span>
                                <span class="account-amount">$<?php echo $lia[0];?></span>
                            </div>
                             <div class="account-item">
                                <span class="account-name">Accrued Expenses</span>
                                <span class="account-amount">$<?php echo $lia[1];?></span>
                            </div>
                            <div class="account-item">
                                <span class="account-name">Un Earned Revenue</span>
                                <span class="account-amount">$<?php echo $lia[2];?></span>
                            </div>
                            <div class="total-summary">
                                <span class="total-label">Total Liabilities</span>
                                <span class="total-amount">$<?php echo $lia[3];?></span>
                            </div>

                            <?php } $conn->close(); ?>
                            
                </div>
            </div>
    
            <div class="section-box equity-section">
                <h2 class="section-heading">Equity</h2>
                <div class="account-list">
                    <?php
                    include('conn.php');
                    $equity = $conn->query("CALL belance_sheet3('$dateQuery','equity')");
                    while ($eq = $equity->fetch_array()) {
                            ?>
                            <div class="account-item">
                                <span class="account-name">Retained Earnings</span>
                                <span class="account-amount">$<?php echo $eq[0];?></span>
                            </div>
                             <div class="account-item">
                                <span class="account-name">Capital</span>
                                <span class="account-amount">$<?php echo $eq[1];?></span>
                            </div>
                            <div class="total-summary">
                                <span class="total-label">Total Equity</span>
                                <span class="total-amount">$<?php echo $eq[2];?></span>
                            </div>

                            <?php }?>
                </div>
            </div>
    
            
            <div class="grand-total-section">
                <?php
                    include('conn.php');
                    $total = $conn->query("CALL belance_sheet3('$dateQuery','total')");
                    while ($tot = $total->fetch_array()) {
                    ?>
                <div class="grand-total-item">
                    
                    <span class="grand-total-label">Total Assets</span>
                    <span class="grand-total-amount">$<?php echo $tot[0]; ?></span>
                    
                </div>
                <div class="grand-total-item">
                    
                    <span class="grand-total-label">Total Liabilities and Equity</span>
                    <span class="grand-total-amount">$<?php echo $tot[1]; ?></span>
                    
                </div>
                <div class="grand-total-item">
                    
                    <span class="grand-total-label">Total Assets - Total Liabilities and Equity</span>
                    <span class="grand-total-amount">$<?php echo $tot[2]; ?></span>
                    
                </div>
                <?php }?>
            </div>
        </main>
    </div>
    <?php
    $conn->close();
}



?>
