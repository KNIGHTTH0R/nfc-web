<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>NFC</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/form.css">
        <link rel="stylesheet" href="/css/vendor/toastr.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>

        <link href='https://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Exo+2:400,100&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        {% block styles %} {% endblock %}

    </head>
    <body>

    <div class="container">
      {% block content %} {% endblock %}
    </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        {% block scripts %} {% endblock %}

    </body>
</html>
