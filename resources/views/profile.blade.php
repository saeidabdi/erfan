@include('header')
<div class="content container main_box" v-if="logined">
    <div class="div col-lg-9 left">
        <div class="row welcome">
            پروفایل @{{name}}
        </div>
        <div class="col-md-12" style="padding-top: 10px;">
            <div class="col-md-4 right">
                <div v-if="img_user" class="row form-group" style="width: 83%;position: relative;">
                    <img :src="'/images/' + img_user" style="width: 80%;border-radius: 100%;" class="img-circle" alt="عکس کاربری">
                    <button title="حذف عکس" type="button" class="btn btn-danger delete_img" @click="delete_img(img_user)">
                        <i class="fas fa-window-close"></i>
                    </button>
                </div>
                <div v-if="!img_user" class="form-group">
                    <div class="card-body">
                        <form @submit="upload_img_user" enctype="multipart/form-data">
                            عکس : <input type="file" class="form-control" v-on:change="onImageChange">
                            <button class="btn btn-success">آپلود عکس</button>
                        </form>
                    </div>
                </div>
                <div class="form-group">
                    نام و نام خانوادگی : <input class="form-control" v-model="name">
                </div>
                <div class="form-group">
                    شماره تماس : <input type="number" v-model="mobile" class="form-control">
                </div>
                <div class="form-group">
                    ایمیل : <input type="email" class="form-control" v-model="mail">
                </div>
            </div>
            <div class="col-md-4 right">
                <div class="form-group">
                    آدرس : <textarea class="form-control" v-model="address" rows="4" id="comment"></textarea>
                </div>
                <div class="form-group">
                    کد ملی : <input dir="ltr" class="form-control" v-model="code_meli">
                </div>
            </div>
            <div class="col-md-4 right">
                <button type="button" class="btn btn-success" @click="save_profile()">ذخیره</button>
            </div>
        </div>
    </div>
    @include('layout.sidebar')
</div>
@include('footer')