@include("backend.layoust.head")
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    @include("backend.layoust.header")

    @include("backend.layoust.sidebar")

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @yield("title-page")
                <small>@yield("title-description")</small>
            </h1>
        </section>

        <section class="content">
            @yield("content")
        </section>
    </div>

@include('sweetalert::alert')

@include("backend.layoust.footer")
