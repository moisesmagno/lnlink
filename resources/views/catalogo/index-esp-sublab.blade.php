@if($esps == '0')
	<option value="">{{trans('pages.C-FilSel')}}</option>
@else
	
	<option value="">{{trans('pages.C-FilSel')}}</option>

	@foreach($esps as $esp)
		<option value="{{utf8_encode($esp)}}">{{utf8_encode($esp)}}</option>
	@endforeach

@endif




