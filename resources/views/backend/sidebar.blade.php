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
                        {{-- <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-user-3-line align-middle"></i>
                            <span style="vertical-align: middle">Users</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('user-index-all') }}">All</a></li>
                            @foreach ($semua_jabatan as $jabatan)
                                <li><a href="{{ route('user-index', $jabatan->id) }}">{{ $jabatan->nama }}</a></li>
                            @endforeach
                        </ul> --}}

                        <a href="{{ route('user-index-all') }}" class="waves-effect">
                            <i class="ri-user-3-line align-middle"></i>
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
                        {{-- <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Jam</span>
                        </a> --}}
                        <a href="{{ route('jam-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Jam</span>
                        </a>
                        {{-- <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('jam-index') }}">All</a></li>
                            <li><a href="{{ route('jam-pelajaran-index') }}">Pelajaran</a></li>
                            <li><a href="{{ route('jam-istirahat-index') }}">Istirahat</a></li>
                        </ul> --}}
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

                @canany(['guru_wali', 'guru_mapel', 'siswa'])
                    {{-- <li>
                        <a href="{{ route('jadwal-for-guru-wali-mapel-siswa-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Jadwal</span>
                        </a>
                    </li> --}}
                @endcanany

                @canany(['admin', 'kepala_madrasah', 'guru_wali', 'guru_mapel', 'siswa'])
                    <li>
                        {{-- <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Jadwal</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('jadwal-all') }}">All</a></li>
                            <li><a href="javascript: void(0);" class="has-arrow">Pelajaran</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('jadwal-pelajaran-all') }}">All</a></li>
                                    @foreach ($semua_kelas as $kelas)
                                        <li><a
                                                href="{{ route('jadwal-pelajaran-index', $kelas->id) }}">{{ $kelas->nama }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="javascript: void(0);" class="has-arrow">Ekstrakurikuler</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('jadwal-ekstra-all') }}">All</a></li>
                                    @foreach ($semua_kelas as $kelas)
                                        <li><a
                                                href="{{ route('jadwal-ekstra-index', $kelas->id) }}">{{ $kelas->nama }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @can('kepala_madrasah')
                                <li><a href="{{ route('jadwal-for-kepala-madrasah-index') }}">Jadwal saya</a></li>
                            @endcan --}}

                        {{-- </ul> --}}
                        <a href="{{ route('jadwal-all') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Jadwal</span>
                        </a>
                    </li>
                @endcanany

                {{-- @canany(['guru_wali', 'guru_mapel', 'siswa'])
                    <li>
                        <a href="#" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Nilai</span>
                        </a>


                    </li>
                @endcanany --}}

                {{-- @canany(['admin', 'kepala_madrasah']) --}}
                    <li>
                        {{-- <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Nilai</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="javascript: void(0);" class="has-arrow">Ulangan Harian</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    @foreach ($semua_kelas as $kelas)
                                        <li><a
                                                href="{{ route('nilai-ulangan-harian-index-kelas', $kelas->id) }}">{{ $kelas->nama }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="javascript: void(0);" class="has-arrow">Tugas</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    @foreach ($semua_kelas as $kelas)
                                        <li><a
                                                href="{{ route('nilai-tugas-index-kelas', $kelas->id) }}">{{ $kelas->nama }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="javascript: void(0);" class="has-arrow">UTS</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    @foreach ($semua_kelas as $kelas)
                                        <li><a
                                                href="{{ route('nilai-uts-index-kelas', $kelas->id) }}">{{ $kelas->nama }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="javascript: void(0);" class="has-arrow">UAS</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    @foreach ($semua_kelas as $kelas)
                                        <li><a
                                                href="{{ route('nilai-uas-index-kelas', $kelas->id) }}">{{ $kelas->nama }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="javascript: void(0);" class="has-arrow">Rapor</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    @foreach ($semua_kelas as $kelas)
                                        <li><a
                                                href="{{ route('nilai-rapor-index-kelas', $kelas->id) }}">{{ $kelas->nama }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul> --}}

                        <a href="{{ route('nilai-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Nilai</span>
                        </a>
                    </li>
                {{-- @endcanany --}}

                @can('admin')
                    {{-- <li>
                        <a href="{{ route('pengumuman-index') }}" class="waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Pengumuman</span>
                        </a>
                    </li> --}}
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
                            <span style="vertical-align: middle">Profil Sekolah</span>
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

                @canany(['admin', 'kepala_madrasah'])
                    <li>
                        {{-- <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-file-list-line align-middle"></i>
                            <span style="vertical-align: middle">Blog</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('blog-all-index') }}">All</a></li>
                            @foreach ($semua_kategori_blog as $kategori_blog)
                                <li><a
                                        href="{{ route('blog-index', $kategori_blog->id) }}">{{ $kategori_blog->blog_category }}</a>
                                </li>
                            @endforeach
                        </ul> --}}

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
