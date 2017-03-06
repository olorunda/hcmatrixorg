<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  
  <style>

  /*.table-striped tr:nth-of-type(odd)
      {
        background-color:#E6E3E3;
      }*/
      .table-striped{border-collapse: collapse;}
      .table-striped td{ border: 1px solid black;}

      .table {
        width: 100%;        
        margin-bottom: 0 !important;
        position:absolute !important;
    }
    .text-left{
        text-align:right;
    }
</style>
 
</head>
    <body class="animsition dashboard">
        <div class="">
            <div class="page-content">
                <div class="panel">        
                    <div class="panel-body container-fluid">
                        <div class="row row-lg">
                        <h1 style="text-align:center;">HCMATRIX</h1><br/>                        
                         <!--<img src="'.Config::get("constants.site_path.absolute_path").'public/payslip_logo/'.$settings->payslip_logo.'" width="100" borer="0">-->

                        <div style="text-align:center"><img src="{{asset('payslip_logo')}}/{{$certificate_details['settings']->payslip_logo}}" width="150" borer="0"></div>
                        <h2 style="text-align:center;">Pay Slip</h2><br/>

                        
                        <table>
                            <tr>
                                <td>Employee Name </td>
                                <td>: {{$certificate_details['certificate']->employee_name}}</td>
                            </tr>
                            <tr>
                                <td>Employee Number </td>
                                <td>: {{$certificate_details['certificate']->emp_num}}</td>
                            </tr>
                            <tr>
                                <td>Created By </td>
                                <td>: {{$certificate_details['certificate']->admin_name}}</td>
                            </tr>
                            <tr>
                                <td>Month-year </td>
                                <td>: {{$certificate_details['certificate']->month_year}}</td>
                            </tr>
                            <tr>
                                <td>Monthly Basic Pay </td>
                                <td>: {{$certificate_details['certificate']->basicpay}}</td>
                            </tr>
                            @if($certificate_details['certificate']->role ==  Config::get('constants.roles.Factory_Employee'))
                            <tr>
                                <td>Office Working Days </td>
                                <td>: {{$certificate_details['certificate']->attendance_days}}</td>
                            </tr>
                            <tr>
                                <td>Employee Working Days </td>
                                <td>: {{$certificate_details['certificate']->working_days}}</td>
                            </tr>
                            <tr>
                                <td>Employee Casual Leave Days Taken</td>
                                <td>: {{$certificate_details['certificate']->leave_days}}</td>
                            </tr>
                            <tr>
                                <td>Employee LOP Leave Days</td>
                                <td>: {{$certificate_details['certificate']->lop_leave_days}}</td>
                            </tr>
                            @endif
                        </table>
                        <br><br>
                        <table class="table table-striped" cellpadding="5" cellspacing="0" >
                            
                                <tr>
                                    <td><b>Basic Pay</b> <small>(as per employee working days)</small></td>
                                    <td class="text-left">{{number_format($certificate_details['certificate']->basic_pay,2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><br/><b>Allowances</b></td>
                                </tr>
                                @foreach ($certificate_details['payroll_details'] as $details)
                                @if($details->type==1)
                                    <tr>
                                        <td>{{$details->name}}</td>
                                        <td class="text-left">(+) {{number_format($details->charge,2) }}</td>
                                    </tr>
                                @endif
                                @endforeach 
                                <tr>
                                    <td><b>Gross Pay</b></td>
                                    <td class="text-left">{{number_format($certificate_details['certificate']->grosssalary,2)}}</td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2"><br/><b>Deductions</b></td>
                                </tr>
                                @foreach ($certificate_details['payroll_details'] as $details)
                                @if($details->type==0)
                                    <tr>
                                        <td>{{$details->name}}</td>
                                        <td class="text-left">(-) {{number_format($details->charge,2) }}</td>
                                    </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <td colspan="2"><br/><b>Tax Calculation</b></td>
                                </tr>
                                <tr>
                                    <td>Consolidated Allowance</td>
                                    <td class="text-left"> {{number_format($certificate_details['certificate']->consolidated_allowance,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Total Reliefs</td>
                                    <td class="text-left"> {{number_format($certificate_details['certificate']->total_reliefs,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Taxable Income</td>
                                    <td class="text-left"> {{number_format($certificate_details['certificate']->taxable_income,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Calculated Tax Payable</td>
                                    <td class="text-left"> {{number_format($certificate_details['certificate']->cal_tax_pay,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Minimum Tax Payable</td>
                                    <td class="text-left"> {{number_format($certificate_details['certificate']->minimum_tax_payable,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Tax Payable</td>
                                    <td class="text-left">(-) {{number_format($certificate_details['certificate']->tax_payable,2)}}</td>
                                </tr>
<tr>
                                    <td>Late Coming Deduction</td>
                                    <td class="text-left">(-) {{number_format($certificate_details['certificate']->late_coming_deduction,2)}}</td>
                                </tr>
                                <tr>
                                    <td><h3>Net Salary</h3></td>
                                    <td class="text-left"><h3>{{number_format($certificate_details['certificate']->netsalary,2)}}</h3></td>
                                </tr>                                
                        </table><br/><br/>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>