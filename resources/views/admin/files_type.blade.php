@extends('admin.admin')

@section('content')
<div class="col-md-12" style="padding-top: 10px;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link " id="all-cat" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">عناوین</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="add-cat" data-toggle="tab" href="#addcat" role="tab" aria-controls="profile" aria-selected="false">ایجاد عنوان</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div v-if="!is_edit" class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="all-cat">
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable"> دسته بندی</label>
                    <select class="form-control" v-model="cat_select" @change="change_cat()">
                        <option value="0">دسته اصلی</option>
                        <option v-for="cat in all_cat" v-if="cat.parent==cat_select || cat.id==cat_select" :value="cat.id">@{{cat.title}}</option>
                    </select>
                </div>
            </div>

            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>ردیف</th>
                    <th>عنوان</th>
                    <th>نوع</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="file in all_type_file" v-if="file.cat_id==cat_select">
                        <td>@{{file.id}}</td>
                        <td>@{{file.name}}</td>
                        <td v-if="file.forced==0">اختیاری</td>
                        <td v-if="file.forced==1">اجباری</td>
                        <td class="td_edit" @click="edit_type_file(file.id)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_type_file(file.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div v-if="is_edit" class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="all-cat">
            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable"> دسته بندی</label>
                    <select class="form-control" v-model="cat_select" @change="change_cat()" disabled>
                        <option value="0">دسته اصلی</option>
                        <option v-for="cat in all_cat" v-if="cat.parent==cat_select || cat.id==cat_select" :value="cat.id">@{{cat.title}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">عنوان فایل </label>
                    <input v-model="type_file_name" @change="change_cat()" type="text" class="form-control" placeholder="عکس روی جلد">
                </div>
            </div>
            <div class="col-md-2 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">نوع</label>
                    <select class="form-control" v-model="forced_file">
                        <option value="0">اختیاری</option>
                        <option value="1">اجباری</option>
                    </select>
                </div>

            </div>
            <div class="col-md-2 right">
                ضرفیت : @{{cat_num_file}}
            </div>
            <div class="col-md-12 right list_button_insert">
                <button type="button" class="btn btn-warning" @click="add_files_type()">ویرایش</button>
                <button type="button" class="btn btn-danger" @click="()=>{is_edit=0}">انصراف</button>
            </div>
        </div>


        <div class="tab-pane fade show active" id="addcat" role="tabpanel" aria-labelledby="add-cat">

            <div class="col-md-4 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable"> دسته بندی</label>
                    <select class="form-control" v-model="cat_select" @change="change_cat()">
                        <option value="0">دسته اصلی</option>
                        <option v-for="cat in all_cat" v-if="cat.parent==cat_select || cat.id==cat_select" :value="cat.id">@{{cat.title}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">عنوان فایل </label>
                    <input v-model="type_file_name" @change="change_cat()" type="text" class="form-control" placeholder="عکس روی جلد">
                </div>
            </div>
            <div class="col-md-2 right" style="padding-top: 10px;">
                <div class="form-group">
                    <label class="label cat_lable">نوع</label>
                    <select class="form-control" v-model="forced_file">
                        <option value="0">اختیاری</option>
                        <option value="1">اجباری</option>
                    </select>
                </div>

            </div>
            <div class="col-md-2 right">
                ضرفیت : @{{cat_num_file}}
            </div>
            <div class="col-md-12 right list_button_insert">
                <button v-if="send_valid" type="button" class="btn btn-success" @click="add_files_type()">ذخیره</button>
                <div v-if="!send_valid" class="alert alert-danger" role="alert">
                    تمام عناوین این دسته پر شده است
                </div>
            </div>
        </div>
    </div>
</div>
@endsection