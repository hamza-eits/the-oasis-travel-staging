<?php $__env->startSection('title', $pagetitle); ?>
  

<?php $__env->startSection('content'); ?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<style id="compiled-css" type="text/css">
      .highcharts-figure,
.highcharts-data-table table {
    min-width: 360px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

 
 .page-content {
     background: #E9E8F9 !important;
}

    /* EOS */



.bg-primary {
    --bs-bg-opacity: 1;
    background-color: rgb(25 57 209) !important;
} 


.bg-primary2 {
    --bs-bg-opacity: 1;
    background-color: #008476 !important;
} 


.bg-primary3 {
    --bs-bg-opacity: 1;
    background-color: #805475 !important;
} 


.bg-primary4 {
    --bs-bg-opacity: 1;
    background-color: #2a3042 !important;
} 


.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.0rem 1.0rem !important;
}




.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}

.media-body {
     
    margin-left: 25 !important;
}


  </style>

 


 
 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right ">
                                        <strong class="text-danger"><?php echo e(session::get('Email')); ?></strong>
                                         
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



 <?php if(session('error')): ?>

<div class="alert alert-<?php echo e(Session::get('class')); ?> p-3" id="success-alert">
                    
                  <?php echo e(Session::get('error')); ?> 
                </div>

<?php endif; ?>

  <?php if(count($errors) > 0): ?>
                                 
                            <div >
                <div class="alert alert-danger pt-3 pl-0   border-3 bg-danger text-white">
                   <p class="font-weight-bold"> There were some problems with your input.</p>
                    <ul>
                        
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                </div>

            <?php endif; ?>
 
 

<!--  -->


<?php 

 
$assets = DB::table('v_journal')
    ->select(
        'ChartOfAccountID',
        'ChartOfAccountName',
        DB::raw('SUM(IFNULL(Dr, 0)) as Dr'),
        DB::raw('SUM(IFNULL(Cr, 0)) as Cr'),
        DB::raw('SUM(IFNULL(Dr, 0)) - SUM(IFNULL(Cr, 0)) as balance')
    )
    ->whereIn('Category', ['BANK', 'CASH'])
    // ->when(session('UserType') != 'SuperAdmin', function ($query) {
    //     return $query->where('BranchID', session('BranchID'));
    //   })
    //   ->when(session('UserType') == 'SuperAdmin' && request()->branch_id != null, function ($query) {
    //     // If the user is an Admin and a specific branch ID is provided, filter by that BranchID
    //     return $query->where('BranchID', request()->branch_id);
    //     })
    ->groupBy('ChartOfAccountName', 'ChartOfAccountID')
    ->get();
 
 
 ?>


<!-- /////////////////////// -->

 
    <div class="row">

<?php if(Session::get('UserType')=='Admin' || Session::get('UserType')=='SuperAdmin'): ?>             
            

<?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-2 col-sm-2">
        <div class="card shadow-sm text-center" style="border-top: 2px solid <?php echo e(sprintf('#%06X', mt_rand(0, 0xFFFFFF))); ?>;">
            <div class="card-body">
                <h5 class="card-title"><?php echo e($value->ChartOfAccountName); ?></h5>
                <p class="card-text text-muted"><?php echo e(env('APP_CURRENCY')); ?> <?php echo e(number_format($value->balance)); ?> </p>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
<?php endif; ?>
</div>
 




<?php 

//$today_sale = DB::table('v_journal')
    // ->selectRaw("
    //     SUM(IF(ChartOfAccountID = 110101, Dr, 0)) AS CASH,
    //     SUM(IF(ChartOfAccountID = 110202, Dr, 0)) AS ADCB,
    //     SUM(IF(ChartOfAccountID = 110201, Dr, 0)) AS ENBD,
    //     SUM(IF(ChartOfAccountID = 110101, Dr, 0)) + 
    //     SUM(IF(ChartOfAccountID = 110202, Dr, 0)) + 
    //     SUM(IF(ChartOfAccountID = 110201, Dr, 0)) AS TOTAL_SALE
    // ")
    // ->where('Date', date('Y-m-d'))
    // ->whereNotNull('InvoiceMasterID')
    // ->first();


 ?>


<!-- /////////////////////// -->

 
<!-- end new card -->


                        <div class="row">

 
                               


<!-- 
                                        <div class="col-sm-2">
                                        <div class="card bg-info bg-gradient  ">
                                            <div class="card-body border-primary rounded-top ">
                                                <p class="text-white mb-0"><i class="mdi mdi-account-details-outline h2 text-white align-middle mb-0 me-3"></i> Total Leads </p>

                                                <div class="row ">
                                                     
                                                      <h3 class="text-white text-center"><?php echo e(($lead_summary) ? $lead_summary->Total : 0); ?></h3>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card bg-success bg-gradient ">
                                            <div class="card-body">
                                                <p class="text-white mb-0"><i class="mdi mdi-account-question-outline h2 text-white align-middle mb-0 me-3"></i> Pending Leads </p>

                                                <div class="row">
                                                 <div class="row ">
                                                     
                                                      <h3 class="text-white text-center"><?php echo e(($lead_summary ) ? $lead_summary->Pending : 0); ?></h3>
                                                    
                                                </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card bg-primary bg-gradient ">
                                            <div class="card-body">
                                                <p class="text-white mb-0"><i class="mdi mdi-account-multiple-check-outline h2 text-white align-middle mb-0 me-3"></i> Lead Closed </p>

                                                <div class="row">
                                                  <div class="row ">
                                                     
                                                      <h3 class="text-white text-center"><?php echo e(($lead_summary) ? $lead_summary->leads_won : 0); ?></h3>
                                                    
                                                </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>


                                          <div class="col-sm-2">
                                        <div class="card bg-danger bg-gradient">
                                            <div class="card-body  ">
                                                <p class="text-white mb-0"><i class="mdi mdi-account-off h2 text-white align-middle mb-0 me-3"></i> Leads Lost </p>

                                                <div class="row">
                                                 <div class="row ">
                                                     
                                                      <h3 class="text-white text-center"><?php echo e(($lead_summary) ? $lead_summary->leads_lost : 0); ?></h3>
                                                    
                                                </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-sm-2">
                                        <div class="card bg-warning bg-gradient">
                                            <div class="card-body  ">
                                                <p class="text-white mb-0"><i class="mdi mdi-account-multiple-minus h2 text-white align-middle mb-0 me-3"></i> Rejected Lost </p>

                                                <div class="row">
                                                 <div class="row ">
                                                     
                                                      <h3 class="text-white text-center"><?php echo e(($lead_summary) ? $lead_summary->Rejected : 0); ?></h3>
                                                    
                                                </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>


                                       <div class="col-sm-2">
                                        <div class="card bg-secondary bg-gradient">
                                            <div class="card-body  ">
                                                <p class="text-white mb-0"><i class="mdi mdi-account-cancel h2 text-white align-middle mb-0 me-3"></i> Not Assigned </p>

                                                <div class="row">
                                                 <div class="row ">
                                                     
                                                      <h3 class="text-white text-center"><?php echo e(($lead_summary) ? $leads_unassigned : 0); ?></h3>
                                                    
                                                </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>


                <div class="col-sm-2">
                                        <div class="card bg-primary3 bg-gradient">
                                            <div class="card-body  ">
                                                <p class="text-white mb-0"><i class="mdi mdi-account-cancel h2 text-white align-middle mb-0 me-3"></i> Created Today </p>

                                                <div class="row">
                                                 <div class="row ">
                                                     
                                                      <h3 class="text-white text-center"><?php echo e(($leads_created_today) ? $leads_created_today : 0); ?></h3>
                                                    
                                                </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>


                                        <div class="col-sm-2">
                                        <div class="card bg-primary2 bg-gradient">
                                            <div class="card-body  ">
                                                <p class="text-white mb-0"><i class="mdi mdi-account-cancel h2 text-white align-middle mb-0 me-3"></i> Lead Update Today </p>

                                                <div class="row">
                                                 <div class="row ">
                                                     
                                                      <h3 class="text-white text-center"><?php echo e(($leads_updated_today) ? $leads_updated_today : 0); ?></h3>
                                                    
                                                </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>


                                             <div class="col-sm-2">
                                        <div class="card bg-primary4 bg-gradient">
                                            <div class="card-body  ">
                                                <p class="text-white mb-0"><i class="mdi mdi-account-cancel h2 text-white align-middle mb-0 me-3"></i> Followup Today </p>

                                                
                                                 <div class="row ">
                                                     
                                                      <h3 class="text-white text-center "> <a href="<?php echo e(URL('/AdminDashboard')); ?>" class="text-center text-center  text-white"><?php echo e(($followup) ? $followup : 0); ?></a> </h3>
                                                    
                                                </div>
                                                    
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
 -->

                                    

<?php if(Session::get('UserType')=='Admin'): ?>
                           
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="card bg-primary bg-gradient ">
                                            <div class="card-body border-primary border-top border-3 rounded-top">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-light bg-soft text-primary font-size-18">
                                                            <i class="mdi mdi-passport text-white"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0 text-white">Party Balance</h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4 class="text-center text-white"><a href="<?php echo e(URL('/PartyBalance')); ?>" target="_blank" class="text-white"><?php echo e(number_format($party_balance[0]->Balance,2)); ?>  <?php echo e(env('APP_CURRENCY')); ?></a> </h4>
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                  
                                    <div class="col-sm-3">
                                        <div class="card bg-danger bg-gradient">
                                            <div class="card-body border-danger border-top border-3 rounded-top">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-light bg-soft text-primary font-size-18">
                                                           <i class="mdi mdi-passport text-white"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0 text-white">Today's Income </h5>   <span class=" w-50  text-end text-white">         <?php echo e(date('d-M-Y')); ?></span>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4 class="text-center"><a href="<?php echo e(URL('/SalemanTicketRegister')); ?>" class="text-white" ><?php echo e(($expense[0]->Balance ==null) ? '0' :  number_format($expense[0]->Balance,2)); ?>   <?php echo e(env('APP_CURRENCY')); ?></a> </h4>
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-sm-3">
                                        <div class="card bg-primary2 bg-gradient">
                                            <div class="card-body border-primary2 border-top border-3 rounded-top">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-light bg-soft text-white font-size-18">
                                                            <i class="mdi mdi-calendar-cursor font-size-30 text-white "></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0 text-white">Monthly Income </h5> <span class="text-white w-50  text-end"><?php echo e(date('M-Y')); ?></span>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4 class="text-center"><a href="#" class="text-white"><?php echo e(($invoice_summary[0]->Service ==null) ? '0' :  number_format($invoice_summary[0]->Service,2)); ?> 

 
                                                     <?php echo e(env('APP_CURRENCY')); ?></a> </h4>
                                                    
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="col-sm-3">
                                        <div class="card bg-warning bg-gradient">
                                            <div class="card-body border-warning border-top border-3 rounded-top">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-light bg-soft text-primary font-size-18">
                                                            <i class="mdi mdi-fingerprint text-white"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0 text-white">Current Year P&L </h5> <span class="text-white w-50  text-end"><?php echo e(date('Y')); ?></span>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4 class="text-center text-white"><a href="#" class="text-white"><?php echo e(number_format($profit_loss,2)); ?> <?php echo e(env('APP_CURRENCY')); ?></a> </h4>
                                                    
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
 
 

 


                                </div>
                                <!-- end row -->
                            </div>
                        </div>
 
                       <div class="row">
                           
                            <div class="col-xl-12">
                                <div class="row">
                               


                                     <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body border-secondary border-top border-3 rounded-top">
                                                
                                                <div class="text-muted mt-4">
                                                      <div id="sale_register"></div>
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


  <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body border-secondary border-top border-3 rounded-top">
                                                
                                                <div class="text-muted mt-4">
                                                      <div id="container2"></div>
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                         
                                  
                                       <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body border-secondary border-top border-3 rounded-top">
                                                
                                                <div class="text-muted mt-4">
                                                      <div id="container4"></div>
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


            
  <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body border-secondary border-top border-3 rounded-top">
                                                
                                                <div class="text-muted mt-4">
                                                      <div id="sale_report"></div>
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



  <div class="col-sm-6">
    <div class="card">
        <div class="card-body border-secondary border-top border-3 rounded-top">
            
            <div class="text-muted mt-4">
                  <div id="container3"></div>
                <div class="d-flex">
                     <span class="ms-2 text-truncate mt-3"> </span>
                </div>
            </div>
        </div>
    </div>
</div>
                  <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body border-secondary border-top border-3 rounded-top">
                                                
                                                <div class="text-muted mt-4">
                                                      <div id="container"></div>
                                                    <div class="d-flex">
                                                         <span class="ms-2 text-truncate mt-3"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  
                                   
                    </div>



 
<?php endif; ?>
 
                    
                                    
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

   
<script>
    
    Highcharts.chart('container2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly Income & Expense'
    },
   
    xAxis: {
        categories: [
           

<?php $__currentLoopData = $cash1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

 
    
    '<?php echo e($value->Date); ?>',
 
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Amount'
        }
    },
  
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [  

     {
        name: 'Income',
        data: [

 <?php $__currentLoopData = $cash1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

 
    
    <?php echo e($value->Rev); ?>,
 
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        ]

    }, {
        name: 'Expense',
        data: [

        <?php $__currentLoopData = $cash1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

 
    
    <?php echo e($value->Exp); ?>,
 
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 ]

    }],
      credits: {
    enabled: false
  },
});
</script>


<script>
    
    Highcharts.chart('sale_register', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Saleman Ticket Register'
    },

     subtitle: {
        text:
        '<a href="<?php echo e(URL('/SalemanTicketRegister')); ?>" target="_default">DETAIL REPORT</a>'
    },
   
    xAxis: {
        categories:  <?php echo json_encode($ticket_register->pluck('SalemanName')); ?>,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Amount'
        },

        plotLines: [{
                        color: 'red', // Line color
                        value: <?php echo e($avg); ?>, // Target value
                        width: 2, // Line width
                        label: {
                             text: '<?php echo e(number_format($avg,2)); ?>', // Label text
                            align: 'right',
                            style: {
                                color: 'red'
                            }
                        }
                    }]
                
    },
  
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },


    series: [  

    //  {
    //     name: 'Sale',
    //     data: <?php echo json_encode($ticket_register->pluck('TotalInvoices')); ?>,

    // }, 

    {
        name: 'Net Profit',
        data:<?php echo json_encode($ticket_register->pluck('Service')); ?>,

    }],
      credits: {
    enabled: false
  },
});
</script>



    <script type="text/javascript">//<![CDATA[


Highcharts.chart('container', {

   title: {
        text: 'Cash Flow'
    },
   

    yAxis: {
        title: {
            text: 'Amount'
        }
    },

  xAxis: {
        categories: [
           <?php $__currentLoopData = $v_cashflow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           '<?php echo e($value->MonthName); ?>',
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
        // crosshair: true
    },

    

    

    series: [{
        // name: 'CashFlow',
        showInLegend: false,     
        name: ' ',
        data: [<?php $__currentLoopData = $v_cashflow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <?php echo e($value->Balance); ?>,
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>]
    } ],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    },
    credits: {
    enabled: false
  },

});


  //]]></script>


 



    <script> 

  // Create the chart
Highcharts.chart('container3', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Expenses'
    },
    

    accessibility: {
        announceNewData: {
            enabled: true
        },
        point: {
            valueSuffix: ''
        }
    },

    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.1f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> <br/>'
    },

    series: [
        {
            // name: "Browsers",
            colorByPoint: true,
            data: [
              

<?php $__currentLoopData = $exp_chart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      
           
  {

                    name:'<?php echo e($value->ChartOfAccountName); ?>',
                    y: <?php echo e($value->Balance); ?>,
                     },

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                   
               
               
                
            ]
        }
    ],
     
});


  </script>


 

 <script>
     // Create the chart
Highcharts.chart('container4', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Cash Summary'
    },
   
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Amount'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },

    

    series: [
        {
            name: "",
            colorByPoint: true,
            data: [




 <?php $__currentLoopData = $cash; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

{
    name:"<?php echo e($value->ChartOfAccountName); ?>",
                     y: <?php echo e(($value->Balance)); ?>,
},
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                
                
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            {
                name: "Chrome",
                id: "Chrome",
                data: [
                    [
                        "v65.0",
                        0.1
                    ],
                    [
                        "v64.0",
                        1.3
                    ],
                    [
                        "v63.0",
                        53.02
                    ],
                    [
                        "v62.0",
                        1.4
                    ],
                    [
                        "v61.0",
                        0.88
                    ],
                    [
                        "v60.0",
                        0.56
                    ],
                    [
                        "v59.0",
                        0.45
                    ],
                    [
                        "v58.0",
                        0.49
                    ],
                    [
                        "v57.0",
                        0.32
                    ],
                    [
                        "v56.0",
                        0.29
                    ],
                    [
                        "v55.0",
                        0.79
                    ],
                    [
                        "v54.0",
                        0.18
                    ],
                    [
                        "v51.0",
                        0.13
                    ],
                    [
                        "v49.0",
                        2.16
                    ],
                    [
                        "v48.0",
                        0.13
                    ],
                    [
                        "v47.0",
                        0.11
                    ],
                    [
                        "v43.0",
                        0.17
                    ],
                    [
                        "v29.0",
                        0.26
                    ]
                ]
            },
            {
                name: "Firefox",
                id: "Firefox",
                data: [
                    [
                        "v58.0",
                        1.02
                    ],
                    [
                        "v57.0",
                        7.36
                    ],
                    [
                        "v56.0",
                        0.35
                    ],
                    [
                        "v55.0",
                        0.11
                    ],
                    [
                        "v54.0",
                        0.1
                    ],
                    [
                        "v52.0",
                        0.95
                    ],
                    [
                        "v51.0",
                        0.15
                    ],
                    [
                        "v50.0",
                        0.1
                    ],
                    [
                        "v48.0",
                        0.31
                    ],
                    [
                        "v47.0",
                        0.12
                    ]
                ]
            },
            {
                name: "Internet Explorer",
                id: "Internet Explorer",
                data: [
                    [
                        "v11.0",
                        6.2
                    ],
                    [
                        "v10.0",
                        0.29
                    ],
                    [
                        "v9.0",
                        0.27
                    ],
                    [
                        "v8.0",
                        0.47
                    ]
                ]
            },
            {
                name: "Safari",
                id: "Safari",
                data: [
                    [
                        "v11.0",
                        3.39
                    ],
                    [
                        "v10.1",
                        0.96
                    ],
                    [
                        "v10.0",
                        0.36
                    ],
                    [
                        "v9.1",
                        0.54
                    ],
                    [
                        "v9.0",
                        0.13
                    ],
                    [
                        "v5.1",
                        0.2
                    ]
                ]
            },
            
              
        ]
    }
});
       


// sale report chart

  

 Highcharts.chart('sale_report', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Item Wise Sale'
    },
    tooltip: {
        valueSuffix: ''
    },

     subtitle: {
        text:
        '<a href="<?php echo e(URL('/ItemWiseSale')); ?>" target="_default">DETAIL REPORT</a>'
    },


     
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.2em',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        }
    },
    series: [
        {
            name: 'No of sale ',
            colorByPoint: true,
            data: [
              


            <?php $__currentLoopData = $sale_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    name: "<?php echo e($value->ItemName); ?>",
                    y: <?php echo e($value->Total); ?>

                },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
              
             
            ]
        }
    ]
});




// end of sale report chart


 </script>



                                </div>
                                <!-- end row -->
                            </div>
                        </div>
 
                           

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
       
                
            </div>

  <?php $__env->stopSection(); ?>
<?php echo $__env->make('template.tmp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u790884004/domains/xtbooks.cloud/public_html/the-oasis-travels/resources/views/dashboard.blade.php ENDPATH**/ ?>