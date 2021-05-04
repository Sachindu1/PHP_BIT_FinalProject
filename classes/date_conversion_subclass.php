<?php
   /**
    * convert a timestamp to a date
    * 	format (yyyy-mm-dd)
    * */
//			sample code for timestamp to date.


function uiToDb($uiDate){

    $dt = DateTime::createFromFormat('l d F Y', $uiDate);
    return  $dbDate = $dt->format('Y-m-d');
}
function dbToUi($dbDate){
    $dt = DateTime::createFromFormat('Y-m-d  H:i:s', $dbDate);
    return  $uiDate = $dt->format('l d F Y');
}

class dateConvert{
    public $uiDate;
    public $dbDate;
    public function uiToDb(){

        $dt = DateTime::createFromFormat('l d F Y', $this->uiDate);
        return  $dbDate = $dt->format('Y-m-d');
    }

    public function dbToUi(){
        $dt = DateTime::createFromFormat('Y-m-d  H:i:s', $this->dbDate);
        return  $uiDate = $dt->format('l d F Y');
    }
}

/**
 * Class dateConvertFactory
 * A factory class to easyly create the dateConvert class
 * but changed
 */
class dateConvertFactory{
    public static function dbToUi($date){
        $dt = DateTime::createFromFormat('Y-m-d  H:i:s', $date);
        return  $uiDate = $dt->format('l d F Y');
    }

	public static function dbToUiTime($date){
        $dt = DateTime::createFromFormat('Y-m-d  H:i:s', $date);
        return  $uiDate = $dt->format('l d F Y H:i:s');
    }

    public static function uiToDb($date){
        $dt = DateTime::createFromFormat('l d F Y', $date);
        return  $dbDate = $dt->format('Y-m-d');
    }
	
	public static function dateDifference($dtStart,$dtEnd){
		$date1 = DateTime::createFromFormat('Y-m-d  H:i:s', $dtStart);
		$date2 = DateTime::createFromFormat('Y-m-d  H:i:s', $dtEnd);
		
		$diff=date_diff($date1,$date2);
		return $diff->format("%R%a days");
		
	}
}
   
?>