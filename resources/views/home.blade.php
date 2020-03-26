@include('header')
<div class="content container main_box" v-if="logined">
    <div class="div col-lg-9 left">
        <div class="row welcome">
            @{{name}} عزیز به پنل کاربری خوش آمدید
        </div>
        <div class="col-md-12" style="padding-top: 10px;">
            <div class="col-md-6 right">
                <div v-if="img_user" class="row" style="width: 83%;margin: auto;">
                    <img :src="'/images/' + img_user" style="width: 80%;border-radius: 100%;" class="img-circle" alt="Cinque Terre">
                </div>
                <div v-if="!img_user" class="row" style="width: 83%;margin: auto;">
                    <i style="font-size: 100px;color: #CCC;" class="fa fa-user"></i>
                </div>
                <div class="list-group acount">
                    <li class="list-group-item list-group-item-action">شماره کاربری : @{{user_id}}</li>
                    <li class="list-group-item list-group-item-action">نام کاربری : @{{username}}</li>
                    <li class="list-group-item list-group-item-action">شماره موبایل : @{{mobile}}</li>
                    <li class="list-group-item list-group-item-action">اعتبار : 0 تومان</li>
                    <li class="list-group-item list-group-item-action">زمان عضویت :  @{{time_added}}</li>
                </div>
            </div>
            <div class="col-md-6 left">
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <td><a href="/all_orders_user" style="width: 100%;height:100%;display: inline-block;">تعداد سفارش ثبت شده: @{{order_counts}} عدد</a></td>
                        </tr>
                        <tr>
                            <td><a style="width: 100%;height:100%;display: inline-block;">جمع مبلغ كل سفارشات ثبت شده : @{{order_price0}} تومان</a></td>
                        </tr>
                        <tr>
                            <td><a href="/allorder" style="width: 100%;height:100%;display: inline-block;">سفارشات در انتظار تاييد  : @{{ordering_for_ok}} عدد</a></td>
                        </tr>
                        <tr>
                            <td><a href="/allorder" style="width: 100%;height:100%;display: inline-block;">سفارشات آماده پرداخت   : @{{ordering_for_servise}} عدد</a></td>
                        </tr>
                        <tr>
                            <td><a href="/allorder" style="width: 100%;height:100%;display: inline-block;">سفارشات آماده تحويل : @{{ordering_for_reedy}} عدد</a></td>
                        </tr>
                        <tr>
                            <td><a href="/end_orders_user" style="width: 100%;height:100%;display: inline-block;">سفارشات تحويل داده شده : @{{ordering_for_end}} عدد</a></td>
                        </tr>
                        <tr>
                            <td><a style="width: 100%;height:100%;display: inline-block;">مبلغ كل سفارشات تحويل شده : @{{order_price3}} تومان</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layout.sidebar')
</div>
@include('footer')