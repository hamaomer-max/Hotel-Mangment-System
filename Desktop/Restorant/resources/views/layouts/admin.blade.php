@auth()
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->

        <!-- Fonts -->

        <script src="{{ asset('online/jquery.min.js') }}"></script>
        <script src="{{ asset('online/axios.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('online/jquery.datatable.min.css') }}">
        <script type="text/javascript" charset="utf8" src="{{ asset('online/jquery-3.3.1.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('online/datatable.js') }}"></script>
        <!-- Styles -->

        <link href="{{ asset('online/fonta.css') }}" rel="stylesheet">
        <script src="{{ asset('online/sweetAlert.js') }}" defer></script>

        <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/2.0.6/css/dataTables.dataTables.min.css">
        <script src="{{ asset('js/printThis.js') }}" defer></script>
        <script src="{{ asset('js/select.js') }}" defer></script>
        <script src="//cdn.datatables.net/2.0.6/js/dataTables.min.js"></script>

        <!-- Vendor CSS Files -->
        <link href="{{ asset('import/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('import/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('import/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('import/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('import/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('import/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('import/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">



        <!-- Template Main CSS File -->
        <link href="{{ asset('import/assets/css/lightstyleen.css') }}" rel="stylesheet">

        <style>
            .btn-danger {
                background-color: rgb(167, 53, 53) !important
            }

            *::-webkit-scrollbar {
                width: 5px;
                height: 5px
            }

            *::-webkit-scrollbar-thumb {
                background: rgb(126, 126, 126)
            }
        </style>
    </head>

    <body dir="">
        <div class="app" >

            <!-- ======= Header ======= -->
            <header id="header" class="header fixed-top   justify-content-between d-flex align-items-center">

                <div class="d-flex  align-items-center justify-content-between px-4">
                    <a href="" class="logo  align-items-center">
                        <span class="d-none d-lg-block">
                            <span class="fs-4 mr-1"> Admin Panel</span>
                        </span>
                    </a>
                    <i class="bi bi-list toggle-sidebar-btn"></i>
                </div><!-- End Logo -->


                <nav class="">
                    <ul class="d-flex align-items-center">

                        <li class="nav-item dropdown pe-3 d-flex rounded-3 p-1 head">

                            <a class="mt-2 ">
                                <i class="bi bi-person"></i>
                                {{ Auth::user()->email }}
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn text-dark" type="submit"><i
                                        class="bi bi-box-arrow-right"></i></button>
                            </form>


                        </li>

                    </ul>
                </nav>

            </header>


            <aside id="sidebar" class="sidebar ">
                <ul class="sidebar-nav" id="sidebar-nav">

                        <li class="nav-item">
                            <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['home']) ? 'bg-primary bg-opacity-25 d-block' : '' }}"
                                href="{{ route('home') }}">
                                <i class="bi bi-grid mx-1"></i> <span> Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">

                            <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['admin.users.index', 'admin.users.create', 'admin.users.edit']) ? 'bg-primary bg-opacity-25 d-block' : '' }}"
                                data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                                <i class="bi bi-person mx-1"></i> <span> Users </span><i
                                    class="bi bi-chevron-down ms-auto"></i>
                            </a>
                            <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                <li class="nav-item">

                                    <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['admin.users.index']) ? 'bg-primary bg-opacity-25 d-block' : '' }}"
                                        href="{{ route('admin.users.index') }}">
                                        <i class="bi bi-person mx-1"></i> <span> Show </span><i
                                            class="bi bi-chevron-down ms-auto"></i>
                                    </a>
                                </li>
                                
                        <li class="nav-item">

                            <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['admin.users.create']) ? 'bg-primary bg-opacity-25 d-block' : '' }}"
                                 href="{{ route('admin.users.create') }}">
                                <i class="bi bi-person mx-1"></i> <span> Create </span><i
                                    class="bi bi-chevron-down ms-auto"></i>
                            </a>
                        </li>
                        </ul>
                        </li>
                     
                </ul>
                     
            </aside><!-- End Sidebar-->

            <main id="main" class="main">
                <section class="section dashboard">

                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible mt-2 fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        @foreach ($errors->all() as $item)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $item }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endforeach
                    @endif
                    @yield('content')
                </section>

            </main><!-- End #main -->

        </div>


        <script src="{{ asset('import/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('import/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('import/assets/vendor/chart.js/chart.min.js') }}"></script>
        <script src="{{ asset('import/assets/vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ asset('import/assets/vendor/quill/quill.min.js') }}"></script>
        <script src="{{ asset('import/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
        <script src="{{ asset('import/assets/vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('import/assets/vendor/php-email-form/validate.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('import/assets/js/main.js') }}"></script>



    </html>

    <script>
        let deleteFunction=(id)=>{
                Swal.fire({
                    title: 'Are you sure to delete this?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',


                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Deleted!',
                        'Deleted Successfully',
                        'success'
                        );

                    document.getElementById(id).submit();

                    }
                })
        };

    </script>

<script>

</script>
@endauth
