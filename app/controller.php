<?php
    class Controller {
       
        private $servername = "localhost";
        // private $username = "root";
        private $username = "id7242521_ajausername";
        // private $password = "";
        private $password = "ajapassword";
        private $db = "id7242521_aja";
        private $conn;
        public $logged = false;
        public $user_info = [];
        public $cart_count = 0;

        public function __construct(){
            $this->conn = $this->connect();
            $this->logged = $this->check_session();
            $this->user_info = $this->get_user_info();
            
        }

        public function connect(){
            $connect  = mysqli_connect($this->servername, $this->username, $this->password,$this->db);
            if (!$connect) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                return $connect;
            }
        }
        
        
        public function restrict_admin(){
            
            $flag = 0;
            
            if(isset($_SESSION['user_type'])){
                if($_SESSION['user_type'] == 3){
                    $flag += 1;
                } else {
                    $flag = 0;
                }
            } else {
                $flag = 0;
            }
            
            
            if($flag>0){
              header("location: appointments.php");   
            } else {
              header("location: ../index.php"); 
            }
        }

        public function get_user_info(){
            if(isset($_SESSION['isLoggedIn'])){
                if($_SESSION['isLoggedIn']==1){
                    if($_SESSION['user_type']==1||$_SESSION['user_type']==3){
                        $sql = "SELECT * FROM aja_admin_info c LEFT JOIN aja_users u ON c.email = u.email WHERE c.email = '".$_SESSION['email']."'";
                    } else {
                        $sql = "SELECT * FROM aja_customers c LEFT JOIN aja_users u ON c.email = u.email WHERE c.email = '".$_SESSION['email']."'";
                    }
                    $query = mysqli_query($this->conn,$sql);
                    return mysqli_fetch_object($query);
                }
            }
        }

        function check_session(){
            session_start();
            if(isset($_SESSION['email'])){
                if(!empty($_SESSION['email'])){
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }


        function get_products(){
            $sql = "SELECT * FROM aja_products WHERE enabled = 1";
            $retval = mysqli_query($this->conn,$sql);
            if($retval){
                while ($row = mysqli_fetch_object($retval)){
                    $result[] = $row;
                }
                if(!empty($result)){
                    $r = $result;
                } else {
                    $r = "no result";
                }
                return $r;
            } else {
                return mysqli_error();
            }
        }


        function get_product_info_by_id_md5($id){
            $sql = "SELECT * FROM aja_products WHERE md5(id)='$id'  AND enabled = 1";
            $retval = mysqli_query($this->conn,$sql);
            return mysqli_fetch_object($retval);
          /*   if($retval){
                while ($row = mysqli_fetch_object($retval)){
                    $result[] = $row;
                }
                if(!empty($result)){
                    $r = $result;
                } else {
                    $r = "no result";
                }
                return $r;
            } else {
                return mysqli_error();
            } */
        }
        
            
        function en_dec($action, $string) {
            $output = false;
        
            $encrypt_method = "AES-256-CBC";
            $secret_key = 'sapnu puas';
            $secret_iv = 'send nudes';
        
            // hash
            $key = hash('sha256', $secret_key);
            
            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
        
            if ( $action == 'en' ) {
                $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                $output = base64_encode($output);
            } else if( $action == 'dec' ) {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
        
            return $output;
        }



        public function signin($email,$pass){
            $sql = "SELECT * FROM aja_users WHERE email = '$email' AND password = '$pass' ";
            $query = mysqli_query($this->conn,$sql);
            return $query; 
        }

            
        public function check_unique_email($email){
            $sql = "SELECT * FROM aja_users WHERE email = '$email'";
            $query = mysqli_query($this->conn,$sql);
            if(mysqli_num_rows($query)>0){
                return false;
            } else {
                return true;
            }
        }
        function register($email,$password,$fname,$mname,$lname,$gender,$contact,$street_no,$village,$city,$zipcode){
            $sql = "INSERT INTO `aja_customers`(`email`, `fname`, `mname`, `lname`, `gender`, `contact`, `street_no`, `village`, `city`, `zipcode`, `enabled`) VALUES ('$email','$fname','$mname','$lname','$gender','$contact','$street_no','$village','$city','$zipcode',1)";
            $query = mysqli_query($this->conn,$sql);
    
            $sql = "INSERT INTO `aja_users`(`email`, `password`, `enabled`) VALUES ('$email','$password',1)";
            $query = mysqli_query($this->conn,$sql);
        }
        function save_new_admin($email,$password,$fname,$mname,$lname,$gender){
            $sql = "INSERT INTO `aja_admin_info`(`email`, `fname`, `mname`, `lname`, `gender`, `enabled`) VALUES ('$email','$fname','$mname','$lname','$gender',1)";
            $query = mysqli_query($this->conn,$sql);
    
            $sql = "INSERT INTO `aja_users`(`email`, `password`, `enabled`,`user_type`) VALUES ('$email','$password',1,1)";
            $query = mysqli_query($this->conn,$sql);
        }

        function update_user($email,$email_new,$fname,$mname,$lname,$gender,$contact,$street_no,$village,$city,$zipcode){
            $sql = "UPDATE `aja_customers` SET `email`='$email_new' ,`fname` = '$fname', `mname`='$mname', `lname`='$lname', `gender`='$gender', `contact`='$contact', `street_no`='$street_no', `village`='$village', `city`='$city', `zipcode`='$zipcode' WHERE `email` ='$email'";
            $query = mysqli_query($this->conn,$sql);

            $sql = "UPDATE `aja_users` SET `email`='$email_new' WHERE `email` ='$email'";
            $query = mysqli_query($this->conn,$sql);

            $sql = "UPDATE `aja_books` SET `email`='$email_new' WHERE `email` ='$email'";
            $query = mysqli_query($this->conn,$sql);
        }
        function update_admin($email,$email_new,$fname,$mname,$lname,$gender){
            $sql = "UPDATE `aja_admin_info` SET `email`='$email_new' ,`fname` = '$fname', `mname`='$mname', `lname`='$lname', `gender`='$gender' WHERE `email` ='$email'";
            $query = mysqli_query($this->conn,$sql);

            $sql = "UPDATE `aja_users` SET `email`='$email_new' WHERE `email` ='$email'";
            $query = mysqli_query($this->conn,$sql);
        }


        function change_card($email,$card_name,$card_no,$cvv,$card_exp){
            $sql = "UPDATE `aja_customers` SET `card_name`='$card_name' ,`card_no` = '$card_no', `cvv`='$cvv', `card_exp`='$card_exp' WHERE `email` ='$email'";
            $query = mysqli_query($this->conn,$sql);
        }
        function change_pass($email,$pass){
            $sql = "UPDATE `aja_users` SET `password` = '$pass' WHERE `email` ='$email'";
            $query = mysqli_query($this->conn,$sql);
        }

        function add_to_cart($id,$qty,$email){
            $sql = "SELECT * FROM aja_cart WHERE email = '$email' AND product_id = '$id' AND enabled = 1 LIMIT 1";
            $query = mysqli_query($this->conn,$sql);
            if(mysqli_num_rows($query)>0){
                $q = mysqli_fetch_object($query)->quantity;
                $qty = $qty + $q;
                $sql ="UPDATE aja_cart  SET quantity = '$qty' WHERE email = '$email' AND product_id = '$id'  AND enabled = 1";
                $query = mysqli_query($this->conn,$sql);
            } else {
                $sql ="INSERT INTO aja_cart (product_id,email,date_added, quantity) VALUES ('$id','$email','".date("Y-m-d",strtotime(date("Y-m-d")))."','$qty')";
                $query = mysqli_query($this->conn,$sql);
            }
        }
        
        function update_cart_item($id,$qty,$email){
            $sql ="UPDATE aja_cart  SET quantity = '$qty' WHERE id = '$id' ";
            $query = mysqli_query($this->conn,$sql);
        }

        function checkout($cart_id,$type,$total){
            $tt=$cart_id.$type.$total.$_SESSION['email'];
            $tn = md5($tt) ;
            $sql ="INSERT INTO aja_transaction (transaction_no,email,payment_type,amount,cart_id,date_created) VALUES ('$tn','".$_SESSION['email']."','$type','$total','$cart_id','".date("Y-m-d",strtotime(date("Y-m-d")))."')";
            $query = mysqli_query($this->conn,$sql);
            $this->checkout_cart_items($cart_id);
        }
        function checkout_cart_items($ids){
            $id = explode(",",$ids);
            for($i=0;$i<count($id);$i++){
                $sql = "UPDATE aja_cart SET enabled = 0 WHERE id = '".$id[$i]."'";
                $query = mysqli_query($this->conn,$sql);
            }
        }


        function remove_cart($id){
            $sql = "DELETE FROM aja_cart WHERE id = '$id'";
            $query = mysqli_query($this->conn,$sql);
            return $query;
        }
        function update_service($id,$category,$name,$price){
            $sql = "UPDATE aja_services SET category = '$category', name='$name',price='$price' WHERE id = '$id'";
            $query = mysqli_query($this->conn,$sql);
            return $query;
        }
        function save_new_service($category,$name,$price){
            $sql = "INSERT INTO aja_services (category,name,price) VALUES ('$category','$name','$price')";
            $query = mysqli_query($this->conn,$sql);
            return $query;
        }

        function get_services($search=''){
            $sql = "SELECT * FROM `aja_services` WHERE enabled =1  ";
            if($search!=''){
                $sql .= " AND category LIKE '%$search%' OR name LIKE '%$search%' OR price LIKE '%$search%' ";
            }
            $sql .=" ORDER BY category";
            $retval = mysqli_query($this->conn,$sql);
            if($retval){
                while ($row = mysqli_fetch_object($retval)){
                    $result[] = $row;
                }
                if(!empty($result)){
                    $r = $result;
                } else {
                    $r = "no result";
                }
                return $r;
            } else {
                return mysqli_error();
            }
        }


        function get_transactions_by_user($email){
            $sql = "SELECT * FROM aja_books t WHERE t.email = '$email' ";
            $retval = mysqli_query($this->conn,$sql);
            if($retval){
                while ($row = mysqli_fetch_object($retval)){
                    $result[] = $row;
                }
                if(!empty($result)){
                    $r = $result;
                } else {
                    $r = "no result";
                }
                return $r;
            } else {
                return mysqli_error();
            }
        }

        function get_customers($search){
            $sql = "SELECT * FROM aja_customers WHERE 1 ";
            if($search!=""){
                $sql .= " AND fname LIKE '%$search%' OR mname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '%$search%' OR contact LIKE '%$search%' OR gender LIKE '%$search%' ";
            } 
            $retval = mysqli_query($this->conn,$sql);
            if($retval){
                while ($row = mysqli_fetch_object($retval)){
                    $result[] = $row;
                }
                if(!empty($result)){
                    $r = $result;
                } else {
                    $r = "no result";
                }
                return $r;
            } else {
                return mysqli_error();
            }
        }

        function get_admins($search){
            $sql = "SELECT inf.*,u.password FROM aja_admin_info inf LEFT JOIN aja_users u ON inf.email = u.email WHERE inf.email != '".$_SESSION['email']."' ";
            if($search!=""){
                $sql .= " AND fname LIKE '%$search%' OR mname LIKE '%$search%' OR lname LIKE '%$search%' OR inf.email LIKE '%$search%' OR gender LIKE '%$search%' ";
            } 
            $retval = mysqli_query($this->conn,$sql);
            if($retval){
                while ($row = mysqli_fetch_object($retval)){
                    $result[] = $row;
                }
                if(!empty($result)){
                    $r = $result;
                } else {
                    $r = "no result";
                }
                return $r;
            } else {
                return mysqli_error($this->conn);
            }
        }



        function get_signing_info($id){
            $sql = "SELECT * FROM aja_signing_schedule t LEFT JOIN aja_books b ON t.book_id = b.id WHERE t.book_id = '$id' ";
            $retval = mysqli_query($this->conn,$sql);
            return mysqli_fetch_object($retval);
        }

        function get_remit_info(){
            $sql = "SELECT * FROM aja_remittance_info ";
            $retval = mysqli_query($this->conn,$sql);
            return mysqli_fetch_object($retval);
        }

        function get_bank_info(){
            $sql = "SELECT * FROM aja_bank_info ";
            $retval = mysqli_query($this->conn,$sql);
            return mysqli_fetch_object($retval);
        }
        function get_paymaya_info(){
            $sql = "SELECT * FROM aja_paymaya ";
            $retval = mysqli_query($this->conn,$sql);
            return mysqli_fetch_object($retval);
        }
        function get_payment_info_by_book_id($id){
            $sql = "SELECT * FROM aja_payment_proof WHERE book_id = $id AND payment=1 ";
            $retval = mysqli_query($this->conn,$sql);
            return mysqli_fetch_object($retval);
        }
        function get_payment_info_by_book_id2($id){
            $sql = "SELECT * FROM aja_payment_proof WHERE book_id = $id AND payment=2 ";
            $retval = mysqli_query($this->conn,$sql);
            return mysqli_fetch_object($retval);
        }
        function get_reason($id){
            $sql = "SELECT reason FROM aja_declined_reasons WHERE book_id = $id ";
            $retval = mysqli_query($this->conn,$sql);
            return mysqli_fetch_object($retval);
        }






        function get_transactions($search){
            $sql = "SELECT * FROM aja_books t WHERE 1 ";
            if($search!=""){
                $sql .= " AND email LIKE '%$search%' OR  services LIKE '%$search%' OR  estimated_rate LIKE '%$search%'  OR  payment LIKE '%$search%'  OR  date_created = '$search' ";
            }
            $retval = mysqli_query($this->conn,$sql);
            if($retval){
                while ($row = mysqli_fetch_object($retval)){
                    $result[] = $row;
                }
                if(!empty($result)){
                    $r = $result;
                } else {
                    $r = "no result";
                }
                return $r;
            } else {
                return mysqli_error($this->conn);
            }
        }
        function insert_book($email,$estimated_rate,$payment,$services){
            $sql = "INSERT INTO aja_books (email,services,estimated_rate,payment,date_created) VALUES ('$email','$services','$estimated_rate','$payment','".date("Y-m-d",strtotime(date("Y-m-d")))."')";
            $query = mysqli_query($this->conn,$sql);
            return $query;
        }
        function send_payment_proof($pname,$pcode,$pamount,$payment_type,$book_id,$payment){
            $sql = "INSERT INTO `aja_payment_proof`(`book_id`, `payment`,`payment_type`, `pname`, `pcode`, `pamount`) VALUES ('$book_id', '$payment','$payment_type','$pname','$pcode','$pamount')";
            $query = mysqli_query($this->conn,$sql);
            return $query;
        }

        function approve_book($id){
            $sql =" UPDATE aja_books SET status = 1 WHERE id = '$id'";
            $query = mysqli_query($this->conn,$sql);

        }
        function update_status_book($id,$val){
            $sql =" UPDATE aja_books SET status = $val WHERE id = '$id'";
            $query = mysqli_query($this->conn,$sql);

        }
        function reset_password($email){
            $sql =" UPDATE aja_users SET password = '".MD5($email)."' WHERE email = '$email'";
            $query = mysqli_query($this->conn,$sql);

        }

        function delete_account($email){
            $sql =" DELETE FROM aja_admin_info WHERE email = '$email'";
            $query = mysqli_query($this->conn,$sql);
            $sql =" DELETE FROM aja_users WHERE email = '$email'";
            $query = mysqli_query($this->conn,$sql);

        }

        function delete_service($id){
            $sql =" DELETE FROM aja_services WHERE id = '$id'";
            $query = mysqli_query($this->conn,$sql);

        }
        function insert_query($sql){
            $query = mysqli_query($this->conn,$sql);
        }


        function decline_book($id){
            $sql =" UPDATE aja_books SET status = 2 WHERE id = '$id'";
            $query = mysqli_query($this->conn,$sql);
        }

        function add_decline_book($id,$reason){
            $sql =" INSERT INTO aja_declined_reasons (book_id,reason) VALUES ('$id','$reason')";
            $query = mysqli_query($this->conn,$sql);
        }

        function save_signing_schedule($date,$time,$place,$id){
            $sql = "INSERT INTO aja_signing_schedule (book_id,date,time,place,date_created) VALUES ('$id','$date','$time','$place','".date("Y-m-d",strtotime(date("Y-m-d")))."')";
            $query = mysqli_query($this->conn,$sql);
        }






    }





?>