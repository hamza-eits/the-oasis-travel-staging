<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Invoice</title>
    <style type="text/css">
        @page {
            margin-top: 0.5cm;
            margin-bottom: 0.5cm;
            margin-left: 0.4cm;
            margin-right: 0.4cm;
        }


        body {

            background: #fff;
            color: #000;
            font-family: 'Open Sans', 'Arial', 'Helvetica', sans-serif, 'Tahoma', 'Amiri', sans-serif;
            /* Arabic font */
            font-size: 10pt;
            line-height: 100%;
        }

        .paid-invoice-img {
            position: absolute;
            top: 0;
            right: 0;
            margin-bottom: 20px;
            /* Adjust the value as needed */
            z-index: 9999;
            float: right;
        }

        .style3 {
            color: #FFFFFF
        }
    </style>
</head>

<body onload="window.print();">
    @if ($balance > 0)
        <img align="right" src="{{ asset('assets/images/unpaid-invoice.png') }}" alt="" class="paid-invoice-img">
    @else
        <img align="right" src="{{ asset('assets/images/paid-invoice.png') }}" alt="" class="paid-invoice-img">
    @endif
    <table width="100%" border="0" style="margin-top: 0px;">
        <tr>
            <th width="50%" scope="col" align="left" style="vertical-align: top;">
                <img src="{{ asset('documents/' . $company->Logo) }}" alt="" width="{{ env('APP_LOGO_WIDTH') }}"
                    height="{{ env('APP_LOGO_HEIGHT') }}">
            </th>

            <th width="50%" scope="col">&nbsp;</th>
        </tr>
        <tr>
            <td width="50%" style="line-height: 12pt">
                {{ $company->Address }}<br />
                {{ $company->Contact }}<br>
                {{ $company->Email }}<br>
                {{ $company->TRN }}<br>
            </td>
            <td>

            </td>

        </tr>
        <tr>
            <td></td>
            <td width="50%" align="right" style="font-size: 28pt; font-weight: bolder;">
                <br><br>
                {{ strtoupper(env('APP_INVOICE_LABEL')) }}

            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <div align="right" style="margin-top: 15px;"><strong>Balance Due<br />
                        {{ env('APP_CURRENCY') }} {{ number_format($invoice_mst[0]->Balance, 2) }}</strong></div><br>
            </td>
        </tr>
    </table>

    <table width="100%" border="0">
        <tr>
            <th width="50%" valign="bottom" scope="col">
                <div align="left">Bill To<br />
                    {{ $invoice_mst[0]->PartyName }} <br />
                    {{ $invoice_mst[0]->Phone }} <br>
                    {{ $invoice_mst[0]->TRN }}
                </div>
            </th>
            <th width="50%" scope="col">
                <div align="right">
                    <table width="75%" border="0" align="right">
                        <tr>
                            <th align="right" style="text-align:right;">{{ env('APP_INVOICE_LABEL') }} No :</th>
                            <td align="right" style="text-align:right;">{{ $invoice_mst[0]->InvoiceCode }}</td>
                        </tr>
                        <tr>
                            <th align="right" style="text-align:right;">Invoice Date :</th>
                            <td align="right" style="text-align:right;">{{ $invoice_mst[0]->Date }}</td>
                        </tr>
                        <tr>
                            <td align="right" style="text-align:right;">Terms :</td>
                            <td align="right" style="text-align:right;">Due on Receipt</td>
                        </tr>
                        <tr>
                            <td align="right" style="text-align:right;">Due Date :</td>
                            <td align="right" style="text-align:right;">{{ $invoice_mst[0]->DueDate }}</td>
                        </tr>


                    </table>
                </div>
            </th>
        </tr>

    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr style="color: white; ">
            <td align="center" height="25" bgcolor="#333333">#</p>
            </td>
            <td align="center" bgcolor="#333333">Item Descrption </p>
            </td>
            {{-- <td align="center" bgcolor="#333333" >Taxable<br /> Amount</p></td> --}}
            <td align="center" bgcolor="#333333">{{ env('APP_TAX_NAME') }}</p>
            </td>
            <td align="center" bgcolor="#333333">Amount</p>
            </td>
        </tr>

        <?php
        
        $service = 0;
        $taxable = 0;
        $total = 0;
        
        ?>

        @foreach ($invoice_det as $key => $value)
            <?php
            
            $service = $service + $value->Service;
            $taxable = $taxable + $value->Taxable;
            $total = $total + $value->Total;
            
            ?>

            <tr>
                <td>{{ ++$key }}</td>
                <td style="padding-top: 10px;">{{ $value->ItemName }}
                    @if ($value->PaxName)
                        <br><strong>PAX:</strong> {{ $value->PaxName }}
                    @endif

                    @if ($value->PNR)
                        <br><strong>PNR:</strong> {{ $value->PNR }}
                    @endif

                    @if ($value->Sector)
                        <br><strong>Sector:</strong> {{ $value->Sector }}
                    @endif

                    @if ($value->Passport)
                        <br><strong>Passport #:</strong> {{ $value->Passport }}
                    @endif

                    @if ($value->TicketNo)
                        <br><strong>Ticket #:</strong> {{ $value->TicketNo }}
                    @endif

                    {{-- @if ($value->AirlineName)
                        <br><strong>Airline:</strong> {{ $value->AirlineName }}
                    @endif --}}

                    @if ($value->DepartureDate)
                        <br><strong>Departure Date:</strong> {{ dateformatman2($value->DepartureDate) }}
                    @endif

                </td>
                {{-- <td align="center">{{number_format($value->Service,2)}}</td> --}}
                <td align="center">{{ $value->Taxable > 0 ? number_format($value->Taxable, 2) : '' }} </td>
                <td align="center">{{ number_format($value->Total, 2) }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="4">
                <hr noshade="noshade" />
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="right"><strong>SubTotal</strong></td>
            {{-- <td align="center">{{number_format($service,2)}}</td> --}}
            <td align="center">{{ $taxable > 0 ? number_format($taxable, 2) : '' }}</td>
            <td align="center">{{ number_format($total, 2) }}</td>

        </tr>
        <tr>
            <td colspan="4">
                <hr noshade="noshade" />
            </td>
        </tr>
        <tr width="100%">
            <td colspan="2" width="49%">
                <table width="100%" border="0" align="left">

                    <tr>
                        <td height="25" align="left" style="padding-right: 25px;">
                            <div style="line-height: 18px">
                                {!! nl2br(e($company->DigitalSignature)) !!}
                            </div>
                        </td>
                    </tr>


                </table>
            </td>
            <td colspan="2" width="49%">
                <table width="100%" border="0" align="right">

                    <tr>
                        <td height="25" align="right" style="padding-right: 25px;"><strong>Total</strong></td>
                        <td height="25">
                            <strong>{{ env('APP_CURRENCY') }}{{ number_format($invoice_mst[0]->Total, 2) }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td height="25" align="right" style="padding-right: 25px;">Payment Made </td>
                        <td style="color: red;"> (-) {{ number_format($invoice_mst[0]->Paid, 2) }} </td>
                    </tr>
                    <tr style="background-color: #e9e9e9;">
                        <td height="25" align="right" style="padding-right: 25px;"><strong>Balance Due</strong>
                        </td>
                        <td height="25"><strong>{{ env('APP_CURRENCY') }}
                                {{ number_format($invoice_mst[0]->Balance, 2) }}</strong></td>
                    </tr>

                    <tr>
                        <td height="25" align="right" style="padding-right: 25px;"><strong>Payment Mode</strong>
                        </td>
                        <td height="25"><strong>{{ $invoice_mst[0]->PaymentMode }}</strong></td>
                    </tr>



                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p>Notes</p>
                <p>Thanks for your business.</p>
                <hr noshade="noshade" />
            </td>
        </tr>
    </table>
</body>

</html>
