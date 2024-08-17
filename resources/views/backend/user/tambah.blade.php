<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">


            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk menambah {{ $title }}. <small class="text-danger">* Harus diisi</small></p>
            <form enctype="multipart/form-data" id="formTambahData" method="POST">
                @csrf

                @if ($id_role == '5')
                    <div class="row mb-3">
                        <label for="nama" class="col-lg-1 col-form-label col-sm-2">Nama <span class="text-danger">*</span></label>
                        <div class="col-lg-11 col-sm-10">
                            <input class="form-control" type="text" placeholder="Masukkan nama" id="nama"
                                name="nama" value="{{ old('nama') }}" required>
                            <div class="mt-2">
                                <span class="text-danger error-text nama_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="username" class="col-sm-2 col-form-label">Username <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan username"
                                        id="username" name="username" value="{{ old('username') }}" required>
                                    <div class="mt-2">
                                        <span class="text-danger error-text username_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan email"
                                        id="email" name="email" value="{{ old('email') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text email_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="password" class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" placeholder="Masukkan password"
                                        id="password" name="password" required>
                                    <div class="mt-2">
                                        <span class="text-danger error-text password_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" placeholder="Masukkan ulang password"
                                        id="confirm_password" name="confirm_password" required>
                                    <div class="mt-2">
                                        <span class="text-danger error-text confirm_password_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" id="kelass">
                        <label for="kelas" class="col-lg-1 col-form-label col-sm-2">Kelas <span class="text-danger">*</span></label>
                        <div class="col-lg-11 col-sm-10">
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($semua_kelas as $kelas)
                                    @if (old('kelas') == $kelas->id)
                                        <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}
                                        </option>
                                    @else
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <span class="text-danger error-text kelas_error"></span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Masukkan nama" id="nama"
                                name="nama" value="{{ old('nama') }}" required>
                            <div class="mt-2">
                                <span class="text-danger error-text nama_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Masukkkan username"
                                id="username" name="username" value="{{ old('username') }}" required>
                            <div class="mt-2">
                                <span class="text-danger error-text username_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Masukkkan email" id="email"
                                name="email" value="{{ old('email') }}">
                            <div class="mt-2">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" placeholder="Masukkan password"
                                id="password" name="password" required>
                            <div class="mt-2">
                                <span class="text-danger error-text password_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" placeholder="Masukkan ulang password"
                                id="confirm_password" name="confirm_password" required>
                            <div class="mt-2">
                                <span class="text-danger error-text confirm_password_error"></span>
                            </div>
                        </div>
                    </div>
                    @if ($id_role == '3')
                        <div class="row mb-3" id="kelass">
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" id="kelas" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($semua_kelas as $kelas)
                                        @if (old('kelas') == $kelas->id)
                                            <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}
                                            </option>
                                        @else
                                            <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    <span class="text-danger error-text kelas_error"></span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif


                @if ($id_role == '5')
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NISN"
                                        id="nisn" name="nisn" value="{{ old('nisn') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nisn_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="nis_lokal" class="col-sm-2 col-form-label">NIS Lokal <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NIS Lokal"
                                        id="nis_lokal" name="nis_lokal" value="{{ old('nis_lokal') }}" required>
                                    <div class="mt-2">
                                        <span class="text-danger error-text nis_lokal_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nik" class="col-lg-1 col-form-label col-sm-2">NIK</label>
                        <div class="col-lg-11 col-sm-10">
                            <input class="form-control" type="text" placeholder="Masukkkan NIK" id="nik"
                                name="nik" value="{{ old('nik') }}">
                            <div class="mt-2">
                                <span class="text-danger error-text nik_error"></span>
                            </div>
                        </div>
                    </div>




                    <div class="row mb-3">
                        <div class="col-lg-6">

                            <div class="row mb-3">
                                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        @foreach ($semua_jenis_kelamin as $jenis_kelamin)
                                            @if (old('jenis_kelamin') == $jenis_kelamin)
                                                <option value="{{ $jenis_kelamin }}" selected>
                                                    {{ $jenis_kelamin }}
                                                </option>
                                            @else
                                                <option value="{{ $jenis_kelamin }}">{{ $jenis_kelamin }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text jenis_kelamin_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan agama"
                                        id="agama" name="agama" value="{{ old('agama') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text agama_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="status_dalam_keluarga" class="col-sm-2 col-form-label">Status dalam Keluarga</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan status_dalam_keluarga"
                                        id="status_dalam_keluarga" name="status_dalam_keluarga" value="{{ old('status_dalam_keluarga') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text status_dalam_keluarga_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="anak_ke" class="col-sm-2 col-form-label">Anak ke</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan anak_ke"
                                        id="anak_ke" name="anak_ke" value="{{ old('anak_ke') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text anak_ke_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan Tempat Lahir"
                                        id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text tempat_lahir_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" placeholder="Masukkkan Tanggal Lahir"
                                        id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text tanggal_lahir_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Masukkan Alamat" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                                    <div class="mt-2">
                                        <span class="text-danger error-text alamat_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_hp" class="col-sm-2 col-form-label">Nomor HP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nomor HP"
                                        id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_hp_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" placeholder="Masukkkan tanggal masuk"
                                        id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text tanggal_masuk_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="diterima_di_kelas" class="col-sm-2 col-form-label">Diterima di
                                    kelas</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="diterima_di_kelas" name="diterima_di_kelas">
                                        <option value="">Pilih diterima di kelas</option>
                                        @foreach ($semua_kelas as $kelas)
                                            @if (old('diterima_di_kelas') == $kelas->id)
                                                <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}
                                                </option>
                                            @else
                                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text kelas_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="row mb-3">
                                <label for="jumlah_saudara" class="col-sm-2 col-form-label">Jumlah Saudara</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" placeholder="Masukkkan Jumlah Saudara"
                                        id="jumlah_saudara" name="jumlah_saudara"
                                        value="{{ old('jumlah_saudara') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text jumlah_saudara_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cita_cita" class="col-sm-2 col-form-label">Cita-cita</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="cita_cita" name="cita_cita">
                                        <option value="">Pilih Cita-cita</option>
                                        @foreach ($semua_cita_cita as $cita_cita)
                                            @if (old('cita_cita') == $cita_cita->id)
                                                <option value="{{ $cita_cita->id }}" selected>
                                                    {{ $cita_cita->cita_cita }}
                                                </option>
                                            @else
                                                <option value="{{ $cita_cita->id }}">{{ $cita_cita->cita_cita }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text cita_cita_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="hobi" class="col-sm-2 col-form-label">Hobi</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="hobi" name="hobi">
                                        <option value="">Pilih Hobi</option>
                                        @foreach ($semua_hobi as $hobi)
                                            @if (old('hobi') == $hobi->id)
                                                <option value="{{ $hobi->id }}" selected>{{ $hobi->hobi }}
                                                </option>
                                            @else
                                                <option value="{{ $hobi->id }}">{{ $hobi->hobi }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text hobi_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jarak_rumah" class="col-sm-2 col-form-label">Jarak
                                    Rumah-Madrasah</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text"
                                        placeholder="Masukkkan jarak rumah-madrasah" id="jarak_rumah"
                                        name="jarak_rumah" value="{{ old('jarak_rumah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text jarak_rumah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_kk" class="col-sm-2 col-form-label">Nomor KK</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nomor KK"
                                        id="nomor_kk" name="nomor_kk" value="{{ old('nomor_kk') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_kk_error"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="nomor_kip" class="col-sm-2 col-form-label">Nomor KIP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nomor KIP"
                                        id="nomor_kip" name="nomor_kip" value="{{ old('nomor_kip') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_kip_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="col-form-label">PRA SEKOLAH</label>
                            <hr style="margin-top: -5px;">

                            <div class="row mb-3">
                                <label for="jenjang_sebelumnya" class="col-sm-2 col-form-label">Jenjang
                                    Sebelumnya</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="jenjang_sebelumnya" name="jenjang_sebelumnya">
                                        <option value="">Pilih jenjang sebelumnya</option>
                                        @foreach ($semua_jenjang_sebelumnya as $jenjang_sebelumnya)
                                            @if (old('jenjang_sebelumnya') == $jenjang_sebelumnya)
                                                <option value="{{ $jenjang_sebelumnya }}" selected>
                                                    {{ $jenjang_sebelumnya }}
                                                </option>
                                            @else
                                                <option value="{{ $jenjang_sebelumnya }}">{{ $jenjang_sebelumnya }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text jenjang_sebelumnya_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sekolah_pra_sekolah" class="col-sm-2 col-form-label">Nama
                                    Sekolah</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nama sekolah"
                                        id="sekolah_pra_sekolah" name="sekolah_pra_sekolah"
                                        value="{{ old('sekolah_pra_sekolah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text sekolah_pra_sekolah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="npsn_pra_sekolah" class="col-sm-2 col-form-label">NPSN</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NPSN"
                                        id="npsn_pra_sekolah" name="npsn_pra_sekolah"
                                        value="{{ old('npsn_pra_sekolah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text npsn_pra_sekolah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nism_pra_sekolah" class="col-sm-2 col-form-label">NISM</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NISM"
                                        id="nism_pra_sekolah" name="nism_pra_sekolah"
                                        value="{{ old('nism_pra_sekolah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nism_pra_sekolah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_ijazah" class="col-sm-2 col-form-label">No. Ijazah</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan no. ijazah"
                                        id="nomor_ijazah" name="nomor_ijazah" value="{{ old('nomor_ijazah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_ijazah_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">MUTASI/KELULUSAN</label>
                            <hr style="margin-top: -5px;">

                            <div class="row mb-3">
                                <label for="jenis_mutasi" class="col-sm-2 col-form-label">Jenis Mutasi</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="jenis_mutasi" name="jenis_mutasi">
                                        <option value="">Pilih jenis mutasi</option>
                                        @foreach ($semua_jenis_mutasi as $jenis_mutasi)
                                            @if (old('jenis_mutasi') == $jenis_mutasi)
                                                <option value="{{ $jenis_mutasi }}" selected>{{ $jenis_mutasi }}
                                                </option>
                                            @else
                                                <option value="{{ $jenis_mutasi }}">{{ $jenis_mutasi }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text jenis_mutasi_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sekolah_mutasi" class="col-sm-2 col-form-label">Nama Sekolah</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nama sekolah"
                                        id="sekolah_mutasi" name="sekolah_mutasi"
                                        value="{{ old('sekolah_mutasi') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text sekolah_mutasi_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="npsn_mutasi" class="col-sm-2 col-form-label">NPSN</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NPSN"
                                        id="npsn_mutasi" name="npsn_mutasi" value="{{ old('npsn_mutasi') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text npsn_mutasi_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nism_mutasi" class="col-sm-2 col-form-label">NISM</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NISM"
                                        id="nism_mutasi" name="nism_mutasi" value="{{ old('nism_mutasi') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nism_mutasi_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_mutasi" class="col-sm-2 col-form-label">Tanggal Mutasi</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" placeholder="Masukkkan tanggal mutasi"
                                        id="tanggal_mutasi" name="tanggal_mutasi"
                                        value="{{ old('tanggal_mutasi') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text tanggal_mutasi_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">

                            <label class="col-form-label">DATA AYAH</label>
                            <hr style="margin-top: -5px;">

                            <div class="row mb-3">
                                <label for="ayah_kandung" class="col-sm-2 col-form-label">Ayah Kandung</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan ayah kandung"
                                        id="ayah_kandung" name="ayah_kandung" value="{{ old('ayah_kandung') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text ayah_kandung_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="status_ayah" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="status_ayah" name="status_ayah">
                                        <option value="">Pilih status</option>
                                        @foreach ($semua_status as $status_ayah)
                                            @if (old('status_ayah') == $status_ayah)
                                                <option value="{{ $status_ayah }}" selected>{{ $status_ayah }}
                                                </option>
                                            @else
                                                <option value="{{ $status_ayah }}">{{ $status_ayah }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text status_ayah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nik_ayah" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NIK"
                                        id="nik_ayah" name="nik_ayah" value="{{ old('nik_ayah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nik_ayah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tempat_lahir_ayah" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan Tempat Lahir"
                                        id="tempat_lahir_ayah" name="tempat_lahir_ayah"
                                        value="{{ old('tempat_lahir_ayah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text tempat_lahir_ayah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_lahir_ayah" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" placeholder="Masukkkan Tanggal Lahir"
                                        id="tanggal_lahir_ayah" name="tanggal_lahir_ayah"
                                        value="{{ old('tanggal_lahir_ayah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text tanggal_lahir_ayah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pendidikan_ayah" class="col-sm-2 col-form-label">Pendidikan
                                    terakhir</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="pendidikan_ayah" name="pendidikan_ayah">
                                        <option value="">Pilih pendidikan terakhir</option>
                                        @foreach ($semua_pendidikan_terakhir as $pendidikan_ayah)
                                            @if (old('pendidikan_ayah') == $pendidikan_ayah)
                                                <option value="{{ $pendidikan_ayah }}" selected>
                                                    {{ $pendidikan_ayah }}
                                                </option>
                                            @else
                                                <option value="{{ $pendidikan_ayah }}">
                                                    {{ $pendidikan_ayah }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text pendidikan_ayah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pekerjaan_ayah" class="col-sm-2 col-form-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="pekerjaan_ayah" name="pekerjaan_ayah">
                                        <option value="">Pilih pekerjaan</option>
                                        @foreach ($semua_pekerjaan as $pekerjaan_ayah)
                                            @if (old('pekerjaan_ayah') == $pekerjaan_ayah->id)
                                                <option value="{{ $pekerjaan_ayah->id }}" selected>
                                                    {{ $pekerjaan_ayah->pekerjaan }}
                                                </option>
                                            @else
                                                <option value="{{ $pekerjaan_ayah->id }}">
                                                    {{ $pekerjaan_ayah->pekerjaan }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text pekerjaan_ayah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_telepon_ayah" class="col-sm-2 col-form-label">No. Telepon</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan No. Telepon"
                                        id="nomor_telepon_ayah" name="nomor_telepon_ayah"
                                        value="{{ old('nomor_telepon_ayah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_telepon_ayah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat_ayah" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Masukkan alamat_ayah" id="alamat_ayah" name="alamat_ayah" rows="3">{{ old('alamat_ayah') }}</textarea>
                                    <div class="mt-2">
                                        <span class="text-danger error-text alamat_ayah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="no_kks" class="col-sm-2 col-form-label">No. KKS</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nomor KKS"
                                        id="nomor_kks" name="nomor_kks" value="{{ old('nomor_kks') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_kks_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">


                            <label class="col-form-label">DATA IBU</label>
                            <hr style="margin-top: -5px;">

                            <div class="row mb-3">
                                <label for="ibu_kandung" class="col-sm-2 col-form-label">Ibu Kandung</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan ibu kandung"
                                        id="ibu_kandung" name="ibu_kandung" value="{{ old('ibu_kandung') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text ibu_kandung_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="status_ibu" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="status_ibu" name="status_ibu">
                                        <option value="">Pilih status</option>
                                        @foreach ($semua_status as $status_ibu)
                                            @if (old('status_ibu') == $status_ibu)
                                                <option value="{{ $status_ibu }}" selected>{{ $status_ibu }}
                                                </option>
                                            @else
                                                <option value="{{ $status_ibu }}">{{ $status_ibu }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text status_ibu_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nik_ibu" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NIK"
                                        id="nik_ibu" name="nik_ibu" value="{{ old('nik_ibu') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nik_ibu_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tempat_lahir_ibu" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan Tempat Lahir"
                                        id="tempat_lahir_ibu" name="tempat_lahir_ibu"
                                        value="{{ old('tempat_lahir_ibu') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text tempat_lahir_ibu_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_lahir_ibu" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" placeholder="Masukkkan Tanggal Lahir"
                                        id="tanggal_lahir_ibu" name="tanggal_lahir_ibu"
                                        value="{{ old('tanggal_lahir_ibu') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text tanggal_lahir_ibu_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pendidikan_ibu" class="col-sm-2 col-form-label">Pendidikan
                                    terakhir</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="pendidikan_ibu" name="pendidikan_ibu">
                                        <option value="">Pilih pendidikan terakhir</option>
                                        @foreach ($semua_pendidikan_terakhir as $pendidikan_ibu)
                                            @if (old('pendidikan_ibu') == $pendidikan_ibu)
                                                <option value="{{ $pendidikan_ibu }}" selected>
                                                    {{ $pendidikan_ibu }}
                                                </option>
                                            @else
                                                <option value="{{ $pendidikan_ibu }}">
                                                    {{ $pendidikan_ibu }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text pendidikan_ibu_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pekerjaan_ibu" class="col-sm-2 col-form-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="pekerjaan_ibu" name="pekerjaan_ibu">
                                        <option value="">Pilih pekerjaan</option>
                                        @foreach ($semua_pekerjaan as $pekerjaan_ibu)
                                            @if (old('pekerjaan_ibu') == $pekerjaan_ibu->id)
                                                <option value="{{ $pekerjaan_ibu->id }}" selected>
                                                    {{ $pekerjaan_ibu->pekerjaan }}
                                                </option>
                                            @else
                                                <option value="{{ $pekerjaan_ibu->id }}">
                                                    {{ $pekerjaan_ibu->pekerjaan }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text pekerjaan_ibu_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_telepon_ibu" class="col-sm-2 col-form-label">No. Telepon</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan No. Telepon"
                                        id="nomor_telepon_ibu" name="nomor_telepon_ibu"
                                        value="{{ old('nomor_telepon_ibu') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_telepon_ibu_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat_ibu" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Masukkan alamat_ibu" id="alamat_ibu" name="alamat_ibu" rows="3">{{ old('alamat_ibu') }}</textarea>
                                    <div class="mt-2">
                                        <span class="text-danger error-text alamat_ibu_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="no_pkh" class="col-sm-2 col-form-label">No. PKH</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nomor PKH"
                                        id="nomor_pkh" name="nomor_pkh" value="{{ old('nomor_pkh') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_pkh_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">

                            <label class="col-form-label">DATA WALI</label>
                            <hr style="margin-top: -5px;">

                            <div class="row mb-3">
                                <label for="nama_wali" class="col-sm-2 col-form-label">Nama Wali</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nama wali"
                                        id="nama_wali" name="nama_wali" value="{{ old('nama_wali') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nama_wali_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pekerjaan_wali" class="col-sm-2 col-form-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="pekerjaan_wali" name="pekerjaan_wali">
                                        <option value="">Pilih pekerjaan</option>
                                        @foreach ($semua_pekerjaan as $pekerjaan_wali)
                                            @if (old('pekerjaan_wali') == $pekerjaan_wali->id)
                                                <option value="{{ $pekerjaan_wali->id }}" selected>
                                                    {{ $pekerjaan_wali->pekerjaan }}
                                                </option>
                                            @else
                                                <option value="{{ $pekerjaan_wali->id }}">
                                                    {{ $pekerjaan_wali->pekerjaan }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        <span class="text-danger error-text pekerjaan_wali_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_telepon_wali" class="col-sm-2 col-form-label">No. Telepon</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan No. Telepon"
                                        id="nomor_telepon_wali" name="nomor_telepon_wali"
                                        value="{{ old('nomor_telepon_wali') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_telepon_wali_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat_wali" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Masukkan alamat_wali" id="alamat_wali" name="alamat_wali" rows="3">{{ old('alamat_wali') }}</textarea>
                                    <div class="mt-2">
                                        <span class="text-danger error-text alamat_wali_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($id_role == '4')
                    <div class="row mb-3" id="mapell">
                        <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-select" id="mapel" name="mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($semua_mapel as $mapel)
                                    @if (old('mapel') == $mapel->id)
                                        <option value="{{ $mapel->id }}" selected>
                                            {{ $mapel->mata_pelajaran }}</option>
                                    @else
                                        <option value="{{ $mapel->id }}">{{ $mapel->mata_pelajaran }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <span class="text-danger error-text mapel_error"></span>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($id_role == '5')
                    <div class="row mb-3">

                        <div class="col-lg-6">
                            <div class="row mb-3">
                                <label for="ijazah" class="col-lg-2 col-sm-2 col-form-label">Ijazah</label>
                                <div class="col-lg-10 col-sm-10">
                                    <div class="input-group">
                                        <input class="form-control" type="file" id="ijazah" name="ijazah"
                                            accept="image/*">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="inputGroupFileAddon04" onclick="clearFileIjazah()">
                                            <i class="ri-delete-bin-7-line align-middle me-1"></i>
                                            <span style="vertical-align: middle">Clear Image</span>
                                        </button>
                                        <div class="mt-2">
                                            <span class="text-danger error-text ijazah_error"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="showIjazah" class="col-lg-2 col-sm-2 col-form-label"></label>
                                <div class="col-lg-10 col-sm-10">
                                    <img src="" alt="" class="img-thumbnail" width="200"
                                        id="showIjazah">
                                    <input type="hidden" value="" id="ijazahPreview" name="ijazahPreview">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row mb-3">
                                <label for="gambar" class="col-lg-2 col-sm-2 col-form-label">Foto Profil</label>
                                <div class="col-lg-10 col-sm-10">
                                    <div class="input-group">
                                        <input class="form-control" type="file" id="gambar" name="gambar"
                                            accept="image/*">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="inputGroupFileAddon04" onclick="clearFile()">
                                            <i class="ri-delete-bin-7-line align-middle me-1"></i>
                                            <span style="vertical-align: middle">Clear Image</span>
                                        </button>
                                        <div class="mt-2">
                                            <span class="text-danger error-text gambar_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <label for="showImage" class="col-lg-2 col-sm-2 col-form-label"></label>
                                <div class="col-lg-10 col-sm-10">
                                    <img src="" alt="" class="img-thumbnail" width="200"
                                        id="showImage">
                                    <input type="hidden" value="" id="gambarPreview" name="gambarPreview">
                                </div>
                            </div>
                            {{-- <div class="row mb-3"> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                @else
                    <div class="row mb-3">

                        <label for="gambar" class="col-sm-2 col-form-label">Foto Profil</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="file" id="gambar" name="gambar"
                                    accept="image/*">
                                <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04"
                                    onclick="clearFile()">
                                    <i class="ri-delete-bin-7-line align-middle me-1"></i>
                                    <span style="vertical-align: middle">Clear Image</span>
                                </button>
                                <div class="mt-2">
                                    <span class="text-danger error-text gambar_error"></span>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row mb-3">
                        <label for="showImage" class="col-lg-2 col-sm-2 col-form-label"></label>
                        <div class="col-lg-10 col-sm-10">
                            <img src="" alt="" class="img-thumbnail" width="200" id="showImage">
                            <input type="hidden" value="" id="gambarPreview" name="gambarPreview">
                        </div>
                    </div>
                @endif



                {{-- tambah id role --}}
                <input type="hidden" name="id_role" value="{{ $id_role }}" id="id_role">



                <button type="submit" class="btn btn-info waves-effect waves-light">
                    <i class="ri-save-3-line align-middle me-1"></i>
                    <span style="vertical-align: middle">Simpan</span>
                </button>
            </form>

        </div>
    </div>
</div> <!-- end col -->

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $('#gambar').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });
    $('#ijazah').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showIjazah').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    function clearFile() {
        $('#gambar').val('');
        $('#showImage').attr('src', '');
        $('#gambarPreview').val('');
    }

    function clearFileIjazah() {
        $('#ijazah').val('');
        $('#showIjazah').attr('src', '');
        $('#ijazahPreview').val('');
    }

    // insert data
    $('#formTambahData').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData($('#formTambahData')[0]);

        $.ajax({
            url: '/data-user/simpan/' + $('#id_role').val(),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(response) {

                if (response.status == 'error') {
                    $.each(response.message, function(prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else if (response.status == 'error2') {
                    toastr.warning(response.message, "", {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
                } else {

                    // toastr success message
                    toastr.success(response.message, "", {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });

                    // reset form
                    $('#formTambahData')[0].reset();

                    // clear image
                    clearFile();

                    // clear image
                    clearFileIjazah();

                    // fetch data
                    filterData();
                }
            }
        })

    })
</script>
