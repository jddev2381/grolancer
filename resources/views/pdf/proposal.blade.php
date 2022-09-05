<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<style>
@font-face {
    font-family: 'Qwitcher Grypen';
    src: url({{ storage_path('fonts\QwitcherGrypen-Bold.ttf') }}) format("truetype");
    font-weight: bold;
    font-style: normal;
}
body {
    font-family: Arial, Helvetica, sans-serif;
}
p.sig {
    border-bottom: 1px solid black;
    margin: 0px;
    padding: 0px;
    width: 300px;
    font-family: 'Qwitcher Grypen', cursive;
}
p.sig2 {
    margin: 0px;
    padding: 0px;
}
p.stamp {
    font-size: 12px;
    font-family: Courier;
}
</style>
<body>



    <table style="width: 100%;">

        <tr>
            <td>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 200px;">
                            <img style="width: 100%;" src="{{ 'storage/' . $proposal->user->logo }}" alt="{{ $proposal->user->business_name }}">
                        </td>
                        <td>
                            <h3 style="width: 100%; text-align:right; color: #333333;">
                                Propsoal ID: {{ $proposal->id }}
                            </h3>
                            <h3 style="width: 100%; text-align:right; color: #333333;">
                                Amount: ${{ $proposal->amount }}
                            </h3>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table style="width: 100%; margin-top: 200px;">
                    <tr>
                        <td>
                            <table style="width: 100%; margin-bottom: 50px;">
                                <tr>
                                    <td>
                                        <h1 style="text-align: center;">{{ $proposal->name }}</h1>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 style="text-align: center; color: #000000;">
                                Prepared For: {{ $proposal->contact->first_name }} {{ $proposal->contact->last_name }}
                            </h2>
                            <h3 style="text-align: center; color: #333333;">
                                By: {{ $proposal->user->business_name }}<br>
                                {{ $proposal->user->first_name }} {{ $proposal->user->last_name }}<br>
                            </h3>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                @foreach($sections as $section)
                    <table style="width: 100%; page-break-before: always;">
                        <tr>
                            <td>
                                <h1>{{ $section->title }}</h1>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! $section->body !!}
                            </td>
                        </tr>
                    </table>

                @endforeach
            </td>
        </tr>

        <tr>
            <table style="width: 100%;">
                <tr>
                    <td colspan="2">
                        <p style="font-size: 18px;">
                            By signing below,  you accept this proposal
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        
                        <p class="sig">
                            {{ $proposal->user->first_name }} {{ $proposal->user->last_name }}<br>
                        </p>
                        <p class="sig2">{{ $proposal->user->first_name }} {{ $proposal->user->last_name }}</p>
                    </td>
                    <td>
                        <p class="sig">
                            {{ $proposal->accepted_name }}<br>
                        </p>
                        <p class="sig2">{{ $proposal->contact->first_name }} {{ $proposal->contact->last_name }}</p>
                        
                    </td>
                </tr>
            </table>
        </tr>
        <tr>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;">

                    </td>
                    <td>
                        <p class="stamp">
                            <b>IP Address:</b>{{ $proposal->accepted_ip}}<br>
                            <b>TimeStamp:</b> {{ $proposal->accepted_date }} UTC<br>
                            <b>User Agent:</b> {{ $proposal->accepted_user_agent }}
                        </p>
                    </td>
                </tr>
            </table>
        </tr>

    </table>


</body>
</html>