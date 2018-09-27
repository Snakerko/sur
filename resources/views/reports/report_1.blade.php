<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>HTML5 Admin Template</title>
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

	<!-- CSS Reset -->
	<link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
	
	<!-- Main Styles -->
	<link rel="stylesheet" href="{{ asset('css/repstyles.css') }}">
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="{{ asset('js/jspdf.min.js') }}"></script>
	<script src="{{ asset('js/html2canvas.js') }}"></script>
	<script>
        function getPDF() {
		  doCanvas();
		}

		function doCanvas() {
		  html2canvas(document.querySelector("#main-content")).then(canvas => {
		    doPDF(canvas);
		  });

		}

		function doPDF(canvas) {
		  var doc = new jsPDF('p', 'mm', [480, 400]);
		  doc.addImage(canvas.toDataURL(), 'PNG', 0, 0);
		    var pdf = btoa(doc.output()); 
				$.ajaxSetup({
    			headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  				}
				});
				$.ajax({
		      method: "POST",
		      url: "{{ route('report') }}",
		      data: {data: pdf},
		    }).done(function(data){
		    });
		}
	</script>
</head>
<body onload="setTimeout(getPDF, 2000)">
<div class="navbar">
	<div class="row">
		<div class="column column-30 col-site-title"><a href="#" class="site-title float-left">Страница отчета</a></div>
		<div class="column column-30">
			<div class="user-section"><a href="/">
				<div class="username">
					<h4>{{ $user->username }}</h4>
					<p>Администратор</p>
				</div>
			</a></div>
		</div>
	</div>
</div>
<div class="container">
<div class="row">
	<section id="main-content" class="column">
			<!--Charts-->
		<h5>Код категории</h5><a class="anchor" name="charts"></a>
		<div class="row grid-responsive">
			<div class="column column-50">
				<div class="card">
					<div class="card-title">
						<h2>Диаграмма опроса</h2>
					</div>
					<div class="card-block">
						<div class="canvas-wrapper">
							<canvas class="chart" id="pie-chart" height="auto" width="auto"></canvas>
						</div>
					</div>
				</div>
      </div>
      <div class="column column-50">
					<div class="card">
						<div class="card-title">
							<h2>Главный цвет пользователя</h2>
						</div>
						<div class="card-block">
							<img id="maincolor" src="images/picture-red.jpg" width="162" height="162" alt="Главный цвет пользователя">
						</div>
					</div>
				</div>
		</div>
		
		<!--Tables-->
		<h5 class="mt-2">Таблицы</h5><a class="anchor" name="tables"></a>
		<div class="row grid-responsive">
			<div class="column ">
				<div class="card">
					<div class="card-title">
						<h3>Положительные</h3>
					</div>
					<div class="card-block">
						<table id="grid">
							<thead>
								<tr>
									<th class="bg-red">Красный</th>
									<th class="bg-blue">Синий</th>
									<th class="bg-white">Белый</th>
									<th class="bg-yellow">Желтый</th>
								</tr>
							</thead>
							<tbody>
              @foreach($posdata as $item)
                <tr>
                  <td>{{ $item[0] }}</td>
                  <td>{{ $item[1] }}</td>
                  <td>{{ $item[2] }}</td>
                  <td>{{ $item[3] }}</td>
                </tr>
              @endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="card">
					<div class="card-title">
						<h3>Отрицательные</h3>
					</div>
					<div class="card-block">
						<table id="grid">
							<thead>
								<tr class="bg-grey">
									<th class="bg-red">Красный</th>
  								<th class="bg-blue">Синий</th>
									<th class="bg-white">Белый</th>
									<th class="bg-yellow">Желтый</th>
								</tr>
							</thead>
							<tbody>
              @foreach($negdata as $item)
                <tr>
                  <td>{{ $item[0] }}</td>
                  <td>{{ $item[1] }}</td>
                  <td>{{ $item[2] }}</td>
                  <td>{{ $item[3] }}</td>
                </tr>
              @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</section>
</div>	
</div>
	<script type="text/javascript" src="{{ asset('js/chart.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
	<script>
	$(function(){

		var vote = {};
		var path = '{!! $piedata !!}';
		data=JSON.parse(path);

			var vote = data;
			var i = 0;
			var maincolor = 0;
		
			for (var key in vote) {
					vote[key]["value"] = parseFloat(vote[key]["value"]);
					if(vote[key]["value"]>=maincolor) {
						maincolor = vote[key]["value"];
						if(vote[key]["label"]=="красный")
						{
							document.getElementById("maincolor").src="{{ asset('images/picture-red.jpg') }}";
						}
						else if(vote[key]["label"]=="желтый")
						{
							document.getElementById("maincolor").src="{{ asset('images/picture-yellow.jpg') }}";
						}
						else if(vote[key]["label"]=="синий")
						{
							document.getElementById("maincolor").src="{{ asset('images/picture-blue.jpg') }}";
						}
						else if(vote[key]["label"]=="белый")
						{
							document.getElementById("maincolor").src="{{ asset('images/picture-white.jpg') }}";
						}
					}
			}

			var pieData = [
						{
							value: vote[0]["value"],
							color: vote[0]["color"],
							label: vote[0]["label"]
						},
						{
							value: vote[1]["value"],
							color: vote[1]["color"],
							label: vote[1]["label"]
						},
						{
							value: vote[2]["value"],
							color: vote[2]["color"],
							label: vote[2]["label"]
						},
						{
							value: vote[3]["value"],
							color: vote[3]["color"],
							label: vote[3]["label"]
						}
					];

			var chart4 = document.getElementById("pie-chart").getContext("2d");
			window.myPie = new Chart(chart4).Pie(pieData, {
				responsive: true,
				segmentShowStroke: false
			});
		});
	</script>
</body>
</html> 
