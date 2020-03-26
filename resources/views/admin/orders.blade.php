@extends('admin.admin')

@section('content')
<div class="col-md-12" style="padding-top: 10px;">
    <ul v-if="!order_id" class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active " id="all-cat" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ثبت شده</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="add-cat" data-toggle="tab" href="#addcat" role="tab" aria-controls="profile" aria-selected="false">پرداخت شده</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="manage-cat" data-toggle="tab" href="#manage" role="tab" aria-controls="manage" aria-selected="ture">مدیریت سفارشات</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <!-- back -->
        <div class="row inorder_header" v-if="order_id">
            <i class="fas fa-arrow-right" @click="get_adminorder()"></i>
        </div>

        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="all-cat">
            <table v-if="!order_id" class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>شناسه سفارش</th>
                    <th>کاربر</th>
                    <th>عنوان</th>
                    <th>قیمت</th>
                    <th>نمایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="ord in order" v-if="ord.status == 0">
                        <td v-if="ord.view == 0"><a class="badge badge-danger new_for_order">جدید</a>@{{ord.id}}</td>
                        <td v-if="ord.view == 1">@{{ord.id}}</td>
                        <td><a :href="'/admin/user/'+ord.user_id" target="_blank">@{{ord.username}}</a></td>
                        <td>@{{ord.title}}</td>
                        <td>@{{ord.price}}</td>
                        <td class="td_edit" data-toggle="modal" data-target=".bd-example-modal-lg" @click="show_admin_order(ord.id,ord.title)"><i class="fa fa-eye" aria-hidden="true"></i></td>
                        <td class="td_delete" @click="delete_order(ord.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
            <div v-if="order_id">
                <div class=""></div>
                <h4 class="col-md-12 item_inorder_h4">@{{order_title}}</h4>
                <div class="col-md-6 right">
                    <div class="col-md-12 itme_inorder">شناسه سفارش : @{{inorder[0].id}}</div>
                    <div class="col-md-12 itme_inorder">ابعاد : @{{inorder[0].size}}</div>
                    <div class="col-md-12 itme_inorder">تعداد : @{{inorder[0].number}}</div>
                    <div class="col-md-12 itme_inorder">تاریخ ثبت سفارش : @{{time_added}} </div>
                    <h5 class="col-md-12 itme_inorder_h5">خدمات</h5>
                    <div class="col-md-12 itme_inorder">
                        <span v-for="option in inorder[0].attr" class="tiem_inorder_option">@{{option.attr}}</span>
                    </div>
                    <h5 class="col-md-12 itme_inorder_h5">فایل ها</h5>
                    <div class="col-md-12 itme_inorder" v-for="file in inorder[0].files">
                        <a :href="'/files/'+file.file_addr" download>@{{file.file_name}}</a>
                    </div>
                </div>
                <div class="col-md-6 left">
                    <div class="desk_inorder">
                        @{{inorder[0].desk}}
                    </div>
                    <div class="all_price">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>مبلغ</td>
                                    <td v-if="inorder[0].price">@{{inorder[0].price}} تومان</td>
                                </tr>
                                <tr>
                                    <td>مبلغ خدمات</td>
                                    <td><input type="number" v-model="servise_price"></td>
                                </tr>
                                <tr>
                                    <td>مبلغ نهایی</td>
                                    <td>@{{parseInt(count_price) + parseInt(servise_price)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="all_price">
                        <button type="button" @click="okOrder(inorder[0].id)" class="btn btn-success">تایید سفارش</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="tab-pane fade" id="addcat" role="tabpanel" aria-labelledby="add-cat">
            <table v-if="!order_id" class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>شناسه سفارش</th>
                    <th>کاربر</th>
                    <th>عنوان</th>
                    <th>مبلغ پرداختی</th>
                    <th>نمایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="ord in order" v-if="ord.status == 2">
                        <td v-if="ord.view == 0"><a class="badge badge-danger new_for_order">جدید</a>@{{ord.id}}</td>
                        <td v-if="ord.view == 1">@{{ord.id}}</td>
                        <td><a :href="ord.user_id" target="_blank">@{{ord.username}}</a></td>
                        <td>@{{ord.title}}</td>
                        <td>@{{ord.price + ord.price_service}}</td>
                        <td class="td_edit" @click="show_admin_order(ord.id,ord.title)"><i class="fa fa-eye" aria-hidden="true"></i></td>
                        <td class="td_delete" @click="delete_order(ord.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
            <div v-if="order_id">
                <div class=""></div>
                <h4 class="col-md-12 item_inorder_h4">@{{order_title}}</h4>
                <div class="col-md-6 right">
                    <div class="col-md-12 itme_inorder">شناسه سفارش : @{{inorder[0].id}}</div>
                    <div class="col-md-12 itme_inorder">ابعاد : @{{inorder[0].size}}</div>
                    <div class="col-md-12 itme_inorder">تعداد : @{{inorder[0].number}}</div>
                    <div class="col-md-12 itme_inorder">تاریخ ثبت سفارش : @{{time_added}} </div>
                    <div class="col-md-12 itme_inorder">تاریخ پرداخت سفارش : @{{time_payment}} </div>
                    <h5 class="col-md-12 itme_inorder_h5">خدمات</h5>
                    <div class="col-md-12 itme_inorder">
                        <span v-for="option in inorder[0].attr" class="tiem_inorder_option">@{{option.attr}}</span>
                    </div>
                    <h5 class="col-md-12 itme_inorder_h5">فایل ها</h5>
                    <div class="col-md-12 itme_inorder" v-for="file in inorder[0].files">
                        <a :href="'/files/'+file.file_addr" download>@{{file.file_name}}</a>
                    </div>
                </div>
                <div class="col-md-6 left">
                    <div class="desk_inorder">
                        @{{inorder[0].desk}}
                    </div>
                    <div class="all_price">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>مبلغ</td>
                                    <td v-if="inorder[0].price">@{{inorder[0].price}} تومان</td>
                                </tr>
                                <tr>
                                    <td>مبلغ خدمات</td>
                                    <td v-if="inorder[0].price_service">@{{inorder[0].price_service}} تومان</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="all_price">
                        <button type="button" @click="complet_order(inorder[0].id)" class="btn btn-success">سفارش تکمیل شد</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="manage" role="tabpanel" aria-labelledby="manage-cat">

            <table v-if="!order_id" class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>شناسه سفارش</th>
                    <th>کاربر</th>
                    <th>عنوان</th>
                    <th>قیمت</th>
                    <th>نمایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="ord in order" v-if="ord.status == 3">
                        <td v-if="ord.view == 0"><a class="badge badge-danger new_for_order">جدید</a>@{{ord.id}}</td>
                        <td v-if="ord.view == 1">@{{ord.id}}</td>
                        <td><a :href="'/admin/user/'+ord.user_id" target="_blank">@{{ord.username}}</a></td>
                        <td>@{{ord.title}}</td>
                        <td>@{{ord.price}}</td>
                        <td class="td_edit" data-toggle="modal" data-target=".bd-example-modal-lg" @click="show_admin_order(ord.id,ord.title)"><i class="fa fa-eye" aria-hidden="true"></i></td>
                        <td class="td_delete" @click="delete_order(ord.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
            <div v-if="order_id">
                <div class=""></div>
                <h4 class="col-md-12 item_inorder_h4">@{{order_title}}</h4>
                <div class="col-md-6 right">
                    <div class="col-md-12 itme_inorder">شناسه سفارش : @{{inorder[0].id}}</div>
                    <div class="col-md-12 itme_inorder">ابعاد : @{{inorder[0].size}}</div>
                    <div class="col-md-12 itme_inorder">تعداد : @{{inorder[0].number}}</div>
                    <div class="col-md-12 itme_inorder">تاریخ ثبت سفارش : @{{time_added}} </div>
                    <h5 class="col-md-12 itme_inorder_h5">خدمات</h5>
                    <div class="col-md-12 itme_inorder">
                        <span v-for="option in inorder[0].attr" class="tiem_inorder_option">@{{option.attr}}</span>
                    </div>
                    <h5 class="col-md-12 itme_inorder_h5">فایل ها</h5>
                    <div class="col-md-12 itme_inorder" v-for="file in inorder[0].files">
                        <a :href="'/files/'+file.file_addr" download>@{{file.file_name}}</a>
                    </div>
                </div>
                <div class="col-md-6 left">
                    <div class="desk_inorder">
                        @{{inorder[0].desk}}
                    </div>
                    <div class="all_price">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>مبلغ</td>
                                    <td v-if="inorder[0].price">@{{inorder[0].price}} تومان</td>
                                </tr>
                                <tr>
                                    <td>مبلغ خدمات</td>
                                    <td v-if="inorder[0].price">@{{inorder[0].price_service}} تومان</td>
                                </tr>
                                <tr>
                                    <td>مبلغ نهایی</td>
                                    <td>@{{parseInt(count_price)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="all_price">
                        <button type="button" @click="Delivery(inorder[0].id)" class="btn btn-success">تحویل داده شده</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection