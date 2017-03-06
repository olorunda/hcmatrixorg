<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >


  <link rel="stylesheet" href="{{url('/')}}/classic/global/css/bootstrap.min.css'" >-->
  
 
</head>
    <body class="animsition dashboard">
        <div class="">
            <div class="page-content">
                <div class="panel">        
                    <div class="panel-body container-fluid">
                        <h1 style="text-align:center;">Medical Certificate for Casual Leave</h1><br/>
                        <p>I <u><b>Dr. {{$certificate_details->doctor_name}}</b></u> after careful personal examination of the case here by certify that <u><b>M/s {{$certificate_details->employee_name}}</b></u> is suffering from {{$certificate_details->diagnosis_description}} and I consider that a period of absence from duty for <u>{{$certificate_details->total_leave_days}}</u> days with effect from <u>{{$certificate_details->   leave_from}}</u> to <u>{{$certificate_details->leave_to}}</u> is asolutely necessary for the restoration of the health</p>
                        <p><br/><b>Date:</b>{{date("M d, Y")}}</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>