<?php if(isset($_POST['print_payment.blade.php'])){
    $filename = $_POST['print_payment.blade.php'];
    $pax=0;
}
if(isset($filename)){ 
    echo $filename;
}
?>
<style>
    input[type=text]:focus {
        background: lightyellow;
    }
</style>
<div class="row" style="padding-left: 20px">
    <a title="Table" class="btn btn-warning pay" data-toggle="modal" data-target="#modal"
       href="cashier/table">
        <b id="table_id">{{Session::has('table_id')?\App\Table::find(Session::get('table_id'))->name:'Table #'}}</b>
    </a>
    <a class="btn btn-primary pay"
       data-toggle="modal" data-target="#modal" href="cashier/change-table">
        Transfer
    </a>
    <a class="btn btn-primary pay" data-toggle="modal"
       data-target="#modal_open" href="cashier/open">
        Add
    </a>
    <div class="pay" style="background: none;padding-left: 0px;padding-right: 0px;padding-top: 5px">
        <input @if(Session::get('table_id')=='') disabled @endif type="text" class="form-control" placeholder="Code"
               onkeydown="if (event.keyCode == 13) ajaxLoad('cashier/order/'+this.value,'orderList')"/>
    </div>
    <a style="@if(Session::get('table_id')=='' || count($order)==0) pointer-events: none @endif"
       href="{{url("cashier/print")}}"
       target="_blank" class="btn btn-danger pay">
        Print
    </a>
    <a class="btn btn-success pay" data-toggle="modal" data-target="#modal_pay" href="cashier/pay"
       style="@if(Session::get('table_id')=='' || count($order)==0) pointer-events: none @endif">
        Cash Out
    </a>
</div>
<div class="row" style="background: white;padding: 10px 50px 30px 10px">
    <table class="table" >
        <thead>
    
        <tr>
            <th style="text-align: left">Id</th>
            <th style="text-align: left; width: 100px">  Description </th>
            <th style="text-align: left">Qty</th>
            <th style="text-align: left">Price</th>
            <th style="text-align: left">Total</th>
            <th style="text-align: left">Served</th>
            <th style="text-align: left">Delete</th>
           
        </tr>
        </thead>
        
        @if(count($order)>0)

            <?php $total = 0; $ntotal = 0;  $allDisc=0; $max=0; $totOPS=0;
                           
            ?>
            <tbody>
            
            @foreach($order->order_details()->orderBy('description')->get() as $orderDetail)
               <?php  $pax=$orderDetail->pax; ?>
                <tr style="color: darkblue;@if(($orderDetail->status=='Filled')) color: red; @endif @if(!empty($orderDetail->deleted_at)) text-decoration: line-through; @endif">
                    <td style="margin: 0px;padding: 0px;vertical-align:middle">
                        <input type="text" style="width: 30px;height: 18px" value="{{$orderDetail->id}}"
                               class="idRow" readonly/>
                    </td>
                    <td style="@if($orderDetail->sent==1) color:red; @endif">
                        <input  onkeypress="ajaxLoad('cashier/update-description/{{$orderDetail->id}}/'+this.value,'orderList')"
                               type="text" style="width: 100%;border: none;height: 20px; text-align: left"
                               value="{{$orderDetail->description}}" readonly/>
                    </td>
                    <td align="left">
                        <input onfocus="$(this).select()"
                        onchange="ajaxLoad('cashier/update-quantity/{{$orderDetail->id}}/'+this.value,'orderList')"
                               type="number" step="1" style="width: 50px;border: 1;height: 20px;text-align:right"
                               value="{{$orderDetail->quantity}}" />
                    </td>
                    <td align="left">
                        <input onfocus="$(this).select()"
                        onkeypress="ajaxLoad('cashier/update-price/{{$orderDetail->id}}/'+this.value,'orderList')"
                               type="text" style="width: 56px;border: none;height: 20px;text-align: left"
                               value="₱ {{number_format($orderDetail->price,2)}}" readonly/>
                    </td>
                    <td align="left">
                        <input type="text" style="width: 70px;border: none;height: 20px;text-align: left" readonly
                               value="₱ {{number_format($orderDetail->price * $orderDetail->quantity,2)}}" readonly="readonly"/>               
                    <td align="right">
                      <input onfocus="$(this).select()"
                      onchange="ajaxLoad('cashier/update-Srv/{{$orderDetail->id}}/'+this.value,'orderList')"
                     
                                type="number" step="1" style="width: 70px;border: 1;height: 20px;text-align: right"
                                max="{{$orderDetail->quantity}}"
                                min="{{0}}"
                                pattern="[0-9]"
                               value="{{$orderDetail->Srv}}" />   
                        </td>
                    <td align="center">
                        @if($orderDetail->status!='Filled' or (isset($orderDetail->product_id) and $orderDetail->product_id==0))
                            <a href="javascript:if(confirm('Are you sure want to delete?')) ajaxDelete('cashier/delete/{{$orderDetail->id}}','{{csrf_token()}}','orderList')">
                                <i class="glyphicon glyphicon-minus-sign" style="color: brown;text-align: left;"></i></a>
                        @endif
                    </td>    
                    
                    <th style="text-align: left;"></th>
                    <th style="text-align: left">
                      <tr><td><td>
                      <td align="left"> Owner <td align="left"> PWD <td align="left"> Senior </td>  <td align="left"> Discount </td> 
                      <tr><td><td>
                      
                      <td align="left">
                     
                      <input onfocus="$(this).select()"
                                name="owner"
                                onkeypress="<script type='text/javascript'>alert('You can not exceed the number of persons  or quantity!')</script>"
                                onchange="ajaxLoad('cashier/update-Owner/{{$orderDetail->id}}/'+this.value,'orderList')"
                                type="number" step="1" style="width: 50px;border: 1;height: 20px;text-align: right"
                                max="{{4}}"
                                min="{{0}}"
                                pattern="[0-9]"
                               value="{{$orderDetail->Owner}}" />
                               
                        </td>
            
                        <td align="left">
                        <input onfocus="$(this).select()"
                                onchange="ajaxLoad('cashier/update-PWD/{{$orderDetail->id}}/'+this.value,'orderList')"
                                
                                type="number" step="1" style="width: 50px;border: 1;height: 20px;text-align: right"
                                max="{{4}}"
                                min="{{0}}"
                                pattern="[0-9]"
                               value="{{$orderDetail->PWD}}" />
                       </td>
                       
                        <td align="left">
                        <input onfocus="$(this).select()"
                                onchange="ajaxLoad('cashier/update-Senior/{{$orderDetail->id}}/'+this.value,'orderList')"
                                type="number" step="1" style="width: 50px;border: 1;height: 20px;text-align: right"
                                max="{{4}}"
                                min="{{0}}"
                                pattern="[0-9]"
                                value="{{$orderDetail->Senior}}" />
                       </td>
                       <td align="right">
                       <?php 
                            $totDisc=$orderDetail->Owner+$orderDetail->PWD+$orderDetail->Senior;
                            if ($totDisc>$orderDetail->quantity) {
                                $orderDetail->Owner=$orderDetail->quantity-$orderDetail->PWD-$orderDetail->Senior;
                            }
                            if ($totDisc>$orderDetail->quantity) {
                                $orderDetail->PWD=$orderDetail->quantity-$orderDetail->Owner-$orderDetail->Senior;
                            }
                            if ($totDisc>$orderDetail->quantity) {
                                $orderDetail->Senior=$orderDetail->quantity-$orderDetail->PWD-$orderDetail->Owner;
                            }
                            $orderDetail->discount=$orderDetail->Owner*$orderDetail->price+$orderDetail->PWD*$orderDetail->price*.2+$orderDetail->Senior*$orderDetail->price*.2;
                        ?>
                       ₱<input onfocus="$(this).select()"
                            type="text"  style="width:50px;border: none;height: 20px;text-align: right"
                             value="{{number_format($orderDetail->discount,2)}}" readonly />
                       </td>
                    </th>
                    
                </tr>
                </td>
                    
                    </td>
                </tr>
                
                <?php if (empty($orderDetail->deleted_at)) $ntotal += ($orderDetail->price * $orderDetail->quantity ); ?>
                <?php 
                    $allDisc+=$orderDetail->discount;
                ?>
            @endforeach
            </tbody>
        @endif
    </table>

    @if(count($order)>0)
    
        <div style="text-align: right;float: right;border-top: solid 1px whitesmoke;">
            <table width="100%">
            <tr>
                <th style="text-align: left">
                     
                    </th>
                </tr>
                <tr>
                    </th>
                </tr>
                <p>
                        <i><input onfocus="$(this).select()"
                               onchange="ajaxLoad('cashier/update-price/{{$orderDetail->id}}/'+this.value,'orderList')"
                               type="text" style="border: none;text-align: right;padding-right: 20px"
                               value="Free Board Games" readonly/></i>
                    </p>
                <tr>
                    <th style="text-align: right;padding-right: 20px">Pax:</th>
                    <td align="right">
                      <input onfocus="$(this).select()"
        
                      onchange="ajaxLoad('cashier/update-Pax/{{$orderDetail->id}}/'+this.value,'orderList')"
                               type="number" step="1" style="width: 60px;border: 1;height: 20px;text-align: right"
                               max="{{4}}"
                               min="{{0}}"
                               value="{{$orderDetail->Pax}}" /> 
                              
                        </td>
                </tr>
                <tr>
                    <th style="text-align: right;padding-right: 20px">Total:</th>
                    <th style="text-align: right">₱ {{number_format($ntotal,2)}}</th>
                </tr>
                <tr>
                    <th style="text-align: right;padding-right: 20px">Discount:</th>
    
                    <th style="text-align: right">{{number_format($allDisc,2)}}</th>
                </tr>
                <tr>
                    <th style="text-align: right;padding-right: 20px">Total Amount without VAT:</th>
                    <?php $total=$ntotal-$allDisc;$total=$total-($total*.12)?>
                    <th style="text-align: right">₱ {{number_format($total,2)}}</th>
                </tr>

                <tr>
                    <th style="text-align: right;padding-right: 20px">VAT:</th>
                    <?php $total=$ntotal-$totDisc;?>
                    <th style="text-align: right">₱ {{number_format($total*.12,2)}}</th>
                </tr>
                <tr>
                    <th style="text-align: right;padding-right: 20px">Total Amount DUE:</th>
                    <?php $total=$ntotal-$allDisc;?>
                    <th style="text-align: right">₱ {{number_format($total,2)}}</th>
                </tr>

         <div style="text-align: left;float: left;border-top: solid 1px whitesmoke;">
            <table width="100%">
            <tr>
                <th style="text-align: left">
                                     
                    </td>
                
        </tr>
                @if($total>100)
                  
                @endif

                
            </table>
            
        </div>
</div>
@endif

<script>
    function getSelectedRows() {
        var selected = [];
        $(".idRow:checked").each(function () {
            selected.push($(this).attr('value'));
        });
        return selected;
    }
</script>