@if(count($datas) > 0 )
	<li class="dropdown"><a href="{{$node->getURL()}}" class="dropdown-toggle" data-toggle="dropdown">{{$node->post_title}}<span class="caret"></span></a>
		<ul class="dropdown-menu">
		@foreach($datas as $node)
		   @include('layouts.partials.menuitem', ['datas' => $node->children()])
		@endforeach
	    </ul>
	</li>
@else
	 <li><a href="{{ $node->getURL() }}">{{$node->post_title}}</a></li>
@endif