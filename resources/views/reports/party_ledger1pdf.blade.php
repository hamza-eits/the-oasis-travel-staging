<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pagetitle }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .company-logo {
            width: {{ env('APP_LOGO_WIDTH', '100px') }};
            height: {{ env('APP_LOGO_HEIGHT', 'auto') }};
        }

        .company-details {
            flex: 1;
            text-align: center;
        }

        .company-details .name {
            font-size: 20px;
            font-weight: bold;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
        }

        .party-info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .transaction-table th,
        .transaction-table td {
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

    @php
        $company = DB::table('company')->first();
        $openingBalance = $sql[0]->Balance ?? 0;
        $DrTotal = 0;
        $CrTotal = 0;
        $balance = null;
    @endphp
</head>
<body>

    <!-- Header (Table Layout for DOMPDF Compatibility) -->
<table width="100%" style="border-bottom: 2px solid #000; padding-bottom: 10px;">
    <tr>
        <!-- Logo (left) -->
        <td style="width: 25%; vertical-align: top;">
            <img src="{{ asset('documents/'.$company->Logo) }}" alt="Company Logo"
                 style="width: {{ env('APP_LOGO_WIDTH', '100px') }}; height: {{ env('APP_LOGO_HEIGHT', 'auto') }};">
        </td>

        <!-- Company Details (center) -->
        <td style="text-align: center; width: 50%;">
            <div style="font-size: 20px; font-weight: bold;">{{ $company->Name }}</div>
            <div>{{ $company->Address }}</div>
            <div>{{ $company->Mobile }}</div>
            <div>{{ $company->Contact }}</div>
        </td>

        <!-- Empty space to balance layout (right) -->
        <td style="width: 25%;"></td>
    </tr>
</table>

<!-- Party Info (Table for consistent inline layout) -->
<table width="100%" style="margin-top: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
    <tr>
        <td style="text-align: left;">
            <div><strong>Party Details</strong></div>
            <div><strong>{{ $party[0]->PartyName }} ({{ $party[0]->PartyID }})</strong></div>
            <div>{{ $party[0]->Address }}</div>
            <div>{{ $party[0]->Phone }}</div>
        </td>
        <td style="text-align: right;">
            <strong>From:</strong> {{ Session::get('StartDate') }}<br>
            <strong>To:</strong> {{ Session::get('EndDate') }}
        </td>
    </tr>
</table>



    <!-- Transactions -->
    @if(count($journal) > 0)
        <table class="transaction-table">
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
                  <td>{{ number_format($openingBalance, 2) }}</td>
                </tr>

                <!-- Transactions -->
                @foreach ($journal as $entry)
                    @php
                        $balance = is_null($balance)
                            ? $openingBalance + ($entry->Dr - $entry->Cr)
                            : $balance + ($entry->Dr - $entry->Cr);

                        $DrTotal += $entry->Dr;
                        $CrTotal += $entry->Cr;
                    @endphp
                    <tr>
                        <td class="text-center">{{ dateformatman($entry->Date) }}</td>
                        <td class="text-center">{{ $entry->VHNO }}</td>
                        <td class="text-center">{{ $entry->JournalType }}</td>
                        <td class="text-left">{{ $entry->Narration }}</td>
                        <td>{{ $entry->Dr ? number_format($entry->Dr, 2) : '' }}</td>
                        <td>{{ $entry->Cr ? number_format($entry->Cr, 2) : '' }}</td>
                        <td>
                            {{ number_format(abs($balance), 2) }}
                            {{ $balance >= 0 ? 'DR' : 'CR' }}
                        </td>
                    </tr>
                @endforeach

                <!-- Totals -->
                <tr class="text-bold">
                    <td colspan="4" class="text-center">TOTAL</td>
                    <td>{{ number_format($DrTotal, 2) }}</td>
                    <td>{{ number_format($CrTotal, 2) }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @else
        <div class="no-data">No transaction data found.</div>
    @endif

</body>
</html>
