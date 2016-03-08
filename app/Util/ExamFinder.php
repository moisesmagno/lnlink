<?php namespace App\Util;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;



class ExamFinder 
{	
	public function find($examesUsados)
	{
		$e = Session::get('eln');

		$eln = explode('^', $e);
		array_pop($eln);

		$exames = array();
		$retorno = array();

		foreach ($eln as $row) {			
			$aux = explode('#',$row);
			array_push($exames, $aux);
		}

		foreach ($exames as $row) {
			if (in_array($row[0],$examesUsados) AND $row[6] == 'Catalogo') {
				array_push($retorno, ['span' => '<span style="display:none" class="exames_usados" data-findexam="'.utf8_encode($row[0]).'" data-info="'.utf8_encode($row[0]).' - '.utf8_encode($row[1]).'#'.utf8_encode($row[0]).'#'.utf8_encode($row[1]).'#'.utf8_encode($row[2]).'#'.utf8_encode($row[3]).'#'.utf8_encode($row[4]).'#'.utf8_encode($row[5]).'#'.utf8_encode($row[6]).'"></span>','cod' => $row[0],'def' => utf8_encode($row[0]).' - '.utf8_encode($row[1])]);

			}
		}

		return $retorno;
	}

	public function findGenPet($examesUsados)
	{
		$e = Session::get('eln');

		$eln = explode('^', $e);
		array_pop($eln);

		$exames = array();
		$retorno = array();

		foreach ($eln as $row) {			
			$aux = explode('#',$row);
			array_push($exames, $aux);
		}

		foreach ($exames as $row) {
			if (in_array($row[0],$examesUsados) AND $row[6] == 'Catalogo') {
				array_push($retorno, $row);

			}
		}

		return $retorno;
	}

	public function validarExames($examesUsados)
	{
		$e = Session::get('eln');

		$eln = explode('^', $e);
		array_pop($eln);

		$exames = array();		

		foreach ($eln as $row) {			
			$aux = explode('#',$row);
			array_push($exames, $aux[0]);			
		}

		$examesValidados = array();		
		
		foreach ($examesUsados as $exame) {			
			if (!in_array($exame, $exames)) {
				Log::error('Exame incorreto');
				abort(500);
			}elseif (in_array($exame, $examesValidados)) {
				Log::error('Exame repitido');
				abort(500);
			}else{
				array_push($examesValidados,$exame);
			}
		}
		
	}

	
}

?>