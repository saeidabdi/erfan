@include('header')
<div class="content container newsmain" style="width: 100%;">
    <h1>{{$news->title}}</h1>
    <div class="news_box_main" style="min-height: 400px;">
        <div class="col-md-5 left" style="display: inline-block;">
            <img style="width: 100%;max-height: 280px;" src="/images/{{$img->img}}" alt="عکس خبر">
            <ul class="ul_single_news" style="margin-top:8px;padding: 0 0 0 150px;">
                <li><i class="fa fa-user"></i>{{$news->user_name}}</li>
                <li><i class="fas fa-eye"></i>{{$news->view}} بازدید</li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i> {{$news->time_added}}</li>
            </ul>
        </div>
        <p class="col-md-7" style="text-align: justify;">
            {{$news->desk}}
        </p>
    </div>
</div>
@include('footer')