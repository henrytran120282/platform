<div class="panel panel-default">
  <div class="panel-heading">
    <div style="padding-top:2px;float:left">
      {{ $value->name }}
      <a data-target="select-widget-{{ $group }}-{{$key}}" data-role='toggle-menu' href="#"><i class="fa fa-chevron-down"></i></a>
    </div>
    <div class="btn-group" style="float:right">
      <button type="button" class="btn btn-success dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add <span class="caret"></span></button>
      <ul class="dropdown-menu">
        @foreach($widgetGroups as $val)
          <li><a href="#" data-role="add-widget" data-widgetname="{{ get_class($value)}}" data-widgetposition="{{ $val->id }}" >{{ ucwords(str_replace("_"," ",$val->name)) }}</a></li>
        @endforeach
      </ul>
    </div>

    <div class="clearfix"></div>
  </div>
  <div id="select-widget-{{ $group }}-{{$key}}" class="panel-body" style="display: none;">
    {{ $value->description }}
  </div>
</div>