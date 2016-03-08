<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #999a9a;
				display: table;
				font-family: 'Avenir-book';
			}
			
			a{text-decoration: none; color: inherit;}

			.container{text-align: center; display: table-cell; vertical-align: middle;}

			.content{text-align: center; display: inline-block;}
			
			.content span{font-size: 24px; cursor: pointer;}

			.content span:hover{color: #888888;}

			.title{font-size: 65px; margin-bottom: 40px;}

			.logo_pg_falha{width: 100px;}

			@media all and (min-width: 481px) and (max-width: 960px){
				.content p{font-size: 20px;}
				
				.content p img{width: 17px;}

				.title {font-size: 43px; margin-bottom: 35px;}

				.logo_pg_falha{width: 80px; margin-bottom: 5px;}
			}

			@media all and (min-width: 1px) and (max-width: 480px){
				.content p{font-size: 20px;}
				
				.content p img{width: 17px;}

				.title{font-size: 30px;	margin-bottom: 30px;}

				.logo_pg_falha{width: 70px; margin-bottom: 5px;}
			}
		</style>
		<title>{{trans('pages.EC-Aten')}}</title>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<img src="{{asset('img/logotipo_geral.png')}}" alt="" class="logo_pg_falha">
				<div class="title">{{trans('pages.EC-EstPedNaoPosPDF')}}</div>
				<span onclick="window.close();"><p> X {{trans('pages.EC-Fechar')}}</p></span>
			</div>
		</div>
	</body>
</html>