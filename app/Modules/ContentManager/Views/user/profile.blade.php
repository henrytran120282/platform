@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>User Report <small>Activity report</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
          <div class="profile_img">
            <div id="crop-avatar">
              <!-- Current avatar -->
              <img class="img-responsive avatar-view" src="{{ url('/assets/images') }}/{{ $model->photo }}" alt="Avatar" title="Change the avatar">
            </div>
          </div>
          <h3>{{ $model->name }}</h3>

          <ul class="list-unstyled user_data">
            <li><i class="fa fa-map-marker user-profile-icon"></i> Nbr8 - No3 - Dich Vong - Cau Giay - Ha Noi
            </li>

            <li>
              <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
            </li>

            <li class="m-top-xs">
              <i class="fa fa-external-link user-profile-icon"></i>
              <a href="http://www.qsoftvietnam.com" target="_blank">www.qsoftvietnam.com</a>
            </li>
          </ul>

          <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
          <br />

          <!-- start skills -->
          <h4>Description</h4>
          {{ $model->description }}
          <!-- end of skills -->

        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">

          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Posts</a>
              </li>
              <li role="presentation"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Signin Log</a>
              </li>

            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade in" id="tab_content1" aria-labelledby="home-tab">

                <!-- start user projects -->
                <table class="data table table-striped no-margin">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Desciption</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($model->meta as $data)
                    <tr>
                      <td>{{ Admin::userLogSerial($data->meta_value,'date') }}</td>
                      <td>{{ Admin::userLogSerial($data->meta_value,'desc') }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- end user projects -->

              </div>
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content2" aria-labelledby="profile-tab">
                <!-- start user projects -->
                <table class="data table table-striped no-margin">
                  <thead>
                    <tr>
                      <th>Post Title</th>
                      <th>Category</th>
                      <th>Tags</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($post as $value)
                    <tr>
                      <td>{{ $value->post_title }}</td>
                      <td>{!! Helper::taxonomyLink($value->categories,false) !!}</td>
                      <td>{!! Helper::taxonomyLink($value->tags,false) !!}</td> 
                      <td>{{$value->updated_at->format("M d, Y")}}</td> 
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- end user projects -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection