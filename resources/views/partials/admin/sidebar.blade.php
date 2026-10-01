<aside class="sidebar">

    <!-- BRAND -->

    <div class="sidebar-brand">

        <div class="brand-icon">

            <i class="bi bi-fingerprint"></i>

        </div>

        <div class="brand-text">

            Absensi

            <span class="brand-subtitle">
                Sistem Absensi Karyawan
            </span>

        </div>

    </div>


    <!-- MENU -->

    <div class="sidebar-menu">

        <div class="menu-title">
            Menu Utama
        </div>


        <a href="{{ route('attendance.view') }}" class="menu-link active">

            <i class="bi bi-speedometer2"></i>

            <span>
                Dashboard
            </span>

        </a>


        <a href="{{ route('pegawai.index') }}" class="menu-link">

            <i class="bi bi-people"></i>

            <span>
                Data Pegawai
            </span>

        </a>


        <div class="menu-title mt-4">
            Sistem
        </div>


        <a href="{{ url('/attendance/view') }}" class="menu-link">

            <i class="bi bi-fingerprint"></i>

            <span>
                Fingerprint
            </span>

        </a>

    </div>


    <!-- USER + LOGOUT -->

    <div class="sidebar-bottom">


        <div class="user-sidebar">

            <div class="user-avatar">

                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}

            </div>


            <div class="user-information">

                <div class="user-name">

                    {{ $user->name ?? 'User' }}

                </div>

                <div class="user-role">

                    Administrator

                </div>

            </div>

        </div>


        <!-- LOGOUT -->

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button type="submit" class="btn-logout">

                <i class="bi bi-box-arrow-left me-2"></i>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>
