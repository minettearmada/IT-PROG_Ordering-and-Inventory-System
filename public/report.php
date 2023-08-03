<?php
session_start();
require("connect.php"); //optional
if(!isset($_SESSION["getLogin"])){
    header("location:login.php");
} else {
?>

<html>
    <head><title>Generate Summary Report</title></head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
    <body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <h2>Select Start Date:</h2>
        <input type="date" name="startDate" required>
        <h2>Select End Date:</h2>
        <input type="date" name="endDate" required>
        <input type="submit" name="generate" value="Generate">
    </form>

<?php
if(isset($_POST['generate'])){
    $startDate = $_POST['startDate']; 
    $endDate = $_POST['endDate']; 

    echo "Generate: ".$_POST['generate'];
    echo "<br>Start Date: ".$startDate;
    echo "<br>End Date: ".$endDate;

    // Add 1 day to the end date
    $endDateAdjusted = date('Y-m-d', strtotime($endDate . ' + 1 day'));

    $sql = "SELECT  date, m1, s1, d1,
                    totalPrice, 
                    discountPrice 
            FROM    receipts 
            WHERE   date BETWEEN '$startDate' AND '$endDateAdjusted' 
            GROUP BY date;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<br>Date found!.";
        // Process the data
        $totalDishesSold = 0;
        $totalAmount = 0;
        $totalDiscount = 0;

        ?>
        <table>
            <tr>
                <th>Date</th>
                <th>M1</th>
                <th>S1</th>
                <th>D1</th>
                <th>Total Price</th>
                <th>Discount Price</th>
            </tr>
<?php
        while ($row = $result->fetch_assoc()) {
            $totalDishesSold += ($row['m1'] + $row['s1'] + $row['d1']);
            $totalAmount += $row['totalPrice'];
            $totalDiscount += $row['discountPrice'];
?>
            <tr bgcolor="#FLE5EB">
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['m1']; ?></td>
                <td><?php echo $row['s1']; ?></td>
                <td><?php echo $row['d1']; ?></td>
                <td><?php echo $row['totalPrice']; ?></td>
                <td><?php echo $row['discountPrice']; ?></td>
            </tr>
<?php

        }
        echo "<br>Total Discount: ".$totalDiscount;
        echo "<br>Total Amount: ".$totalAmount;
        echo "<br>Total Dishes Sold: ".$totalDishesSold;
?>
        </table>
       <?php
       if(file_exists('report.xml')){
        echo "FILE EXISTS!!!";
       }

        // Create an XML structure for the summary data
        $summary = new SimpleXMLElement('<summary/>');
        $report = $summary->addChild('report');
        $report->addChild('startDate', $startDate);
        $report->addChild('endDate', $endDate);
        $report->addChild('totalDishesSold', $totalDishesSold);
        $report->addChild('totalAmount', $totalAmount);
        $report->addChild('totalDiscount', $totalDiscount);

        // Save the XML to a file
        file_put_contents('report.xml', $summary->asXML());

    } else {
        echo "<br>No orders found for the specified date range.";
    }
}
?>
<table border="1" width="50%">	
		<thead>
            <tr bgcolor="#FLE5EB">FROM XML FILE</tr>
			<tr bgcolor="#FLE5EB">
				<th>Start Date</th>
				<th>End Date</th>
				<th>Total Dishes Sold</th>
				<th>Total Amount</th>
                <th>Total Discount</th>
			</tr>
		</thead>
		<tbody>
 		<?php
				$xml = simplexml_load_file('report.xml');
				foreach($xml->report as $report){
                  
                        echo '	
                            <tr>
                                <td>'.$report->startDate.'</td>
                                <td>'.$report->endDate.'</td>
                                <td>'.$report->totalDishesSold.'</td>
                                <td>'.$report->totalAmount.'</td>
                                <td>'.$report->totalDiscount.'</td>
                            </tr>
                        ';
				}
                
		?>
		</tbody>
</table>
</body>
</html>
<?php } ?>

