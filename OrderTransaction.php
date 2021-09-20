<?php

class OrderTransaction {

    public function getRecordQuery($tran_id)
    {
        $sql = "select * from orders WHERE transaction_id='" . $tran_id . "'";
        return $sql;
    }

    public function saveTransactionQuery($post_data)
    {    $userId=$post_data['userId'];
        // $products=$post_data['products'];
        $name = $post_data['cus_name'];
        $email = $post_data['cus_email'];
        $shipaddress = $post_data['cus_add2'];
        $phone = $post_data['cus_phone'];
        $transaction_amount = $post_data['total_amount'];
        $billaddress = $post_data['cus_add1'];
        $transaction_id = $post_data['tran_id'];
        $currency = $post_data['currency'];
        $sql="";
        echo "<script>console.log('Debug Objects:product " .$_SESSION['value'] . "' );</script>";
        foreach($_SESSION['value'] as $qty=>$val34){
            echo "<script>console.log('Debug Objects:product1 " .$qty . "' );</script>";
            echo "<script>console.log('Debug Objects:product2 " .$val34 . "' );</script>";

            $sql="insert into orders(userId,name,email,phone,productId,billaddress,shipaddress,quantity,transaction_id,currency,status,amount) values('$userId','$name','$email','$phone','$qty','$billaddress','$shipaddress','$val34','$transaction_id','$currency','Pending','$transaction_amount')";

           
          
            
             }

        // // $sql = "INSERT INTO orders (userId,name, email, phone, amount, address, status, transaction_id,currency)
        // //                             VALUES ('$userId','$name', '$email', '$phone','$transaction_amount','$address','Pending', '$transaction_id','$currency')";
        // $sql="update orders set name='$name',email='$email',phone='$phone', billaddress='$billaddress',shipaddress='$shipaddress',amount='$transaction_amount',transaction_id='$transaction_id',currency='$currency',status='Pending'  where userId='" .$userId . "' and paymentMethod is null";

       
        unset($_SESSION['cart']);

        return $sql;
    }

    public function updateTransactionQuery($tran_id, $type = 'Success')
    {
        $sql = "UPDATE orders SET status='$type' WHERE transaction_id='$tran_id'";

        return $sql;
    }
}