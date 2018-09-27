<div class="navbar">
	<div class="row">
		<div class="column column-30 col-site-title"><a href="#" class="site-title float-left">Личный кабинет</a></div>
			<div class="column column-30">
				<div class="user-section"><a>
					<div class="username">
						<h4>{{ $user->username }}</h4>
						@if($user->admin == 1)
						<p>Администратор</p>
						@else
						<p>Пользователь</p>
						@endif
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
</div>
<div class="container">
	<div class="row">
		<section id="main-content" class="column">
			
			<!--Forms-->
			<div class="row grid-responsive">
				<div class="column ">
					@if($user->username == null)
					<div class="card">
						<div class="card-title">
							<h3>Форма ввода имени и пола</h3>
						</div>
						<div class="card-block">
							<form method='post'>
								{{ csrf_field() }}
								<fieldset>
									<label for="nameField">Имя</label>
										<input type="text" placeholder="Иван Иванов" name="name" id="nameField">
										<label for="sexField">Пол</label>
										<select id="sexField" name="sexfield">
											<option value="male">мужской</option>
											<option value="female">женский</option>
										</select>
										<p class="submit-button"><input class="button-primary" type="submit" value="Отправить"></p>
								</fieldset>
							</form>
						</div>
					</div>
					@elseif($user->complete_survey == "да")
					<div class="card">
						<div class="card-title">
							<h3>Отчет</h3>
						</div>
						<div class="card-block">
							<fieldset>
								<a href="/survey" title="Просмотр в браузере"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
							</fieldset>
						</div>
					</div>
					@else
					<a class="button" href="/survey">Начать опрос</a>
					@endif
				</div>
			</div>
		
		</section>
	</div>	
</div>
