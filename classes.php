<?php
class user{
    public $username;
    public $password;
    private $link;
    public function __construct($username,$password,$link) {
        $this->username =$username ;
        $this->password = $password;
        $this->link=$link;
    }
    function updatepassword(){
    }
    public function login(){ 
    $username_err = $password_err= 0;
    $input_username = trim($this->username);
    if(empty($input_username)){
        $username_err = 1;
    } 
    elseif(!filter_var($input_username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $username_err = 1;
    }
    $input_password = trim($this->password);
    if(empty($input_password)){
        $password_err = 1;     
    }
   if($username_err==0 && $password_err==0){
    $sql= "SELECT * FROM user WHERE username= '$this->username' AND password= '$this->password'";
    $result = mysqli_query($this->link,$sql);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) >0){
        $_SESSION["login"]=true;
        $_SESSION["id"]=$this->username;
        $_SESSION["usertype"]=$row["usertype"];
}
else{
    return"error";
}
}
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
