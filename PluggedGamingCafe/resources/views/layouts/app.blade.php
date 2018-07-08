<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plugged Board Game Cafe and Gaming Lounge</title>
    <!-- Styles -->
    <link href="{{ asset('bootstrap-3.3.7/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-3.3.7/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('pickadate/themes/default.css') }}" rel="stylesheet">
    <link href="{{ asset('pickadate/themes/default.date.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .picker__select--month, .picker__select--year {
            height: inherit;
        }

        .form-control:disabled, .form-control[readonly] {
            background-color: white;
        }
    </style>
</head>
<body style="background: #e9e7e9">
<div class="container-fluid" style="background: #4f3558;border-bottom: 5px solid #675682">
    <img src="{{asset('images/logo.png')}}" height="70px" width="100px"/><font color= "white"> PLUGGED BOARD GAME CAFE AND GAMING LOUNGE </font>
    <button class="navbar-toggle collapsed" data-toggle="collapse"
            data-target="#menu" aria-expanded="false">
        <i style="color: darkgrey" class="glyphicon glyphicon-menu-hamburger"></i> Menu
    </button>
</div>
<div class="container-fluid" style="padding-bottom: 160px">
    <div class="row-fluid" style="margin-top: 10px">
        <div class="col-sm-4 col-md-3">
            <div class="collapse navbar-collapse" id="menu" style="background: #4f3558">
                <div style="background: #675682;margin: 15px 0;padding: 5px 0;text-align: center">
                    <table width="100%">
                        <tr>
                            <td width="30%" style="padding:0 5px 0 5px"><img
                                        src="{{url('images/default_profile.png')}}"
                                        width="100%"
                                        class="img-rounded"/></td>
                            <td>
                                <b style="font-size: 180%;color: white">{{ucwords(Auth::user()->username)}}</b><br/>
                                <a href="{{url('/logout')}}" style="font-size: 15px;color: white;" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i
                                            class="glyphicon glyphicon-log-out"></i>
                                    Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
                <ul class="nav nav-stacked" id="sidebar" style="margin-bottom: 100px">
                    <li class="nav_home">
                        <a href="#home"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
                    </li>
                    <li><a href="#" style="pointer-events: none"><i class="glyphicon glyphicon-th"></i> Main Data</a>
                        <ul class="nav" id="sidebar">
                            <li class="nav_table"><a href="#table"> Table</a></li>
                            <li class="nav_customer"><a href="#customer"> Customer</a></li>
                        </ul>
                    </li>
                    <li>
                        
                    </li>
                    <li>
                        <a href="#" style="pointer-events: none"><i class="glyphicon glyphicon-th"></i> Product</a>
                        <ul class="nav" id="sidebar">
                            <li class="nav_product">
                                <a href="#product">Product List</a>
                            </li>
                            <li class="nav_product_category">
                                <a href="#product_category">Product Category</a>
                            </li>
                            <li class="nav_recipe">
                                
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" style="pointer-events: none"><i class="glyphicon glyphicon-search"></i>
                            Report</a>
                        <ul class="nav" id="sidebar">
                            <li class="nav_report_daily-summary">
                                <a href="#report/daily-summary">Daily Summary Report</a>
                            </li>
                            <li class="nav_report_sale-history">
                                <a href="#report/sale-history">Sale History Report</a>
                            </li>
                            <!--<li class="nav_report_sale-deleted-report">
                                <a href="#report/sale-deleted-report">Sale Deleted Report</a>
                            </li>
                            <li class="nav_report_sale-discount">
                                <a href="#report/sale-discount">Sale Discount Report</a>
                            </li>-->
                            <li class="nav_report_sale-graph">
                                <a href="#report/sale-graph">Sale Graph Report</a>
                            </li>
                        </ul>
                    </li>
                    @if(Auth::user()->role=='SuperAdmin')
                        <li class="nav_user"><a href="#user"><i
                                        class="glyphicon glyphicon-user"></i> User Management</a></li>
                    @endif
                    <li class="nav_change-password"><a href="#change-password"><i
                                    class="glyphicon glyphicon-lock"></i>
                            Change
                            Password</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-8 col-md-9" style="background: white;padding-top: 1px;padding-bottom: 50px" id="content">
        </div>
    </div>
</div>
<div class="loading"></div>
<!-- JavaScripts -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('bootstrap-3.3.7/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/routie.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/highcharts.js') }}"></script>
<script src="{{ asset('js/exporting.js') }}"></script>
<script src="{{ asset('pickadate/picker.js') }}"></script>
<script src="{{ asset('pickadate/picker.date.js') }}"></script>
</body>
</html>