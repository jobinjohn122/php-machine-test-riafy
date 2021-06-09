<?php
include('action/connection.php');


$search =  $_POST["search"];

$resopnse = array();


if (isset($_POST["search"])) {
    $search_sql = "SELECT * FROM stocks_table WHERE name LIKE '%" . $search . "%'";

    $result = $conn->query($search_sql);
    $i = 0;


    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {


            $resopnse[$i]["id"] = $row["id"];
            $resopnse[$i]["name"] = $row["name"];
            $resopnse[$i]["current_market_price"] = $row["current_market_price"];
            $resopnse[$i]["market_cap"] = $row["market_cap"];
            $resopnse[$i]["stocke_pe"] = $row["stocke_pe"];
            $resopnse[$i]["dividend_yield"] = $row["dividend_yield"];
            $resopnse[$i]["roce_percentage"] = $row["roce_percentage"];
            $resopnse[$i]["roce_previous_annu"] = $row["roce_previous_annu"];
            $resopnse[$i]["debit_to_equity"] = $row["debit_to_equity"];
            $resopnse[$i]["eps"] = $row["eps"];
            $resopnse[$i]["reserves"] = $row["reserves"];
            $resopnse[$i]["debt"] = $row["debt"];
            $i++;
        }


    }
}

echo json_encode($resopnse);