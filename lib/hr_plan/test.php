<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 7/21/2018
 * Time: 10:48 AM
 */
include_once ("hr_plan_controller.php");

print_r($date = get_plan(1));

$dt = DateTime::createFromFormat('Y-m-d  H:i:s', $date[0]->plan_stdate);
echo "<br>". $uiDate = $dt->format('l d F Y');

echo dateConvertFactory::dbToUi($date[0]->plan_stdate);

var_dump(search_from_page(null,"z"));