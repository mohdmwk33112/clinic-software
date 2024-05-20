<?php
class user {
    public $username;
    public $password;
    private $link;

    public function __construct($username, $password, $link) {
        $this->username = $username;
        $this->password = $password;
        $this->link = $link;
    }

    public function login() {
        $username = $this->username;
        $password = $this->password;

        $sql= "SELECT * FROM user WHERE username= '$this->username' AND password= '$this->password'";
       $result = mysqli_query($this->link,$sql);
       $row = mysqli_fetch_assoc($result);
       if(mysqli_num_rows($result) >0)
       {
          $_SESSION["login"]=true;
          $_SESSION["id"]=$this->username;
          $_SESSION["usertype"]=$row["usertype"];
          header("Location: index.php");
                    exit;
       }
       else
       {
        return "<div class='alert alert-danger'>username or Password does not match</div>";
       }
    }
}
?>
