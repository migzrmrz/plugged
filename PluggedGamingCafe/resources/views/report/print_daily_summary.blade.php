<center>
    <img src="{{asset('images/logo.png')}}" height="80px" width="150px"/>
    <h1 style="font-size:20px;margin:0">Plugged Board Cafe and Gaming Lounge</h1>
    <i style="font-size:11px;width:90%;display:block">Address: 16 Legarda Road, Baguio City
        Contact Number: 09178531817 </i>
    <h4 style="margin: 0">Daily Summary Report</h4>
    <h5 style="margin: 5px">{{date('d-M-Y',strtotime(Session::get('report_from')))}}</h5>
</center>
<hr style="size:2px;border:inset">
<h2 style=text-align:center;class="page-header">Daily Summary Report </h2>
<h2 style="width:100%;text-align: center;padding: 10px;background: whitesmoke">
    ₱ {{number_format($orders['Total']['total'],2)}}</h2>
<table style="width:40%;margin-top:10px" border="1px solid" cellspacing="0" cellpadding="5px" align="center">
    <tr style="font-size:14px">
        <th>Category</th>
        <th>Total</th>
    </tr>
    @foreach($sale as $key=>$value)
        @if($key!='Total')
            <tr style="font-size: 14px">
                <td align="center">{{$key}}</td>
                <td align="center">₱ {{number_format($value['total'],2)}}</td>
            </tr>
        @endif
    @endforeach
</table>
</body>
<script>
//    window.print();
//    window.close();
</script>
