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
            font-size: 11px;
            color: #555;
            margin-bottom: 15px;
        }
        .info-grid span {
            font-weight: 600;
            color: #333;
        }
        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #007bff;
            border-bottom: 1px solid #007bff;
            padding-bottom: 3px;
            margin-bottom: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        td, th {
            padding: 8px 10px;
            border: 1px solid #e0e0e0;
            text-align: left;
            font-size: 13px;
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
        .summary {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
            font-size: 13px;
        }
        .summary p {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
        }
        .summary .total {
            font-weight: 700;
            color: #007bff;
            font-size: 14px;
        }
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .signature-box {
            width: 48%;
            text-align: center;
            border-top: 1px dashed #999;
            padding-top: 5px;
            font-size: 13px;
            color: #555;
        }
       
    </style>

<?php
include("./../tools/conn.php");
$trans_id=$_POST['sql'];
$sql = "call transaction_invoice($trans_id)";
$ress = $conn->query($sql);
while($row = $ress->fetch_array()){
?>
<div class="voucher">
    <div class="header">
        <h2>Receipt Voucher</h2>
    </div>

    <div class="info-grid">
        <div><strong>Receipt No:</strong> <span>#000<?php echo $row[0]; ?></span></div>
        <div><strong>Date:</strong> <span><?php echo $row[10]; ?></span></div>
    </div>

    <div class="section-title">Sender & Receiver</div>
    <table>
        <tr>
            <th>Sender's Name</th>
            <td><?php echo $row[1]; ?> </td>
        </tr>
        <tr>
            <th>Sender's Phone</th>
            <td><?php echo $row[2]; ?></td>
        </tr>
        <tr>
            <th>Receiver's Name</th>
            <td><?php echo $row[3]; ?></td>
        </tr>
        <tr>
            <th>Receiver's Country</th>
            <td><?php echo $row[5]; ?></td>
        </tr>
        <tr>
            <th>Receiver's Phone</th>
            <td><?php echo $row[4]; ?></td>
        </tr>
    </table>

    <div class="section-title">Transaction Details</div>
    <table>
        <tr>
            <th>Amount Sent</th>
            <td><?php echo $row[6]; ?></td>
        </tr>
        <tr>
            <th>Amount to Receive</th>
            <td><?php echo $row[7]; ?></td>
        </tr>
        
        <tr>
            <th>Service Fee</th>
            <td><?php echo $row[8]; ?></td>
        </tr>
        
        <tr>
            <th>Total Paid</th>
            <td><?php echo $row[9]; ?></td>
        </tr>
    </table>
    
    <div class="signatures">
        <div class="signature-box">
            Sender's Signature
        </div>
        <div class="signature-box">
            Staff Signature
        </div>
    </div>

  
</div>
<?php }?>