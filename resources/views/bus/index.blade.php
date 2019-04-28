@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.buspage.title')</h3>

    <div class="card card-default">

        <div class="card-body table-responsive">
            <div class="row">


                  <div class="col-sm-6"><img src="{{ URL::to('/images/bus.jpg') }}" width="510px" height="535px"></div>


                  <div class="col-sm-3">
                      <div class="card border-info">
                          <div class="card-header"><strong>Head of Physical Facility</strong></div>
                          <div class="card-body"><div><img src="{{ URL::to('/images/mahendra.jpg') }}" width="190" height="150" align="middle"> </div><div>Mr. Mahendra Miraula</div></div>
                      </div>

                      <div class="card border-info">
                          <div class="card-header"><strong>Coordinator of Bus Facility</strong></div>
                          <div class="card-body"><div><img src="{{ URL::to('/images/sambhu.jpg') }}" width="190" height="150" align="middle"> </div><div>Mr. Sambhu Pokhrel</div></div>
                      </div>
                  </div>

                  <div class="col-sm-3">
                      <div class="card">
                          <div class="card-header">
                              <strong>Action</strong>
                              <div class="card-body">
                                  <button class="btn btn-secondary btn-lg btn-block" type="button"><a href="{{route('busNotice')}}">Notice</a></button>
                                  <button class="btn btn-secondary btn-lg btn-block" type="button"><a href="{{route('busApply')}}">Apply New</a></button>
                                  <button class="btn btn-secondary btn-lg btn-block" type="button">Payment</button>
                              </div>
                          </div>
                      </div>

                      <div class="card">
                          <div class="card-header">
                              <strong>Recent Notices</strong>
                          </div>
                          <div class="card-header">
                              <ul>
                                  <li><a title="Notice for Bus Students" href="http://www.ku.edu.np/news/index.php?op=ViewArticle&amp;articleId=2624&amp;blogId=1">Notice for Bus Students</a></li>
                                  <li><a title="Notice for Scholarship Interview - SoE and SoSc" href="http://www.ku.edu.np/news/index.php?op=ViewArticle&amp;articleId=2623&amp;blogId=1">Notice for Scholarship Interview - SoE and SoSc</a></li>
                                  <li><a title="Notice of written test for Officer (Contract Basis)" href="http://www.ku.edu.np/news/index.php?op=ViewArticle&amp;articleId=2621&amp;blogId=1">Notice of written test for Officer (Contract Basis)</a></li>
                                  <li><a title="Invitation to Interaction with DAAD" href="http://www.ku.edu.np/news/index.php?op=ViewArticle&amp;articleId=2619&amp;blogId=1">Invitation to Interaction with DAAD</a></li>
                                  <li><a title="Dr. Adhikari Co-authored a Peer-reviewed Article" href="http://www.ku.edu.np/news/index.php?op=ViewArticle&amp;articleId=2618&amp;blogId=1">Dr. Adhikari Co-authored a Peer-reviewed Article</a></li>
                                  <li><a title="MOU signed between Yunnan University and Kathmandu University" href="http://www.ku.edu.np/news/index.php?op=ViewArticle&amp;articleId=2617&amp;blogId=1">MOU signed between Yunnan University and Kathmandu University</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
            </div>
        </div>
    </div>
@stop
