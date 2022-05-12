<!DOCTYPE html>
<html>
<head>
    <title>Rechnung</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif;">
  <h1>Rechnung</h1>
  <div>
    
     <p style="text-align: right;">
        Datum: {{date('d.m.Y', strtotime($bill->created_at))}}<br>
        Zeitraum: {{date('d.m.Y', strtotime($start))}} - {{date('d.m.Y', strtotime($end))}}<br><br>
    </p>
     <p style="text-align: right;">
        Rechnungsnummer: <b> {{$bill->number}} </b><br>
    </p>
    Moin {{$name->firstname}}, <br><br> hier deine neue Kiosk-Rechnung:<br><br>

    <table class="table table-responsive " style="width: 100%;border-collapse: collapse;"> <tbody>
        <tr class="font-weight-bold" style="font-weight: bold; background-color: #D8D8D8;"><td>Artikel</td><td>Anzahl</td><td>Preis/Stk</td><td>Kosten</td></tr>                                               
        @foreach($positions as $position)
            <tr>
                <td>{{$position->article}}</td>
                <td>{{$position->quantity}}</td>
                <td>{{number_format($position->price,2)}}&#8364;</td>
                <td>{{number_format($position->amount,2)}}&#8364;</td>
            </tr>
        @endforeach           
            <tr><td></td><td></td><td  style="background-color: #D8D8D8;">Summe</td><td style="background-color: #D8D8D8;"><b>{{number_format($position->amount,2)}}&#8364;</b></td></tr>
   
    </tbody></table>
    <br><br>
    <p>Bitte überweise den Betrag bis zum <b>{{date('d.m.Y', strtotime($bill->term))}}</b> an folgendes Konto:<br><br>
        <table style="border: 1px solid black;">
            <tr><td>Bank</td></tr>
            <tr><td>IBAN: <b></b></td></tr>
            <tr><td>Verwendungszweck: <b></b></td></tr>
        </table>           
    </p>
    <br><br><br>
    <p><i></i></p>
    <br><br><br>
    <p style="font-size: 14px;">Damit die Zuordnung deiner Zahlung  funktioniert, bitte den Verwendungszweck genauso eingeben, wie oben angegeben.</p>

  </div>
</body>
</html>
