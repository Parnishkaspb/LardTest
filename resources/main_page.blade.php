<!-- resources/views/main_page.blade.php -->
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <title>@yield('title', 'Test')</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body style="background-color: #f5f5f5;">
        <div class="container">
            @yield('content')
            <div class="card mt-4" id="answer_card" style="display: none;">
                <div class="card-body"><h7 id="answer_text"></h7></div>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="comment" placeholder="Написать комментарий" name="0/0" aria-label="comments" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" onclick="comment()" id="button-addon2">Отправить</button>
            </div>
        </div>    
    </body>
</html>
