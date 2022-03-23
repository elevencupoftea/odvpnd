<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
<div id="wrapper">
    <header>
        @include('includes.header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('includes.footer')
    </footer>
</div>
</body>
</html>
