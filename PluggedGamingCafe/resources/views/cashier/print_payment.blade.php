
<center>
    <img src="{{asset('images/logo.png')}}" height="80px" width="150px"/>
    <h1 style="font-size:20px;margin:0">Plugged Board Cafe and Gaming Lounge</h1>
    <i style="font-size:15px;width:90%;display:block">Address: 16 Legarda Road, Baguio City
        Contact Number: (+63) (917) 853-1817 </i>
    <h3 style="padding: 0px;margin: 0px">Cash Invoice</h3>
</center>
<hr style="size:2px;border:inset;margin-top: 0px;padding-top: 0px">
<table style="width:100%;font-size:15px">
    <tr>
        <td width="80px" style="text-align:right">Invoice #:</td>
        <td style="text-align:left">{{str_pad($order->id,6,0,0)}}</td>
        <td style="width:60px;text-align:right">Date:</td>
        <td style="text-align:left;width:100px">{{date("d-M-Y",strtotime($order->updated_at))}}</td>
    </tr>
    <tr>
        <td width="80px" style="text-align:right">Table No:</td>
        <td style="text-align:left">{{$order->table->name}}</td>
        <td style="width:60px;text-align:right">Cashier:</td>
        <td style="text-align:left;width:100px">{{ucwords(Auth::user()->username)}}</td>
    </tr>
    <tr>
        <td width="80px" style="text-align:right">Customer:</td>
        <td style="text-align:left">{{!empty($order->customer_id)&&$order->customer_id!='-1'?$order->customer->name:'General'}}</td>
    </tr>
</table>
<table style="width:100%;margin-top:10px" border="0" cellspacing="0" cellpadding="2px">
    <tr style="font-size:15px">
        <th width="20px">No</th>
        <th>Description</th>
        <th style="width:8%;text-align: center">Qty</th>
        <th style="width:16%;text-align: right">Price</th>
        <th style="width:18%;text-align: right">Total</th>
        <th style="width:18%;text-align: right">Discount</th>
    </tr>
    <tr style="font-size:15px">
        <th colspan="6" align="left">
            <hr>
        </th>
    </tr>
    <?php $total = 0; $i = 1; $totalDiscount = 0;$disc=0;$discounted=0;$vat=0;?>
    @foreach($order->order_details()->select(DB::raw("description,sum(quantity) as quantity,price,discount,Owner,PWD,Senior"))->groupBy('product_id')->groupBy('price')->groupBy('Owner')->groupBy('PWD')->groupBy('Senior')->groupBy('description')->groupBy('discount')->orderBy('description')->get() as $orderDetail)
        <tr style="font-size:15px;@if(!empty($orderDetail->deleted_at)) text-decoration: line-through; @endif">
            <td align="center">{{$i++}}</td>
            <td align="center">{{$orderDetail->description}}</td>
            <td align="center">{{$orderDetail->quantity}}</td>
            <td align="right">₱ {{number_format($orderDetail->price,2)}}</td>
            <td align="right">₱ {{number_format($orderDetail->quantity*$orderDetail->price,2)}}</td>
            <?php 
                $total += ($orderDetail->price * $orderDetail->quantity); 
                $disc=$orderDetail->Owner*$orderDetail->price+$orderDetail->PWD*$orderDetail->price*.2+$orderDetail->Senior*$orderDetail->price*.2;
                $totalDiscount+= $disc;
            ?>
            </td>
            <td align="right">
        
                ₱ {{number_format($disc,2)}}</td>
        
        </tr>
    @endforeach
</table>
<hr>
<table width="100%">
    <tr>
        <td align="right">
            <table width="100%" style="font-size: 15px">
                  <?php
                    $discounted=$total-$totalDiscount;
                    $vat=($discounted*.12);
                  ?>
                    <tr>
                        <th style="text-align: right;padding-right: 20px"> Total (₱):</th>
                        <th style="text-align: right">{{number_format($total,2)}}</th>
                    </tr>
                    <tr>
                        <th style="text-align: right;padding-right: 20px">Discount:</th>
                        <th style="text-align: right">₱ {{number_format($totalDiscount,2)}}</th>
                    </tr>
                    <tr>
                        <th style="text-align: right;padding-right: 20px"> Total w/o VAT (₱):</th>
                        <th style="text-align: right">{{number_format($discounted-$vat,2)}}</th>
                    </tr>
                    <tr>
                    <th style="text-align: right;padding-right: 20px">VAT (₱):</th>
                    <th style="text-align: right">{{number_format($vat,2)}}</th>
                </tr>
                
                
                <tr>
                    <th style="text-align: right;padding-right: 20px">Net Amount(VAT Inclusive) (₱):</th>
                    <th style="text-align: right">{{number_format($discounted,2)}}</th>
                </tr>
                @if(Session::get('usd')>0)
                    <tr>
                        <th style="text-align: right;padding-right: 20px">Cash in (₱):</th>
                        <th style="text-align: right">{{number_format(Session::get('usd'),2)}}</th>
                    </tr>
                @endif
                @if(Session::get('change_us')>0)
                    <tr>
                        <th style="text-align: right;padding-right: 20px">Change (₱):</th>
                        <th style="text-align: right">
                            {{number_format(Session::get('change_us'),2)}}</th>
                    </tr>
                @endif
            </table>
        </td>
    </tr>
</table>
<hr/>
<center><i style="font-size: 15px">Thank you, see you again!</i><br>
</center>
<script>
    //    window.print();
    //    window.close();
</script>
