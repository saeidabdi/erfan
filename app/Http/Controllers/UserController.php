<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mobile;
use App\Addr;
use App\Attr;
use App\Mail;
use App\Image;
use App\Orders;
use App\Files;
use Session;
use DB;
use Verta;
use App\Lib\zarinpal;

class UserController extends Controller
{
    public function check_username(Request $request)
    {
        $username = $request->username;
        $username = User::where('username', $username)->get();

        return $username;
    }

    public function register(Request $request)
    {

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->pass = $request->pass;
        $user->time_added = $request->time_added;

        if ($user->save()) {

            $mobile = new Mobile;
            $mobile->user_id = $user->id;
            $mobile->number_phone = $request->mobile;
            $mobile->type = 0;

            $mail = new Mail;
            $mail->user_id = $user->id;
            $mail->save();

            $addr = new Addr;
            $addr->user_id = $user->id;
            $addr->save();


            if ($mobile->save()) {
                Session::put('username', $request->username);
                return $user;
            }
        }
    }

    public function login(Request $request)
    {

        $username = $request->username;
        $pass = $request->pass;

        $logined = User::where('username', $username)->where('pass', $pass)->first();

        if ($logined) {
            Session::put('username', $username);
            return $logined;
        }
    }

    public function exit_user()
    {
        $exit_user = Session::forget('username');
        if ($exit_user) {
            return true;
        }
    }

    public function profile()
    {
        return view('profile');
    }

    public function getmobile(Request $request)
    {
        $user_id = $request->user_id;
        $mobile = Mobile::where('user_id', $user_id)->get();
        return $mobile;
    }

    public function getaddr(Request $request)
    {
        $user_id = $request->user_id;
        $addr = Addr::where('user_id', $user_id)->first();
        return $addr;
    }

    public function getmail(Request $request)
    {
        $user_id = $request->user_id;
        $mail = Mail::where('user_id', $user_id)->first();
        return $mail;
    }

    public function getimg_user(Request $request)
    {
        $user_id = $request->user_id;
        $img = Image::where('refrence_id', $user_id)->where('type', 1)->first();
        return $img;
    }

    public function save_profile(Request $request)
    {

        $user_id = $request->user_id;

        $user = User::where('id', $user_id)->update([
            'name' => $request->name,
            'code_meli' => $request->code_meli
        ]);

        $mobile = Mobile::where('user_id', $user_id)->update([
            'number_phone' => $request->mobile
        ]);

        $addr = Addr::where('user_id', $user_id)->update([
            'address' => $request->address
        ]);

        $mail = Mail::where('user_id', $user_id)->update([
            'mail' => $request->mail
        ]);

        if ($user) {
            return $user;
        }
    }

    public function upload_img_user(Request $request)
    {
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();

        $img = new Image;
        $img->type = 1;
        $img->img = $imageName;
        $img->refrence_id = $request->refrence_id;
        if ($img->save()) {
            $request->image->move(public_path('images'), $imageName);
        }

        return response()->json(['success' => 'You have successfully upload image.', 'img' => $imageName]);
    }

    public function delete_img(Request $request)
    {
        $img = Image::where('img', $request->img)->delete();
        unlink(public_path() .  '/images/' . $request->img);
        return $img;
    }

    public function add_order()
    {
        return view('add_order');
    }

    public function get_cat()
    {
        $all_cat = DB::table('cat')
            ->leftJoin('image', 'cat.id', '=', 'image.refrence_id')
            ->select('cat.id', 'cat.title', 'cat.num_file', 'cat.parent', 'image.img', 'cat.attr_ids')
            ->where('image.type', 0)
            ->get();
        return $all_cat;
    }

    public function create_order(Request $request)
    {
        $order = new Orders;
        $order->price = $request->price;
        $order->cat_id = $request->cat_id;
        $order->count_id = $request->count_id;
        $order->size_id = $request->size_id;
        $order->user_id = $request->user_id;
        $order->attr = $request->select_attrs;
        $order->time_added = $request->time_added;
        $order->desk = $request->desk;

        if ($order->save()) {
            for ($i = 0; $i < $request->cunter; $i++) {

                $str = 'file' . strval($i);
                $imageName = time() + rand(11111, 99999) . '.' . $request->file($str)->getClientOriginalExtension();

                $file = new Files;
                $file->order_id = $order->id;
                $file->file_addr = $imageName;
                $filenameis = explode('.', $request->file($str)->getClientOriginalName());
                $file->file_name = $filenameis[0];
                if ($file->save()) {
                    $request->file($str)->move(public_path('files'), $imageName);
                }
            }
            return response()->json(['success' => 'ok']);
        }
    }

    public function allorder()
    {

        return view('all_order');
    }

    public function get_allorder(Request $request)
    {
        $allwhere = [0, 1, 3];
        // $order = Orders::whereIn('status',$allwhere)->get();

        $orders = DB::table('orders')
            ->where('orders.user_id', $request->user_id)
            ->whereIn('orders.status', $allwhere)
            ->leftJoin('cat', 'orders.cat_id', '=', 'cat.id')
            ->select('orders.id', 'orders.price','orders.price_service', 'orders.status', 'orders.time_added', 'cat.title')
            ->get();
        foreach ($orders as $key=>$order) {
            $v = Verta::createTimestamp((int)$orders[$key]->time_added);
            $orders[$key]->time_added = $v->formatDifference();
        }

        return $orders;
    }

    public function delete_order(Request $request)
    {
        $order = Orders::where('id', $request->id)->update([
            'status' => -1
        ]);

        return $order;
    }

    public function get_inorder(Request $request)
    {
        $order = DB::table('orders')
            ->where('orders.id', $request->order_id)
            ->where('orders.status', '!=', -1)
            ->leftJoin('count', 'orders.count_id', '=', 'count.id')
            ->leftJoin('sizes', 'orders.size_id', '=', 'sizes.id')
            ->leftJoin('cat', 'orders.cat_id', '=', 'cat.id')
            ->select('orders.id', 'orders.price', 'orders.price_service', 'orders.status', 'orders.time_added', 'orders.time_payment', 'orders.desk', 'count.number', 'sizes.size', 'orders.attr', 'orders.time_payment', 'cat.title')
            ->get();

        $attr = $order[0]->attr;
        $attr = explode(',', $attr);

        $attr = Attr::whereIn('id', $attr)->select('attr')->get();

        $files = Files::where('order_id', $request->order_id)->select('file_addr', 'file_name')->get();

        $order[0]->attr = $attr;
        $order[0]->files = $files;

        return $order;
    }

    public function get_user_orders(Request $request)
    {
        $orders = Orders::where('user_id', $request->user_id)->get();

        return $orders;
    }

    public function all_orders_user()
    {
        return view('orders.all_orders_user');
    }

    public function end_orders_user()
    {
        return view("orders.end_orders_user");
    }

    public function pay_order($id)
    {
        $order = Orders::find($id);

        Session::put('id_order', $order->id);

        $zaring = new zarinpal();
        $res = $zaring->pay($order->price + $order->price_service,"www.dasaeid.a123@gmail.com","09028545707");
        return redirect('https://www.zarinpal.com/pg/StartPay/' . $res);
    }

    public function buyback(Request $request)
    {
        $MerchantID = '5e682ada-3b69-11e8-aaf3-005056a205be';
        $Authority =$request->get('Authority') ;
                
        $order=Orders::find(Session::get('id_order'));
        $Amount = $order->price + $order->price_service;
        if ($request->get('Status') == 'OK') {
            $client = new nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
            $client->soap_defencoding = 'UTF-8';
 
            //در خط زیر یک درخواست به زرین پال ارسال می کنیم تا از صحت پرداخت کاربر مطمئن شویم
            $result = $client->call('PaymentVerification', [
                [
                    //این مقادیر را به سایت زرین پال برای دریافت تاییدیه نهایی ارسال می کنیم
                    'MerchantID'     => $MerchantID,
                    'Authority'      => $Authority,
                    'Amount'         => $Amount,
                ],
            ]);
            
            if ($result['Status'] == 100) {
                    $order->status = 2;
                    $order->time_payment = time();
                    if($order->update()){
                        return view('orders.verify_pay',['mes'=>'پرداخت سفارش با شناسه'.$order->id.'با موفقیت انجام شد','success'=>1]);
                    }
            } else {
                return view('orders.verify_pay',['mes'=>'خطا در انجام عملیات','success'=>0]);
            }
        }
        else
        {
            return view('orders.verify_pay',['mes'=>'خطا در انجام عملیات','success'=>0]);
        }
    }
}
