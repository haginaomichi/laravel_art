<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    
    <!--<link rel="stylesheet" href=https:/stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    
    <!-- slick CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
     
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <!-- slick js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" integrity="sha256-DHF4zGyjT7GOMPBwpeehwoey18z8uiz98G4PRu2lV0A=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class = "container">
        @yield('header')
     
        {{-- エラーメッセージを出力 --}}
        @foreach($errors->all() as $error)
          <p class="error">{{ $error }}</p>
        @endforeach
     
        {{-- 成功メッセージを出力 --}}
        @if (session()->has('success'))
            <div class="success">
                {{ session()->get('success') }}
            </div>
        @endif
     
        @yield('content')
        
        @yield('footer')
    </div>
</body>
</html>