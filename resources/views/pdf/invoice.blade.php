<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>

@page {
    margin: 0cm 0cm;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    margin-top: 1cm;
    margin-bottom: 1cm;
    margin-right: 1cm;
    margin-left: 1cm;
}
h1, h2, h3, h4, h5, h6, p {
    padding: 0px;
    margin: 0px;
}
footer {
    position: fixed; 
    bottom: 0cm; 
    left: 0cm; 
    right: 0cm;
    height: 1cm;
    background-color: #DD5A0E;
    color: white;
    text-align: center;
    line-height: 0.75cm;
    font-size: 12px;
}
footer a {
    color: white;
    text-decoration: none;
}

header img {
    width: 150px;
}
img.watermark {
    width: 70px;
    position: fixed;
    top: 0.1cm;
    right: 0.1cm;
    opacity: 0.4;
}

</style>
<body>


    @if(auth()->user()->account_level == 'free')
        <img class="watermark" src="img/grolancer-logo.png" alt="GroLancer">
    @endif

    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%;">
                    <tr>
                        <td>
                            @if(auth()->user()->logo)
                                <img style="width: 200px;" src="{{ 'storage/' . auth()->user()->logo }}" alt="{{ auth()->user()->business_name }}">
                            @endif
                        </td>
                        <td>
                            <h1 style="color:#333; font-size: 22px; text-align: right; margin-bottom: 10px;">Invoice # {{ $invoice->id }}</h1>
                            <h3 style="color:#333; font-size: 22px; text-align: right;">Due Date: {{ $invoice->due_date ? date('m/d/Y', strtotime($invoice->due_date)) : '' }}</h3>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table style="width: 100%; margin-top: 20px;">
                    <tr>
                        <td style="width: 40%; background-color: #eeeeee; padding: 20px;">
                            <h3 style="color:#333; font-size: 22px;">From</h3>
                            <p style="color:#333; font-size: 18px;">
                                {{ auth()->user()->business_name }}
                            </p>
                        </td>
                        <td style="width: 20%;"></td>
                        <td style="width: 40%; background-color: #eeeeee; padding: 20px;">
                            <h3 style="color:#333; font-size: 22px;">To</h3>
                            <p style="color:#333; font-size: 18px;">{{ $invoice->contact->first_name }} {{ $invoice->contact->last_name }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>


        <tr>
            <td>
                <table style="width: 100%; margin-top: 30px; border-bottom: 1px solid black;">
                    <tr>
                        <td>
                            <p style="font-size:20px; font-weight: bold;">Item </p>
                        </td>
                        <td>
                            <p style="text-align: right; font-size: 20px; font-weight: bold;">Amount</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        @php
            $total = 0;
        @endphp

        @foreach($items as $item)
            <tr>
                <td>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 80%;">
                                <p style="font-size:18px;">{{ $item->description }}</p>
                            </td>
                            <td style="width: 20%;">
                                <p style="text-align: right; font-size: 18px;">${{ $item->amount }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @php
                $total += $item->amount;
            @endphp
        @endforeach


        <tr>
            <td>
                <table style="width: 100%; margin-top: 30px; border-top: 1px solid black;">
                    <tr>
                        <td>
                            <p style="font-size:20px; font-weight: bold;">Total </p>
                        </td>
                        <td>
                            <p style="text-align: right; font-size: 20px; font-weight: bold;">${{ number_format((float)$total, 2, '.', '') }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        


        @if(auth()->user()->paypal_link || auth()->user()->cashapp_tag)

            <tr>
                <td>
                    <table style="width: 100%; margin-top: 100px;">
                        <tr>
                            <td style="background-color: #eeeeee; padding: 20px;">
                                <h4 style="margin-bottom: 10px;">Payment Options:</h4>
                                <p>
                                    @if(auth()->user()->paypal_link)
                                        <p style="margin-bottom: 5px;"><b>PayPal:</b> <a href="{{ auth()->user()->paypal_link }}" target="_blank">{{ auth()->user()->paypal_link }}</a></p>
                                    @endif
                                    @if(auth()->user()->cashapp_tag)
                                        <p><b>Cash App Tag: </b> ${{ auth()->user()->cashapp_tag }}</p>
                                    @endif
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        @endif


    </table>



    @if(auth()->user()->account_level == 'free')

        <footer>
            <p>Generated with <a href="https://grolancer.com" target="_blank">https://grolancer.com</a></p>
        </footer>

    @endif

</body>
</html>