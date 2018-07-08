@extends('layouts.cashier')
@section('content')
    <div class="container-fluid" style="margin-top: 10px">
        <div class="col-md-3" style="padding: 5px">
            @foreach($menuCategories as $menuCategory)
                <div class="menu @if($menuCategory->id==(Session::has('menuCategory_id')?Session::get('menuCategory_id'):env('DEFAULT_MENU_CATEGORY'))) active  @endif"
                     onclick="$('.menu').removeClass('active');$(this).addClass('active');ajaxLoad('cashier/products?menuCategory_id={{$menuCategory->id}}','productList')">{{$menuCategory->name}}
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control"
                   style="border: 2px solid gray;height: 50px;border-radius: 0px;background: lightyellow;font-size: 18px"
            <input type="text" class="form-control" placeholder="Search..."
                   style="border: 2px solid white;height: 50px;border-radius: 0px;background: white;font-size: 18px"
                   onfocus="$(this).select()"
                   onkeyup="ajaxLoad('cashier/products?search='+this.value,'productList')" value="Search..."/>
            <div id="productList">
                <ul class="list-group"
                    style="height: 525px; overflow-y: auto; border: 2px outset;background: white">
                    @foreach(\App\Product::where('product_category_id',Session::get('menuCategory_id'))->orderBy('name')->get() as $menu)
                        <li class="list-group-item"
                            style="font-size: 16px;padding:0px;height: 80px"
                            onclick="if($('#table_id').text()=='Table #') alert('Please select table first'); else ajaxLoad('cashier/order/{{$menu->id}}','orderList')">
                            <img src="{{$menu->image!='' && File::exists('images/products/'.$menu->image)?'/images/products/'.$menu->image:'/images/default.jpg'}}"
                                 class="pull-left" width="80px" height="70px"
                                 style="margin: 5px 5px 0px 5px"/>
                            <div style="margin:20px">
                                <span style="color: #E52A6F;font-size: 15px"
                                      class="pull-right">₱ {{number_format($menu->unitprice,2)}}</span>
                                <div>{{$menu->name}} <span style="color: gray">({{$menu->id}})</span></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-5" id="orderList">
            @include('cashier._order')
        </div>
    </div>
@endsection
