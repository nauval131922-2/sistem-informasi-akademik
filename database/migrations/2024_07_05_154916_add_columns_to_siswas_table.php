<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // tambah kolom nisn, nis lokal, nik
            $table->string('nisn')->nullable();
            $table->string('nis_lokal')->nullable();
            $table->string('nik')->nullable();
            // tambah kolom jumlah saudara, cita-cita, hobi
            $table->string('jumlah_saudara')->nullable();
            $table->string('cita_cita')->nullable();
            $table->string('hobi')->nullable();
            // ubah tipe data alamat dari varchar ke text
            // $table->text('alamat')->nullable();
            // tambah kolom jarak rumah, nomor kk, nomo kip
            $table->string('jarak_rumah')->nullable();
            $table->string('nomor_kk')->nullable();
            $table->string('nomor_kip')->nullable();
            // tambah kolom jenjang sebelumnya, jenis mutasi
            $table->string('jenjang_sebelumnya')->nullable();
            $table->string('jenis_mutasi')->nullable();
            // tambah kolom nama sekolah pra sekolah, nama sekolah mutasi
            $table->string('sekolah_pra_sekolah')->nullable();
            $table->string('sekolah_mutasi')->nullable();
            // tambah kolom npsn pra sekolah, npsn mutasi
            $table->string('npsn_pra_sekolah')->nullable();
            $table->string('npsn_mutasi')->nullable();
            // tambah kolom nism pra sekolah, nism mutasi
            $table->string('nism_pra_sekolah')->nullable();
            $table->string('nism_mutasi')->nullable();
            // tambah kolom nomor ijazah, tanggal mutasi
            $table->string('nomor_ijazah')->nullable();
            $table->date('tanggal_mutasi')->nullable();
            // tambah kolom ayah kandung, ibu kandung
            $table->string('ayah_kandung')->nullable();
            $table->string('ibu_kandung')->nullable();
            // tambah kolom status ayah, status ibu
            $table->string('status_ayah')->nullable();
            $table->string('status_ibu')->nullable();
            // tambah kolom nik ayah, nik ibu
            $table->string('nik_ayah')->nullable();
            $table->string('nik_ibu')->nullable();
            // tambah kolom tempat lahir ayah, tempat lahir ibu
            $table->string('tempat_lahir_ayah')->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            // tambah kolom tanggal lahir ayah, tanggal lahir ibu
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            // tambah kolom pendidikan terakhir ayah, pendidikan terakhir ibu
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            // tambah kolom pekerjaan ayah, pekerjaan ibu
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            // tambah kolom nomor kks, nomor pkh
            $table->string('nomor_kks')->nullable();
            $table->string('nomor_pkh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // hapus kolom nisn, nis lokal, nik
            $table->dropColumn('nisn');
            $table->dropColumn('nis_lokal');
            $table->dropColumn('nik');
            // hapus kolom jumlah saudara, cita-cita, hobi
            $table->dropColumn('jumlah_saudara');
            $table->dropColumn('cita_cita');
            $table->dropColumn('hobi');
            // ubah tipe data alamat dari text ke varchar
            $table->string('alamat', 255)->change();
            // hapus kolom jarak rumah, nomor kk, nomo kip
            $table->dropColumn('jarak_rumah');
            $table->dropColumn('nomor_kk');
            $table->dropColumn('nomor_kip');
            // hapus kolom jenjang sebelumnya, jenis mutasi
            $table->dropColumn('jenjang_sebelumnya');
            $table->dropColumn('jenis_mutasi');
            // hapus kolom nama sekolah pra sekolah, nama sekolah mutasi
            $table->dropColumn('sekolah_pra_sekolah');
            $table->dropColumn('sekolah_mutasi');
            // hapus kolom npsn pra sekolah, npsn mutasi
            $table->dropColumn('npsn_pra_sekolah');
            $table->dropColumn('npsn_mutasi');
            // hapus kolom nism pra sekolah, nism mutasi
            $table->dropColumn('nism_pra_sekolah');
            $table->dropColumn('nism_mutasi');
            // hapus kolom nomor ijazah, tanggal mutasi
            $table->dropColumn('nomor_ijazah');
            $table->dropColumn('tanggal_mutasi');
            // hapus kolom ayah kandung, ibu kandung
            $table->dropColumn('ayah_kandung');
            $table->dropColumn('ibu_kandung');
            // hapus kolom status ayah, status ibu
            $table->dropColumn('status_ayah');
            $table->dropColumn('status_ibu');
            // hapus kolom nik ayah, nik ibu
            $table->dropColumn('nik_ayah');
            $table->dropColumn('nik_ibu');
            // hapus kolom tempat lahir ayah, tempat lahir ibu
            $table->dropColumn('tempat_lahir_ayah');
            $table->dropColumn('tempat_lahir_ibu');
            // hapus kolom tanggal lahir ayah, tanggal lahir ibu
            $table->dropColumn('tanggal_lahir_ayah');
            $table->dropColumn('tanggal_lahir_ibu');
            // hapus kolom pendidikan terakhir ayah, pendidikan terakhir ibu
            $table->dropColumn('pendidikan_ayah');
            $table->dropColumn('pendidikan_ibu');
            // hapus kolom pekerjaan ayah, pekerjaan ibu
            $table->dropColumn('pekerjaan_ayah');
            $table->dropColumn('pekerjaan_ibu');
            // hapus kolom nomor kks, nomor pkh
            $table->dropColumn('nomor_kks');
            $table->dropColumn('nomor_pkh');
        });
    }
};
