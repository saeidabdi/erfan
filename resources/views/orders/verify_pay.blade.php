@include('header')
<div class="content container main_box" v-if="logined">
    <div class="div col-lg-9 left">
        <div class="add_order_header" v-if="!order_id">
            تایید سفارشات
        </div>
        <div class="col-md-12" v-if="!order_id" style="padding-top: 30px;">
            @if($success == 1)
            <div class="alert alert-success" role="alert">
                {{$mes}}
            </div>
            @endif
            @if($success == 0)
            <div class="alert alert-danger" role="alert">
                {{$mes}}
            </div>
            @endif
        </div>
    </div>
    @include('layout.sidebar')
</div>
@include('footer')