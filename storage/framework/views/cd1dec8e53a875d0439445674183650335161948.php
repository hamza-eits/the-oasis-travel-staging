<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo e($pagetitle); ?></title>
    <style type="text/css">
<!--
.style1 {font-size: 20px}
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
    </style>

    <?php 

$company = DB::table('company')->first();

     ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
	
<div align="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2"><div align="center" class="style1"><?php echo e($company->Name); ?> </div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><strong>GENERAL LEDGER </strong></div></td>
    </tr>
    <tr>
      <td width="50%">From <?php echo e(request()->StartDate); ?> to <?php echo e(request()->EndDate); ?></td>
	  <td width="50%"><div align="right">DATED: <?php echo e(date('d-m-Y')); ?></div></td>
    
    </tr>
  </table>

   <?php 
            $DrTotal=0;
            $CrTotal=0;
             ?>

             
  <?php if(count($journal)>0): ?>    
          <table width="100%" border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
          <tbody><tr bgcolor="#CCCCCC">
          <th class="col-md-1 text-center">DATE</th>
          <th class="col-md-1 text-center" >VHNO</th>
          <th class="col-md-2 text-center">AC</th>
          <th class="col-md-4 text-center">Description</th>
          <th class="col-md-1 text-center">DEBIT</th>
          <th class="col-md-1 text-center">CREDIT</th>
          <th class="col-md-1 text-center">Balance</th>
          <th class="col-md-1 text-center">PARTY</th>
          <th class="col-md-1 text-center">SUPPLIER</th> 
           </tr>
          </tbody>
          <tbody>
            <tr> 
            <td></td>
            <td></td>
            <td></td>
            <td>By Balance Brought Forward</td>
            <td><div align="right"></div></td>
            <td><div align="right"></div></td>
            <td class="text-danger text-end"><div align="right"><?php echo e($sql[0]->Balance); ?></div></td>
            <td></td>
            <td></td>
          <?php $__currentLoopData = $journal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr>
           <td class="text-center"><?php echo e(dateformatman($value->Date)); ?></td>
           <td class="text-center"><?php echo e($value->VHNO); ?></td>
           <td class="text-center"><?php echo e($value->ChartOfAccountName); ?></td>
           <td ><?php echo e($value->Narration); ?></td>
           <td class="text-end"><div> 
             <div align="right"><?php echo e(($value->Dr==0) ? '' : number_format($value->Dr,2)); ?></div>
           </div></td>
           <td class="text-end"><div> 
             <div align="right"><?php echo e(($value->Cr==0) ? '' : number_format($value->Cr,2)); ?></div>
           </div></td>
              <td class="text-end">
               

                <div align="right">
                  <?php 

if(!isset($balance)) { 

             $balance  =  $sql[0]->Balance + ($value->Dr-$value->Cr);
             $DrTotal = $DrTotal+$value->Dr;
             $CrTotal = $CrTotal+$value->Cr;
             echo number_format($balance,2);


}
else
{
  $balance = $balance + ($value->Dr-$value->Cr);
  $DrTotal = $DrTotal+$value->Dr;
             $CrTotal = $CrTotal+$value->Cr;
   echo number_format($balance,2);
}
              ?>
             <?php echo e(($balance>0) ? "DR" : "CR"); ?> </div></td>
           <td class="text-center"><div align="center"><?php echo e($value->PartyID); ?></div></td>
           <td class="text-center"><div align="center"><?php echo e($value->SupplierID); ?></div></td>
           </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
          <tr  class="table-active">
              
           <td></td>
           <td></td>
           <td bgcolor="#CCCCCC"><strong>TOTAL</strong></td>
            <td bgcolor="#CCCCCC" class="text-end"></td>
           <td bgcolor="#CCCCCC" class="text-end fw-bolder"><div align="right"><strong><?php echo e(number_format($DrTotal,2)); ?></strong></div></td>
           <td bgcolor="#CCCCCC" class="text-end fw-bolder"><div align="right"><strong><?php echo e(number_format($CrTotal,2)); ?></strong></div></td>
            
            <td bgcolor="#CCCCCC" class="text-end fw-bolder"> <div align="right"><strong><?php echo e(number_format($balance)); ?> <?php echo e(($balance>0) ? "DR" : "CR"); ?></strong></div></td>
            <td class="text-end"></td>
            <td class="text-end"></td>
          </tr>
           </tbody>
  </table>
           <?php else: ?>
             <p class=" text-danger">No data found</p>
           <?php endif; ?> 
</div>
</body>
</html><?php /**PATH /home/u790884004/domains/xtbooks.cloud/public_html/the-oasis-travels/resources/views/reports/general_ledger1pdf.blade.php ENDPATH**/ ?>