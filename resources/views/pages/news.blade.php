@include('header')
<div class="content container newsmain" style="width: 100%;" v-if="logined">
    <h1>اخبار چاپ</h1>
    <div class="news_box_main">
        <header>
            <h3><span></span>اخبار پر بازدید</h3>
        </header>
        <div class="body_news_child row">
            @foreach($news_viewed as $new)
            <div class="single-recent-blog col-lg-4 col-md-4">
                <div class="item_news">
                    <a href="/news/{{$new->id}}">
                        <img src="/images/{{$new->img}}" alt="عکس خبر">
                        <div class="col-md-12 title_news">
                            <div class="row">
                                <span style="color: #999;left:17px;" href="">{{$new->time_added}}</span>
                                <span style="color: #999;right:17px;" href="">
                                    <i class="fas fa-eye"></i>
                                    {{$new->view}}</span>
                            </div>
                            <a class="right" href="/news/{{$new->id}}">{{$new->title}}</a>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="news_box_main">
        <header>
            <h3><span></span>آخرین اخبار </h3>
        </header>
        <div class="body_news_child">
            @foreach($news_latest as $new)
            <div class="single-recent-blog col-lg-4 col-md-4">
                <div class="item_news">
                    <a href="/news/{{$new->id}}">
                        <img src="/images/{{$new->img}}" alt="عکس خبر">
                        <div class="col-md-12 title_news">
                            <div class="row">
                                <span style="color: #999;left:17px;" href="">{{$new->time_added}}</span>
                                <span style="color: #999;right:17px;" href="">
                                    <i class="fas fa-eye"></i>
                                    {{$new->view}}</span>
                            </div>
                            <a class="right" href="/news/{{$new->id}}">{{$new->title}}</a>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@include('footer')