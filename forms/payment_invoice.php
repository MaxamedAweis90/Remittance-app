
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        .voucher {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 10px;
        }
        .header h2 {
            color: #2c3e50;
            font-weight: 700;
            margin: 0;
            font-size: 18px;
        }
        .header p {
            color: #7f8c8d;
            font-size: 10px;
            margin: 3px 0 0 0;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
        }
        .info-grid strong {
            font-weight: 700;
            color: #333;
        }
        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #28a745;
            border-bottom: 1px solid #28a745;
            padding-bottom: 3px;
            margin-bottom: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        td, th {
            padding: 10px 12px;
            border: 1px solid #e0e0e0;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #f8f9fa;
            color: #555;
            font-weight: 600;
            width: 45%;
        }
        td {
            color: #333;
        }
        .amount-section {
            background-color: #f0fdf4;
            border: 1px solid #28a745;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 15px;
            text-align: center;
        }
        .amount-section h3 {
            margin: 0 0 5px 0;
            color: #28a745;
            font-size: 14px;
            font-weight: 600;
        }
        .amount-section .total-amount {
            font-size: 24px;
            font-weight: 700;
            color: #28a745;
            margin: 0;
        }
        
        #thanks {
            margin-top: 15px;
            font-size: 10px;
            text-align: center;
            color: #7f8c8d;
            padding-top: 10px;
        }
    </style>

<?php
include("./../tools/conn.php");
$trans_id=$_POST['sql'];
$sql = "call payment_invoice($trans_id)";
$ress = $conn->query($sql);
while($row = $ress->fetch_array()){
?>

    <div class="voucher">
        <div class="header">
            <h2>Receipt Voucher</h2>
        </div>

        <div class="info-grid">
            <div><strong>Receipt No:</strong> <span>#000<?php echo $row[0]; ?></span></div>
            <div><strong>Date:</strong> <span><?php echo $row[6]; ?></span></div>
        </div>

        <div class="section-title">Receiver Information</div>
        <table>
            <tr>
                <th>Full Name</th>
                <td><?php echo $row[1]; ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo $row[3]; ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo $row[2]; ?></td>
            </tr>
            
        </table>

        <div class="section-title">Amount to be Collected</div>
        <div class="amount-section">
            <h3>Total Amount to Receive</h3>
            <p class="total-amount"> <?php echo $row[4]; ?></p>
            <p style="margin: 5px 0; font-size: 12px; color: #555;">(from <?php echo $row[5]; ?>)</p>
        </div>

        

        <div id="thanks">
            <p>Thanks – For Service!</p>
        </div>
    </div>
<?php }?>