@extends('admin.admin')

@section('content')
<div class="col-md-12" style="padding-top: 10px;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link " id="all-cat" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">مدیریت ویژگی ها</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="add-cat" data-toggle="tab" href="#addcat" role="tab" aria-controls="profile" aria-selected="false">ثبت ویژگی</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div v-if="!is_edit" class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="all-cat">
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable"> دسته بندی</label>
                    <select class="form-control" v-model="cat_select" @change="set_cat()">
                        <option value="0">دسته اصلی</option>
                        <option v-for="cat in all_cat" @click="cat_set(cat.id)" v-if="cat.parent==cat_select || cat.id==cat_select" :value="cat.id">@{{cat.title}}</option>
                    </select>
                </div>
            </div><br>

            <div class="col-md-12 right">
                <div class="form-check col-md-2 right" v-for="attrs in all_attr">
                    <label class="form-check-label" :for="'defaultCheck'+attrs.id">@{{attrs.attr}}</label>
                    <input class="form-check-input" type="checkbox" :value="attrs.id" :id="'defaultCheck'+attrs.id" v-model="attr_ids">
                </div>
                <div class="col-md-12 right list_button_insert">
                    <button style="margin-top:47px;" type="button" class="btn btn-success" @click="update_attr()">اختصاص ویژگی</button>
                </div>
            </div>
        </div>


        <div class="tab-pane fade show active" id="addcat" role="tabpanel" aria-labelledby="add-cat">

            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">ویژگی جدید</label>
                    <input v-model="attr" class="form-control" placeholder="طلاکوب">
                </div>
            </div>
            <div class="col-md-8 right list_button_insert">
                <button style="margin-top:47px;" type="button" class="btn btn-success" @click="add_attr()">ثبت ویژگی</button>
            </div>
        </div>
    </div>
</div>
@endsection