Dear {{$name}}<br>
@if(session('notifymessage22')!="")
<p>{!! html_entity_decode(session('notifymessage22')) !!}<p>
@else
	
<p>{!! html_entity_decode($message) !!}<p>
@endif
