<?php 
// include("tools/conn.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Balance Sheet</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #f5f7ff;
            color: var(--dark-color);
            line-height: 1.6;
        }
        
        .report-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }
        
        .report-header {
            padding: 30px 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            text-align: center;
        }
        
        .report-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        
        .report-header .date-range {
            margin-top: 8px;
            opacity: 0.9;
            font-size: 16px;
        }
        
        .section-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .section-table th, 
        .section-table td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }
        
        .section-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        
        .section-table tr:hover td {
            background-color: #f1f3ff;
        }
        
        .section-header {
            background-color: #edf2ff !important;
            color: var(--primary-color) !important;
            font-weight: 600 !important;
            font-size: 16px !important;
            text-transform: none !important;
            letter-spacing: normal !important;
        }
        
        .section-header td {
            padding: 18px 20px !important;
            border-left: 4px solid var(--primary-color);
        }
        
        .total-row td {
            font-weight: 600;
            background-color: #f8f9fa;
            border-top: 2px solid #dee2e6;
        }
        
        .summary-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin: 30px auto;
            overflow: hidden;
            max-width: 600px;
        }
        
        .summary-card-header {
            padding: 18px 25px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
        }
        
        .summary-card-body {
            padding: 0;
        }
        
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .summary-table tr:last-child td {
            border-bottom: none;
        }
        
        .summary-table td {
            padding: 18px 25px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .summary-table tr:nth-child(even) td {
            background-color: #f8f9fa;
        }
        
        .summary-label {
            font-weight: 500;
            color: #495057;
        }
        
        .summary-value {
            font-weight: 600;
            color: var(--dark-color);
            text-align: right;
        }
        
        .positive-value {
            color: #2b8a3e;
        }
        
        .negative-value {
            color: #c92a2a;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .currency {
            font-family: 'Courier New', monospace;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="report-container">
        <div class="report-header">
            <h1>Balance Sheet Report</h1>
            <div class="date-range">July 1, 2025 - July 18, 2025</div>
        </div>
        
        <div style="padding: 30px 40px 40px;">
            <?php
            multiViewProcedurePlain("CALL balance_sheet_procedure('2025-07-01', '2025-07-18')");
            ?>
        </div>
    </div>
</body>
</html>

<?php
function multiViewProcedurePlain($sql) {
    include "tools/conn.php";

    $hasTableStarted = false;
    $summaryData = [];
    $currentDate = date('F j, Y');

    if ($conn->multi_query($sql)) {
        do {
            if ($result = $conn->store_result()) {
                $fields = $result->fetch_fields();
                $firstCol = strtolower($fields[0]->name);
                $title = "";

                if (strpos($firstCol, 'asset') !== false) {
                    $title = "Assets";
                } elseif (strpos($firstCol, 'liabilit') !== false) {
                    $title = "Liabilities";
                } elseif (strpos($firstCol, 'expense') !== false) {
                    $title = "Expenses";
                } elseif (strpos($firstCol, 'equity') !== false) {
                    $title = "Equity";
                } elseif (strpos($firstCol, 'total') !== false || strpos($firstCol, 'summary') !== false) {
                    $title = "Balance Summary";
                } else {
                    $title = "Section";
                }

                // Start table once
                if (!$hasTableStarted && $title !== "Balance Summary") {
                    echo "<table class='section-table'>";
                    echo "<thead><tr>";
                    foreach ($fields as $field) {
                        $colName = htmlspecialchars(ucwords(str_replace('_', ' ', $field->name)));
                        echo "<th>$colName</th>";
                    }
                    echo "</tr></thead><tbody>";
                    $hasTableStarted = true;
                }

                // Section Header Row (skip for summary)
                if ($title !== "Balance Summary") {
                    echo "<tr class='section-header'><td colspan='" . count($fields) . "'>$title</td></tr>";
                    
                    while ($row = $result->fetch_assoc()) {
                        $isTotalRow = (strpos(strtolower($row[$fields[0]->name]), 'total') !== false);
                        $rowClass = $isTotalRow ? 'total-row' : '';
                        
                        echo "<tr class='$rowClass'>";
                        foreach ($row as $key => $value) {
                            $cellClass = '';
                            $valueFormatted = htmlspecialchars($value);
                            
                            // Check if this is a numeric value (for right alignment)
                            if (is_numeric(str_replace(['$', ',', '.'], '', $value))) {
                                $cellClass .= 'text-right currency';
                                
                                // Add color for positive/negative if it's a total row
                                if ($isTotalRow) {
                                    $numericValue = (float)str_replace(['$', ','], '', $value);
                                    if ($numericValue < 0) {
                                        $cellClass .= ' negative-value';
                                    } elseif ($numericValue > 0) {
                                        $cellClass .= ' positive-value';
                                    }
                                }
                            }
                            
                            echo "<td class='$cellClass'>$valueFormatted</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    // Collect summary data
                    while ($row = $result->fetch_assoc()) {
                        foreach ($row as $key => $value) {
                            $summaryData[] = [
                                'label' => ucwords(str_replace('_', ' ', $key)),
                                'value' => $value
                            ];
                        }
                    }
                }

                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());

        if ($hasTableStarted) {
            echo "</tbody></table>";
        }

        // Output Balance Summary Card
        if (!empty($summaryData)) {
            echo '<div class="summary-card">';
            echo '<div class="summary-card-header">Balance Summary</div>';
            echo '<div class="summary-card-body">';
            echo '<table class="summary-table">';
            
            foreach ($summaryData as $item) {
                $valueClass = '';
                $numericValue = is_numeric(str_replace(['$', ',', '.'], '', $item['value'])) 
                    ? (float)str_replace(['$', ','], '', $item['value']) 
                    : null;
                
                if ($numericValue !== null) {
                    $valueClass = 'currency text-right ';
                    if ($numericValue < 0) {
                        $valueClass .= 'negative-value';
                    } elseif ($numericValue > 0) {
                        $valueClass .= 'positive-value';
                    }
                }
                
                echo '<tr>';
                echo '<td class="summary-label">' . htmlspecialchars($item['label']) . '</td>';
                echo '<td class="' . $valueClass . '">' . htmlspecialchars($item['value']) . '</td>';
                echo '</tr>';
            }
            
            echo '</table>';
            echo '</div>';
            echo '</div>';
            
            // Report generated timestamp
            echo '<div style="text-align: center; margin-top: 30px; color: #6c757d; font-size: 14px;">';
            echo 'Report generated on ' . $currentDate;
            echo '</div>';
        }

    } else {
        echo "<div style='color: #c92a2a; background-color: #fff3bf; padding: 15px; border-radius: 4px;'>";
        echo "Error: " . htmlspecialchars($conn->error);
        echo "</div>";
    }
}
?>