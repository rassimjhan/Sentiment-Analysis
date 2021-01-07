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
                background-color: #5dc5d0;
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

    </head>
    <body>
        <div class="container">
            <div class="text-center">
                <h1> Sentiment Analysis </h1>
            </div>
            <div class="card col-md-10 offset-md-1">
                <div class="mb-3 mt-3">
                    <label for="exampleFormControlInput1" class="form-label">Enter your text</label>
                    <textarea class="form-control" id="text" rows="3"></textarea>
                </div>
                <div class="mb-3 mt-3">
                    <button type="submit" class="btn btn-primary mb-3" onclick="checkWord()">Check</button>
                </div>
            </div>
            <div class="card col-md-10 offset-md-1" style="display: none" id="positive">
                <img src="/images/positive.png" style=" width : 25%; margin: 10px auto;">
            </div>
            <div class="card col-md-10 offset-md-1" style="display: none" id="neutral">
                <img src="/images/neutral.png" style=" width : 25%; margin: 10px auto;">
            </div>
            <div class="card col-md-10 offset-md-1" style="display: none" id="negative">
                <img src="/images/negative.png" style=" width : 25%; margin: 10px auto;">
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
