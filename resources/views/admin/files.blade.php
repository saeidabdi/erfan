@extends('admin.admin')

@section('content')
<div class="col-md-12" style="padding-top: 10px;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <!-- <li class="nav-item">
            <a class="nav-link " id="all-cat" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">اندازه ها</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link active" id="add-cat" data-toggle="tab" href="#addcat" role="tab" aria-controls="profile" aria-selected="false">کاربران</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="addcat" role="tabpanel" aria-labelledby="add-cat">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>ردیف</th>
                    <th>عنوان فایل</th>
                    <th>شناسه سفارش</th>
                    <th>دانلود</th>
                    <th>حذف</th>
                </thead>
                <tbody>
                    
                    <tr v-for="file in admin_files">
                        <td>@{{file.id}}</td>
                        <td>@{{file.file_name}}</td>
                        <td>@{{file.order_id}}</td>
                        <td class="td_edit"><a :href="'/files/'+file.file_addr" download><i class="fa fa-download" aria-hidden="true"></i></a></td>
                        <td class="td_delete" @click="delete_admin_files(file.file_addr)"><i class="fa fa-trash"></i></td>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection