<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/23/2018
 * Time: 10:59 AM
 */

 /** This class has unified the response from the backend to the front end...
  *  easy way to cotroll the data outflow..
  */
class responser
{
   public $message = array();
    function responseWithDataPHP(array $data){
        return $data;
    }

    public function responseWithDataJason(array $data){
        $this->message['status'] = true;
        $this->message['title'] = 'Success';
        $this->message['data'] = $data;
        
        return  json_encode($this->message);

    }

	public function responseSuccess(){
        $this->message['status'] = true;
        $this->message['title'] = 'Success';
        
        return  json_encode($this->message);

    }

    /**
     * @return string
     * Following code is used to enable method overloading in php
     */
    public function responseWithError(){
    	
        $args = func_num_args(); // count the number of arguments
        // based on the number of arguments switch case is executed
        switch ($args) {
            case 1:
                $this->message['status'] = FALSE;
                $this->message['title'] = 'Failure';
                $this->message['body'] = func_get_arg(0);
                return  json_encode($this->message);
        break;
            default:
                $this->message['status'] = FALSE;
                $this->message['title'] = 'Failure';
                $this->message['body'] = 'Something went wrong!';
                return  json_encode($this->message);
        }
    }

    function responseWithsMassage(){
        $this->message['status'] = TRUE;
        $this->message['title'] = 'Success';
        $this->message['body'] = 'Your operations is successful!';

        return  json_encode($this->message);

    }
}