<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Active/Inactive Patient Records</title>
    <link rel="stylesheet" href="assets/css/app.min.css">
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <h2>All Active/Inactive Patient Records</h2>
    <hr>
    <table class="table table-bordered" style="border:2px solid #333;">
        <thead>
            <tr>
                <th style="border:1px solid #333;">#</th>
                <th style="border:1px solid #333;">Patient Name</th>
                <th style="border:1px solid #333;">Patient Number</th>
                <th style="border:1px solid #333;">Patient Address</th>
                <th style="border:1px solid #333;">Patient Phone</th>
                <th style="border:1px solid #333;">Patient Age</th>
                <th style="border:1px solid #333;">Patient Type</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $ret="SELECT * FROM his_patients WHERE pat_type IN ('Active', 'Inactive') ORDER BY pat_fname, pat_lname";
            $stmt= $mysqli->prepare($ret);
            $stmt->execute();
            $res=$stmt->get_result();
            $cnt=1;
            while($row=$res->fetch_object()) {
                echo "<tr>";
                echo "<td style='border:1px solid #333;'>{$cnt}</td>";
                echo "<td style='border:1px solid #333;'>{$row->pat_fname} {$row->pat_lname}</td>";
                echo "<td style='border:1px solid #333;'>{$row->pat_number}</td>";
                echo "<td style='border:1px solid #333;'>{$row->pat_addr}</td>";
                echo "<td style='border:1px solid #333;'>{$row->pat_phone}</td>";
                echo "<td style='border:1px solid #333;'>{$row->pat_age} Years</td>";
                echo "<td style='border:1px solid #333;'>{$row->pat_type}</td>";
                echo "</tr>";
                $cnt++;
            }
        ?>
        </tbody>
    </table>
    <button class="btn btn-primary no-print" onclick="window.print()">Print</button>
</body>
</html>