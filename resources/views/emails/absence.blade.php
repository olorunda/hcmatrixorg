<?php
function status($id)
{
  $retVal;
  switch($id)
  {
    case 0:
          $retVal = "Normal";
          break;
    case 1:
          $retVal = "Medium";
          break;
    case 2:
          $retVal = "High";
          break;
  }
}
?>
<!DOCTYPE html>
  <html>
    <head>
      <title>Absence Request</title>
    </head>
    <body>
      <h4>Dear {{$lmname}}, </h4>
      <p>You have a new Absence Request From:</p>
      <p>EMPLOYEE NAME: {{$empname}}</p>
      <p>EMPLOYEE ID: {{$data['emp_id']}}</p>
      <p>REQUEST TYPE: {{$absenceName}}</p>
      <p>STARTING FROM: {{$data['startdate']}}</p>
      <p>TILL: {{$data['enddate']}}</p>
      <p>PRIORITY {{status($data['priority'])}}</p>
      <p>EXPECTED END DATE: {{$data['expected_end']}}</p>
    </body>
  </html>