<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>HTML5 Admin Template</title>
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700" rel="stylesheet">
  
  <!-- Template Styles -->
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    
  <!-- CSS Reset -->
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    
  <!-- Milligram CSS minified -->
  <link rel="stylesheet" href="{{ asset('css/milligram.min.css') }}">
    
  <!-- Main Styles -->
	<link rel="stylesheet" href="{{ asset('css/admstyles.css') }}">
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
  @yield('content')
</body>
</html>