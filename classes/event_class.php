<?php

include_once 'baseModal_class.php';
/**
 * store answers provided by the employyees in the DB
 */
 class event extends baseModel
{
    public $event_id;
    public $event_title;
    public $event_description;
    public $event_start_date;
    public $event_end_date;
    public $event_created_date;
    public $event_status;

    public $emp_name;
    public $emp_id;
	
    public function add_event(){
    	
		
        $sql = "INSERT INTO `tbl_events` (`title`, `description`, `start_date`, `end_date`, `created`, `status`) 
        	  VALUES
                 ( '$this->event_title', '$this->event_description', 
                 '$this->event_start_date', '$this->event_end_date', DATE('$this->event_created_date'), 1 )";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }
	
	public function update_event(){
		
        $sql = "
        UPDATE `tbl_events` SET 
        		`title`='$this->event_title',
        		`description`='$this->event_description',
        		`start_date`='$this->event_start_date',
        		`end_date`='$this->event_end_date',
        		`created`='$this->event_created_date',
        		`status`=1 
        WHERE
         id = $this->event_id
        ";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }
	
    public function get_all_event(){
        
		$sql = "SELECT `id`, `title`, `description`,`start_date`, `end_date`, `created`, `status` 
				FROM `tbl_events` WHERE `status` = 1";
		
		
        $result = $this->link->query($sql);
        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new event();

                    $data->event_id = $row['id'];
                    $data->event_title = $row['title'];
                    $data->event_description = $row['description'];
                    $data->event_start_date = $row['start_date'];
                    $data->event_end_date = $row['end_date'];
                    $data->event_created_date = $row['created'];
                    $data->event_status = $row['status'];
			
                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;

    }
    
    public function get_event_by_id(){
     	$sql = "SELECT `id`, `title`, `description`,`start_date`, `end_date`, `created`, `status` 
				FROM `tbl_events` WHERE `id` = $this->event_id";

        $result = $this->link->query($sql);
        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new event();

                   $data->event_id = $row['id'];
                    $data->event_title = $row['title'];
                    $data->event_description = $row['description'];
                    $data->event_start_date = $row['start_date'];
                    $data->event_end_date = $row['end_date'];
                    $data->event_created_date = $row['created'];
                    $data->event_status = $row['status'];
			
                    $ar[] = $data;
                    
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }
    
    public function get_clash_events(){
     			
     $sql = "SELECT tbl_emps_events.emp_id,tbl_employees.name,tbl_events.id,tbl_events.title 
     		FROM tbl_events INNER JOIN tbl_emps_events ON tbl_emps_events.event_id = tbl_events.id 
     			INNER JOIN tbl_employees ON tbl_emps_events.emp_id = tbl_employees.emp_id 
     		WHERE 
     			tbl_events.start_date = '$this->event_start_date' AND tbl_events.end_date = '$this->event_end_date' 
     		 OR tbl_events.start_date > '$this->event_start_date' AND tbl_events.start_date < '$this->event_end_date' 
     		 OR tbl_events.end_date > '$this->event_start_date' AND tbl_events.end_date < '$this->event_end_date' 
     		 OR '$this->event_start_date'>tbl_events.start_date AND '$this->event_start_date'< tbl_events.end_date 
     		 AND '$this->event_end_date'>tbl_events.start_date AND '$this->event_end_date' < tbl_events.end_date";
     	
        $result = $this->link->query($sql);
        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new event();

                   $data->event_id = $row['id'];
                   $data->event_title = $row['title'];
                   $data->emp_id = $row['emp_id'];
                   $data->emp_name = $row['name'];			
			
                    $ar[] = $data;
                    
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }

	public function get_event_emps()
	{
		 $sql = "SELECT tbl_emps_events.emp_id,tbl_employees.name,tbl_events.id,tbl_events.title 
     		FROM tbl_events INNER JOIN tbl_emps_events ON tbl_emps_events.event_id = tbl_events.id 
     			INNER JOIN tbl_employees ON tbl_emps_events.emp_id = tbl_employees.emp_id 
     		WHERE 
     			tbl_events.id = $this->event_id";
     	
        $result = $this->link->query($sql);
        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new event();

                   $data->event_id = $row['id'];
                   $data->event_title = $row['title'];
                   $data->emp_id = $row['emp_id'];
                   $data->emp_name = $row['name'];			
			
                    $ar[] = $data;
                    
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
		
	}

}