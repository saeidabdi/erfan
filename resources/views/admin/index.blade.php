@extends('admin.admin')

@section('content')
<div class="col-md-12" style="padding-top: 10px;">
    <div class="div col-md-12 right" style="padding: 15px;">
        <div class="col-md-3 box_news">
            <a href="#" class="col-md-10">
                <div><i class="fa fa-user" style="font-size: 100px; color: #1c5b99;"></i></div>
                <div class="count">{{$users}}</div>
            </a>
        </div>
        <div class="col-md-3 box_news">
            <a href="#" class="col-md-10">
                <div><i class="fa fa-book" style="font-size: 100px; color: #1c5b99;"></i></div>
                <div class="count">{{$orders}}</div>
            </a>
        </div>
        <div class="col-md-3 box_news">
            <a href="#" class="col-md-10">
                <div><i class="fa fa-file" style="font-size: 100px; color: #1c5b99;"></i></div>
                <div class="count">{{$num_files}}</div>
            </a>
        </div>
        <div class="col-md-3 box_news">
            <a href="#" class="col-md-10">
                <div><i class="fa fa-user" style="font-size: 100px; color: #1c5b99;"></i></div>
                <div class="count"></div>
            </a>
        </div>
    </div>
</div>
@endsection