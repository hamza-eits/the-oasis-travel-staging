<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt Voucher</title>
    <style>
        @page {
            size: 210mm 148.5mm; /* Half A4 portrait */
            margin: 5mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
        }

        .container {
            width: 100%;
        }

        .receipt-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;

        }

        .table-payment {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-payment td, .table-payment th {
            border: 1px solid black;
            padding: 8px;
            vertical-align: top;
        }

        .signature-stamp {
            margin-top: 40px;
        }

        .signature-stamp td {
            width: 50%;
            vertical-align: top;
        }

        .signature-img,
        .stamp-img {
            height: 60px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        hr {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .logo{
            width: 150px;
            height: 100px;
        }
    </style>
</head>
<body>
    
    <?php
        $voucher = DB::table('v_voucher_detail')->where('VoucherMstID',$voucher_master[0]->VoucherMstID)->get();

        $party = DB::table('party')->where('PartyID',$voucher[0]->PartyID)->first();
        
        $chartOfAccount = DB::table('chartofaccount')->where('ChartOfAccountID',$voucher[0]->ChOfAcc)->first();

        $bankName = $chartOfAccount->Category == 'BANK' ? $chartOfAccount->ChartOfAccountName : 'Cash Transaction';
        $company = DB::table('company')->first();

        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
        $amountInWords = ucwords($formatter->format($voucher[0]->Debit)) . ' Only';

    ?>
<div class="container">
    <div class="header">
        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <div class="logo">
                        <img class="logo" src="<?php echo e(asset('documents/'.$company->Logo)); ?>" alt="Logo">
                    </div>
                </td>
               
                <td style="width: 50%; vertical-align: top;">
                    <div class="company-details" style="text-align: right;">
                        <h2><?php echo e($company->Name); ?></h2>
                        <p style="margin: 0;">
                            <?php echo e($company->Mobile); ?><br>
                            <?php echo e($company->Email); ?><br>
                            <?php echo e($company->Address); ?><br>
                           
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <hr>

    <div class="receipt-title" >Receipt Voucher</div>

    <table class="table-payment">
        <tr>
            <th>Voucher No</th>
            <td><?php echo e($voucher_master[0]->Voucher); ?></td>
            <th>Date</th>
            <td><?php echo e(date('d-m-Y', strtotime($voucher[0]->Date))); ?></td>
        </tr>
        <tr>
            <th>Received From</th>
            
            <td colspan="3"><?php echo e($party->PartyName); ?> </td>
        </tr>
        <tr>
            <th>Amount</th>
            <td colspan="3"><b><?php echo e(env('APP_CURRENCY')); ?>  <?php echo e(number_format($voucher[0]->Debit, 2)); ?></b></td>
        </tr>
        <tr>
            <th>The Sum of <?php echo e(env('APP_CURRENCY')); ?> </th>
            <td colspan="3"><i> <?php echo e($amountInWords); ?></i></td>
        </tr>
        <tr>
            <th>Payment Mode</th>
            <td>Bank Receipt</td>
            
            <th>Reference</th>
            <td><?php echo e($voucher[0]->RefNo != '' ? $voucher[0]->RefNo : '-'); ?></td>
        </tr>
        <tr>
            <th>Purpose / Remarks</th>
            <td colspan="3">
                <?php echo e($voucher[0]->Narration); ?>


            </td>
        </tr>
    </table>

    <!-- Signature and Stamp Area -->
<footer style="position: fixed; bottom: 40px; left: 0; right: 0; width: 100%;">
    <table style="width: 100%; margin-top: 10px; border-collapse: collapse; text-align: center;">
        <tr>
            <td style="width: 6%;"></td>

            <!-- Signature Label -->
            <td style="width: 20%; vertical-align: bottom; font-weight: bold;">Signature</td>

            <!-- Signature Image and Line -->
            <td style="width: 20%; border-bottom: 1px solid #000; vertical-align: bottom; padding: 5px 0;">
                
            </td>

            <!-- Stamp Label -->
            <td style="width: 20%; vertical-align: bottom; font-weight: bold;">Stamp</td>

            <!-- Stamp Image and Line -->
            <td style="width: 20%; border-bottom: 1px solid #000; vertical-align: bottom; padding: 5px 0;">
                
            </td>

            <td style="width: 14%;"></td>
        </tr>
    </table>
</footer>



</div>

</div>
</body>
</html>

<!--
AMIN UR REHMAN Managing Director
☎ +971 4 388 5983
+971 56 105 7202
3
MZK
Technical Services Co. LLC
amin@mzkgroups.ae
www.mzkgroups.ae
QOffice No. 20 (Floor 35th), Al Saqr
Business Tower, Sheikh Zayed Road, Dubai-UAE
3
MZK
Group Of Companies
-->
<?php /**PATH /home/u790884004/domains/xtbooks.cloud/public_html/the-oasis-travels/resources/views/voucher_receipt_view.blade.php ENDPATH**/ ?>