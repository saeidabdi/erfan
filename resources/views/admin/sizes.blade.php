@extends('admin.admin')

@section('content')
<div class="col-md-12" style="padding-top: 10px;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link " id="all-cat" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">اندازه ها</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="add-cat" data-toggle="tab" href="#addcat" role="tab" aria-controls="profile" aria-selected="false">ایجاد اندازه جدید</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div v-if="!is_edit" class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="all-cat">
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable"> دسته بندی</label>
                    <select class="form-control" v-model="cat_select">
                        <option value="0">دسته اصلی</option>
                        <option v-for="cat in all_cat" v-if="cat.parent==cat_select || cat.id==cat_select" :value="cat.id">@{{cat.title}}</option>
                    </select>
                </div>
            </div>

            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>ردیف</th>
                    <th>اندازه</th>
                    <th>دسته</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="size in all_size" v-if="size.cat_id==cat_select">
                        <td>@{{size.id}}</td>
                        <td>@{{size.size}}</td>
                        <td>@{{size.title}}</td>
                        <td class="td_edit" @click="size_edit(size.id)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_size(size.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div v-if="is_edit" class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="all-cat">
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable"> دسته بندی</label>
                    <select class="form-control" v-model="cat_select">
                        <option value="0">دسته اصلی</option>
                        <option v-for="cat in all_cat" v-if="cat.parent==cat_select || cat.id==cat_select" :value="cat.id">@{{cat.title}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">ابعاد جدید</label>
                    <input v-model="cat_size" type="text" class="form-control" placeholder="A3 {افقی 29 - عمودی 40}">
                </div>
            </div>
            <div class="col-md-4 right list_button_insert">
                <button type="button" class="btn btn-warning" @click="add_size()">ویرایش</button>
                <button type="button" class="btn btn-danger" @click="()=>{is_edit=0}">انصراف</button>
            </div>
        </div>


        <div class="tab-pane fade show active" id="addcat" role="tabpanel" aria-labelledby="add-cat">

            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable"> دسته بندی</label>
                    <select class="form-control" v-model="cat_select">
                        <option value="0">دسته اصلی</option>
                        <option v-for="cat in all_cat" v-if="cat.parent==cat_select || cat.id==cat_select" :value="cat.id">@{{cat.title}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">ابعاد جدید</label>
                    <input v-model="cat_size" type="text" class="form-control" placeholder="A3 {افقی 29 - عمودی 40}">
                </div>
            </div>
            <div class="col-md-4 right list_button_insert">
                <button type="button" class="btn btn-success" @click="add_size()">ثبت اندازه</button>
            </div>
        </div>
    </div>
</div>
@endsection