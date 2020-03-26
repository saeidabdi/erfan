

require('./bootstrap');

window.Vue = require('vue');
import swal from 'sweetalert';
import moment from 'jalali-moment';
import Swal2 from 'sweetalert2'
// var moment = require('jalali-moment');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        username: '', pass: '', mobile: '', name: '', pass2: '', user_id: '', ceredi: '', time_added: '', code_meli: '', address: '', mail: '', img_user: '',
        status: '', userok: 0, logined: '', image: '', previewImage: '', type_cat: '', jens_cat: '', select_attrs: [], loading: 0, all_order: [], order_id: '', order: [], order_title: '',
        order_counts: 0, order_price0: 0, ordering_for_ok: 0, ordering_for_servise: 0, order_price3: 0, ordering_for_reedy: 0, ordering_for_end: 0,
        // admin
        cat_select: 0, cat_title: '', cat_num_file: 0, all_cat: [], all_size: [],
        admin: 0, cat_id: 0, is_edit: '', cat_size: '', size_id: '', count_price: '', count: '',
        all_count: [], count_id: '', attr: '', all_attr: [], attr_ids: [], forced_file: 0, type_file_name: '', type_file_id: '', all_type_file: [], send_valid: 1, file: [], index_file: -1,
        final_price: 0, file_names: [], desc: '', inorder: [], time_payment: '', servise_price: 0, admin_files: [], news_title: '', news_desk: '', all_news: [],news_id:''
    },
    mounted() {
        this.getuser();
    },
    watch: {
        'username': function () {
            if (!this.username) {
                this.userok = 0;
                return;
            }
            axios
                .post('/check_username', {
                    username: this.username
                }).then(response => {
                    if (response.data.length == 0) {
                        if (this.username) {
                            $("#username").css('color', 'green');
                            $("#username").css('border-bottom', '1px solid green');
                            this.userok = 1;
                        }
                    } else {
                        $("#username").css('color', 'red');
                        $("#username").css('border-bottom', '1px solid red');
                        this.userok = 0;
                    }
                }, response => { });
        }
    },
    methods: {
        //  ---------------user
        exit_user() {
            axios
                .get('/exit_user')

                .then(response => {
                    swal(name + 'شما خارج شدید')
                    location.href = "/";

                }, response => {
                    swal('خارج نشد')

                });
        },
        login() {
            axios
                .post('/login', {
                    username: this.username,
                    pass: this.pass

                }).then(response => {
                    if (response.data.username != undefined) {
                        if (response.data.status == 2) {
                            swal('مدیر گرامی ' + response.data.name + ' شما وارد شدید');
                            this.admin = 1;
                            location.href = "/admin/index";
                        } else {
                            swal(response.data.name + ' شما وارد شدید ');
                            location.href = "/home";
                        }

                    } else {
                        swal('کاربر وجود ندارد')

                    }

                }, response => {
                    swal('مشکل در اتصال به سرور')
                });
        },
        register() {
            if (this.pass == this.pass2) {
                if (this.userok == 1) {
                    axios
                        .post('/register', {
                            name: this.name,
                            username: this.username,
                            mobile: this.mobile,
                            pass: this.pass,
                            time_added: Math.floor(Date.now() / 1000)

                        }).then(response => {
                            this.logined = 1;
                            location.href = "/home";
                            swal('ثبت نام شدید')

                        }, response => {
                            swal('ثبت نام نشدید')

                        })

                } else {
                    swal("نام کاربری معتبر نیست");
                }
            }
            else {
                swal("کلمه عبور با تکرار کلمه عبور برابر نیست");
            }
        },
        save_profile() {
            axios.
                post('/save_profile', {
                    user_id: this.user_id,
                    name: this.name, code_meli: this.code_meli,
                    mobile: this.mobile,
                    mail: this.mail,
                    address: this.address
                }).then(
                    response => {
                        swal('پروفایل بروزرسانی شد.')
                    }, response => { })
        },
        go_to_cat(cat_id) {
            this.cat_id = cat_id;
            for (var i = 0; i < this.all_cat.length; i++) {
                if (this.all_cat[i].id == cat_id) {
                    this.cat_title = this.all_cat[i].title;
                    this.cat_num_file = this.all_cat[i].num_file;
                }
            }
        },
        async change_jens() {
            // for get sizes
            if (!this.all_size.length) {
                await this.get_size();
            }
            // for get count_file
            if (!this.all_type_file.length) {
                await this.get_type_file();
            }

            // for get attrs
            if (!this.all_attr.length) {
                await this.get_attr();
            }
            this.attr_ids = [];
            this.select_attrs = [];

            // detect who attr
            for (var i = 0; i < this.all_cat.length; i++) {
                if (this.all_cat[i].id == this.jens_cat) {
                    if (this.all_cat[i].attr_ids) {
                        var new_ids = this.all_cat[i].attr_ids.split(',');
                        var result = new_ids.map((x) => { return parseInt(x, 10); });
                        this.attr_ids.push(...result)
                    }
                }
            }
        },
        change_type() {
            this.jens_cat = '';
            this.attr_ids = [];
            this.size_id = '';
            this.count_id = '';
            this.final_price = 0;
        },
        change_size() {
            if (!this.all_count.length) {
                this.get_count();
            }
            this.final_price = 0;
        },
        change_count() {
            for (var i = 0; i < this.all_count.length; i++) {
                if (this.all_count[i].id == this.count_id) {
                    this.final_price = this.all_count[i].price;
                }
            }
        },
        add_order() {
            var filearr = [];
            for (var i = 0; i < this.file.length; i++) {
                if (this.file[i]) {
                    filearr.push(this.file[i]);
                }
            }
            // send data to server
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            if (this.type_cat) {
                let formData = new FormData();
                formData.append('cat_id', this.jens_cat);
                formData.append('select_attrs', this.select_attrs);
                formData.append('size_id', this.size_id);
                formData.append('count_id', this.count_id);
                var cunter = 0;
                for (var i = 0; i < filearr.length; i++) {
                    formData.append('file' + i, filearr[i]);
                    cunter++;
                }
                formData.append('cunter', cunter);
                formData.append('user_id', this.user_id);
                formData.append('price', this.final_price);
                formData.append('time_added', Math.floor(Date.now() / 1000));
                formData.append('desk', this.desc);

                axios.post('/create_order', formData, config)
                    .then(async response => {
                        if (response.data.success == 'ok') {
                            await Swal2.fire('', 'سفارش شما با موفقیت ثبت شد', 'success');
                            location.href = '/allorder';
                        } else {
                            Swal2.fire('', 'مشکل در ثبت سفارش!', 'error')
                        }

                    })
            } else {
                Swal2.fire('', 'فیلد های اجباری را پر کنید!', 'error')
            }

        },
        change_up_file(e, index) {
            this.file[index] = e.target.files[0];
            var en = this;
            $(document).ready(function () {
                var label = $('.file' + index).parent('div').find('label').text();
                // en.file_names[index] = label;
                var pasvand = en.file[index].name.split('.').pop();
                en.file[index] = new File([en.file[index]], label + '.' + pasvand, { type: en.file[index].type });
            });
        },
        allorder() {
            axios
                .post('/get_allorder', { user_id: this.user_id }).then(response => {
                    this.all_order = response.data;
                })
        },
        delete_order(order_id) {
            Swal2.fire({
                title: 'سفارش حذف شود؟',
                text: 'سفارش حذف شده شما قابل بازگشت نمیباشد !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'حذف',
                cancelButtonText: 'لغو حذف'
            }).then((result) => {
                if (result.value) {
                    this.loading = 1;
                    this.loading_func();
                    axios
                        .post('/delete_order', { id: order_id })
                        .then(async response => {
                            if (window.location.pathname == '/admin/orders') {
                                await this.get_adminorder();
                            } else {
                                await this.allorder();
                            }
                            this.loading = 0;
                            this.loading_func();
                            Swal2.fire(
                                'حذف شد!',
                                'سفارش شما با موفقیت حذف شد',
                                'success'
                            )
                        })

                }
            })
        },
        loading_func() {
            if (this.loading == 1) {
                swal({
                    title: '',
                    text: 'لطفا صبر کنید ...',
                    buttons: false
                })

            } else {
                swal.close();
            }
        },
        get_inorder(order_id, order_title) {
            this.loading = 1;
            this.loading_func();
            axios
                .post('/get_inorder', {
                    order_id: order_id
                }).then(response => {
                    this.loading = 0;
                    this.loading_func();
                    this.order = response.data;
                    this.order_title = order_title;
                    this.order_id = order_id;
                    this.final_price = response.data.price;
                    this.time_added = moment.unix(response.data.time_added).format("jYYYY/jMM/jDD");
                })
        },
        get_user_orders(user_id) {
            axios
                .post('/get_user_orders', { user_id: user_id })
                .then(response => {
                    for (var i = 0; i < response.data.length; i++) {
                        this.order_counts++;
                        if (response.data[i].status == 0) {
                            this.order_price0 += response.data[i].price;
                            this.ordering_for_ok++;
                        }
                        if (response.data[i].status == 1) {
                            this.ordering_for_servise++;
                        }
                        if (response.data[i].status == 3) {
                            this.ordering_for_reedy++;
                        }
                        if (response.data[i].status == 4) {
                            this.ordering_for_end++;
                            this.order_price3 += response.data[i].price + response.data[i].price_service;
                        }
                    }
                })
        },
        all_orders_user(user_id) {
            axios
                .post('/get_user_orders', { user_id: user_id })
                .then(response => {
                    this.all_order = response.data;
                })
        },
        end_orders_user(user_id) {
            axios
                .post('/get_user_orders', { user_id: user_id })
                .then(response => {
                    this.all_order = response.data;
                })
        },
        pay_order() {
            // alert('ss')
            this.loading = 1;
            this.loading_func();
            location.href = '/pay_order/' + this.order[0].id
        },
        // ---------------admin
        add_cat(e) {
            // e.preventDefault();
            let currentObj = this;

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('image', this.image);
            formData.append('cat_select', this.cat_select);
            formData.append('cat_title', this.cat_title);
            formData.append('cat_num_file', this.cat_num_file);
            if (this.is_edit) {
                formData.append('id', this.cat_id);
            }

            axios.post('/admin/add_cat', formData, config)
                .then((response) => {
                    if (response.data.success == 'update') {
                        swal('دسته ' + this.cat_title + ' بروزرسانی شد')
                    } else {
                        swal('دسته ' + this.cat_title + ' اضافه شد')
                    }
                    location.href = "/admin/cat"
                })
                .catch(function (error) {
                    // currentObj.output = error;
                });
        },
        get_cat() {
            axios
                .get('/admin/get_cat').then(
                    response => {
                        this.all_cat = response.data

                    })
            // setInterval(this.get_cat(),2000) 
        },
        delete_cat(parent_id) {
            // parent_id = this.cat_select,
            var all_id = [parent_id];

            for (var i = 0; i < this.all_cat.length; i++) {

                if (this.all_cat[i].parent == parent_id) {

                    all_id.push(this.all_cat[i].id);

                    for (var j = 0; j < this.all_cat.length; j++) {
                        if (this.all_cat[j].parent == this.all_cat[i].id) {

                            all_id.push(this.all_cat[j].id);

                        }

                    }
                }
            }

            axios
                .post('/admin/delete_cat', {
                    cat_select: all_id
                }).then(response => {

                    this.get_cat();
                    swal('دسته حذف شد')

                })
        },
        cat_edit(cat_id) {

            for (var i = 0; i < this.all_cat.length; i++) {
                if (this.all_cat[i].id == cat_id) {
                    this.cat_id = this.all_cat[i].id;
                    this.cat_title = this.all_cat[i].title;
                    this.cat_select = this.all_cat[i].parent;
                    this.previewImage = '/images/' + this.all_cat[i].img;
                    this.cat_num_file = this.all_cat[i].num_file;
                }
            }
            this.is_edit = 1;
        },
        add_size() {
            if (this.cat_select && this.cat_size) {
                if (!this.is_edit) {
                    this.size_id = '';
                }
                axios
                    .post('/admin/add_size', {
                        cat_select: this.cat_select,
                        cat_size: this.cat_size,
                        id: this.size_id
                    }).then(
                        response => {
                            this.get_size();
                            if (response.data.success == 'update') {
                                swal('اندازه ویرایش  شد')
                                return;
                            }
                            swal('ابعاد جدید اضافه شد')

                        })

            } else {
                swal('تمام فیلد ها رو پر کنید')
            }
        },
        get_size() {
            axios
                .get('/admin/get_size').then(
                    response => {
                        this.all_size = response.data;
                    })
        },
        delete_size(size_id) {
            axios
                .post('/admin/delete_size', {
                    id: size_id
                }).then(response => {
                    this.get_size();
                    swal('ابعاد با موفیت حذف شد')
                })
        },
        size_edit(size_id) {

            for (var i = 0; i < this.all_size.length; i++) {
                if (this.all_size[i].id == size_id) {
                    this.size_id = this.all_size[i].id;
                    this.cat_size = this.all_size[i].size;
                    this.cat_select = this.all_size[i].cat_id;
                }
            }
            this.is_edit = 1;
        },
        add_count() {
            if (this.cat_select && this.size_id && this.count && this.count_price) {
                if (!this.is_edit) {
                    this.count_id = '';
                }
                axios
                    .post('/admin/add_count', {
                        cat_select: this.cat_select,
                        size_id: this.size_id,
                        count: this.count,
                        count_price: this.count_price,
                        id: this.count_id
                    }).then(
                        response => {
                            this.get_count();
                            if (response.data.success == 'update') {
                                swal('تعداد ویرایش  شد')
                                return;
                            }
                            swal('تعداد جدید اضافه شد')

                        })
            } else {
                swal('لطفا تمام فیلد ها رو پر کنید')
            }
        },
        get_count() {
            axios
                .get('/admin/get_count').then(
                    response => {
                        this.all_count = response.data;
                    })
        },
        delete_count(count_id) {
            axios
                .post('/admin/delete_count', {
                    id: count_id
                }).then(response => {
                    this.get_count();
                    swal('تعداد با موفیت حذف شد')
                })
        },
        count_edit(count_id) {
            for (var i = 0; i < this.all_count.length; i++) {
                if (this.all_count[i].id == count_id) {
                    this.count_id = this.all_count[i].id;
                    this.cat_select = this.all_count[i].cat_id;
                    this.count = this.all_count[i].number;
                    this.count_price = this.all_count[i].price;
                }
            }
            this.is_edit = 1;
        },
        add_attr() {
            axios
                .post('/admin/add_attr', {
                    attr: this.attr,
                }).then(response => {
                    this.get_attr();
                    swal('ویژگی جدید اضافه شد')

                })
        },
        get_attr() {
            axios
                .get('/admin/get_attr').then(
                    response => {
                        this.all_attr = response.data;
                    })
        },
        set_cat() {
            this.attr_ids = [];
            for (var i = 0; i < this.all_cat.length; i++) {
                if (this.all_cat[i].id == this.cat_select) {
                    if (this.all_cat[i].attr_ids) {
                        var new_ids = this.all_cat[i].attr_ids.split(',');
                        var result = new_ids.map((x) => { return parseInt(x, 10); });
                        this.attr_ids.push(...result)
                    }
                }
            }

        },
        update_attr() {
            axios
                .post('/admin/update_attr', {
                    cat_select: this.cat_select,
                    attr_ids: this.attr_ids
                }).then(response => {
                    this.get_cat();
                    swal('ویژگی ها ثبت شدند')

                })
        },
        add_files_type() {
            if (!this.is_edit) {
                this.type_file_id = '';
            }
            axios
                .post('/admin/add_files_type', {
                    cat_select: this.cat_select,
                    type_file_name: this.type_file_name,
                    forced_file: this.forced_file,
                    id: this.type_file_id
                }).then(response => {
                    this.get_type_file();
                    if (response.data.success == 'add') {
                    } else {
                        swal('عنوان فایل ویرایش شد')
                    }
                })
        },
        change_cat() {
            if (!this.all_type_file.length) {
                this.get_type_file();
            }
            // get limit for this cat
            for (var i = 0; i < this.all_cat.length; i++) {
                if (this.all_cat[i].id == this.cat_select) {
                    this.cat_num_file = this.all_cat[i].num_file;
                }
            }
            // count created file_type
            var j = 0;
            for (var i = 0; i < this.all_type_file.length; i++) {
                if (this.all_type_file[i].cat_id == this.cat_select) {
                    j++;
                }
            }
            // set send_valid
            if (this.cat_num_file > j) {
                this.send_valid = 1;
            }
            else {
                this.send_valid = 0;
            }

        },
        get_type_file() {
            axios
                .get('/admin/get_type_file').then(response => {
                    this.all_type_file = response.data;
                })
        },
        delete_type_file(type_file_id) {
            axios
                .post('/admin/delete_type_file', {
                    id: type_file_id
                }).then(response => {
                    this.get_type_file();
                    swal('عنوان با موفیت حذف شد')
                })
        },
        edit_type_file(type_file_id) {
            for (var i = 0; i < this.all_type_file.length; i++) {
                if (this.all_type_file[i].id == type_file_id) {
                    this.cat_select = this.all_type_file[i].cat_id;
                    this.type_file_name = this.all_type_file[i].name;
                    this.forced_file = this.all_type_file[i].forced;
                    this.type_file_id = type_file_id;
                }
            }
            this.is_edit = 1;
        },
        get_adminorder(a = 0) {
            this.order_id = '';
            if (a == 0) {
                this.loading = 1;
                this.loading_func();
            }
            axios
                .get('/admin/get_adminorder')
                .then(response => {
                    if (a == 0) {
                        this.loading = 0;
                        this.loading_func();
                    }
                    this.order = response.data;
                })
        },
        show_admin_order(order_id, order_title) {
            this.loading = 1;
            this.loading_func();
            axios
                .post('/get_inorder', {
                    order_id: order_id
                }).then(response => {
                    this.loading = 0;
                    this.loading_func();
                    this.visited(order_id);
                    this.inorder = response.data;
                    this.order_title = order_title;
                    this.order_id = order_id;
                    this.time_added = moment.unix(response.data[0].time_added).format("jYYYY/jMM/jDD");
                    if (response.data[0].time_payment) {
                        this.time_payment = moment.unix(response.data[0].time_payment).format("jYYYY/jMM/jDD");
                    }
                    this.count_price = response.data[0].price + response.data[0].price_service;
                })
        },
        visited(order_id) {
            axios.post('/admin/visited', { order_id: order_id })
        },
        okOrder(order_id) {
            this.loading = 1;
            this.loading_func();
            axios
                .post('/admin/okorder', {
                    order_id: order_id,
                    servise_price: this.servise_price
                }).then(response => {
                    this.loading = 0;
                    this.loading_func();
                    Swal2.fire('', 'سفارش شما با موفقیت تایید شد', 'success');
                    this.get_adminorder();
                })
        },
        complet_order(order_id) {
            this.loading = 1;
            this.loading_func();
            axios
                .post('/admin/complet_order', {
                    order_id: order_id
                }).then(response => {
                    this.loading = 0;
                    this.loading_func();
                    Swal2.fire('', 'سفارش  با موفقیت تکمیل شد', 'success');
                    this.get_adminorder();
                })
        },
        get_file_admin() {
            this.loading = 1;
            this.loading_func();
            axios
                .get('/admin/get_files')
                .then(response => {
                    this.loading = 0;
                    this.loading_func();
                    this.admin_files = response.data;
                })
        },
        delete_admin_files(file_addr) {
            axios
                .post('/admin/delete_admin_files', { file_addr: file_addr })
                .then(response => {
                    this.get_file_admin();
                })
        },
        Delivery(order_id) {
            this.loading = 1;
            this.loading_func();
            axios
                .post('/admin/Delivery', {
                    order_id: order_id
                }).then(response => {
                    this.loading = 0;
                    this.loading_func();
                    Swal2.fire('', 'سفارش شما با موفقیت تایید شد', 'success');
                    this.get_adminorder();
                })
        },
        add_news() {
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('image', this.image);
            formData.append('news_title', this.news_title);
            formData.append('news_desk', this.news_desk);
            formData.append('user_name', this.name);
            if (this.is_edit) {
                formData.append('id', this.news_id);
            }

            axios.post('/admin/add_news', formData, config)
                .then((response) => {
                    if (response.data.success == 'update') {
                        swal('خبر بروزرسانی شد')
                    } else {
                        swal('خبر اضافه شد')
                    }
                    this.get_news();
                })
        },
        get_news() {
            this.is_edit = 0;this.news_title = '';this.news_desk = '';this.previewImage = '';
            this.loading = 1;
            this.loading_func();
            axios
                .get('/admin/get_news')
                .then(response => {
                    this.all_news = response.data;
                    this.loading=0;
                    this.loading_func();
                })
        },
        delete_new(news_id) {
            Swal2.fire({
                title: 'خبر حذف شود؟',
                text: 'خبر حذف شده شما قابل بازگشت نمیباشد !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'حذف',
                cancelButtonText: 'لغو حذف'
            }).then((result) => {
                if (result.value) {
                    this.loading = 1;
                    this.loading_func();
                    axios
                        .post('/admin/delete_new', { id: news_id })
                        .then(async response => {
                            this.get_news();
                            this.loading = 0;
                            this.loading_func();
                            Swal2.fire(
                                'حذف شد!',
                                'خبر شما با موفقیت حذف شد',
                                'success'
                            )
                        })

                }
            })
        },
        new_edit(news_id){
            this.loading = 1;this.loading_func()
            this.is_edit = 1;
            axios
                .post('/admin/new_edit',{id:news_id})
                .then(response=>{
                    this.news_title = response.data[0].title;
                    this.news_desk = response.data[0].desk;
                    this.previewImage = response.data[0].img;
                    this.news_id = response.data[0].id;
                    this.loading = 0;this.loading_func()
                })
        },
        // get with load page
        getuser() {
            axios.get('/getuser').then(response => {
                if (response.data.username != undefined) {
                    this.logined = 1;
                    this.user_id = response.data.id
                    if (response.data.status == 2) {
                        this.admin = 1;
                        this.name = response.data.name
                        this.get_cat();
                        this.get_size();
                        this.get_count();
                        this.get_attr();
                        if (window.location.pathname == '/admin/orders') {
                            this.get_adminorder();
                            setInterval(() => {
                                if (!this.order_id) {
                                    this.get_adminorder(1);
                                }

                            }, 10000);
                        }
                        if (window.location.pathname == '/admin/files') {
                            this.get_file_admin();
                        }
                        if (window.location.pathname == '/admin/news') {
                            this.get_news();
                        }
                        return;
                    }
                    if (window.location.pathname == '/allorder') {
                        this.allorder();
                    }
                    if (window.location.pathname == '/home') {
                        this.get_user_orders(response.data.id);
                    }
                    if (window.location.pathname == '/all_orders_user') {
                        this.all_orders_user(response.data.id);
                    }
                    if (window.location.pathname == '/end_orders_user') {
                        this.end_orders_user(response.data.id);
                    }
                    this.getMobile(response.data.id);
                    this.getAddr(response.data.id);
                    this.getmail(response.data.id);
                    this.getimg_user(response.data.id);
                    this.get_cat_user();
                    this.username = response.data.username
                    this.name = response.data.name
                    this.ceredi = response.data.ceredi
                    var day = moment.unix(response.data.time_added).format("jYYYY/jMM/jDD");
                    this.time_added = day
                    this.code_meli = response.data.code_meli
                } else {
                    this.logined = '';
                }
            });
        },
        getMobile(user_id) {
            axios
                .post('/getmobile', { user_id: user_id }).then(
                    response => {
                        if (response.data['0'].type == 0) {
                            this.mobile = response.data['0'].number_phone;
                        }
                    }, response => { })
        },
        getAddr(user_id) {
            axios
                .post('/getaddr', { user_id: user_id }).then(
                    response => {
                        this.address = response.data.address;
                    }, response => { })
        },
        getmail(user_id) {
            axios
                .post('/getmail', { user_id: user_id }).then(
                    response => {
                        this.mail = response.data.mail;
                    }, response => { })
        },
        getimg_user(user_id) {
            axios
                .post('/getimg_user', { user_id: user_id }).then(
                    response => {
                        this.img_user = response.data.img;
                    }, response => { })
        },
        get_cat_user() {
            axios
                .get('/get_cat').then(
                    response => {
                        this.all_cat = response.data

                    })
        },
        // img
        onImageChange(e) {
            this.image = e.target.files[0];

            const reader = new FileReader();
            reader.readAsDataURL(this.image);
            reader.onload = e => {
                this.previewImage = e.target.result;
            };
        },
        upload_img_user(e) {
            e.preventDefault();
            let currentObj = this;

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('image', this.image);
            formData.append('refrence_id', this.user_id);

            axios.post('/upload_img_user', formData, config)
                .then((response) => {
                    this.img_user = response.data.img;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
        },
        delete_img(img) {
            axios
                .post('/delete_img', { img: img }).then(
                    response => {
                        this.img_user = 0;
                        swal('عکس حذف شد')
                    },
                    response => { })
        }

    }
});
