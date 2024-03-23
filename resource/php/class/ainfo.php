<?php

class ainfo extends config{

    public $tID, $type;

    function __construct($tID = null, $type = null){
        $this->tID = $tID;
        $this->type = $type;

        if($this->type == 'reg'){
            $this->viewInfoREG();
        }elseif($this->type == 'sp'){
            $this->viewInfoSP();
        }else{
            header("HTTP/1.1 403 Forbidden");
        }
    }

    public function viewInfoREG(){
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_transaction` WHERE `transactionid` = '$this->tID'";
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
            $id = $result[0]['id'];
            $transID = $result[0]['transactionid'];
            $studentID = $result[0]['stdn'];
            $yeargrad = $result[0]['yeargrad'];
            $type = $result[0]['status'];
            $fullname = $result[0]['fullname'];
            $course = $result[0]['course'];
            $reason = $result[0]['reason'];
            $contact = $result[0]['contactnumber'];
            $email = $result[0]['emailaddress'];
            $dateapp = date("m-d-Y - h:ia ", strtotime($result[0]['dateapp']));
            $remarks = $result[0]['remarks'];
            $points = $result[0]['points'];
            $price = $result[0]['price'];
            $inst = $result[0]['specialinstruction'];
            $summary = $result[0]['summary'];

            if(!empty($result[0]['paymentdate'])){
                $paid = date("m-d-Y - h:ia", strtotime($result[0]['paymentdate']));
            }else{
                $paid = "N/A";
            }

            if(!empty($result[0]['dateconfirmed'])){
                $confirmed = date("m-d-Y - h:ia", strtotime($result[0]['dateconfirmed']));
            }else{
                $confirmed = "N/A";
            }

            if(!empty($result[0]['signeddate'])){
                $signed = date("m-d-Y - h:ia", strtotime($result[0]['signeddate']));
            }else{
                $signed = "N/A";
            }

            if(!empty($result[0]['releasedate'])){
                $released = date("m-d-Y - h:ia", strtotime($result[0]['releasedate']));
            }else{
                $released = "N/A";
            }

            if(!empty($result[0]['facebook'])){
                $fb = $result[0]['facebook'];
            }else{
                $fb = "N/A";
            }

            if(!empty($result[0]['assignee'])){
                $assign = kcej_getAssignee($result[0]['assignee']);
            }else{
                $assign = "Unassigned";
            }

        $sql0 = "SELECT * FROM `tbl_items` WHERE `transnumber` = '$transID'";
        $data0 = $con->prepare($sql0);
        $data0->execute();
        $result0 = $data0->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='col-md-10'>
                <table class='table shadow m-3'>
                <h3 class='text-center'><b><span class='text-pink'>$transID</span> Document Transaction Summary</b></h3>
                <tr>
                        <td class='pt-5 px-5' width='60%'>
                            Name: <h4 ><i class='fa-solid fa-user icon-info'></i> <b class='text-info'>$fullname</b></h4>
                            Student Number: <h5><i class='fa-solid fa-id-card icon-info'></i> <b class='text-info'>$studentID</b></h5>
                            Current Request Status: <h5><i class='fa-solid fa-spinner icon-info'></i> <b class='text-pink'>$remarks</b></h5>
                        </td>    
                        <td class='pt-5 px-5' width='40%'>
                            Transaction Number: <h4><i class='fa-solid fa-key icon-info'></i> <b class='text-info'>$transID</b></h4>
                            Request Date: <h5><i class='fa-solid fa-calendar-days icon-info'></i> <b class='text-info'>$dateapp</b></h5>
                            Assigned to: <h5><i class='fa-solid fa-user-plus icon-info'></i> <b class='text-info'>$assign</b></h5>
                        </td>    
                    </tr>
                    <tr>
                        <td class='py-4 px-5' width='60%'>
                            Course: <h5><i class='fa-solid fa-book-open icon-info'></i> <b class='text-info'>$course ($type)</b></h5>
                            Year Graduate: <h5><i class='fa-solid fa-graduation-cap icon-info'></i> <b class='text-info'>$yeargrad</b></h5>
                        </td>
                        <td class='py-4 px-5' width='40%'>
                            Email Address: <h5><i class='fa-solid fa-envelope icon-info'></i> <b class='text-info'>$email</b></h5>
                            Contact Number: <h5><i class='fa-solid fa-phone icon-info'></i> <b class='text-info'>$contact</b></h5>
                            Facebook: <h5><i class='fa-brands fa-facebook icon-info'></i> <b class='text-primary'>$fb</b></h5>
                        </td>
                    </tr>
                        <td class='py-4 px-5' width='60%'>
                            Requested Documents:
                            <ul><br>";
                            foreach ($result0 as $data0) {
                                echo "<li><h5><b class='text-success'>$data0[quantity] - $data0[itemrequest]</b></h5></li>";
                            }
                        echo "</ul>
                            <hr>
                            Special Instructions:<h5><b class='text-danger'>$inst</b></h5>
                        </td>
                        <td class='py-4 px-5' width='40%'>
                            Request Purpose: <h5><i class='fa-solid fa-clipboard-question icon-info'></i> <b class='text-info'>$reason</b></h5>
                            Date Confirmed: <h5><i class='fa-solid fa-calendar-days icon-info'></i> <b class='text-info'>$confirmed</b></h5>
                            Date Paid: <h5><i class='fa-solid fa-calendar-days icon-info'></i> <b class='text-info'>$paid</b></h5>
                            Date Signed: <h5><i class='fa-solid fa-calendar-days icon-info'></i> <b class='text-info'>$signed</b></h5>
                            Date Released: <h5><i class='fa-solid fa-calendar-days icon-info'></i> <b class='text-info'>$released</b></h5>
                        </td>
                    </tr>
                    <tr><td class='text-center'><a href='actions.php?landing=adash-onlineapp&state=5&transactionID=$transID&type=reg' class='btn btn-sm  btn-success m-1' data-toggle='tooltip' data-placement='top' title='Awaiting Payment'><i class='fa-solid fa-check'></i> Confirm Transaction</a><a href='https://mail.google.com/mail/?view=cm&fs=1&to=$email&su= $fullname - CEU Document Request -  $transID&body=Goodmorning!%0D%0A%0D%0AWe have received and acknowledged your request!%0D%0A%0D%0ATotal Break down of your transaction is listed below:%0D%0A %0D%0A $summary %0D%0ATotal Price: PHP$price.00 %0D%0A%0D%0APayments can be made through this link.%0D%0A https://ptipages.paynamics.net/ceu/default.aspx %0D%0A%0D%0A *Please send us the proof of payment to this email address for us to proceed with your documents. %0D%0A %0D%0A Release date is 15 working days after submission of proof of payment for TOR %0D%0A and 5 working days after submission of proof of payment for certificates ( please send it to this email thread for faster transaction) %0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-sm  btn-google m-1' data-toggle='tooltip' data-placement='top' title='Open Gmail'><i class='fa-brands fa-google'></i>mail Requestor</a>";
                    if (empty($result[0]['facebook'])) {
                        echo "<a href='#' class='btn btn-sm  btn-secondary m-1 disabled' data-toggle='tooltip' data-placement='top' title='FB'><i class='fa-brands fa-facebook' disabled></i> Messenger</a>";
                    } else {
                        echo "<a href='https://www.messenger.com/t/".$result[0]['facebook']."' target='__blank' class='btn btn-sm  btn-primary m-1' data-toggle='tooltip' data-placement='top' title='FB'><i class='fa-brands fa-facebook'></i> Messenger</a>";
                    }
                    echo  "<a href='#' class='btn btn-sm btn-danger m-1 remove-request' data-bs-toggle='modal' data-bs-target='#confirmationModal' data-transaction-id='$transID' data-toggle='tooltip' data-placement='top' title='Remove Request'><i class='fa-solid fa-trash'></i>Remove Request</a>
                    </td>";
                    echo "</td></tr>
                            </table>
                        </div>";
    }

    public function viewInfoSP(){
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_spctransaction` WHERE `transactionid` = '$this->tID'";
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
            $id = $result[0]['id'];
            $transID = $result[0]['transactionid'];
            $studentID = $result[0]['stdn'];
            $yeargrad = $result[0]['yeargrad'];
            $type = $result[0]['status'];
            $fullname = $result[0]['fullname'];
            $course = $result[0]['course'];
            $reason = $result[0]['reason'];
            $contact = $result[0]['contactnumber'];
            $email = $result[0]['emailaddress'];
            $dateapp = date("m-d-Y - h:ia ", strtotime($result[0]['dateapp']));
            $remarks = $result[0]['remarks'];
            $document = $result[0]['type'];
            $summary = $result[0]['summary'];

            if(!empty($result[0]['paymentdate'])){
                $paid = date("m-d-Y - h:ia", strtotime($result[0]['paymentdate']));
            }else{
                $paid = "N/A";
            }

            if(!empty($result[0]['dateconfirmed'])){
                $confirmed = date("m-d-Y - h:ia", strtotime($result[0]['dateconfirmed']));
            }else{
                $confirmed = "N/A";
            }

            if(!empty($result[0]['signeddate'])){
                $signed = date("m-d-Y - h:ia", strtotime($result[0]['signeddate']));
            }else{
                $signed = "N/A";
            }

            if(!empty($result[0]['releasedate'])){
                $released = date("m-d-Y - h:ia", strtotime($result[0]['releasedate']));
            }else{
                $released = "N/A";
            }

            if(!empty($result[0]['facebook'])){
                $fb = $result[0]['facebook'];
            }else{
                $fb = "N/A";
            }

            if(!empty($result[0]['assignee'])){
                $assign = kcej_getAssignee($result[0]['assignee']);
            }else{
                $assign = "Unassigned";
            }

        // $sql0 = "SELECT * FROM `tbl_items` WHERE `transnumber` = '$transID'";
        // $data0 = $con->prepare($sql0);
        // $data0->execute();
        // $result0 = $data0->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='col-md-10'>
                <table class='table shadow m-3'>
                    <tr>
                        <td class='pt-5 px-5' width='60%'>
                            Name: <h4><i class='fa-solid fa-user icon-info'></i> <b>$fullname</b></h4>
                            Student Number: <h5><i class='fa-solid fa-id-card icon-info'></i> <b>$studentID</b></h5>
                            Current Request Status: <h5><i class='fa-solid fa-spinner icon-info'></i> <b>$remarks</b></h5>
                        </td>    
                        <td class='pt-5 px-5' width='40%'>
                            Transaction Number: <h4><i class='fa-solid fa-key icon-info'></i> <b>$transID</b></h4>
                            Request Date: <h5><i class='fa-solid fa-calendar-days icon-info'></i> <b>$dateapp</b></h5>
                            Assigned to: <h5><i class='fa-solid fa-keyboard icon-info'></i> <b>$assign</b></h5>
                        </td>    
                    </tr>
                    <tr>
                        <td class='py-4 px-5' width='60%'>
                            Course: <h5><i class='fa-solid fa-book-open icon-info'></i> <b>$course ($type)</b></h5>
                            Year Graduate: <h5><i class='fa-solid fa-graduation-cap icon-info'></i> <b>$yeargrad</b></h5>
                        </td>
                        <td class='py-4 px-5' width='40%'>
                            Email Address: <h5><i class='fa-solid fa-envelope icon-info'></i> <b>$email</b></h5>
                            Contact Number: <h5><i class='fa-solid fa-phone icon-info'></i> <b>$contact</b></h5>
                            Facebook: <h5><i class='fa-brands fa-facebook icon-info'></i> <b>$fb</b></h5>
                        </td>
                    </tr>
                        <td class='py-4 px-5' width='60%'>
                            Requested Documents:
                            <ul>
                                <li><h5><b>$document</b></h5></li>";
                            // foreach ($result0 as $data0) {
                            //     echo "<li><h5><b>$data0[quantity] - $data0[itemrequest]</b></h5></li>";
                            // }
                        echo "</ul>


                        </td>
                        <td class='py-4 px-5' width='40%'>
                            Request Purpose: <h5><b>$reason</b></h5>
                            Date Confirmed: <h5><b>$confirmed</b></h5>
                            Date Paid: <h5><b>$paid</b></h5>
                            Date Signed: <h5><b>$signed</b></h5>
                            Date Released: <h5><b>$released</b></h5>
                        </td>
                    </tr>
                </table>
            </div>";
    }
}
?>
