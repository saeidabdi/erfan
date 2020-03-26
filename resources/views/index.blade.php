@include('header')
<div class="content">
    <div class="col-lg-12 col-md-12 col-sx-12">
        <div dir="ltr" class="col-md-8 col-xs-12 col-sm-12 for_slider">
            <div id="base">
                <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:789px;margin:0px auto 56px;">
                    <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
                        <ul class="amazingslider-slides" style="display:none;">
                            <li><img src="/as/images/erfan 4.png" alt="" title="" />
                            </li>
                            <li><img src="/as/images/erfan 2.png" alt="" title="" />
                            </li>
                            <li><img src="/as/images/erfan 3.png" alt="" title="" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="login_form">
                <!-- =============== inputs and buttons ================ -->
                <div class="col-lg-10 col-md-10 col-sx-10" style="float: right;">
                    <div v-if="!status" style="margin-top: 65px;" class="input-group mb-2 login_inputs">
                        <input dir="rtl" type="text" v-model="username" class="form-control" placeholder="نام کاربری">
                        <i v-if="!username" class="fa fa-user"></i>
                        <i v-if="username" class="fa fa-user active"></i>
                    </div>
                    <div v-if="status" class="input-group mb-2 login_inputs">
                        <input id="username" dir="rtl" type="text" v-model="username" class="form-control" placeholder="نام کاربری">
                        <i v-if="!username" class="fa fa-user"></i>
                        <i v-if="username" class="fa fa-user active"></i>
                    </div>
                    <div v-if="status==1" class="input-group mb-2 login_inputs">
                        <input dir="rtl" v-model="name" class="form-control" placeholder="سعید عبدی">
                        <i v-if="!name" class="fa fa-user"></i>
                        <i v-if="name" class="fa fa-user active"></i>
                    </div>
                    <div v-if="status==1" class="input-group mb-2 login_inputs">
                        <input type="number" v-model="mobile" class="form-control" placeholder="091267***94">
                        <i v-if="!mobile" class="fa fa-phone"></i>
                        <i v-if="mobile" class="fa fa-phone active"></i>
                    </div>
                    <div class="input-group mb-2 login_inputs">
                        <input type="password" v-model="pass" class="form-control" placeholder="*****">
                        <i v-if="!pass" class="fa fa-lock"></i>
                        <i v-if="pass" class="fa fa-lock active"></i>
                    </div>
                    <div v-if="status==1" class="input-group mb-2 login_inputs">
                        <input v-model="pass2" class="form-control" placeholder="*****">
                        <i v-if="!pass2" class="">تکرار پسورد</i>
                        <i v-if="pass2" class="active">تکرار پسورد</i>
                    </div>
                    <!-- login -->
                    <button v-if="!username && !status" class="btn_login btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">ورود</button>
                    <button v-if="username && !status" style="color: #050505;background: linear-gradient(to right, rgba(255,0,0,0), rgb(7, 106, 254));" class="btn_login btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" @click="login()">ورود</button>
                    <!-- register -->
                    <button v-if="(!name || !username || !mobile || !pass2 || !pass) && status" class="btn_login btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">ثبت نام</button>
                    <button v-if="(name && username && mobile && pass2 && pass) && status" style="color: #050505;background: linear-gradient(to right, rgba(255,0,0,0), rgb(7, 106, 254));" class="btn_login btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" @click="register()">ثبت نام</button>
                    <!-- ========================== reg login forget ================= -->
                    <a style="width: 48%;" href="#" class=" btn btn-dark col-md-6" role="button" aria-pressed="true">فراموشی رمز؟</a>
                    <a href="#" v-if="status==0" class="btn btn-success col-md-6" role="button" aria-pressed="true" @click="()=>{status=1}">ثبت نام</a>
                    <a href="#" v-if="status==1" class="btn btn-success col-md-6" role="button" aria-pressed="true" @click="()=>{status=0}">ورود</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 siderbar">
            <div class="list-group" style="margin-top: 55px;">
                @foreach($news_latest as $news)
                <a href="/news/{{$news->id}}" class="list-group-item list-group-item-action">
                    <div class="thumb_date right">
                        {{$news->time_added}}
                    </div>
                    {{mb_strimwidth($news->title, 0, 50, '...')}}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('footer')