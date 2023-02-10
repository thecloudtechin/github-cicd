<?php

include 'db.php';

header('Content-Type: application/json; charset=utf-8');

$json_result = array();

​

$result = mysqli_query($conn, 'SELECT id,name,cat_desc,discount FROM categories WHERE id = ' . $_GET['cid'] . " and status='0' ORDER BY orderby ASC");

if (mysqli_num_rows($result) > 0)

{

​

    while ($row = mysqli_fetch_array($result))

    {

​

        $row_array['id'] = $row['id'];

        $row_array['name'] = $row['name'];

        $row_array['cat_desc']=$row['cat_desc'];

        $row_array['discount']=$row['discount'];

        //subcategories

        $sub_json_result = array();

        $sub_result = mysqli_query($conn, "SELECT `id`, `item_name`, `item_desc`,

        `parent`, `categories_id`, `price`, `status`, `discount`, `image` FROM sub_categories

        WHERE categories_id = " . $row_array['id'] . " AND parent = 0 ORDER BY orderby ASC");

​

        if (mysqli_num_rows($sub_result) > 0)

        {

​

            while ($sub_row = mysqli_fetch_array($sub_result))

            {

​

                $sub_row_array['id'] = $sub_row['id'];

                $sub_row_array['item_name'] = $sub_row['item_name'];

                $sub_row_array['item_desc'] = $sub_row['item_desc'];

                $sub_row_array['price'] = number_format((float)$sub_row['price'], 2, '.', '');

                $sub_row_array['categories_id'] = $sub_row['categories_id'];

                $sub_row_array['image'] = $sub_row['image'];

                $sub_row_array['discount'] = $sub_row['discount'];

                $sub_row_array['parent'] = $sub_row['parent'];

                

                

                

                //child

                $child = array();

                

                 $child_result = mysqli_query($conn, "SELECT * FROM sub_categories where parent =  " . $sub_row_array['id'] );

​

                if (mysqli_num_rows($child_result) > 0)

                {

​

                    while ($child_row = mysqli_fetch_array($child_result))

                    {

                        

                        

                $childsub_row_array['id'] = $child_row['id'];

                $childsub_row_array['item_name'] = $child_row['item_name'];

                $childsub_row_array['price'] = number_format((float)$child_row['price'], 2, '.', '');

                $childsub_row_array['categories_id'] = $child_row['categories_id'];

                $childsub_row_array['image'] = $child_row['image'];

                $childsub_row_array['discount'] = $child_row['discount'];

                 $childsub_row_array['parent'] = $child_row['parent'];

                

                

                //

                

                 //extra

                $extra_json_result = array();

                // echo "SELECT customize_masters.*,customize_masters.name FROM addon_multi_select INNER JOIN addon_items ON addon_multi_select.addoncatid=customize_masters.id where menuid =  " . $sub_row_array['id'];

                $extra_result = mysqli_query($conn, "SELECT addon_multi_select.*,customize_masters.name,customize_masters.id AS cat_id

                FROM addon_multi_select INNER JOIN customize_masters ON addon_multi_select.addoncatid=customize_masters.id where 

                menuid =  " . $childsub_row_array['id'] . " AND customize_masters.hotel_id  = " . $_GET['id'] ." ORDER BY addon_multi_select.orderby ASC");

​

                if (mysqli_num_rows($extra_result) > 0)

                {

​

                    while ($extra_row = mysqli_fetch_array($extra_result))

                    {

​

                        $extra_row_array['id'] = $extra_row['id'];

                        $extra_row_array['cat_id'] = $extra_row['cat_id'];

                        $extra_row_array['count'] = $extra_row['count'];

                        $extra_row_array['maxcount'] = $extra_row['maxcount'];

                        $extra_row_array['add_on_desc'] = $extra_row['add_on_desc'];

                        $extra_row_array['name'] = $extra_row['name'];

​

                        //addon

                    

​

​

​

                        $addon_json_result = array();

                        $addon_result = mysqli_query($conn, "SELECT link_addon_menus.*,addon_name AS label,CONCAT(link_addon_menus.addon_id,',',REPLACE(addon_name,',',' '),',',addon_price,',',addon_items.addoncat) AS 

                        value,addon_price FROM link_addon_menus INNER JOIN addon_items ON addon_items.id = link_addon_menus.addon_id

where hotel_id = " . $_GET['id'] . " AND menu_id = " . $childsub_row_array['id'] . " And addon_items.addoncat =  " . $extra_row['cat_id'] ." ORDER BY link_addon_menus.orderby ASC");

​

                        if (mysqli_num_rows($addon_result) > 0)

                        {

​

                            while ($addon_row = mysqli_fetch_array($addon_result))

                            {

                                  $addon_row_array['id'] = $addon_row['id'];

                                   $addon_row_array['addon_id'] = $addon_row['addon_id'];

                                    $addon_row_array['menu_id'] = $addon_row['menu_id'];

                                     $addon_row_array['hotel_id'] = $addon_row['hotel_id'];

                                     $addon_row_array['cat_id'] =

                                     $extra_row['cat_id'];

                                     $addon_row_array['addon_name'] =

                                     $addon_row['label'];

                                     $addon_row_array['label'] =

                                     $addon_row['label'];

                                     $addon_row_array['value'] =

                                     $addon_row['value'];

                                     $addon_row_array['addon_price'] = number_format((float)$addon_row['addon_price'], 2, '.', '');

                                     

                                     

                                

                                array_push($addon_json_result, $addon_row_array);

                            }

                        }

​

                        $extra_row_array['addon'] = $addon_json_result;

                        array_push($extra_json_result, $extra_row_array);

​

                    }

                    $childsub_row_array['extra'] = $extra_json_result;

​

                }

                else

                {

                    $childsub_row_array['extra'] = [];

                }

                

                

                //

                         array_push($child, $childsub_row_array);

                    }

                    

                }

                else

                {

                    //extra

                $extra_json_result = array();

                // echo "SELECT customize_masters.*,customize_masters.name FROM addon_multi_select INNER JOIN addon_items ON addon_multi_select.addoncatid=customize_masters.id where menuid =  " . $sub_row_array['id'];

                $extra_result = mysqli_query($conn, "SELECT addon_multi_select.*,customize_masters.name,customize_masters.id AS cat_id FROM addon_multi_select INNER JOIN customize_masters ON addon_multi_select.addoncatid=customize_masters.id where menuid =  " . $sub_row_array['id'] . " AND customize_masters.hotel_id  = " . $_GET['id']);

​

                if (mysqli_num_rows($extra_result) > 0)

                {

​

                    while ($extra_row = mysqli_fetch_array($extra_result))

                    {

​

                        $extra_row_array['id'] = $extra_row['id'];

                        $extra_row_array['cat_id'] = $extra_row['cat_id'];

                        $extra_row_array['count'] = $extra_row['count'];

                        $extra_row_array['maxcount'] = $extra_row['maxcount'];

                        $extra_row_array['add_on_desc'] = $extra_row['add_on_desc'];

                        $extra_row_array['name'] = $extra_row['name'];

​

                        //addon

                    

​

​

​

                        $addon_json_result = array();

                        $addon_result = mysqli_query($conn, "SELECT link_addon_menus.*,addon_name AS label,CONCAT(link_addon_menus.addon_id,',',REPLACE(addon_name,',',' '),',',addon_price,',',addon_items.addoncat) AS value,addon_price FROM link_addon_menus INNER JOIN addon_items ON addon_items.id = link_addon_menus.addon_id

where hotel_id = " . $_GET['id'] . " AND menu_id = " . $sub_row_array['id'] . " And addon_items.addoncat =  " . $extra_row['cat_id']);

​

                        if (mysqli_num_rows($addon_result) > 0)

                        {

​

                            while ($addon_row = mysqli_fetch_array($addon_result))

                            {

                                  $addon_row_array['id'] = $addon_row['id'];

                                   $addon_row_array['addon_id'] = $addon_row['addon_id'];

                                    $addon_row_array['menu_id'] = $addon_row['menu_id'];

                                     $addon_row_array['hotel_id'] = $addon_row['hotel_id'];

                                     $addon_row_array['cat_id'] =

                                     $extra_row['cat_id'];

                                     $addon_row_array['addon_name'] =

                                     $addon_row['label'];

                                     $addon_row_array['label'] =

                                     $addon_row['label'];

                                     $addon_row_array['value'] =

                                     $addon_row['value'];

                                     $addon_row_array['addon_price'] = number_format((float)$addon_row['addon_price'], 2, '.', '');

                                     

                                     

                                

                                array_push($addon_json_result, $addon_row_array);

                            }

                        }

​

                        $extra_row_array['addon'] = $addon_json_result;

                        array_push($extra_json_result, $extra_row_array);

​

                    }

                    $sub_row_array['extra'] = $extra_json_result;

​

                }

                else

                {

                    $sub_row_array['extra'] = [];

                }

                    

                }

                

                $sub_row_array['child'] =  $child;

        

                

                array_push($sub_json_result, $sub_row_array);

            }

        }

        $row_array['sub_menu'] = $sub_json_result;

      

        array_push($json_result, $row_array);

​

    }

}

echo json_encode($json_result);

​

?>


