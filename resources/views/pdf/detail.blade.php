<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cybernaptics</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="{{public_path('cybernapticslogo.png')}}" style="width: 100%; max-width: 300px" />
                        </td>

                        <td>
                            BI No: {{$data[0]['id']}}<br />
                            Date: {{date('j F Y', strtotime($data[0]['created_at']))}} <br/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            Freeport zone 5<br />
                            Mer Rouge, Port-Louis<br />
                            Mauritius
                        </td>

                        <td>
                            Cybernaptics Ltd<br />
                            +230 2063950<br />
                            info@cybernaptics.com
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Client Information</td>

            <td></td>
        </tr>

        <tr class="item">
            <td>Client Name</td>

            <td>{{$data[0]['client']}}</td>
        </tr>

        <tr class="item">
            <td>Client Contact</td>

            <td>{{$data[0]['client_contact_no']}}</td>
        </tr>

        <tr class="item last">
            <td>Client Email</td>

            <td>{{$data[0]['client_email']}}</td>
        </tr>
        <br>
        <tr class="heading">
            <td>Product Information</td>

            <td></td>
        </tr>

        <tr class="item">
            <td>Product</td>

            <td>{{$data[0]['product']}}</td>
        </tr>

        <tr class="item">
            <td>Model</td>

            <td>{{$data[0]['model']}}</td>
        </tr>

        <tr class="item">
            <td>Serial Number</td>

            <td>{{$data[0]['serial_no']}}</td>
        </tr>

        <tr class="item">
            <td>Cyber Serial No1</td>

            <td>{{$data[0]['cyber_serial_no1']}}</td>
        </tr>

        <tr class="item">
            <td>Cyber Serial No2</td>

            <td>{{$data[0]['cyber_serial_no2']}}</td>
        </tr>

        <tr class="item">
            <td>Warranty</td>

            <td>{{$data[0]['warranty']==0?'No':'Yes'}}</td>
        </tr>

        <tr class="item">
            <td>Invoice Number</td>

            <td> {{$data[0]['invoice_no']==null?'None':$data[0]['invoice_no']}}</td>
        </tr>

        <tr class="item last">
            <td>Accessories</td>

            <td>{{$data[0]['accessories']==null?'None':$data[0]['accessories']}}</td>
        </tr>


        <br>
        <tr class="heading">
            <td>Problem Description</td>

            <td></td>
        </tr>

        <tr class="item">
            <td>Ticket Number</td>

            <td>{{$data[0]['ticket_no']==null?'Not Assigned':$data[0]['ticket_no']}}</td>
        </tr>

        <tr class="item">
            <td>Problem</td>

            <td>{{$data[0]['problem_desc']}}</td>
        </tr>

        <tr class="item last">
            <td>Taken By</td>

            <td>{{$data[0]['taken_by_name']}}</td>
        </tr>

        @if($data[0]['diagnostic_date']!=null)
            <br>
            <br>
        <tr class="heading">
            <td>Diagnostic</td>

            <td></td>
        </tr>

        <tr class="item">
            <td>Diagnostic Date</td>

            <td>{{date('j F Y', strtotime($data[0]['diagnostic_date']))}}</td>
        </tr>

        <tr class="item">
            <td>Diagnostic Remarks</td>

            <td>{{$data[0]['diagnostic']}}</td>
        </tr>

        <tr class="item">
            <td>Diagnostic By</td>

            <td>{{$data[0]['assigned_to_name']}}</td>
        </tr>

            <tr class="item last">
                <td>Chargeable</td>

                <td>{{$data[0]['chargeable']==0?'No':'Yes'}}</td>
            </tr>
 @endif
        @if($data[1]!=null)

            <br>
            <tr class="heading">
                <td>Interventions</td>

                <td></td>
            </tr>

                <td>@foreach($data[1] as $inter)

<p>{{ $inter['name'] }} -  {{ $inter['remarks'] }}</p>
                    @endforeach
                </td>


        @endif



    </table>
</div>
</body>
</html>

