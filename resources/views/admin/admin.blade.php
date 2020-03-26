@include('admin.header')

        <div class="content container-fluid main_box" v-if="logined && admin">
            <div class="div col-md-9 left">
            @yield('content')
            </div>
            @include('admin.sidebar')
        </div>

@include('admin.footer')
