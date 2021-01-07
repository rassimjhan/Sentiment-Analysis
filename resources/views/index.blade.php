<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sentiment Analysis</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Decision', 'Count'],
                    ['Neutral',     {{$resultAll['neutral']}}],
                    ['Positive',    {{$resultAll['positive']}}],
                    ['Negative',    {{$resultAll['negative']}}]
                ]);

                var options = {
                    title: 'Analyze for all period'
                };

                var chart = new google.visualization.PieChart(document.getElementById('periodall'));

                chart.draw(data, options);
            }
        </script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Decision', 'Count'],
                    ['Neutral',     {{$resultDay['neutral']}}],
                    ['Positive',    {{$resultDay['positive']}}],
                    ['Negative',    {{$resultDay['negative']}}]
                ]);

                var options = {
                    title: 'Analyze for today',
                };

                var chart = new google.visualization.PieChart(document.getElementById('periodday'));

                chart.draw(data, options);
            }
        </script>

    </head>
    <body>
        <div class="container">
            <div class="text-center">
                <h1> Sentiment Analysis </h1>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="/images/analyze.jpg">
                </div>
                <div class="col-md-6">
                    <p class="inner__text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto beatae eos et eveniet facere harum laborum praesentium quisquam quos voluptatibus.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto beatae eos et eveniet facere harum laborum praesentium quisquam quos voluptatibus.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto beatae eos et eveniet facere harum laborum praesentium quisquam quos voluptatibus.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto beatae eos et eveniet facere harum laborum praesentium quisquam quos voluptatibus.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto beatae eos et eveniet facere harum laborum praesentium quisquam quos voluptatibus.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto beatae eos et eveniet facere harum laborum praesentium quisquam quos voluptatibus.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores et ex ipsam magnam non nostrum nulla repellat, soluta ut!
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div id="periodall"></div>
                </div>
                <div class="col-md-6">
                    <div id="periodday"></div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <a href="/analyze">
                    <button class="btn btn-lg btn-success">Sentiment Analyzer</button>
                </a>
            </div>
        </div>
    </body>
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script>
        function checkWord(){
            var word = $('#text').val();
            if(word === ''){
                alert('Enter the word')
                return;
            }
            $('#positive').hide();
            $('#negative').hide();
            $('#neutral').hide();
            $.ajax({
                url : '/checkword',
                cache : false,
                dataType : 'json',
                type : 'POST',
                data : {
                    word : word,
                    _token : '{{csrf_token()}}'
                },
                success(data){
                    if(data.success){
                        $('#'+data.decision).show();
                    }else{
                        alert(data.error);
                    }
                },
                error(data){
                    alert(data.text);
                }
            })
        }
    </script>
</html>
