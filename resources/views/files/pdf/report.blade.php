<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Document</title>
</head>

<style>
body {
    font-family: DejaVu Sans, sans-serif;
}

</style>
<body>
<h1><span>Վերնագիր՝ </span> {{ $report->title }}</h1>
<h2><span>Դիմող՝ </span> {{ $user->first_name . ' ' . $user->last_name}}</h2>
<p><span>Դիմում՝ </span> {{ $report->text }}</p>

<p><span>Ուղղարկվել է՝ </span> {{ date('Y-m-d', strtotime($report->created_at)) }}</p>
</body>
</html>
