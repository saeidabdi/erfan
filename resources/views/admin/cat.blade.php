@extends('admin.admin')

@section('content')
<div class="col-md-12" style="padding-top: 10px;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link " id="all-cat" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">دسته ها</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="add-cat" data-toggle="tab" href="#addcat" role="tab" aria-controls="profile" aria-selected="false">ایجاد دسته</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div v-if="!is_edit" class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="all-cat">
            <a style="cursor: pointer;color:#1c5b99;" @click="()=>{cat_id=0}">دسته اصلی</a>
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>تعداد فایل دریافتی</th>
                    <th>عکس</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="cat in all_cat" v-if="cat.parent == cat_id">
                        <td>@{{cat.id}}</td>
                        <td style="cursor: pointer;color:#1c5b99;" @click="()=>{cat_id=cat.id}">@{{cat.title}}</td>
                        <td>@{{cat.num_file}}</td>
                        <td><img style="width: 60px;height:60px;" :src="'/images/' + cat.img" :alt="cat.title"></td>
                        <td class="td_edit" @click="cat_edit(cat.id)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_cat(cat.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div v-if="is_edit" class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="all-cat">
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <input v-model="cat_title" type="text" class="form-control" placeholder="دسته">
                </div>
            </div>
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <select class="form-control" v-model="cat_select">
                        <option value="0">دسته اصلی</option>
                        <option v-for="cat in all_cat" :value="cat.id">@{{cat.title}}</option>
                    </select>
                </div>

            </div>
            <div class="col-md-6 right">
                <div class="form-group">
                    <input type="file" class="form-control" v-on:change="onImageChange">
                </div>
                <div class="form-group">
                    <img style="width: 100%;" :src="previewImage">
                </div>
            </div>
            <div class="col-md-2 right" style="padding-top: 10px;">
                <div class="form-group">
                    <input v-model="cat_num_file" type="number" class="form-control" placeholder="تعداد فایل های مورد نیاز">
                </div>
            </div>
            <div class="col-md-4 right list_button_insert">
                <button type="button" class="btn btn-warning" @click="add_cat()">ویرایش</button>
                <button type="button" class="btn btn-danger" @click="()=>{is_edit=0}">انصراف</button>
            </div>
        </div>


        <div class="tab-pane fade show active" id="addcat" role="tabpanel" aria-labelledby="add-cat">

            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <input v-model="cat_title" type="text" class="form-control" placeholder="دسته">
                </div>
            </div>
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <select class="form-control" v-model="cat_select">
                        <option value="0">دسته اصلی</option>
                        <option v-for="cat in all_cat" :value="cat.id">@{{cat.title}}</option>
                    </select>
                </div>

            </div>
            <div class="col-md-6 right">
                <div class="form-group">
                    <input type="file" class="form-control" v-on:change="onImageChange">
                </div>
                <div class="form-group">
                    <img style="width: 100%;" :src="previewImage">
                </div>
            </div>
            <div class="col-md-2 right" style="padding-top: 10px;">
                <div class="form-group">
                    <input v-model="cat_num_file" type="number" class="form-control" placeholder="تعداد فایل های مورد نیاز">
                </div>
            </div>
            <div class="col-md-4 right list_button_insert">
                <button type="button" class="btn btn-success" @click="add_cat()">ذخیره</button>
            </div>
        </div>
    </div>
</div>
@endsection