<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Ledger</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 20px;
        }

        .header-table, .party-info-table, .transaction-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td, .party-info-table td {
            padding: 5px;
        }

        .header-title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .sub-title {
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
        }

        .transaction-table th, .transaction-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: right;
        }

        .transaction-table th {
            background-color: #A6A6A6;
            font-weight: bold;
        }

        .transaction-table td.text-left {
            text-align: left;
        }

        .transaction-table td.text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .no-data {
            color: red;
            text-align: center;
            margin-top: 30px;
            font-weight: bold;
        }
    </style>

    <?php
        $company = DB::table('company')->first();
        $DrTotal = 0;
        $CrTotal = 0;
        $balance = null;
        $openingBalance = $sql[0]->Balance ?? 0;
    ?>
</head>
<body>

    <!-- Header -->
    <table class="header-table">
        <tr>
            <td colspan="2" class="header-title"><?php echo e($company->Name); ?></td>
        </tr>
        <tr>
            <td colspan="2" class="sub-title">PARTY LEDGER</td>
        </tr>
        <tr>
            <td colspan="2" class="sub-title"><?php echo e($supplier[0]->SupplierID); ?> - <?php echo e($supplier[0]->SupplierName); ?></td>
        </tr>
        <tr>
            <td>DATED: <?php echo e(date('d-m-Y')); ?></td>
            <td style="text-align: right;">
                From <?php echo e(request()->StartDate); ?> TO <?php echo e(request()->EndDate); ?>

            </td>
        </tr>
    </table>

    <!-- Transactions -->
    <?php if(count($journal) > 0): ?>
        <table class="transaction-table" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th class="text-center">DATE</th>
                    <th class="text-center">VHNO</th>
                    <th class="text-center">TYPE</th>
                    <th class="text-left">DESCRIPTION</th>
                    <th>DR</th>
                    <th>CR</th>
                    <th>BALANCE</th>
                </tr>
            </thead>
            <tbody>
                <!-- Opening Balance -->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-left">Opening Balance</td>
                    <td></td>
                    <td></td>
                    <td><?php echo e(number_format($openingBalance, 2)); ?></td>
                </tr>

                <!-- Transactions -->
                <?php $__currentLoopData = $journal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        if (is_null($balance)) {
                            $balance = $openingBalance + ($entry->Dr - $entry->Cr);
                        } else {
                            $balance += ($entry->Dr - $entry->Cr);
                        }
                        $DrTotal += $entry->Dr;
                        $CrTotal += $entry->Cr;
                    ?>
                    <tr>
                        <td class="text-center"><?php echo e(dateformatman($entry->Date)); ?></td>
                        <td class="text-center"><?php echo e($entry->VHNO); ?></td>
                        <td class="text-center"><?php echo e($entry->JournalType); ?></td>
                        <td class="text-left"><?php echo e($entry->Narration); ?></td>
                        <td><?php echo e($entry->Dr ? number_format($entry->Dr, 2) : ''); ?></td>
                        <td><?php echo e($entry->Cr ? number_format($entry->Cr, 2) : ''); ?></td>
                        <td>
                            <?php echo e(number_format(abs($balance), 2)); ?>

                            <?php echo e($balance >= 0 ? 'DR' : 'CR'); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!-- Totals -->
                <tr class="text-bold">
                    <td colspan="4" class="text-center">TOTAL</td>
                    <td><?php echo e(number_format($DrTotal, 2)); ?></td>
                    <td><?php echo e(number_format($CrTotal, 2)); ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-data">No transaction data found.</div>
    <?php endif; ?>

</body>
</html>
<?php /**PATH /home/u790884004/domains/xtbooks.cloud/public_html/the-oasis-travels/resources/views/reports/supplier_ledger1pdf.blade.php ENDPATH**/ ?>