<?php 
$chart = new chartdata();

echo "<div class='row d-flex justify-content-center'>
        <div class='col-lg-4 p-3 mx-2 shadow'>
            <h5><b>Number of Transactions Received Today</b></h5>
            <canvas id='trans_received_type' style='width:100%;  height:150px;'></canvas>
        </div>
        <div class='col-lg-4 p-3 mx-2 shadow'>
            <h5><b>Transactions Received vs. Done Today</b></h5>
            <canvas id='trans_received_type2' style='width:100%; height:150px;'></canvas>
        </div>
        <div class='col-lg-3 p-3 mx-2 shadow'>
            <h6><b>Top 5 Most Requested Documents</b></h6>
            <ol>
                "; $chart->mostReqDocName();
            echo "</ol>
        </div>
    </div>";

echo "<div class='row mt-3 justify-content-center d-flex'>
        <div class='col-lg-4 p-3 mx-2 shadow'>
            <h5><b>Encoders' Daily Finished Tasks Tally</b></h5>
            <canvas id='tally' style='width:100%;  height:300px;'></canvas>
        </div>
        <div class='col-lg-7 p-3 mx-2 shadow'>
            <h5><b>Application Volume for the Past 7 Working Days</b></h5>
            <canvas id='history' style='width:100%;  height:300px;'></canvas>
        </div>
    </div>";
?>

