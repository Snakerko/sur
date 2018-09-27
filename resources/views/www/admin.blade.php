<div class="navbar">
	<div class="row">
			<div class="column column-30 col-site-title"><a class="site-title float-left">Панель администратора</a></div>
			<div class="column column-30">
				<div class="user-section"><a>
					<div class="username">
						<h4>{{ $user->username }}</h4>
						<p>Администратор</p>
					</div>
					</a>
					<button class="button button-outline" href="{{ route('logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</button>
				
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</div>
			</div>
	</div>
</div>
<div class="row">
	<div id="sidebar" class="column">
		<h5>Навигация</h5>
		<ul>
			<li><a href="#"><em class="fa fa-home"></em> Главная</a></li>
			<li><a href="#tables"><em class="fa fa-table"></em>Пользователи</a></li>
		</ul>
	</div>
	<section id="main-content" class="column column-offset-20">
		<div class="row grid-responsive">
			<div class="column page-heading">
				<div class="large-card">
					<h3 class="text-large">Панель администатора</h3>
				</div>
			</div>
		</div>
			
			<!--Forms-->
		@if(session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
		@endif
		<div class="row grid-responsive">
			<div class="column ">
				<div class="card">
					<div class="card-title">
						<h3>Форма для генерации персональной ссылки</h3>
					</div>
					<div class="card-block">
						<form method='post' action='/admin'>
							{{ csrf_field() }}
							<fieldset>
								<label for="nameOrgField">Название организации</label>
								<input type="text" required placeholder="Имя организации" name="org_name" id="nameOrgField">
								<label for="emailOrgField">Почта</label>
								<input type="email" required placeholder="Email" name="email" id="emailOrgField">			
								<p class="submit-button"><input class="button-primary" type="submit" value="Генерировать ссылку"></p>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row grid-responsive">
			<div class="column ">
				<div class="card">
					<div class="card-title">
						<h3>Пользователи</h3>
					</div>
					<div class="card-block">
						{{ $persons->links() }}
						<table id="grid">
							<thead>
								<tr>
									<th data-type="name">Имя</th>
									<th data-type="gender">Пол</th>
									<th data-type="orgname">Организация</th>
									<th data-type="success">Пройден тест?</th>
									<th data-type="review-1">Отчёт 1</th>
									<th data-type="review-2">Отчёт 2</th>
									<th data-type="clear">Сбросить результаты опроса</th>
								</tr>
							</thead>
							<tbody>
								@foreach($persons as $person)
									<tr>
										<td>{{ $person->username }}</td>
										<td>{{ $person->gender }}</td>
										<td>{{ $person->organization->org_name }}</td>
										<td>{{ $person->complete_survey }}</td>
										@if($person->complete_survey == "да")
										<td>Отчет 1&nbsp;&nbsp;&nbsp;<a href="{{ $person->report->report_1 }}" title="Просмотр в браузере"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;</td>
										<td>Отчет 2&nbsp;&nbsp;&nbsp;<a href="#" title="Просмотр в браузере"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;</td>
										@else
										<td></td>
										<td></td>
										@endif
										<td><a href="{{ route('delRep', ['id'=>$person->id]) }}">Обнулить</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
						{{ $persons->links() }}
					</div>
				</div>
			</div>
		</div>
		
	</section>
</div>

	<script>
	window.onload = function () {

	var grid = document.getElementById('grid');

    grid.onclick = function(e) {
      if (e.target.tagName != 'TH') return;

      // Если TH -- сортируем
      sortGrid(e.target.cellIndex, e.target.getAttribute('data-type'));
    };

    function sortGrid(colNum, type) {
      var tbody = grid.getElementsByTagName('tbody')[0];

      // Составить массив из TR
      var rowsArray = [].slice.call(tbody.rows);

      // определить функцию сравнения, в зависимости от типа
      var compare;

      switch (type) {
        case 'name':
          compare = function(rowA, rowB) {
            return rowA.cells[colNum].innerHTML > rowB.cells[colNum].innerHTML;
          };
          break;
        case 'orgname':
          compare = function(rowA, rowB) {
            return rowA.cells[colNum].innerHTML > rowB.cells[colNum].innerHTML;
          };
        case 'gender':
          compare = function(rowA, rowB) {
            return rowA.cells[colNum].innerHTML > rowB.cells[colNum].innerHTML;
          };
          break;
        case 'success':
          compare = function(rowA, rowB) {
            return rowA.cells[colNum].innerHTML > rowB.cells[colNum].innerHTML;
          };
          break;
      }

      // сортировать
      rowsArray.sort(compare);

      // Убрать tbody из большого DOM документа для лучшей производительности
      grid.removeChild(tbody);

      // добавить результат в нужном порядке в TBODY
      // они автоматически будут убраны со старых мест и вставлены в правильном порядке
      for (var i = 0; i < rowsArray.length; i++) {
        tbody.appendChild(rowsArray[i]);
      }

      grid.appendChild(tbody);

    }
	};
  </script>