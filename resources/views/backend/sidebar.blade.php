<?php
$semua_kelas = DB::table('kelas')->get();
$semua_kategori_blog = DB::table('blog_categories')->get();
$semua_jabatan = DB::table('jabatans')->get();
$semua_jam_pelajaran = DB::table('jam_pelajarans')->get();
$route = Route::current()->getName();
?>

<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Dashboard</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri-home-3-line align-middle"></i>
                        <span style="vertical-align: middle">Home</span>
                    </a>
                </li>
                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        <a href="{{ route('cita-cita') }}" class="waves-effect">
                            <i class="ri-star-line align-middle"></i>
                            <span style="vertical-align: middle">Cita-cita</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('hobi') }}" class="waves-effect">
                            <i class="ri-football-line align-middle"></i>
                            <span style="vertical-align: middle">Hobi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pekerjaan') }}" class="waves-effect">
                            <i class="ri-briefcase-line align-middle"></i>
                            <span style="vertical-align: middle">Pekerjaan</span>
                        </a>
                    </li>
                    <li>

                        <a href="{{ route('user-index-all') }}" class="waves-effect">
                            <i class="ri-group-line align-middle"></i>
                            <span style="vertical-align: middle">Users</span>
                        </a>
                    </li>
                @endcanany
                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        <a href="{{ route('mata-pelajaran') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Mata Pelajaran</span>
                        </a>
                    </li>
                @endcanany
                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        <a href="{{ route('ekstra-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Ekstrakurikuler</span>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        <a href="{{ route('jam-index') }}" class="waves-effect">
                            <i class="ri-time-line align-middle"></i>
                            <span style="vertical-align: middle">Jam</span>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        <a href="{{ route('data-tahun-ajaran-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Tahun Ajaran</span>
                        </a>
                    </li>
                @endcanany


                @canany(['admin', 'kepala_madrasah', 'guru_wali', 'guru_mapel', 'siswa'])
                    <li>
                        <a href="{{ route('jadwal-all') }}" class="waves-effect">
                            <i class="ri-calendar-line align-middle"></i>
                            <span style="vertical-align: middle">Jadwal</span>
                        </a>
                    </li>
                @endcanany

                <li>
                    <a href="{{ route('nilai-index') }}" class="waves-effect">
                        <i class="ri-file-list-line align-middle"></i>
                        <span style="vertical-align: middle">Nilai</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('prestasi-siswa') }}" class="waves-effect">
                        <i class="ri-file-list-line align-middle"></i>
                        <span style="vertical-align: middle">Prestasi Siswa</span>
                    </a>
                </li>

                @can('guru_wali')
                    <li>
                        <a href="{{ route('rapor-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Rapor</span>
                        </a>
                    </li>
                @endcan


                @can('guru_wali')
                    <li>
                        <a href="{{ route('pengumuman-for-siswa-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Pengumuman</span>
                        </a>
                    </li>
                @endcan

                @canany(['admin', 'kepala_madrasah'])
                    <li class="menu-title">Main Website</li>
                @endcanany

                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        <a href="{{ route('sambutan-kepala-madrasah-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Sambutan</span>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        <a href="{{ route('profil-sekolah-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Profil Madrasah</span>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        <a href="{{ route('sarana-prasarana-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Sarana Prasarana</span>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        <a href="{{ route('blog-category-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Kategori Blog</span>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'kepala_madrasah', 'guru_wali', 'guru_mapel'])
                    <li>

                        <a href="{{ route('blog-all-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Blog</span>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        <a href="{{ route('kontak-index-be') }}" class="waves-effect">
                            <i class="ri-mail-line align-middle"></i>
                            <span style="vertical-align: middle">Kontak</span>
                        </a>
                    </li>
                @endcanany

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
