<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Login

Route::get('/', 'LoginController@showIndex');
Route::post('/login', 'LoginController@login');

// Consulta

Route::get(trans('routes.consulta'), 'ConsultaController@showIndex');
Route::get(trans('routes.consulta').'/'.trans('routes.incidencias'), 'ConsultaController@showIncidencias');

// Catalogo

Route::get(trans('routes.catalogo'), 'CatalogoController@showIndex');
Route::get(trans('routes.catalogo').'/'.trans('routes.exame').'/{cod}', 'CatalogoController@showExame');
Route::get(trans('routes.lista'), 'CatalogoController@showLista');

// Gerenciamento

Route::get(trans('routes.gerenciamento'), 'GerenciamentoController@showRelatorio');

// Logistica

Route::get(trans('routes.logistica'), 'LogisticaController@showIndex');

// Registro

Route::get(trans('routes.bandeja'), 'RegistroController@showBandeja');
Route::get(trans('routes.registro').'/'.trans('routes.consultaEnviados'), 'RegistroController@showConsulta');
Route::get(trans('routes.registro').'/'.trans('routes.integracao'), 'RegistroController@showIntegracao');
Route::get(trans('routes.registro').'/'.trans('routes.manual'), 'RegistroController@showManual');

//Alterar senha

Route::get(trans('routes.alterarsenha'), 'UsuController@showIndex');
Route::post('alt-sen', 'UsuController@alterarSenha');

//Logout
Route::get('logout','UsuController@logout');

//Alterar Idioma
Route::get('lang/{idioma}','UsuController@alterarIdioma');


//Falhas
Route::get(trans('routes.noscipt'), 'FalhasController@noScript');



// Ajax e outros-----------------------------------------------------------------------------------------------------

	//Consulta
	
	Route::post('/consulta/nhc','AjaxConsultaController@nhc');
	Route::post('/consulta/seguidos','AjaxConsultaController@pedSeguimento');
	Route::post('/consulta/urgencias','AjaxConsultaController@urgSolicitadas');
	Route::post('/consulta/dt-registro','AjaxConsultaController@dtRegistro');
	Route::post('/consulta/exame','AjaxConsultaController@exame');
	Route::post('/consulta/ref-nous','AjaxConsultaController@refNous');
	Route::post('/consulta/ref-cliente','AjaxConsultaController@refCliente');
	Route::post('/consulta/dt-liberacao','AjaxConsultaController@dtLiberacao');
	Route::post('/consulta/nome-paciente','AjaxConsultaController@nomePaciente');
	Route::post('/consulta/planilha','AjaxConsultaController@planilha');
	Route::get('/consulta/dl-planilha/{url}','AjaxConsultaController@dlPlanilha');
	Route::get('/consulta/pdf','AjaxConsultaController@gerarPDF');
	Route::post('/consulta/flashped','AjaxConsultaController@flashPedidos');
	Route::post('/consulta/gerar-impressao','AjaxConsultaController@gerarImpressao');
	Route::get('/consulta/print','AjaxConsultaController@imprimirResultados');
	Route::post('/consulta/gerar-download','AjaxConsultaController@gerarDownload');
	Route::get('/consulta/download','AjaxConsultaController@baixarArquivo');

	    //Modais
		Route::post('/consulta/exames-solicitar-urgencia','AjaxExameController@examesSolicitarUrgencia');
		Route::post('/consulta/exames-excluir-exames','AjaxExameController@examesExcluirExames');
		Route::post('/consulta/adicionar-exames','AjaxConsultaController@addExame');
		Route::post('/consulta/excluir-exames','AjaxConsultaController@cancelarExames');
		Route::post('/consulta/cancelar-pedido','AjaxConsultaController@cancelarPedido');
		Route::post('/consulta/seguir-pedido','AjaxConsultaController@seguirPedido');
		Route::post('/consulta/solicitar-urgencia','AjaxConsultaController@solicitarUrgencia');

		//Incidencias

		Route::post('/consulta/incidencias-nous','AjaxConsultaIncidenciasController@incidenciasNous');
		Route::post('/consulta/incidencias-comentario','AjaxConsultaIncidenciasController@enviarComentario');		

	//AutoComplete

	Route::post('/buscaELN','AjaxExameController@buscarExames');
	Route::post('/listaELN','AjaxExameController@listarExames');
	Route::post('/listaELNrg','AjaxExameController@listarExamesRegistro');
	Route::post('/listaELNcat','AjaxExameController@listarExamesCatalogo');

	//Registro

	Route::post('/registro/adicionar-paciente','AjaxRegistroController@adicionarPaciente');
	Route::post('/registro/criar-grupo','AjaxRegistroController@criarGrupo');
	Route::post('/registro/excluir-grupo','AjaxRegistroController@excluirGrupo');
	Route::post('/registro/listar-grupos','AjaxRegistroController@listarGrupos');
	Route::post('/registro/listar-exames','AjaxRegistroController@listarExames');
	Route::post('/registro/listar-pedidos','AjaxRegistroController@listarPedidos');

		//Bandeja
		Route::post('/bandeja/listar-pedidos','AjaxBandejaController@listarPedidos');
		Route::post('/bandeja/excluir-pedido','AjaxBandejaController@excluirPedido');
		Route::post('/bandeja/excluir-pedidos','AjaxBandejaController@excluirPedidos');
		Route::post('/bandeja/editar-pedido','AjaxBandejaController@editarPedido');
		Route::post('/bandeja/cancelar-alteracoes','AjaxBandejaController@cancelarAlteracoes');
		Route::post('/bandeja/atualizar-count','AjaxBandejaController@atualizarCount');
		Route::post('/bandeja/enviar-pedidos','AjaxBandejaController@enviarPedidos');

		//Consulta
		Route::post('/registro/consulta-enviados/listar','AjaxRegistroConsultaController@listar');
		Route::get('/registro/consulta-enviados/print/{dti}/{dtf}','AjaxRegistroConsultaController@imprimirResultados');

		//Integracao
		Route::post('/registro/integracao/integrados-hoje','AjaxRegistroIntegracaoController@listarArquivosIntegradosHoje');
		Route::post('/registro/integracao/integrados-data','AjaxRegistroIntegracaoController@listarArquivosIntegradosData');
		Route::post('/registro/integracao/upload', 'AjaxRegistroIntegracaoController@uploadIntegracao');


	//Catalogo
	
	Route::post('/catalogo/sublab','AjaxCatalogoController@listarSubLab');
	Route::post('/catalogo/filtro-sublab','AjaxCatalogoController@listarSubLabFiltro');
	Route::post('/catalogo/filtro-sublab-div','AjaxCatalogoController@listarSubLabFiltroDiv');
	Route::post('/catalogo/consulta','AjaxCatalogoController@listarResultados');
	Route::post('/catalogo/add-exame','AjaxCatalogoController@addExame');
	Route::get('/exame/doc/{cod}/{patio}/{doc}','AjaxCatalogoController@getDoc');
	Route::get('/exame/ficha/{cod}','AjaxCatalogoController@getFicha');
	Route::get('/exame/laudo/{cod}','AjaxCatalogoController@getLaudo');
		
		//Lista	
		Route::post('/lista/listar-exames','AjaxListaController@listarExames');
		Route::post('/lista/gerar-pedido','AjaxListaController@gerarPedido');
		Route::post('/lista/excluir-exames','AjaxListaController@excluirExames');
		Route::post('/lista/atualizar-count','AjaxListaController@atualizarCount');
		Route::post('/lista/info-adicional','AjaxListaController@infoAdicional');
		Route::post('/lista/solicitacao-cot','AjaxListaController@cotacoes');

	//Gerenciamento

	Route::post('/gerenciamento/rel-evo-atv-rem','AjaxGerenciamentoController@relEvoAtvRem');
	Route::post('/gerenciamento/rel-div-par-rem','AjaxGerenciamentoController@relDivParRem');
	Route::post('/gerenciamento/rel-comprimento-prazo','AjaxGerenciamentoController@relComprimentoPrazo');
	Route::post('/gerenciamento/rel-ocorrencia-origem','AjaxGerenciamentoController@relOcorrenciaOrigem');
	Route::post('/gerenciamento/fatura-por-exame','AjaxGerenciamentoController@faturaPorExame');
	Route::post('/gerenciamento/fatura-por-mes','AjaxGerenciamentoController@faturaPorMes');
	Route::get('/gerenciamento/dl-planilha/{url}','AjaxGerenciamentoController@dlPlanilha');
	Route::get('/gerenciamento/pdf/{fatura}','AjaxGerenciamentoController@pdf');
	Route::post('/gerenciamento/carregar-fatura','AjaxGerenciamentoController@carregarFatura');


	//Logistica

	Route::get('/logistica/docs/{doc}','AjaxLogisticaController@getDocs');
	Route::get('/logistica/gerar-lote','AjaxLogisticaController@gerarLote');
	Route::post('/logistica/enviar-material','AjaxLogisticaController@enviarMaterial');
	Route::post('/logistica/solicitar-material','AjaxLogisticaController@solicitarMaterial');



	



	













