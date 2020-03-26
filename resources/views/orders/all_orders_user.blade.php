@include('header')
<div class="content container main_box" v-if="logined">
    <div class="div col-lg-9 left">
        <!-- print_r($orders) -->
        <div class="add_order_header" v-if="!order_id">
            کل سفارشات
        </div>
        <div class="col-md-12" v-if="!order_id" style="padding-top: 30px;">
            <ul class="ul_allorder">
                <li class="order_item" v-for="order in all_order">
                    <h4 class="right" style="cursor: pointer;" @click="get_inorder(order.id,order.title)">شناسه سفارش : @{{order.id}}</h4>
                    <div class="right time">قیمت نهایی : @{{order.price + order.price_service}} تومان</div>
                    <div class="left">
                        <button v-if="order.status == 0 || order.status == 1" type="button" class="btn btn-danger" @click="delete_order(order.id)">حذف</button>
                        <button v-if="order.status == 0" @click="get_inorder(order.id,order.title)" type="button" class="btn btn-warning">در انتظار اعلام قیمت...</button>
                        <button v-if="order.status == 1" @click="get_inorder(order.id,order.title)" type="button" class="btn btn-success">آماده پرداخت</button>
                        <button v-if="order.status == 2 || order.status == 3 || order.status == 4" @click="get_inorder(order.id,order.title)" type="button" class="btn btn-info">نمایش</button>
                    </div>
                </li>
            </ul>
        </div>
        <div class="row inorder_header" v-if="order_id">
            <i class="fas fa-arrow-right" @click="order_id = ''"></i>
        </div>
        <div class="col-md-12" v-if="order_id" style="padding-top: 10px;">
            <h4 class="col-md-12 item_inorder_h4">@{{order[0].title}}</h4>
            <div class="col-md-6 right">
                <div class="col-md-12 itme_inorder">شناسه سفارش : @{{order[0].id}}</div>
                <div class="col-md-12 itme_inorder">ابعاد : @{{order[0].size}}</div>
                <div class="col-md-12 itme_inorder">تعداد : @{{order[0].number}}</div>
                <div class="col-md-12 itme_inorder" v-if="order[0].status==0">وضعیت : در انتظار تایین قیمت </div>
                <div class="col-md-12 itme_inorder" v-if="order[0].status==1">وضعیت : آماده پرداخت</div>
                <div class="col-md-12 itme_inorder" v-if="order[0].status==2">وضعیت : در انتظار آماده شدن سفارش</div>
                <div class="col-md-12 itme_inorder" v-if="order[0].status==3">وضعیت : آماده تحویل</div>
                <div class="col-md-12 itme_inorder" v-if="order[0].status==4">وضعیت : انجام شده </div>
                <div class="col-md-12 itme_inorder">تاریخ ثبت :  @{{time_added}} </div>
                <h5 class="col-md-12 itme_inorder_h5">خدمات</h5>
                <div class="col-md-12 itme_inorder">
                    <span v-for="option in order[0].attr" class="tiem_inorder_option">@{{option.attr}}</span>
                </div>
            </div>
            <div class="col-md-6 left">
                <div class="desk_inorder">
                    @{{order[0].desk}}
                </div>
                <div class="all_price">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>قیمت</td>
                                <td v-if="order[0].price">@{{order[0].price}} تومان</td>
                            </tr>
                            <tr>
                                <td>قیمت خدمات</td>
                                <td v-if="order[0].price_service">@{{order[0].price_service}} تومان</td>
                            </tr>
                            <tr>
                                <td>قیمت نهایی : </td>
                                <td>@{{order[0].price + order[0].price_service}} تومان</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="all_price">
                    <button  v-if="order[0].status == 1" type="button" class="btn btn-success" @click="pay_order()">پرداخت</button>
                </div>
            </div>

        </div>
    </div>
    @include('layout.sidebar')
</div>
@include('footer')