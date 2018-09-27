<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Авторизация в опроснике</title>
	<link rel="stylesheet" href="{{ asset('css/logstyle.css') }}" media="screen" type="text/css" />
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

    <div id="login-form">
        <h1>Авторизация</h1>

        <fieldset>
            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                <!-- <input type="email" required value="Логин" onBlur="if(this.value=='')this.value='Логин'" onFocus="if(this.value=='Логин')this.value='' "> -->
                <input id="email" type="email" value="{{ $uri['email'] }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                <!-- <input type="password" required value="Пароль" onBlur="if(this.value=='')this.value='Пароль'" onFocus="if(this.value=='Пароль')this.value='' "> -->
                <input id="password" type="password" value="{{ $uri['password'] }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                <input type="submit" value="ВОЙТИ">
            </form>
        </fieldset>

        <div class="container">
            {{ $uri['password'] }}
        </div>
    </div>
</body>
</html>
