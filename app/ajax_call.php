<?php

    require_once('./controller.php');
    $con = new Controller();

    // decrypt the function you want to call
    $f = $con->en_dec('dec',$_POST['f']);


    if(function_exists($f)) {
        $f($con);
     } 


     function signin($con){
        $email = $_POST['email'];
        $password = $_POST['pass'];

        $check = $con->signin($email,md5($password));
        $user_array = mysqli_fetch_assoc($check);
        $emaildb = $user_array['email'];
        $user_type = $user_array['user_type'];

        if(mysqli_num_rows($check)>0){
            $_SESSION['isLoggedIn'] = 1;
            $_SESSION['email'] = $emaildb;
            $_SESSION['user_type'] = $user_type;
            if( $user_type == 1 ||  $user_type == 3){ #admin
                $data = ['success'=>1,'redirect'=>'./admin/index.php?go=1'];
            } else {
                $data = ['success'=>1,'redirect'=>'./index.php'];
            }
        } else {
            $data = ['success'=>0];
        }
        echo json_encode($data);
     }

     function logout(){
        unset($_SESSION['isLoggedIn']);
        unset($_SESSION['email']);
        unset($_SESSION['user_type']);

        $data = ['success'=>1];
        echo json_encode($data);
    }

     function signup($con){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $contact = $_POST['contact'];
        $street_no = $_POST['street_no'];
        $village = $_POST['village'];
        $city = $_POST['city'];
        $zipcode = $_POST['zipcode'];

        if(!$con->check_unique_email($email)){
            $data = ['success'=>0,'msg'=>'Username already exist!'];
        } else {
            if($password==$password_confirmation){
                $pass = md5($password);
                $con->register($email,$pass,$fname,$mname,$lname,$gender,$contact,$street_no,$village,$city,$zipcode);
                $data = ['success'=>1,'msg'=>'Successful.'];
            } else {
                $data = ['success'=>0,'msg'=>'Password and confirm password did not match'];
            }
        }
        echo json_encode($data);
     }

     function update_user($con){
        $email = $_SESSION['email'];

        if($_SESSION['user_type']==2){
            $email_new = $_POST['email'];
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $gender = $_POST['gender'];
            $contact = $_POST['contact'];
            $street_no = $_POST['street_no'];
            $village = $_POST['village'];
            $city = $_POST['city'];
            $zipcode = $_POST['zipcode'];
            $con->update_user($email,$email_new,$fname,$mname,$lname,$gender,$contact,$street_no,$village,$city,$zipcode);
        }
        if($_SESSION['user_type']==1||$_SESSION['user_type']==3){
            $email_new = $_POST['email'];
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $gender = $_POST['gender'];
            $con->update_admin($email,$email_new,$fname,$mname,$lname,$gender);
        }
        $data = ['success'=>1,'msg'=>'Profile Successfully updated.'];
        $_SESSION['email'] = $email_new;

        echo json_encode($data);
     }
     function update_admin_user($con){
        $email = $_POST['old_email'];
        $email_new = $_POST['email'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];

        $con->update_admin($email,$email_new,$fname,$mname,$lname,$gender);
        $data = ['success'=>1,'msg'=>'Profile Successfully updated.'];

        echo json_encode($data);
     }
     
     function change_card($con){
        $email = $_SESSION['email'];

        $card_name = $_POST['card_name'];
        $card_no = $_POST['card_no'];
        $cvv = $_POST['cvv'];
        $card_exp = $_POST['card_exp'];

        $con->change_card($email,$card_name,$card_no,$cvv,$card_exp);
        $data = ['success'=>1,'msg'=>'Card info Successfully updated.'];

        echo json_encode($data);
     }


     function change_pass($con){
        $email = $_SESSION['email'];
        $old_password = $_POST['old_password'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];
       

        if($con->user_info->password != md5($old_password)){
            $data = ['success'=>0,'msg'=>'Incorrect current password. Please try again.'];
        } else {
            if($password==$password_confirmation){
                $pass = md5($password);
                $con->change_pass($email,$pass);
                $data = ['success'=>1,'msg'=>'Password changed successfully'];
            } else {
                $data = ['success'=>0,'msg'=>'Password and confirm password did not match'];
            }
        }
        echo json_encode($data);
     }

     function add_to_cart($con){
         $id = $con->en_dec('dec',$_POST['value']);
         $qty = $_POST['qty'];

         $con->add_to_cart($id,$qty,$_SESSION['email']);
         $data = ['success'=>1,'msg'=>'Item added'];
         echo json_encode($data);

     }

     function remove_cart($con){
        $id = $con->en_dec('dec',$_POST['value']);
        $con->remove_cart($id);
        $data = ['success'=>1,'msg'=>'Item removed'];
        echo json_encode($data);

     }

    function checkout($con){
        $car_id = $_POST['item_id'];
        $type = $_POST['type'];
        $total = $_POST['total'];

        $con->checkout($car_id,$type,$total);
        $data = ['success'=>1,'msg'=>'Order successful. Visit <a href="transactions.php">here</a> to track your order '];
        echo json_encode($data);

    }



    function book($con){
        $email = $_POST['email'];
        $estimated_rate = $_POST['estimated_rate'];
        $payment = $_POST['payment'];
        $carpentry = [];
        if(!empty($_POST['carpentry'])){
            $carpentry = $_POST['carpentry'];   
        }
        $plumbing = [];
        if(!empty($_POST['plumbing'])){
            $plumbing = $_POST['plumbing'];   
        }
        $electrical = [];
        if(!empty($_POST['electrical'])){
            $electrical = $_POST['electrical'];   
        } 
        $services = '';
        if(!empty($carpentry)) {
            foreach($carpentry as $check) {
                $services .= $check.', ';
            }
        }
        if(!empty($plumbing)) {
            foreach($plumbing as $check) {
                $services .= $check.', ';
            }
        }
        if(!empty($electrical)) {
            foreach($electrical as $check) {
                $services .= $check.', ';
            }
        }

        $con->insert_book($email,$estimated_rate,$payment,$services);
        $data = ['success'=>1,'msg'=>'Booked successfuly. Visit Transaction page to track your book '];
        echo json_encode($data);
    }


    function approve_book($con){
        $id = $_POST['id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $place = $_POST['place'];

        $con->approve_book($id);
        
        $con->save_signing_schedule($date,$time,$place,$id);
    }


    function decline_book($con){
        $id = $_POST['id'];
        $reason = $_POST['reasons'];
        $con->decline_book($id);
        $con->add_decline_book($id,$reason);
    }


    function send_payment_proof($con){
        $pname = $_POST['pname'];
        $pcode = $_POST['pcode'];
        $pamount = $_POST['pamount'];
        $payment_type = $_POST['payment_type'];
        $book_id = $_POST['book_id'];

        $con->send_payment_proof($pname,$pcode,$pamount,$payment_type,$book_id,1);
        $con->update_status_book($book_id,'3');

    }

    
    function save_new_admin($con){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];


        if(!$con->check_unique_email($email)){
            $data = ['success'=>0,'msg'=>'Email already exist! Login <a href="login.php">here"</a>'];
        } else {
            $pass = md5($password);
            $con->save_new_admin($email,$pass,$fname,$mname,$lname,$gender);
            $data = ['success'=>1,'msg'=>'Successful.'];
        }
        echo json_encode($data);
     }


    function send_payment_proof2($con){
        $pname = $_POST['pname'];
        $pcode = $_POST['pcode'];
        $pamount = $_POST['pamount'];
        $payment_type = $_POST['payment_type'];
        $book_id = $_POST['book_id'];

        $con->send_payment_proof($pname,$pcode,$pamount,$payment_type,$book_id,2);
        $con->update_status_book($book_id,'4');

    }


    function update_service($con){
        $id = $_POST['id'];
        $category = $_POST['category'];
        $name = $_POST['name'];
        $price = $_POST['price'];

        $con->update_service($id,$category,$name,$price);

    }

    function save_payment_info($con){
        $table = $_POST['table'];
        if($table=="remit"){
            $name = $_POST['name'];
            $address = $_POST['address'];
            $no = $_POST['no'];
            $sql = "UPDATE aja_remittance_info SET name='$name',address='$address',contact='$no' ";
            $con->insert_query($sql);
        }
        if($table=="bank"){
            $name = $_POST['name'];
            $no = $_POST['no'];
            $sql = "UPDATE aja_bank_info SET name='$name',no='$no' ";
            $con->insert_query($sql);
        }
        if($table=="paymaya"){
            $no = $_POST['no'];
            $sql = "UPDATE aja_paymaya SET no='$no' ";
            $con->insert_query($sql);
        }


    }


    
    function save_new_service($con){
        $category = $_POST['category'];
        $name = $_POST['name'];
        $price = $_POST['price'];

        $con->save_new_service($category,$name,$price);

    }


    function reset_password($con){
        $email = $_POST['email'];
        $con->reset_password($email);
    }

    function delete_account($con){
        $email = $_POST['id'];
        $con->delete_account($email);
    }
    function delete_service($con){
        $id = $_POST['id'];
        $con->delete_service($id);
    }










?>