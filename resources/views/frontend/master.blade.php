@include('frontend.layouts.head')
<body>

@include('frontend.layouts.header')
@include('sweetalert::alert')

@yield("content")
@include('frontend.layouts.footer')
