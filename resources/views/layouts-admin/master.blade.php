<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" href="https://sit.poliwangi.ac.id/favicon.png" type="image/png">
    <title>Sistem Informasi Posyandu Banyuwangi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{asset('arfa/vendor/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('arfa/vendor/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('arfa/vendor/perfect-scrollbar/css/perfect-scrollbar.css')}}">

    <!-- CSS for this page only -->
    @stack('css')
    <link href="{{asset('arfa/vendor/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('arfa/vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet" />
    <!-- End CSS  -->

    <link rel="stylesheet" href="{{asset('arfa/assets/css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.min.css')}}">
    <link rel="stylesheet" id="theme-color" href="{{asset('arfa/assets/css/dark.min.css')}}">
</head>

<body>
    <div id="app">
        @include('layouts-admin.top')
        @include('layouts-admin.sidebar')
        <div class="main-content">

            <div class="content-wrapper">
                <div class="row same-height">

                    @yield('content')
                </div>
            </div>

        </div>

        <div class="settings">
            <div class="settings-icon-wrapper">
                <div class="settings-icon">
                    <!-- <i class="ti ti-settings"></i> -->
                </div>
            </div>
            <div class="settings-content">
                <ul>
                    <li class="fix-header">
                        <div class="fix-header-wrapper">
                            <div class="form-check form-switch lg">
                                <label class="form-check-label" for="settingsFixHeader">Fixed Header</label>
                                <input class="form-check-input toggle-settings" name="Header" type="checkbox" id="settingsFixHeader">
                            </div>

                        </div>
                    </li>
                    <li class="fix-footer">
                        <div class="fix-footer-wrapper">
                            <div class="form-check form-switch lg">
                                <label class="form-check-label" for="settingsFixFooter">Fixed Footer</label>
                                <input class="form-check-input toggle-settings" name="Footer" type="checkbox" id="settingsFixFooter">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="theme-switch">
                            <label for="">Theme Color</label>
                            <div>
                                <div class="form-check form-check-inline lg">
                                    <input class="form-check-input lg theme-color" type="radio" name="ThemeColor" id="light" value="light">
                                    <label class="form-check-label" for="light">Light</label>
                                </div>
                                <div class="form-check form-check-inline lg">
                                    <input class="form-check-input lg theme-color" type="radio" name="ThemeColor" id="dark" value="dark">
                                    <label class="form-check-label" for="dark">Dark</label>
                                </div>

                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="fix-footer-wrapper">
                            <div class="form-check form-switch lg">
                                <label class="form-check-label" for="settingsFixFooter">Collapse Sidebar</label>
                                <input class="form-check-input toggle-settings" name="Sidebar" type="checkbox" id="settingsFixFooter">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <footer>

        </footer>
        <div class="overlay action-toggle ">
        </div>
    </div>

    @yield('js')
    <script src="{{asset('arfa/vendor/bootstrap/dist/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('arfa/vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>

    <!-- js for this page only -->
    @stack('js')
    <script src="{{asset('arfa/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('arfa/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('arfa/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('arfa/assets/js/page/datatables.js')}}"></script>
    <!-- ======= -->
    <script src="{{asset('arfa/assets/js/main.js')}}"></script>
    <script>
        Main.init()
    </script>
    <script>
        DataTable.init()
    </script>
</body>

</html>