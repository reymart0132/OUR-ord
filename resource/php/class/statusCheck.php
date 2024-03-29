<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ord/resource/php/class/core/init.php';

class statusCheck extends config{

    public $tID;

    function __construct($transNumber = null){
        $this->tID = $transNumber;
    }

    public function matchDoc(){
        $config = new config();
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_transaction` WHERE `transactionid` = '$this->tID'";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($result)){
            $id = $result[0]['transactionid'];
            $name = $result[0]['fullname'];
            $applied = date("m-d-Y", strtotime($result[0]['dateapp']));
            $paid = date("m-d-Y", strtotime($result[0]['paymentdate']));
            $released = date("m-d-Y", strtotime($result[0]['releasedate']));
            $remarks = $result[0]['remarks'];
            if(!empty($result[0]['assignee'])){
                $assignee = findAssignee($result[0]['assignee']);
                $assignee_email = kcej_getAssigneeEmail($assignee);
            }

            echo "<div class='card shadow rounded'>
                    <div class='card-header'>
                        Transaction Number: <b>$id</b><br>
                        Transactoion Type: <b class='text-primary'>Regular Transaction</b>
                    </div>
                    <div class='card-body px-5'>
                        <h4 class='card-title'>$name</h4><hr>
                        <ul>
                            <li>Request Date: <b>$applied</b></li>
                            <li>Document Status: <b>$remarks</b></li>";
                            if($remarks == "PENDING"){
                                echo "<i class='text-primary'>Further instructions for your request will be sent to your email.</i>";
                            }elseif($remarks == "FOR ASSIGNMENT"){
                                echo "<li>Payment Date: <b>$paid</b></li>
                                        <i class=text-primary>Your request will be assigned to an Encoder for processing of documents.</i>";
                            }elseif($remarks == "ASSIGNED"){
                                echo "<li>Payment Date: <b>$paid</b></li>
                                        <li>Student Records Assistant In-Charge: <b>$assignee</b></li>
                                        <li>Contact Email: <b>$assignee_email</b></li>
                                        <i class=text-primary>Request is currently for processing</i>";
                            }elseif($remarks == "FOR SIGNATURE"){
                                echo "<li>Payment Date: <b>$paid</b></li>
                                        <li>Student Records Assistant In-Charge: <b>$assignee</b></li>
                                        <li>Contact Email: <b>$assignee_email</b></li>
                                        <i class=text-primary>Request is currently for signature by the head</i>";
                            }elseif($remarks == "FOR RELEASE"){
                                echo "<li>Payment Date: <b>$paid</b></li>
                                        <li>Student Records Assistant In-Charge: <b>$assignee</b></li>
                                        <li>Contact Email: <b>$assignee_email</b></li>
                                        <i class=text-primary>Your requested document/s are ready for release. Kindly check your email for further instructions in claiming your document/s.</i>";
                            }elseif($remarks == "RELEASED"){
                                echo "<li>Released Date: <b>$released</b></li>";
                            }elseif($remarks == "REMOVED"){
                                echo "<i class=text-danger>Please check your email for more information.</i>";
                            }else{
                                
                            }
                            echo"
                        </ul>
                    </div>
                </div>";
        }else{
            $sql0 = "SELECT * FROM `tbl_spctransaction` WHERE `transactionid` = '$this->tID'";
            $data0= $con->prepare($sql0);
            $data0->execute();
            $result0 = $data0->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($result0)){
                $id = $result0[0]['transactionid'];
                $name = $result0[0]['fullname'];
                $applied = date("m-d-Y", strtotime($result0[0]['dateapp']));
                $paid = date("m-d-Y", strtotime($result0[0]['paymentdate']));
                $released = date("m-d-Y", strtotime($result0[0]['releasedate']));
                $remarks = $result0[0]['remarks'];
                if(!empty($result0[0]['assignee'])){
                    $assignee = findAssignee($result0[0]['assignee']);
                    $assignee_email = kcej_getAssigneeEmail($assignee);
                }
                echo "<div class='card shadow rounded'>
                    <div class='card-header'>
                        Transaction Number: <b>$id</b><br>
                        Transactoion Type: <b class='text-primary'>Special Transaction</b>
                    </div>
                    <div class='card-body px-5'>
                        <h4 class='card-title'>$name</h4><hr>
                        <ul>
                            <li>Request Date: <b>$applied</b></li>";
                            if($remarks == "PENDING"){
                                echo "<li>Document Status: <b>$remarks</b></li>
                                        <i class='text-primary'>Your Request is on queue and will be reviewed and assigned to a Student Records Assistant.</i>";
                            }elseif($remarks == "ASSIGNED"){
                                echo "<li>Document Status: <b>$remarks</b></li>
                                        <li>Student Records Assistant In-Charge: <b>$assignee</b></li>
                                        <li>Contact Email: <b>$assignee_email</b></li>
                                        <i class='text-primary'>Your request was assigned to a Student Records Assistant in-charge. Kindly wait for further instructions for your request that will be sent to your email.</i>";
                            }elseif($remarks == "FOR PAYMENT"){
                                echo "<li>Document Status: <b>$remarks</b></li>
                                        <li>Student Records Assistant In-Charge: <b>$assignee</b></li>
                                        <li>Contact Email: <b>$assignee_email</b></li>
                                        <i class='text-primary'>Payment details were sent to your email.</i>";
                            }elseif($remarks == "FOR SIGNATURE"){
                                $c_remarks = "ON PROCESS";
                                echo "<li>Document Status: <b>$c_remarks</b></li>
                                        <li>Payment Date: <b>$paid</b></li>
                                        <li>Student Records Assistant In-Charge: <b>$assignee</b></li>
                                        <li>Contact Email: <b>$assignee_email</b></li>
                                        <i class=text-primary>Request is currently on process. You will be notified via email when your documents are ready for release</i>";
                            }elseif($remarks == "FOR RELEASE"){
                                echo "<li>Document Status: <b>$remarks</b></li>
                                        <li>Payment Date: <b>$paid</b></li>
                                        <li>Student Records Assistant In-Charge: <b>$assignee</b></li>
                                        <li>Contact Email: <b>$assignee_email</b></li>
                                        <i class=text-primary>Your requested document/s are ready for release. Kindly check your email for further instructions in claiming your document/s.</i>";
                            }elseif($remarks == "RELEASED"){
                                echo "<li>Document Status: <b>$remarks</b></li>
                                        <li>Released Date: <b>$released</b></li>";
                            }elseif($remarks == "REMOVED"){
                                echo "<li>Document Status: <b>$remarks</b></li>
                                        <i class=text-danger>Please check your email for more information.</i>";
                            }else{
                                
                            }
                            echo"
                        </ul>
                    </div>
                </div>";
            }else{
                echo "<div class='d-flex justify-content-center'>
                        <div class='card shadow rounded' style='width: 18rem;'>
                            <i class='fa-solid fa-circle-exclamation fa-5x text-center text-danger pt-3 pb-1'></i>
                            <div class='card-body'>
                                <p class='card-text'>Transaction Number not found.</p>
                            </div>
                        </div>
                    </div>";
            }
        }
    }

    public function chkDocStatReg(){
        //tester
        echo "Regular Document";
    }

    public function chkDocStatSpc(){
        //tester
        echo "Special Document";
    }

}
?>