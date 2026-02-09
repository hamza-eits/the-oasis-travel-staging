<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Party List</title>
    <style type="text/css">
<!--
.style1 {font-size: 20px}
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
    </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
	

  <?php
  $company = DB::table('company')->first();
  ?>


<div align="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2"><div align="center" class="style1"><?php echo e($company->Name); ?> </div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><strong>LIST OF PARTIES </strong></div></td>
    </tr>
    <tr>
      <td width="50%">DATED: <?php echo e(date('d-m-Y')); ?></td>
      <td width="50%">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse:collapse;">
    <tr>
      <td width="3%" bgcolor="#CCCCCC"><div align="center"><strong>S.NO</strong></div></td>
      <td width="25%" bgcolor="#CCCCCC"><div align="center"><strong>NAME</strong></div></td>
      <td width="36%" bgcolor="#CCCCCC"><div align="center"><strong>ADDRESS</strong></div></td>
      <td width="32%" bgcolor="#CCCCCC"><div align="center"><strong>PHONE/MOBILE NUMBER </strong></div></td>
      <td width="32%" bgcolor="#CCCCCC"><div align="center"><strong>EMAIL </strong></div></td>
    </tr>
   <?php $__currentLoopData = $party; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   	
    
    <tr>
      <td><div align="center"><?php echo e($key+1); ?>.</div></td>
      <td><?php echo e($value->PartyName); ?></td>
      <td><?php echo e($value->Address); ?></td>
      <td><?php echo e($value->Phone); ?></td>
      <td><?php echo e($value->Email); ?></td>
      
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </table>
  <p>&nbsp;</p>
</div>
</body>
</html><?php /**PATH /home/u790884004/domains/xtbooks.cloud/public_html/the-oasis-travels/resources/views/reports/party_listPDF.blade.php ENDPATH**/ ?>