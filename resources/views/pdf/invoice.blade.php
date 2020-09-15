<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{$invoice->ref}}</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table.info {
            font-size: small;
        }

        table.content {
            border-collapse: collapse;
            font-size: medium;
        }

        table.content th {
            padding: 15px;
        }

        table.content tbody td {
            padding: 10px;
            border-bottom: solid 1px whitesmoke;
        }

        tfoot tr td {
            font-size: medium;
            padding: 5px;
        }

        tfoot {
            border-bottom: solid 1px whitesmoke;
        }

        tfoot tr:last-child td {
            font-weight: bold;
        }

        .note {
            padding: 20px;
        }

        .note > div {
            padding: 5px;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>
<body>

<table class="info" width="100%">
    <tr>
        <td valign="top">
            <h1 style="font-size: 28px">INVOICE #{{$invoice->ref}}</h1>
        </td>
        <td align="right">
            <h3>{{$invoice->user->f_name}} {{$invoice->user->l_name}}</h3>
            <pre>
                {{$invoice->user->email}}
                {{$invoice->user->phone}}
            </pre>
        </td>
    </tr>

</table>

<table class="info" width="100%">
    <tr>
        <td>
            <strong>Account Name:</strong>
            {{$invoice->acc_name}}
        </td>
    </tr>
    <tr>
        <td><strong>Account Number:</strong>
            {{$invoice->acc_num}}
        </td>
    </tr>
    <tr>
        <td><strong>Bank:</strong>
            {{$invoice->bank}}
        </td>
    </tr>

</table>

<br/>

<table class="content" width="100%">
    <thead style="background-color: lightgray;">
    <tr>
        <th>#</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Unit Price ({{$invoice->currency->iso}})</th>
        <th>Total ({{$invoice->currency->iso}})</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($invoice->items as $key=>$item)
        <tr>
            <td align="center" scope="row"><strong>{{$key+1}}</strong></td>
            <td align="center">{{$item->item}}</td>
            <td align="center">{{$item->quantity}}</td>
            <td align="center">{{$item->unit_price}}</td>
            <td align="center">{{$item->total}}</td>
        </tr>
    @endforeach

    </tbody>

    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td align="right">Subtotal</td>
        <td align="right">{{$invoice->currency->iso}} {{$invoice->items->sum('total')}}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td align="right">Discount</td>
        <td align="right">{{$invoice->currency->iso}} {{$invoice->discount}}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td align="right">VAT</td>
        <td align="right">{{$invoice->currency->iso}} {{$invoice->tax}}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td align="right"><strong>Total</strong></td>
        <td align="right">{{$invoice->currency->iso}} {{$invoice->total_amt}}</td>
    </tr>
    </tfoot>
</table>

<div class="note">
    <div><strong>Notes</strong></div>
    <div>
        {{$invoice->notes ?? 'Thank you'}}
    </div>
</div>

</body>
</html>
