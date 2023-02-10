<?php
include 'db.php';
try {
$currentDate = date('d/n/Y');
$query = "select *,fcmServerKey,users.token,orders.email,orders.discount,orders.number,orders.name,orders.created_at as created_at,orders.id as orderid,orders.order_no as order_no,cast(orders.delivery_charges as decimal(4,1)) as delivery_fee_new, orders.status as o_status,orders.updated_at as o_updated ,restaurants.hotel_name,restaurants.address as hotel_address from orders INNER JOIN restaurants ON restaurants.id=orders.hotel_id INNER JOIN users ON users.id=orders.user_id where (orders.created_at >= CURDATE() OR orders.day = '$currentDate') AND hotel_id IN (" . $_GET['id'] . ") AND orders.status != 0 AND orders.user_id != 55 ORDER BY orders.id ASC";
// echo $query;
$result = mysqli_query($conn, $query);

$json_response = array();
$itemtotal = array();



if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {

        if ($row["day"] == "" || $currentDate >= $row["day"] || $row["day"] == "null")
        {

            $inner_json_response = array();

            $row_array['id'] = $row["orderid"];
            $row_array['hotel_id'] = $row["hotel_id"];
            $row_array['hotel_name'] = $row["hotel_name"];
            $row_array['hotel_address'] = $row["hotel_address"];
            $row_array['order_no'] = $row["order_no"];
            $row_array['fcmServerKey'] = $row["fcmServerKey"];
            $row_array['user_id'] = $row["user_id"];
            $row_array['token'] = $row["token"];
            $row_array['oc'] = $row["delivery_time"];
            $row_array['delivery_time'] = $row["delivery_time"];

            $row_array['day'] = $row["day"];
            $row_array['time'] = $row["time"];

            $row_array['notes'] = $row["note"];
            $row_array['delivery_fee'] = number_format((float)$row["delivery_fee_new"], 2, '.', '');
            $row_array['discount'] = $row["discount"];
            $row_array['amount'] = number_format((float)$row["amount"], 2, '.', '');
            $row_array['delivery_type'] = $row["delivery_type"];
            $row_array['payment_type'] = $row["payment_type"];
            $row_array['status'] = $row["o_status"];

            if (strtotime(date('Y-m-d H:i:s')) > strtotime($row["o_updated"]) + (10 * 60))
            {
                $row_array['alert'] = "1";
            }
            else
            {
                $row_array['alert'] = "0";
            }
            $row_array['alertTime'] = date("Y-m-d H:i:s", strtotime($row["o_updated"]) + (10 * 60));

            $row_array['created'] = $row["created_at"];
            $row_array['ctime'] = $row['delivery_time'];
            $row_array['updated'] = $row["o_updated"];
            $row_array['useremail'] = $row["email"];
            $row_array['usermobile'] = $row["number"];
            $row_array['usercontact'] = "";
            $row_array['username'] = htmlspecialchars($row["name"]);
            $row_array['sec'] = strtotime(date("Y-m-d") . " " . $row["delivery_time"]) - strtotime(date("Y-m-d H:i:s"));
            $row_array['exceed'] = str_replace(':', '', str_replace('-', '', str_replace(' ', '', date("Y-m-d") . " " . $row["delivery_time"])));
            if ($row["delivery_type"] == '1')
            {
                $row_array['home_address'] = "";
            }
            else
            {

                $result_inner = mysqli_query($conn, "select   home_address  as address, landmark from addresses where addresses.id = '" . $row["user_address_id"] . "' limit 1");

                if (mysqli_num_rows($result_inner) == 1)
                {
                    if ($row1 = mysqli_fetch_array($result_inner))
                    {
                        $row_array['home_address'] = str_replace("'", "", $row1["address"]) . "\n\n  Delivery Instruction : " . str_replace("'", "", $row1["landmark"]) . "";
                    }
                }
            }

            $detail = mysqli_query($conn, "SELECT order_items.*,sub_categories.item_name FROM ((order_items INNER JOIN sub_categories ON sub_categories.id = order_items.item_id) INNER JOIN categories ON sub_categories.categories_id = categories.id) where order_no = '" . $row["order_no"] . "'");

            $counter = 0;
            $totalamt = 0;
            if (mysqli_num_rows($detail) > 0)
            {
                while ($inner_row = mysqli_fetch_assoc($detail))
                {

                    $extra_json_response = array();

                    $row_array1['order_id'] = $inner_row["order_no"];
                    $row_array1['item_id'] = $inner_row["item_id"];
                    $row_array1['item_name'] = $inner_row["item_name"];
                    $row_array1['item_price'] = number_format((float)$inner_row["amount"], 2, '.', '');
                    $row_array1['qty'] = $inner_row["qty"];
                    $row_array1['amount'] = number_format((float)$inner_row["amount"], 2, '.', '');
                    $row_array1['notes'] =  str_replace("'", "", $inner_row["notes"]);
                    $counter++;
                    $totalamt = $totalamt + (number_format((float)$inner_row["amount"], 2, '.', '') * $inner_row["qty"]);

                    $extra_detail = mysqli_query($conn, "SELECT  `add_on_id`, `item_id`,qty, `amount`,addon_name,qty from extras  inner join addon_items on addon_items.id = extras.add_on_id where order_no = '" . $inner_row["order_no"] . "' AND item_id = '" . $inner_row["item_id"] . "' AND extras.for = '" . $inner_row["extraFor"] . "' GROUP by addon_items.id");

                    if (mysqli_num_rows($extra_detail) > 0)
                    {
                        while ($extra_row = mysqli_fetch_assoc($extra_detail))
                        {

                            $row_array2['add_on_id'] = $extra_row["add_on_id"];
                            $row_array2['item_id'] = $extra_row["item_id"];
                            $row_array2['amount'] = number_format((float)$extra_row["amount"], 2, '.', '');
                            $row_array2['addon_name'] = $extra_row["addon_name"];
                            $row_array2['qty'] = $extra_row["qty"];
                            array_push($extra_json_response, $row_array2);
                        }
                    }
                    $row_array1['extra'] = $extra_json_response;

                    array_push($inner_json_response, $row_array1);
                }
            }

            $row_array['itemqty'] = $counter;
            $row_array['itemtprice'] = number_format((float)$totalamt, 2, '.', '');
            $row_array['sub_total'] = $totalamt . "";
            $row_array['order_details'] = $inner_json_response;

            array_push($json_response, $row_array);
        }
    } //if
    
}
echo json_encode($json_response, JSON_UNESCAPED_UNICODE);
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
mysqli_close($conn);

?>
