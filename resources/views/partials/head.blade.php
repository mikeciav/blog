
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta property="og:description" 			content="Quality Counter-Strike Journalism" />
<meta property="og:image" 					content="http://ragareport.com/icon-lg.png" />

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Ragamuffin\'s Blog') }}</title>

<link rel="shortcut icon" href="/favicon.png" type="image/x-icon">

<!-- Styles -->
<link href="/css/app.css" rel="stylesheet">
<link href="/css/select2.min.css" rel="stylesheet">
<link href="/css/font-awesome.min.css" rel="stylesheet">

<!-- Scripts -->
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
