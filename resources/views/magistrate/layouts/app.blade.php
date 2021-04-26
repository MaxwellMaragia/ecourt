<!DOCTYPE html>
<html lang="en">
<head>
    @include('magistrate.layouts.head')
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
     @include('magistrate.layouts.header')
     @include('magistrate.layouts.sidebar')



     @section('main-content')
        @show

     @include('magistrate.layouts.footer')
    </div>
</body>
</html>
