@extends('admin.admin')

@section('content')
<div class="col-md-12" style="padding-top: 10px;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <!-- <li class="nav-item">
            <a class="nav-link " id="all-cat" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">اندازه ها</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link active" id="add-cat" data-toggle="tab" href="#addcat" role="tab" aria-controls="profile" aria-selected="false"></a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="addcat" role="tabpanel" aria-labelledby="add-cat">
            <div class="col-md-12" style="padding-top: 10px;">
                <h4 class="col-md-12 item_inorder_h4">{{$user[0]->name}}</h4>
                <div class="col-md-6 right">
                    <h5 class="col-md-12 itme_inorder_h5">اطلاعات {{$user[0]->name}}</h5>
                    <div class="col-md-12 itme_inorder">شناسه کاربر : {{$user[0]->id}}</div>
                    <div class="col-md-12 itme_inorder">نام کاربری : {{$user[0]->username}}</div>
                    <div class="col-md-12 itme_inorder">کد ملی : {{$user[0]->code_meli}}</div>
                </div>
                <div class="col-md-6 left">
                    <h5 class="col-md-12 itme_inorder_h5">راه های ارتباطی با {{$user[0]->name}}</h5>
                    <div class="col-md-12 itme_inorder"><a href="tel:{{$user[0]->number_phone}}"> موبایل : {{$user[0]->number_phone}}</a></div>
                    <div class="col-md-12 itme_inorder"> آدرس : {{$user[0]->address}}</div>
                    <div class="col-md-12 itme_inorder"><a href="mailto:{{$user[0]->mail}}"> ایمیل : {{$user[0]->mail}}</a></div>
                </div>

            </div>
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>شناسه سفارش</th>
                    <th>مبلغ</th>
                    <th>مبلغ خدمات</th>
                    <th>توضیحات</th>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->price_service}}</td>
                        <td>{{$order->desk}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection