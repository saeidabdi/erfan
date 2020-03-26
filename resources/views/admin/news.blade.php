@extends('admin.admin')

@section('content')
<div class="col-md-12" style="padding-top: 10px;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link " id="all-cat" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">اخبار</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="add-cat" data-toggle="tab" href="#addcat" role="tab" aria-controls="profile" aria-selected="false">ایجاد خبر جدید</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div v-if="!is_edit" class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="all-cat">

            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>ردیف</th>
                    <th>عنوان</th>
                    <th>بازدید</th>
                    <th>عکس</th>
                    <th>نویسنده</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    <tr v-for="news in all_news">
                        <td>@{{news.id}}</td>
                        <td>@{{news.title}}</td>
                        <td>@{{news.view}}</td>
                        <td><img style="width:35px;height: 35px;" :src="'/images/'+news.img" alt=""></td>
                        <td>@{{news.user_name}}</td>
                        <td class="td_edit" @click="new_edit(news.id)"><i class="fa fa-edit"></i></td>
                        <td class="td_delete" @click="delete_new(news.id)"><i class="fa fa-trash"></i></td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div v-if="is_edit" class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="all-cat">

            <div class="col-md-12 right">
                <div class="form-group">
                    <label class="label cat_lable"> عنوان خبر</label>
                    <input class="form-control" v-model="news_title">
                </div>
            </div>
            <div class="col-md-12 right">
                <div class="form-group">
                    <label class="label cat_lable">متن خبر</label>
                    <textarea style="min-height: 180px;" class="form-control" v-model="news_desk"></textarea>
                </div>
            </div>
            <div class="col-md-6 right">
                <div class="form-group">
                    <input type="file" class="form-control" v-on:change="onImageChange">
                </div>
                <div class="form-group">
                    <img style="width: 100%;" :src="'/images/'+previewImage">
                </div>
            </div>

            <div class="col-md-4 right list_button_insert">
                <button type="button" class="btn btn-warning" @click="add_news()">ویرایش</button>
                <button type="button" class="btn btn-danger" @click="()=>{is_edit=0}">انصراف</button>
            </div>
        </div>


        <div class="tab-pane fade show active" id="addcat" role="tabpanel" aria-labelledby="add-cat">

            <div class="col-md-12 right">
                <div class="form-group">
                    <label class="label cat_lable"> عنوان خبر</label>
                    <input class="form-control" v-model="news_title">
                </div>
            </div>
            <div class="col-md-12 right">
                <div class="form-group">
                    <label class="label cat_lable">متن خبر</label>
                    <textarea class="form-control" v-model="news_desk"></textarea>
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
            <div class="col-md-2 right list_button_insert">
                <button type="button" class="btn btn-success" @click="add_news()">ثبت خبر</button>
            </div>
        </div>
    </div>
</div>
@endsection