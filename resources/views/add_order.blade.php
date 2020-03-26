@include('header')
<div class="content container main_box" v-if="logined">
    <div class="div col-lg-9 left">
        <div class="add_order_header">
            ثبت سفارش
        </div>
        <div v-if="!cat_id" class="col-md-12" style="padding-top: 30px;">
            <div v-for="cat in all_cat" v-if="cat.parent == 0" @click="go_to_cat(cat.id)" class="col-md-4 right cat_box">
                <div class="img_cat">
                    <img :src="'/images/'+cat.img" alt="">
                </div>
                <div class="name_cat">@{{cat.title}}</div>
            </div>
        </div>
        <div v-if="cat_id" class="col-md-12" style="padding-top: 30px;">
            <div class="row" style="padding-right: 17px;">
                <span @click="()=>{cat_id=0;jens_cat=1000;}" class="cat_root">دسته اصلی<i class="fa fa-chevron-left"></i></span>
                <span class="cat_root">@{{cat_title}}</span>
            </div>
            <hr>
            <div class="form-group">
                <label class="label cat_lable">نوع سفارش</label>
                <select class="form-control col-md-6" v-model="type_cat" @change="change_type()">
                    <option v-for="cat in all_cat" v-if="cat.parent==cat_id" :value="cat.id">@{{cat.title}}</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label cat_lable">جنس سفارش</label>
                <select class="form-control col-md-6" v-model="jens_cat" @change="change_jens()">
                    <option v-for="cat in all_cat" v-if="cat.parent==type_cat" :value="cat.id">@{{cat.title}}</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label cat_lable">ویژگی ها</label><br><br>
                <div class="form-check col-md-3" style="display: inline-block;" v-for="attrs in all_attr" v-if="attr_ids.includes(attrs.id)">
                    <label class="form-check-label" :for="'defaultCheck'+attrs.id">@{{attrs.attr}}</label>
                    <input class="form-check-input" type="checkbox" :value="attrs.id" :id="'defaultCheck'+attrs.id" v-model="select_attrs">
                </div>
            </div>
            <div class="form-group">
                <label class="label cat_lable"> ابعاد</label>
                <select class="form-control col-md-6" v-model="size_id" @change="change_size()">
                    <option v-for="size in all_size" v-if="size.cat_id==jens_cat" :value="size.id">@{{size.size}}</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label cat_lable"> تعداد</label>
                <select class="form-control col-md-6" v-model="count_id" @change="change_count()">
                    <option v-for="count in all_count" v-if="count.size_id==size_id" :value="count.id">@{{count.number}}</option>
                </select>
            </div>

            <div class="form-group">
                <label class="label  cat_lable"> فایل ها</label><br>
                <div class="col-md-5 right" style="display: inline-block;" v-for="(type_file, index) in all_type_file" v-if="type_file.cat_id==jens_cat">
                    <label class="label">@{{type_file.name}}</label>
                    <input type="file" :class="'form-control right file'+index" @change="change_up_file($event,index)">
                </div>
            </div>
            <div class="form-group col-md-12 right">
                <label class="label  cat_lable ">توضیحات</label>
                <textarea class="form-control" v-model="desc"></textarea>
            </div>
            <div class="form-group alert alert-success left" role="alert">
                @{{final_price}} تومان
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-info col-md-12 left" @click="add_order()">ثبت سفارش</button>
            </div>


        </div>
    </div>
    @include('layout.sidebar')
</div>
@include('footer')