<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Dark Mode Toggle with Slide Animation -->
                <li class="nav-item">
                    <a class="nav-link" href="#" id="darkModeToggle" role="button">
                        <div class="toggle-container">
                            <i class="fas fa-moon" id="darkModeIcon"></i>
                        </div>
                    </a>
                </li>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const toggle = document.getElementById("darkModeToggle");
                        const icon = document.getElementById("darkModeIcon");
                        const body = document.body;
                        const toggleContainer = document.querySelector(".toggle-container");

                        // Cek mode yang tersimpan di localStorage
                        if (localStorage.getItem("darkMode") === "enabled") {
                            body.classList.add("dark-mode");
                            icon.classList.replace("fa-moon", "fa-sun");
                            toggleContainer.classList.add("active");
                        }

                        toggle.addEventListener("click", function() {
                            body.classList.toggle("dark-mode");
                            toggleContainer.classList.toggle("active");

                            if (body.classList.contains("dark-mode")) {
                                localStorage.setItem("darkMode", "enabled");
                                icon.classList.replace("fa-moon", "fa-sun");
                            } else {
                                localStorage.setItem("darkMode", "disabled");
                                icon.classList.replace("fa-sun", "fa-moon");
                            }
                        });
                    });
                </script>

                <style>
                    .toggle-container {
                        display: inline-block;
                        width: 50px;
                        height: 25px;
                        background-color: #ddd;
                        border-radius: 15px;
                        position: relative;
                        cursor: pointer;
                        transition: background 0.3s;
                    }

                    .toggle-container i {
                        position: absolute;
                        top: 50%;
                        left: 5px;
                        transform: translateY(-50%);
                        transition: left 0.3s;
                    }

                    .toggle-container.active {
                        background-color: #212529;
                    }

                    .toggle-container.active i {
                        left: 25px;
                    }

                    .dark-mode {
                        background-color: #343a40;
                        color: white;
                    }

                    .dark-mode .navbar {
                        background-color: #343a40;
                    }
                </style>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('adminlte/dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('adminlte/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
                <!-- Avatar Dropdown Menu -->
                <li class="nav-item dropdown me-6"> {{-- Item dropdown dalam navbar dengan margin kanan --}}
                    <a class="nav-link" data-toggle="dropdown" href="#" id="avatarDropdown">
                        {{-- Trigger dropdown --}}
                        @if (auth()->user()->photo)
                            {{-- Jika user punya foto profil --}}
                            <img src="{{ asset('storage/profile/' . auth()->user()->photo) }}"
                                class="img-circle elevation-2" alt="User Image" width="27" height="27">
                            {{-- Foto profil user kecil --}}
                        @else
                            {{-- Jika user tidak punya foto --}}
                            <img src="{{ asset('storage/profile/avatar5.png') }}" class="img-circle elevation-2"
                                alt="User Image" width="30" height="30"> {{-- Foto default --}}
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> {{-- Kontainer isi dropdown --}}
                        <div class="dropdown-item text-center"> {{-- Item pertama: tampilkan info user --}}
                            <div class="image"> {{-- Pembungkus gambar besar --}}
                                @if (auth()->user()->photo)
                                    {{-- Jika user punya foto --}}
                                    <img src="{{ asset('storage/profile/' . auth()->user()->photo) }}"
                                        class="img-circle elevation-2" alt="User Image" width="100"
                                        height="100"> {{-- Foto besar user --}}
                                @else
                                    {{-- Jika tidak punya foto --}}
                                    <img src="{{ asset('adminlte/dist/img/avatar.png') }}"
                                        class="img-circle elevation-2" alt="User Image" width="100"
                                        height="100"> {{-- Foto default besar --}}
                                @endif
                            </div>
                            <p class="mt-2">{{ auth()->user()->nama }}</p> {{-- Tampilkan nama user --}}
                        </div>
                        <div class="dropdown-divider"></div> {{-- Garis pemisah --}}
                        <a href="#" class="dropdown-item" data-toggle="modal"
                            data-target="#changeAvatarModal"> {{-- Buka modal ganti foto --}}
                            <i class="fas fa-user-edit mr-2"></i> Ganti Foto Profil
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- /.navbar -->
