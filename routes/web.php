<?php

use App\Models\User;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitaCitaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\HobiController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\SaranaPrasaranaController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\JamPelajaranController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PrestasiSiswa;
use App\Http\Controllers\PrestasiSiswaController;
use App\Http\Controllers\SambutanKepalaMadrasahController;
use App\Http\Controllers\TahunAjaranController;
use App\Models\CitaCita;

require __DIR__ . '/auth.php';

// prevent back history
Route::group(['middleware' => 'prevent-back-history'], function () {

    // auth
    Route::middleware(['auth'])->group(function () {
        // home
        Route::controller(DashboardHomeController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            // route fetch data pengumuman
            Route::get('/pengumuman/fetch', 'fetch')->name('pengumuman-fetch');
        });

        // authentification
        Route::controller(AdminController::class)->group(function () {
            Route::get('/logout', 'destroy')->name('logout');
            Route::get('/profile', 'Profile')->name('profile');
            Route::get('/profile/fetch', 'fetch')->name('profile-fetch');
            Route::post('/update/profile', 'UpdateProfile')->name('update.profile');
            Route::post('/update/password', 'UpdatePassword')->name('update.password');
        });

        // user
        Route::middleware('admin')->group(function () {
            Route::controller(UserController::class)->group(function () {
                // route import excel
                Route::post('/data-user/siswa/import', 'fileImportDataSiswa')->name('file-import-data-siswa');
                // route naik kelas
                Route::post('/data-user/naik-kelas', 'naik')->name('user-naik-kelas');
                // route turun kelas
                Route::post('/data-user/turun-kelas', 'turun')->name('user-turun-kelas');
                Route::get('/data-user/tambah/{id}', 'tambah')->name('user-tambah');
                // Route::get('/admin/tambah', 'admin_tambah')->name('admin-tambah');
                Route::post('/data-user/simpan/{id}', 'simpan')->name('user-simpan');
                Route::get('/data-user/hapus/{id}', 'hapus')->name('user-hapus');
                Route::get('/data-user/edit/{id}', 'edit')->name('user-edit');
                Route::post('/data-user/update/{id}', 'update')->name('user-update');
            });
        });
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('/data-user/all', 'index_all')->name('user-index-all');
                Route::get('/data-user/print', 'cetak')->name('user-cetak');
                Route::get('/data-user/{id}', 'index')->name('user-index');
                Route::get('/data-guru/wali-kelas', 'guru_wali_kelas_index')->name('user-guru-wali-kelas-index');
                Route::get('/data-siswa/{id}', 'siswa_index')->name('user-siswa-index');
                Route::get('/data-guru/mata-pelajaran', 'guru_mapel_index')->name('user-guru-mapel-index');
                // tambah route filter
                Route::get('/user/filter', 'filter_user')->name('user-filter');
            });
        });
        Route::middleware('admin_or_kepala_madrasah_or_guru_wali')->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('/data-rapor/print', 'cetakRapor')->name('user-cetak-rapor');
            });
        });
        Route::middleware('guru_wali')->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('/rapor', 'index_rapor')->name('rapor-index');
                Route::get('/rapor/fetch', 'fetch_rapor')->name('rapor-fetch');
            });
        });

        // mata pelajaran
        Route::middleware('admin')->group(function () {
            Route::controller(MataPelajaranController::class)->group(function () {
                Route::get('/mata-pelajaran/tambah', 'tambah')->name('mata-pelajaran-tambah');
                Route::post('/mata-pelajaran/simpan', 'simpan')->name('mata-pelajaran-simpan');
                Route::get('/mata-pelajaran/edit/{id}', 'edit')->name('mata-pelajaran-edit');
                Route::post('/mata-pelajaran/update/{id}', 'update')->name('mata-pelajaran-update');
                Route::get('/mata-pelajaran/hapus/{id}', 'hapus')->name('mata-pelajaran-hapus');
            });
        });
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(MataPelajaranController::class)->group(function () {
                Route::get('/mata-pelajaran', 'index')->name('mata-pelajaran');
                Route::get('/mata-pelajaran/fetch', 'fetch')->name('mata-pelajaran-fetch');
            });
        });

        // cita-cita
        Route::middleware('admin')->group(function () {
            Route::controller(CitaCitaController::class)->group(function () {
                Route::get('/cita-cita/tambah', 'tambah')->name('cita-cita-tambah');
                Route::post('/cita-cita/simpan', 'simpan')->name('cita-cita-simpan');
                Route::get('/cita-cita/edit/{id}', 'edit')->name('cita-cita-edit');
                Route::post('/cita-cita/update/{id}', 'update')->name('cita-cita-update');
                Route::get('/cita-cita/hapus/{id}', 'hapus')->name('cita-cita-hapus');
            });
        });
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(CitaCitaController::class)->group(function () {
                Route::get('/cita-cita', 'index')->name('cita-cita');
                Route::get('/cita-cita/fetch', 'fetch')->name('cita-cita-fetch');
            });
        });

        // hobi
        Route::middleware('admin')->group(function () {
            Route::controller(HobiController::class)->group(function () {
                Route::get('/hobi/tambah', 'tambah')->name('hobi-tambah');
                Route::post('/hobi/simpan', 'simpan')->name('hobi-simpan');
                Route::get('/hobi/edit/{id}', 'edit')->name('hobi-edit');
                Route::post('/hobi/update/{id}', 'update')->name('hobi-update');
                Route::get('/hobi/hapus/{id}', 'hapus')->name('hobi-hapus');
            });
        });
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(HobiController::class)->group(function () {
                Route::get('/hobi', 'index')->name('hobi');
                Route::get('/hobi/fetch', 'fetch')->name('hobi-fetch');
            });
        });

        // pekerjaan
        Route::middleware('admin')->group(function () {
            Route::controller(PekerjaanController::class)->group(function () {
                Route::get('/pekerjaan/tambah', 'tambah')->name('pekerjaan-tambah');
                Route::post('/pekerjaan/simpan', 'simpan')->name('pekerjaan-simpan');
                Route::get('/pekerjaan/edit/{id}', 'edit')->name('pekerjaan-edit');
                Route::post('/pekerjaan/update/{id}', 'update')->name('pekerjaan-update');
                Route::get('/pekerjaan/hapus/{id}', 'hapus')->name('pekerjaan-hapus');
            });
        });
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(PekerjaanController::class)->group(function () {
                Route::get('/pekerjaan', 'index')->name('pekerjaan');
                Route::get('/pekerjaan/fetch', 'fetch')->name('pekerjaan-fetch');
            });
        });

        // tahun ajaran
        Route::middleware('admin')->group(function () {
            Route::controller(TahunAjaranController::class)->group(function () {
                Route::get('/data-tahun-ajaran/tambah', 'create')->name('data-tahun-ajaran-tambah');
                Route::post('/data-tahun-ajaran/simpan', 'store')->name('data-tahun-ajaran-simpan');
                Route::get('/data-tahun-ajaran/edit/{id}', 'edit')->name('data-tahun-ajaran-edit');
                Route::post('/data-tahun-ajaran/update/{id}', 'update')->name('data-tahun-ajaran-update');
                Route::get('/data-tahun-ajaran/hapus/{id}', 'destroy')->name('data-tahun-ajaran-hapus');
            });
        });
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(TahunAjaranController::class)->group(function () {
                Route::get('/data-tahun-ajaran', 'index')->name('data-tahun-ajaran-index');
                // tambah route fetch
                Route::get('/data-tahun-ajaran/fetch', 'fetch')->name('data-tahun-ajaran-fetch');
            });
        });

        // jadwal pelajaran
        Route::middleware('admin')->group(function () {
            Route::controller(JadwalPelajaranController::class)->group(function () {
                Route::get('/jadwal-pelajaran/tambah', 'jadwal_pelajaran_tambah')->name('jadwal-pelajaran-tambah');
                Route::post('/jadwal-pelajaran/simpan', 'jadwal_pelajaran_simpan')->name('jadwal-pelajaran-simpan');
                Route::get('/jadwal-ekstra/tambah', 'jadwal_ekstra_tambah')->name('jadwal-ekstra-tambah');
                Route::post('/jadwal-ekstra/simpan/{id}', 'jadwal_ekstra_simpan')->name('jadwal-ekstra-simpan');
                Route::get('/jadwal/edit/{id}', 'jadwal_edit')->name('jadwal-edit');
                Route::post('/jadwal/update/{id}', 'jadwal_update')->name('jadwal-update');
                Route::get('/jadwal/hapus/{id}', 'jadwal_hapus')->name('jadwal-hapus');
                Route::get('/getGuruInfo/{id}', 'getGuruInfo')->name('guru-info');
                Route::get('/getGuruInfoTambah/{guruId}', 'getGuruInfoTambah')->name('guru-info-tambah');
                Route::post('/jadwal/simpan', 'jadwal_simpan')->name('jadwal-simpan');
            });
        });
        // Route::middleware('admin_or_guru_wali_kelas_or_guru_mata_pelajaran_or_siswa')->group(function () {
        //     Route::controller(JadwalPelajaranController::class)->group(function () {
        //         Route::get('/jadwal/cek-jumlah', 'checkJumlahJadwal')->name('jadwal-check');
        //         Route::get('/jadwal/print', 'cetak_jadwal')->name('jadwal-cetak');
        //     });
        // });

        Route::controller(JadwalPelajaranController::class)->group(function () {
            Route::get('/jadwal/cek-jumlah', 'checkJumlahJadwal')->name('jadwal-check');
            Route::get('/jadwal/print', 'cetak_jadwal')->name('jadwal-cetak');
        });

        Route::controller(JadwalPelajaranController::class)->group(function () {
            Route::get('/jadwal-all', 'index_all_jadwal')->name('jadwal-all');
            Route::get('/jadwal/filter', 'filter_jadwal')->name('jadwal-filter');
        });


        // ekstrakurikuler
        Route::middleware('admin')->group(function () {
            Route::controller(EkstrakurikulerController::class)->group(function () {
                Route::get('/data-ekstrakurikuler/tambah', 'tambah')->name('ekstra-tambah');
                Route::post('/data-ekstrakurikuler/simpan', 'simpan')->name('ekstra-simpan');
                Route::get('/data-ekstrakurikuler/hapus/{id}', 'hapus')->name('ekstra-hapus');
                Route::get('/data-ekstrakurikuler/edit/{id}', 'edit')->name('ekstra-edit');
                Route::post('/data-ekstrakurikuler/update/{id}', 'update')->name('ekstra-update');
            });
        });
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(EkstrakurikulerController::class)->group(function () {
                Route::get('/data-ekstrakurikuler', 'index')->name('ekstra-index');
                Route::get('/data-ekstrakurikuler/fetch', 'fetch')->name('ekstra-fetch');
            });
        });

        // nilai
        Route::controller(NilaiController::class)->group(function () {
            Route::get('/data-nilai', 'index')->name('nilai-index');
            // tambah route filter
            Route::get('/data-nilai/filter', 'filter')->name('nilai-filter');
        });

        Route::middleware('admin_or_guru_wali_kelas_or_guru_mata_pelajaran')->group(function () {
            Route::controller(NilaiController::class)->group(function () {
                Route::get('/data-nilai/ulangan-harian/tambah', 'tambah_nilai_ulangan_harian')->name('nilai-ulangan-harian-tambah');
                Route::get('/data-nilai/tugas/tambah', 'tambah_nilai_tugas')->name('nilai-tugas-tambah');
                Route::get('/data-nilai/uts/tambah', 'tambah_nilai_uts')->name('nilai-uts-tambah');
                Route::get('/data-nilai/uas/tambah', 'tambah_nilai_uas')->name('nilai-uas-tambah');
                Route::get('/data-nilai/ujian/tambah', 'tambah_nilai_ujian')->name('nilai-ujian-tambah');
                Route::post('/data-nilai/simpan', 'simpan')->name('nilai-simpan');
                Route::get('/data-nilai/hapus/{id}', 'hapus')->name('nilai-hapus');
                Route::get('/data-nilai/edit/{id}', 'edit')->name('nilai-edit');
                Route::post('/data-nilai/update/{id}', 'update')->name('nilai-update');
                // get daftar siswa untuk tambah dan edit nilai
                Route::get('/get-data-siswa', 'getDataSiswa')->name('get-data-siswa');
            });
        });

        // pengumuman
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(PengumumanController::class)->group(function () {
                Route::get('/pengumuman', 'index')->name('pengumuman-index');
                Route::post('/pengumuman/update/{id}', 'update')->name('pengumuman-update');
            });
        });
        Route::middleware('guru_wali')->group(function () {
            Route::controller(PengumumanController::class)->group(function () {
                Route::get('/pengumuman-for-siswa', 'index_pengumuman_for_siswa')->name('pengumuman-for-siswa-index');
                Route::get('/pengumuman-for-siswa/fetch', 'fetch')->name('pengumuman-for-siswa-fetch');
                Route::post('/pengumuman-for-siswa/update/{id}', 'update_pengumuman_for_siswa')->name('pengumuman-for-siswa-update');
            });
        });

        // sambutan kepala madrasah
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(SambutanKepalaMadrasahController::class)->group(function () {
                Route::get('/data-sambutan-kepala-madrasah', 'index')->name('sambutan-kepala-madrasah-index');
                Route::get('/data-sambutan-kepala-madrasah/fetch', 'fetch')->name('sambutan-kepala-madrasah-fetch');
                Route::post('/data-sambutan-kepala-madrasah/update/{id}', 'update')->name('sambutan-kepala-madrasah-update');
            });
        });

        // profil sekolah
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(ProfilSekolahController::class)->group(function () {
                Route::get('/profil-sekolah', 'index')->name('profil-sekolah-index');
                Route::post('/profil-sekolah/update/{id}', 'update')->name('profil-sekolah-update');
                Route::get('/profil-sekolah/fetch', 'fetch')->name('profil-sekolah-fetch');
            });
        });

        // sarana prasarana
        Route::middleware('admin')->group(function () {
            Route::controller(SaranaPrasaranaController::class)->group(function () {
                Route::get('/data-sarana-prasarana/tambah', 'tambah')->name('sarana-prasarana-tambah');
                Route::post('/data-sarana-prasarana/simpan', 'simpan')->name('sarana-prasarana-simpan');
                Route::get('/data-sarana-prasarana/edit/{id}', 'edit')->name('sarana-prasarana-edit');
                Route::post('/data-sarana-prasarana/update/{id}', 'update')->name('sarana-prasarana-update');
                Route::get('/data-sarana-prasarana/hapus/{id}', 'hapus')->name('sarana-prasarana-hapus');
            });
        });
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(SaranaPrasaranaController::class)->group(function () {
                Route::get('/data-sarana-prasarana', 'index')->name('sarana-prasarana-index');
                Route::get('/data-sarana-prasarana/fetch', 'fetch')->name('sarana-prasarana-fetch');
            });
        });

        // blog category
        Route::middleware('admin')->group(function () {
            Route::controller(BlogCategoryController::class)->group(function () {
                Route::get('/blog-category/tambah', 'tambah')->name('blog-category-tambah');
                Route::post('/blog-category/simpan', 'simpan')->name('blog-category-simpan');
                Route::get('/blog-category/hapus/{id}', 'hapus')->name('blog-category-hapus');
                Route::get('/blog-category/edit/{id}', 'edit')->name('blog-category-edit');
                Route::post('/blog-category/update/{id}', 'update')->name('blog-category-update');
            });
        });
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(BlogCategoryController::class)->group(function () {
                Route::get('/blog-category', 'index')->name('blog-category-index');
                Route::get('/blog-category/fetch', 'fetch')->name('blog-category-fetch');
            });
        });

        // prestasi siswa
        Route::middleware('admin_or_guru_wali')->group(function () {
            Route::controller(PrestasiSiswaController::class)->group(function () {
                Route::get('/prestasi-siswa/tambah', 'tambah')->name('prestasi-siswa-tambah');
                Route::post('/prestasi-siswa/simpan', 'simpan')->name('prestasi-siswa-simpan');
                Route::get('/prestasi-siswa/edit/{id}', 'edit')->name('prestasi-siswa-edit');
                Route::post('/prestasi-siswa/update/{id}', 'update')->name('prestasi-siswa-update');
                Route::get('/prestasi-siswa/hapus/{id}', 'hapus')->name('prestasi-siswa-hapus');
            });
        });
        Route::middleware('admin_or_kepala_madrasah_or_guru_wali')->group(function () {
            Route::controller(PrestasiSiswaController::class)->group(function () {
                Route::get('/prestasi-siswa', 'index')->name('prestasi-siswa');
                Route::get('/prestasi-siswa/fetch', 'fetch')->name('prestasi-siswa-fetch');
            });
        });

        // blog
        Route::middleware('admin_or_kepala_madrasah_or_guru_wali_kelas_or_guru_mata_pelajaran')->group(function () {
            Route::controller(BlogController::class)->group(function () {
                Route::get('/blog/all', 'index_all')->name('blog-all-index');
                Route::get('/blog/filter', 'filter_blog')->name('blog-filter');
                Route::get('/blog/tambah', 'tambah')->name('blog-tambah');
                Route::post('/blog/simpan/{id}', 'simpan')->name('blog-simpan');
                Route::get('/blog/edit/{id}', 'edit')->name('blog-edit');
                Route::post('/blog/update/{id}', 'update')->name('blog-update');
                Route::get('/blog/hapus/{id}', 'hapus')->name('blog-hapus');
            });
        });

        // kontak
        Route::middleware('admin')->group(function () {
            Route::controller(KontakController::class)->group(function () {
                Route::get('/kontak/balas/{id}', 'balas')->name('kontak-balas');
                Route::get('/kontak/ganti/status/{id}', 'ganti_status')->name('kontak-ganti-status');
                Route::get('/kontak/hapus/{id}', 'hapus')->name('kontak-hapus');
            });
        });

        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(KontakController::class)->group(function () {
                Route::get('/data-kontak', 'index_be')->name('kontak-index-be');
                Route::get('/data-kontak/fetch', 'fetch')->name('kontak-fetch');
                Route::get('/data-kontak/filter', 'filter')->name('kontak-filter');
            });
        });

        // jam pelajaran
        Route::middleware('admin')->group(function () {
            Route::controller(JamPelajaranController::class)->group(function () {
                Route::get('/data-jam-pelajaran/tambah', 'create_jam_pelajaran')->name('jam-pelajaran-tambah');
                Route::get('/data-jam-istirahat/tambah', 'create_jam_istirahat')->name('jam-istirahat-tambah');
                // tambah rout simpan jam
                Route::post('/data-jam/simpan', 'store_jam')->name('jam-simpan');
                Route::get('/data-jam/edit/{id}', 'edit')->name('jam-edit');
                Route::get('/data-jam/hapus/{id}', 'destroy')->name('jam-hapus');
                Route::post('/data-jam/update/{id}', 'update')->name('jam-update');
            });
        });
        Route::middleware('kepala_madrasah_or_admin')->group(function () {
            Route::controller(JamPelajaranController::class)->group(function () {
                Route::get('/data-jam', 'index')->name('jam-index');
                Route::get('/data-jam-pelajaran', 'index_jam_pelajaran')->name('jam-pelajaran-index');
                Route::get('/data-jam-istirahat', 'index_jam_istirahat')->name('jam-istirahat-index');
                // tambah route fetch all jam
                Route::get('/data-jam/fetch', 'fetch_jam')->name('jam-fetch');
                // tambah route fetch jam pelajaran
                Route::get('/data-jam-pelajaran/fetch', 'fetch_jam_pelajaran')->name('jam-pelajaran-fetch');
                // tambah route fetch jam istirahat
                Route::get('/data-jam-istirahat/fetch', 'fetch_jam_istirahat')->name('jam-istirahat-fetch');
                // route filter jam
                Route::get('/data-jam/filter', 'filter_jam')->name('jam-filter');
            });
        });
    });
}); // prevent back button after logout

// sambutan front routes
Route::controller(SambutanKepalaMadrasahController::class)->group(function () {
    Route::get('/sambutan-kepala-madrasah', 'index_fe')->name('sambutan-kepala-madrasah-index-fe');
});

// sarana prasarana front routes
Route::controller(SaranaPrasaranaController::class)->group(function () {
    Route::get('/sarana-prasarana', 'index_fe')->name('sarana-prasarana-index-fe');
});

// blog front routes
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog-details/{id}', 'blog_single')->name('blog-single');
    Route::get('/blog-by-category/{id}', 'blog_by_category')->name('blog-by-category');
    // blog uncategorized
    Route::get('/blog-uncategorized', 'blog_uncategorized')->name('blog-uncategorized');
    Route::get('/all-blog', 'blog_all')->name('blog-all');
    Route::get('/all-blog/search', 'search')->name('blog-search');
});

// kontak front routes
Route::controller(KontakController::class)->group(function () {
    Route::get('/kontak', 'index')->name('kontak-index');
    Route::post('/kontak/simpan', 'simpan')->name('kontak-simpan');
});

// user front routes
Route::controller(UserController::class)->group(function () {
    Route::get('/guru', 'index_guru_fe')->name('guru-index-fe');
});

// ekstrakurikuler front routes
Route::controller(EkstrakurikulerController::class)->group(function () {
    Route::get('/ekstrakurikuler', 'index_fe')->name('ekstra-index-fe');
});

// home slider front routes
Route::controller(HomeSliderController::class)->group(function () {
    Route::get('/', 'Home')->name('home');
});
