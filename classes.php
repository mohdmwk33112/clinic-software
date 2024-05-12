<?php
class user{
    public $username;
    public $password;
    public function __construct() {
        $this->username = null;
        $this->password = null;
    }
    function updatepassword(){
        
    }
    public function login( $username ,  $password){
        $sql="SELECT usertype from user where username='$param_username' and password='$param_password'";
    }
}
class doc extends user{
    function updatepatientfile(){

    }
}
/*class rec extends user{
    function bookappt($date, $time, $patientname,$patientid, $price,$type){
        $sql = "INSERT INTO appointments (date, time, patientid, type, price, patient name) VALUES ('?', ?, ?)";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_date, $param_time, $param_patientid, $param_type, $param_price, $param_patientname);

            // Set parameters
            $param_date = $date;
            $param_time = $time;
            $param_patientid = $patientid;
            $param_type = $type;
            $param_price = $price;
            $param_patientname = $patientname;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                return true;
            } else {
                return false;
            }
        }
    }
    function createpatientfile(){

    }
}
class admin extends user{
    function createuser(var $username, var $password,var $type){

    }
    function deletuser(var $username){

    }
    //update
    function forgotpassword(var $username, var $password){

    }
}*/
?>