<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Страница, содержащая блок для голосования</title>
  <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <h1 class ="page-header text-center">Наука о личности</h1>
  <div class="container">
    <div class="row">
      <div class="col-sm-offset-3 col-sm-6">
        <section class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">
              Опросник по определению внутреннего движущего мотива
            </h3>
          </div>
          <div class="panel-body" id="wrapper">
            <div id="start">
              <p>Для заполнения опросника и получения неискаженных результатов, необходимо вспомнить себя в максимально раннем детстве.</p> 
              <p>Для ориентира можно использовать возраст начальной школы.</p>
              <p>Очень важно отвечать на вопросы, именно думая о себе в детстве.</p>
              <p><strong>Понятно?</strong>&nbsp;&nbsp;&nbsp;<a class="btn btn-default" id='go' href=''>Понятно</a></p>
            </div>
            <div id="second">
              <p>Если в детстве вы испытывали сильное влияние со стороны родителей, и ваши действия были продиктованы их требованиями, то при заполнении опросника отвечайте так, как вы поступили бы сами по своей воле, не имея такого влияния.</p>
              <p><strong>Хорошо?</strong>&nbsp;&nbsp;&nbsp;<a class="btn btn-default" id='good' href=''>Хорошо</a></p>
            </div>
            <div id="third">
              <p>Из четырех предложенных вариантов необходимо выбрать только один. Если вам подходит несколько вариантов, необходимо выбрать один максимально близко описывающий вас в детстве. Если ни один вариант не подходит, выбрать один максимально близко описывающий вас в детстве.</p>
              <p><strong>OK?</strong>&nbsp;&nbsp;&nbsp;<a class="btn btn-default" id='ok' href=''>OK</a></p>
            </div>
            <div id="content-wrapper">
            <!-- HTML-структура голосовалки -->
              <div id="vote-section">              
                <form id="vote" action="/survey" method="POST">
                {{ csrf_field() }}
                  <div id="content">
                    <div class="pattern">
                      <h4 class="question">{% question %}</h4>
                      <h5>(<span class="number"></span> из 45) Выберите только один ответ, максимально близкий по описанию к вам в детстве.</h5>
                      <hr>
                      <div class="answers">
                        <div class="radio"><label><input type="radio" name="poll[{% id %}]" value="{% answer.value %}">{% answer.title %}</label></div>
                      </div>
                    </div>
                  </div>
                  <div><button type="submit" class="btn btn-default answer-btn" disabled="disabled">Ответить</button></div>
                </form>
              </div>
            <!-- конец HTML-структура -->
            </div>
          </div>
        </section>
      </div>
    </div>    
  </div>
        
    <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <script src="{{ asset('js/surv.js') }}"></script>
  </body>
</html>