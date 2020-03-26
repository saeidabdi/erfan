<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cat;
use App\Image;
use App\Size;
use App\Count;
use App\Attr;
use App\Files;
use App\Files_type;
use App\Orders;
use App\User;
use App\News;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();
        // count files
        $num_files = count(glob("files/" . "*"));
        $orders = Orders::count();

        return view('admin.index', ['users' => $users,'num_files'=>$num_files,'orders'=>$orders]);
    }

    public function cat()
    {
        return view('admin.cat');
    }

    public function add_cat(Request $request)
    {
        $id = $request->id;
        // for edit cat
        if ($id) {
            $cat = Cat::where('id', $id)->update([

                'title' => $request->cat_title,
                'parent' => $request->cat_select,
                'num_file' => $request->cat_num_file,
            ]);
            if ($request->image) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images'), $imageName);
                $img = Image::where('type', 0)->where('refrence_id', $id)->update([
                    'img' => $imageName,
                ]);
            }
            return response()->json(['success' => 'update']);
        }
        // for add cat
        else {
            $new_cat = new Cat;
            $new_cat->title = $request->cat_title;
            $new_cat->parent = $request->cat_select;
            $new_cat->num_file = $request->cat_num_file;

            if ($new_cat->save()) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $img = new Image;
                $img->type = 0;
                $img->img = $imageName;
                $img->refrence_id = $new_cat->id;
                if ($img->save()) {
                    $request->image->move(public_path('images'), $imageName);
                    return response()->json(['success' => 'You have successfully upload image.', 'img' => $imageName]);
                }
            }
        }
    }

    public function get_cat(Request $request)
    {

        $all_cat = DB::table('cat')
            ->leftJoin('image', 'cat.id', '=', 'image.refrence_id')
            ->select('cat.id', 'cat.title', 'cat.num_file', 'cat.parent', 'image.img', 'cat.attr_ids')
            ->where('image.type', 0)
            ->get();
        return $all_cat;
    }

    public function delete_cat(Request $request)
    {

        if (Cat::whereIn('id', $request->cat_select)->delete()) {
            if (Image::where('type', 0)->whereIn('refrence_id', $request->cat_select)->delete()) {
                return response()->json(['success' => 'عکس با موفقیت حذف شد.']);
            }
        }
    }
    // ---------------------  sizes  ----------------------
    public function sizes()
    {
        return view('admin.sizes');
    }

    public function add_size(Request $request)
    {
        $id = $request->id;
        // for update size
        if ($id) {
            $size = Size::where('id', $id)->update([

                'cat_id' => $request->cat_select,
                'size' => $request->cat_size,
            ]);
            return response()->json(['success' => 'update']);
        }
        // for add size
        else {

            $size = new Size;
            $size->cat_id = $request->cat_select;
            $size->size = $request->cat_size;

            if ($size->save()) {
                return $size;
            }
        }
    }

    public function get_size()
    {
        $all_size = DB::table('sizes')
            ->leftJoin('cat', 'sizes.cat_id', '=', 'cat.id')
            ->select('sizes.id', 'sizes.cat_id', 'sizes.size', 'cat.title')
            ->get();
        return $all_size;
    }

    public function delete_size(Request $request)
    {
        if (Size::find($request->id)->delete()) {
            return response()->json(['success' => 'ابعاد با موفقیت حذف شد.']);
        }
    }
    // *******************  counts  *********************
    public function counts()
    {
        return view('admin.count');
    }

    public function add_count(Request $request)
    {
        $id = $request->id;
        // for update count
        if ($id) {
            $count = Count::where('id', $id)->update([

                'cat_id' => $request->cat_select,
                'size_id' => $request->size_id,
                'number' => $request->count,
                'price' => $request->count_price,
            ]);
            return response()->json(['success' => 'update']);
        }
        // for add count
        else {

            $count = new Count;
            $count->cat_id = $request->cat_select;
            $count->size_id = $request->size_id;
            $count->number = $request->count;
            $count->price = $request->count_price;

            if ($count->save()) {
                return response()->json(['success' => 'add']);
            }
        }
    }

    public function get_count()
    {
        $all_count = DB::table('count')
            ->leftJoin('sizes', 'count.size_id', '=', 'sizes.id')
            ->leftJoin('cat', 'sizes.cat_id', '=', 'cat.id')
            ->select('count.id', 'count.cat_id', 'count.size_id', 'count.number', 'count.price', 'sizes.size', 'cat.title')
            ->get();
        return $all_count;
    }

    public function delete_count(Request $request)
    {
        if (Count::find($request->id)->delete()) {
            return response()->json(['success' => 'تعداد با موفقیت حذف شد.']);
        }
    }
    // ***********  attr  ******************
    public function attr()
    {
        return view('admin.attr');
    }

    public function add_attr(Request $request)
    {
        $attr = new Attr;
        $attr->attr = $request->attr;

        if ($attr->save()) {
            return response()->json(['success' => 'add']);
        }
    }

    public function get_attr()
    {
        $all_attr = Attr::all();
        return $all_attr;
    }

    public function update_attr(Request $request)
    {
        $cat_select = $request->cat_select;
        $attr_ids = $request->attr_ids;
        $attr_ids = implode(",", $attr_ids);

        $cat = Cat::where('id', $cat_select)->update([

            'attr_ids' => $attr_ids
        ]);
        return response()->json(['success' => 'update']);
    }
    // files_type

    public function files_type()
    {
        return view('admin.files_type');
    }

    public function add_files_type(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $files = Files_type::where('id', $id)->update([
                'name' => $request->type_file_name,
                'forced' => $request->forced_file,
            ]);
            return response()->json(['success' => 'update']);
        } else {
            $files_type = new Files_type;
            $files_type->cat_id = $request->cat_select;
            $files_type->name = $request->type_file_name;
            $files_type->forced = $request->forced_file;
            if ($files_type->save()) {
                return response()->json(['success' => 'add']);
            }
        }
    }

    public function get_type_file()
    {
        $files_type = Files_type::all();
        return $files_type;
    }

    public function delete_type_file(Request $request)
    {
        if (Files_type::find($request->id)->delete()) {
            return response()->json(['success' => 'تعداد با موفقیت حذف شد.']);
        }
    }
    // orders
    public function orders()
    {
        return view('admin.orders');
    }

    public function visited(Request $request)
    {
        $update = DB::table('orders')->where('id', $request->order_id)->update([
            'view' => 1
        ]);
    }

    public function get_adminorder()
    {
        $status = [0,2,3];
        $orders = DB::table('orders')
            ->whereIn('orders.status', $status)
            ->leftJoin('cat', 'orders.cat_id', '=', 'cat.id')
            ->leftJoin('user', 'orders.user_id', '=', 'user.id')
            ->select('orders.id', 'orders.price', 'orders.price_service', 'orders.status', 'orders.view', 'cat.title', 'user.username', 'orders.user_id')
            ->get();

        return $orders;
    }

    public function okorder(Request $request)
    {
        $order = Orders::where('id', $request->order_id)->update([
            'status' => 1,
            'price_service' => $request->servise_price
        ]);
        return $order;
    }

    public function complet_order(Request $request)
    {
        $order = Orders::where('id', $request->order_id)->update([
            'status' => 3
        ]);
    }
    // users
    public function users()
    {
        $users = User::all();
        return view('admin.users',['users'=>$users]);
    }

    public function get_user($id)
    {
        $user = DB::table('user')
        ->where('user.id', $id)
        ->leftJoin('mobile', 'user.id', '=', 'mobile.user_id')
        ->leftJoin('addr', 'user.id', '=', 'addr.user_id')
        ->leftJoin('email', 'user.id', '=', 'email.user_id')
        ->select('user.id', 'user.name', 'user.username', 'user.code_meli', 'user.time_added','mobile.number_phone','addr.address','email.mail')
        ->get();

        $orders = Orders::where('user_id',$id)->get();

        return view('admin.get_user',['user'=>$user,'orders'=>$orders]);
    }

    public function files()
    {   
        return view('admin.files');
    }


    public function get_files($order_id=null)
    {
        if($order_id){
            $files = Files::where('order_id',$order_id)->get();
        }else{
            $files = Files::all();
        }

        return $files;
    }


    public function delete_file_admin($id){
        return redirect('/admin/files/3');
        // return response()->json(['success' => $id]);
    }


    public function delete_admin_files(Request $request)
    {
        $file = Files::where('file_addr', $request->file_addr)->delete();
        unlink(public_path() .  '/files/' . $request->file_addr);
        return $file;
    }

    public function Delivery(Request $request)
    {
        $order = Orders::where('id',$request->order_id)->update([
            'status'=>4
        ]);

        return $order;
    }

    // news
    public function news()
    {
        return view('admin.news');
    }

    public function add_news(Request $request)
    {
        $id = $request->id;
        // for edit cat
        if ($id) {
            $new = News::where('id', $id)->update([

                'title' => $request->news_title,
                'desk' => $request->news_desk,
            ]);
            if ($request->image) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images'), $imageName);
                $img = Image::where('type', 2)->where('refrence_id', $id)->update([
                    'img' => $imageName,
                ]);
            }
            return response()->json(['success' => 'update']);
        }
        // for add cat
        else {
            $new = new News;
            $new->title = $request->news_title;
            $new->desk = $request->news_desk;
            $new->user_name = $request->user_name;
            $new->time_added = time();

            if ($new->save()) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $img = new Image;
                $img->type = 2;
                $img->img = $imageName;
                $img->refrence_id = $new->id;
                if ($img->save()) {
                    $request->image->move(public_path('images'), $imageName);
                    return response()->json(['success' => 'You have successfully upload image.', 'img' => $imageName]);
                }
            }
        }
    }

    public function get_news()
    {
        $news_latest = DB::table('news')
        ->leftJoin('image', 'news.id', '=', 'image.refrence_id')
        ->where('image.type', '2')
        ->select('news.id', 'news.title', 'news.time_added','news.view','news.user_name', 'image.img')
        ->get();

        return $news_latest;
    }

    public function delete_new(Request $request)
    {
        if(News::find($request->id)->delete()){
            return response()->json(['success' => 'delete']);
        }

        
    }

    public function new_edit(Request $request)
    {
        $news = DB::table('news')
        ->where('news.id', $request->id)
        ->leftJoin('image', 'news.id', '=', 'image.refrence_id')
        ->where('image.type', '2')
        ->select('news.id', 'news.title', 'news.time_added','news.desk','news.user_name', 'image.img')
        ->get();
        return $news;
    }
}
