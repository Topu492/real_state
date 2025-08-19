<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <title>Admin Panel</title>

    <link rel="icon" type="image/png" href="">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    @include('admin.layouts.style')
    @include('admin.layouts.script')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        @yield('main_content')
    </div>
</div>

@include('admin.layouts.script_footer')

</body>
</html>