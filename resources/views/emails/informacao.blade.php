<h1 style="margin: 0px !important; font-size: 22px !important; color: #002f56 !important; font-family: 'Avenir-book' !important;">{{trans('pages.LE-ETtSolInfAdi')}}</h1>
<br>
<p style="margin: 0px !important; width: 98% !important; color: #999a9a !important; font-family: 'Avenir-book' !important; font-size: 16px !important;">
	<span style="font-weight: bold !important; color: #007298 !important;">{{trans('pages.LE-ENomSol')}} </span>{{Session::get('usuario')}}</p>
<p style="margin: 0px !important; width: 98% !important; color: #999a9a !important; font-family: 'Avenir-book' !important; font-size: 16px !important;">
	<span style="font-weight: bold !important; color: #007298 !important;">{{trans('pages.LE-EEmaSol')}} </span>{{Session::get('email')}}</p>
<p style="margin: 0px !important; width: 98% !important; color: #999a9a !important; font-family: 'Avenir-book' !important; font-size: 16px !important;">
	<span style="font-weight: bold !important; color: #007298 !important;">{{trans('pages.LE-ECliVinUsu')}} </span>{{Session::get('cliVinculado')}}</p>
<br>
<h3 style="margin: 0px !important; font-size: 18px !important; color: #007298 !important; font-family: 'Avenir-book' !important;">{{trans('pages.LE-EExa')}}</h3> 
    <ul style="margin: 0px !important; width: 100% !important; font-size: 16px !important; font-family: 'Avenir-book' !important; color: #999a9a !important;">
    	@foreach($exames as $exame)
    	<li style="margin: 0px !important; width: 98% !important;">{{$exame}}</li>
        @endforeach
    </ul>
<br>
<h3 style="margin: 0px !important; font-size: 18px !important; color: #007298 !important; font-family: 'Avenir-book' !important;">{{trans('pages.LE-EEmaret')}}</h3>
	<ul style="margin: 0px !important; width: 98% !important; font-size: 16px !important; font-family: 'Avenir-book' !important;">
    	<li style="margin: 0px !important; color: #999a9a !important; width: 98% !important;">{{$emails}}</li>
    </ul>
<br>
<h3 style="margin: 0px !important; font-size: 18px !important; color: #007298 !important; font-family: 'Avenir-book' !important;">{{trans('pages.LE-EDesc')}}</h3> 
    <p style="margin: 0px !important; width: 98% !important; color: #999a9a !important; font-family: 'Avenir-book' !important; font-size: 16px !important; text-align: justify !important;  margin-left: 23px !important;">{{$desc}}</p>