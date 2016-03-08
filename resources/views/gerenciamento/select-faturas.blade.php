@foreach($faturas as $fatura)
							<?php 
								if (trim($fatura[3]) == '') {
									$fatenv = $fatura[2];
								}else{
									$fatenv = $fatura[3];
								}
								if (trim($fatura[1]) != '') {
									$tipo = $fatura[1].' ';
								}else{
									$tipo = '';
								}

							 ?>
							<option value="{{$fatura[2]}}" selected>{{trans('pages.PG-Fatura')}} {{$fatenv.' '}}{{$tipo}}{{trans('pages.PG-De')}} {{$fatura[0]}}</option>
@endforeach