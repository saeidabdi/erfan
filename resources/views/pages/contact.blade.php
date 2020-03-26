@include('header')
<div class="content" style="width: 100%;" v-if="logined">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d810.4694973291125!2d51.059471211119785!3d35.65537759215222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8df25ddb03489d%3A0xc1144289314dff35!2z2K_Yp9ix2YjYrtin2YbZhyDYs9i52K_Zig!5e0!3m2!1sen!2s!4v1584969808694!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    <div style="background: #fff;min-height: 400px;margin-top: -9px;">
        <div class="container" style="padding: 40px;">
            <h1 class="col-md-4 heding_pages">
                <span>تماس با ما</span>
            </h1>
            <ul class="list-group col-md-4 ul_pages">
                <li class="list-group-item active">راههای ارتباطی</li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <i class="fas fa-phone"></i>
                    <a href="tel:09028545707">09028545707</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:erfan@gmail.com">erfan@gmail.com</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <i class="fab fa-instagram"></i>
                    <a href="https://www.instagram.com/saeid.abdi_78/">@saeid.abdi_78</a>
                </li>
            </ul>
            <ul class="list-group col-md-4 ul_pages">
                <li class="list-group-item active">ساعات کاری</li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    شنبه
                    <span class="badge badge-primary badge-pill">8 تا 6</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    یکشنبه
                    <span class="badge badge-primary badge-pill">8 تا 7</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    چهارشنبه
                    <span class="badge badge-primary badge-pill">6 تا 5</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@include('footer')