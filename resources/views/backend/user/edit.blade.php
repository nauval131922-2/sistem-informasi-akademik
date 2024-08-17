<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">


            <div class="row">
                <div class="col-auto me-auto">
                    <p class="card-title-desc mb-0">Lengkapi form
                        berikut untuk mengubah {{ $title }}. <small class="text-danger">* Harus diisi</small></p>
                    </p>

                </div>

                {{-- <div class="col-auto mb-2">
                    <div class="dropdown">
                        @if ($id_role == '5')
                            <button class="btn btn-success" onclick="cetakData()" id="btnCetak"
                                style="margin-top: -10px">
                                <i class="ri-printer-line align-middle me-1"></i>
                                <span style="vertical-align: middle">Cetak</span>
                            </button>
                        @endif
                    </div>
                </div> --}}

                <div class="col-auto mb-2">
                    <div class="dropdown">
                        @if ($id_role == '5')
                            <button class="btn btn-success" id="dropdownMenuLink" style="margin-top: -10px"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-printer-line align-middle me-1"></i>
                                <span style="vertical-align: middle">Cetak</span>
                            </button>
                        @endif

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><button class="dropdown-item" onclick="cetakData()" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalScrollable">Riwayat Pendidikan Siswa</button></li>
                            <li><button class="dropdown-item" onclick="cetakRapor()" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalScrollable">Rapor Semester</button></li>
                        </ul>
                    </div>
                </div>

            </div>

            <hr style="margin: 0 0 1rem 0">

            <form enctype="multipart/form-data" id="formUbahData" method="POST">
                @csrf

                @if ($id_role == '5')
                    <div class="row mb-3">
                        <label for="nama" class="col-lg-1 col-form-label col-sm-2">Nama <span
                                class="text-danger">*</span></label>
                        <div class="col-lg-11 col-sm-10">
                            <input class="form-control" type="text" placeholder="Masukkan nama" id="nama"
                                name="nama" value="{{ $user->name ?? old('nama') }}" required>
                            <div class="mt-2">
                                <span class="text-danger error-text nama_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="username" class="col-sm-2 col-form-label">Username <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan username"
                                        id="username" name="username" value="{{ $user->username ?? old('username') }}"
                                        required>
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
                                        id="email" name="email" value="{{ $user->email ?? old('email') }}">
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
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" placeholder="Masukkan password"
                                        id="password" name="password">
                                    <div class="mt-2">
                                        <span class="text-danger error-text password_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" placeholder="Masukkan ulang password"
                                        id="confirm_password" name="confirm_password">
                                    <div class="mt-2">
                                        <span class="text-danger error-text confirm_password_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" id="kelass">
                        <label for="kelas" class="col-lg-1 col-form-label col-sm-2">Kelas <span
                                class="text-danger">*</span></label>
                        <div class="col-lg-11 col-sm-10">
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($semua_kelas as $kelas)
                                    @if ($user->id_kelas == $kelas->id ?? old('kelas') == $kelas->id)
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
                        <label for="nama" class="col-sm-2 col-form-label">Nama <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Masukkan nama" id="nama"
                                name="nama" value="{{ $user->name ?? old('nama') }}" required>
                            <div class="mt-2">
                                <span class="text-danger error-text nama_error"></span>
                            </div>
                        </div>
                    </div>

                    @if ($id_role == '2')
                        <div class="row mb-3">
                            <label for="nip" class="col-sm-2 col-form-label">NIP <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan NIP" id="nip"
                                    name="nip" value="{{ $user->nip ?? old('nip') }}" required>
                                <div class="mt-2">
                                    <span class="text-danger error-text nip_error"></span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Masukkkan username"
                                id="username" name="username" value="{{ $user->username ?? old('username') }}"
                                required>
                            <div class="mt-2">
                                <span class="text-danger error-text username_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Masukkkan email" id="email"
                                name="email" value="{{ $user->email ?? old('email') }}">
                            <div class="mt-2">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" placeholder="Masukkan password"
                                id="password" name="password">
                            <div class="mt-2">
                                <span class="text-danger error-text password_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" placeholder="Masukkan ulang password"
                                id="confirm_password" name="confirm_password">
                            <div class="mt-2">
                                <span class="text-danger error-text confirm_password_error"></span>
                            </div>
                        </div>
                    </div>
                    @if ($id_role == '3')
                        <div class="row mb-3" id="kelass">
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" id="kelas" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($semua_kelas as $kelas)
                                        @if ($user->id_kelas == $kelas->id ?? old('kelas') == $kelas->id)
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
                                        id="nisn" name="nisn" value="{{ $siswa->nisn ?? old('nisn') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nisn_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="nis_lokal" class="col-sm-2 col-form-label">NIS Lokal <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NIS Lokal"
                                        id="nis_lokal" name="nis_lokal"
                                        value="{{ $siswa->nis_lokal ?? old('nis_lokal') }}" required>
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
                                name="nik" value="{{ $siswa->nik ?? old('nik') }}">
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
                                            @if (
                                                (isset($siswa->jenis_kelamin) && $siswa->jenis_kelamin == $jenis_kelamin) ||
                                                    (!isset($siswa->jenis_kelamin) && old('jenis_kelamin') == $jenis_kelamin))
                                                <option value="{{ $jenis_kelamin }}" selected>{{ $jenis_kelamin }}
                                                </option>
                                            @else
                                                <option value="{{ $jenis_kelamin }}">{{ $jenis_kelamin }}</option>
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
                                        id="agama" name="agama" value="{{ $siswa->agama ?? old('agama') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text agama_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="status_dalam_keluarga" class="col-sm-2 col-form-label">Status dalam
                                    Keluarga</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text"
                                        placeholder="Masukkkan status_dalam_keluarga" id="status_dalam_keluarga"
                                        name="status_dalam_keluarga"
                                        value="{{ $siswa->status_dalam_keluarga ?? old('status_dalam_keluarga') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text status_dalam_keluarga_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="anak_ke" class="col-sm-2 col-form-label">Anak ke</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan anak_ke"
                                        id="anak_ke" name="anak_ke"
                                        value="{{ $siswa->anak_ke ?? old('anak_ke') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text anak_ke_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan Tempat Lahir"
                                        id="tempat_lahir" name="tempat_lahir"
                                        value="{{ $siswa->tempat_lahir ?? old('tempat_lahir') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text tempat_lahir_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" placeholder="Masukkkan Tanggal Lahir"
                                        id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ $siswa->tanggal_lahir ?? old('tanggal_lahir') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text tanggal_lahir_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Masukkan Alamat" id="alamat" name="alamat" rows="3">{{ $siswa->alamat ?? old('alamat') }}</textarea>
                                    <div class="mt-2">
                                        <span class="text-danger error-text alamat_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_hp" class="col-sm-2 col-form-label">Nomor HP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nomor HP"
                                        id="nomor_hp" name="nomor_hp"
                                        value="{{ $siswa->nomor_hp ?? old('nomor_hp') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_hp_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" placeholder="Masukkkan tanggal masuk"
                                        id="tanggal_masuk" name="tanggal_masuk"
                                        value="{{ $siswa->tanggal_masuk ?? old('tanggal_masuk') }}">
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
                                            @if (
                                                (isset($siswa->id_diterima_di_kelas_for_siswa) && $siswa->id_diterima_di_kelas_for_siswa == $kelas->id) ||
                                                    (old('diterima_di_kelas') == $kelas->id && !isset($siswa->id_diterima_di_kelas_for_siswa)))
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
                                        value="{{ $siswa->jumlah_saudara ?? old('jumlah_saudara') }}">
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
                                            @if (
                                                (isset($siswa->id_cita_cita_for_siswa) && $siswa->id_cita_cita_for_siswa == $cita_cita->id) ||
                                                    (!isset($siswa->id_cita_cita_for_siswa) && old('cita_cita') == $cita_cita->id))
                                                <option value="{{ $cita_cita->id }}" selected>
                                                    {{ $cita_cita->cita_cita }}</option>
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
                                            @if (
                                                (isset($siswa->id_hobi_for_siswa) && $siswa->id_hobi_for_siswa == $hobi->id) ||
                                                    (!isset($siswa->id_hobi_for_siswa) && old('hobi') == $hobi->id))
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
                                <label for="jarak_rumah" class="col-sm-2 col-form-label">Jarak Rumah-Madrasah</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text"
                                        placeholder="Masukkkan jarak rumah-madrasah" id="jarak_rumah"
                                        name="jarak_rumah" value="{{ $siswa->jarak_rumah ?? old('jarak_rumah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text jarak_rumah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_kk" class="col-sm-2 col-form-label">Nomor KK</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nomor KK"
                                        id="nomor_kk" name="nomor_kk"
                                        value="{{ $siswa->nomor_kk ?? old('nomor_kk') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_kk_error"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="nomor_kip" class="col-sm-2 col-form-label">Nomor KIP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nomor KIP"
                                        id="nomor_kip" name="nomor_kip"
                                        value="{{ $siswa->nomor_kip ?? old('nomor_kip') }}">
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
                                            @if (
                                                (isset($siswa->jenjang_sebelumnya) && $siswa->jenjang_sebelumnya == $jenjang_sebelumnya) ||
                                                    (!isset($siswa->jenjang_sebelumnya) && old('jenjang_sebelumnya') == $jenjang_sebelumnya))
                                                <option value="{{ $jenjang_sebelumnya }}" selected>
                                                    {{ $jenjang_sebelumnya }}</option>
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
                                        value="{{ $siswa->sekolah_pra_sekolah ?? old('sekolah_pra_sekolah') }}">
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
                                        value="{{ $siswa->npsn_pra_sekolah ?? old('npsn_pra_sekolah') }}">
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
                                        value="{{ $siswa->nism_pra_sekolah ?? old('nism_pra_sekolah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nism_pra_sekolah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_ijazah" class="col-sm-2 col-form-label">No. Ijazah</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan no. ijazah"
                                        id="nomor_ijazah" name="nomor_ijazah"
                                        value="{{ $siswa->nomor_ijazah ?? old('nomor_ijazah') }}">
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
                                            @if (
                                                (isset($siswa->jenis_mutasi) && $siswa->jenis_mutasi == $jenis_mutasi) ||
                                                    (!isset($siswa->jenis_mutasi) && old('jenis_mutasi') == $jenis_mutasi))
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
                                        value="{{ $siswa->sekolah_mutasi ?? old('sekolah_mutasi') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text sekolah_mutasi_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="npsn_mutasi" class="col-sm-2 col-form-label">NPSN</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NPSN"
                                        id="npsn_mutasi" name="npsn_mutasi"
                                        value="{{ $siswa->npsn_mutasi ?? old('npsn_mutasi') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text npsn_mutasi_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nism_mutasi" class="col-sm-2 col-form-label">NISM</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan NISM"
                                        id="nism_mutasi" name="nism_mutasi"
                                        value="{{ $siswa->nism_mutasi ?? old('nism_mutasi') }}">
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
                                        value="{{ $siswa->tanggal_mutasi ?? old('tanggal_mutasi') }}">
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
                                        id="ayah_kandung" name="ayah_kandung"
                                        value="{{ $siswa->ayah_kandung ?? old('ayah_kandung') }}">
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
                                            @if (
                                                (isset($siswa->status_ayah) && $siswa->status_ayah == $status_ayah) ||
                                                    (!isset($siswa->status_ayah) && old('status_ayah') == $status_ayah))
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
                                        id="nik_ayah" name="nik_ayah"
                                        value="{{ $siswa->nik_ayah ?? old('nik_ayah') }}">
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
                                        value="{{ $siswa->tempat_lahir_ayah ?? old('tempat_lahir_ayah') }}">
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
                                        value="{{ $siswa->tanggal_lahir_ayah ?? old('tanggal_lahir_ayah') }}">
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
                                            @if (
                                                (isset($siswa->pendidikan_ayah) && $siswa->pendidikan_ayah == $pendidikan_ayah) ||
                                                    (!isset($siswa->pendidikan_ayah) && old('pendidikan_ayah') == $pendidikan_ayah))
                                                <option value="{{ $pendidikan_ayah }}" selected>
                                                    {{ $pendidikan_ayah }}</option>
                                            @else
                                                <option value="{{ $pendidikan_ayah }}">{{ $pendidikan_ayah }}
                                                </option>
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
                                            @if (
                                                $siswa->id_pekerjaan_ayah_for_siswa ??
                                                    (null == $pekerjaan_ayah->id ?? old('pekerjaan_ayah') == $pekerjaan_ayah->id))
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
                                        value="{{ $siswa->nomor_telepon_ayah ?? old('nomor_telepon_ayah') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_telepon_ayah_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat_ayah" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Masukkan alamat_ayah" id="alamat_ayah" name="alamat_ayah"
                                        rows="3">{{ $siswa->alamat_ayah ?? old('alamat_ayah') }}</textarea>
                                    <div class="mt-2">
                                        <span class="text-danger error-text alamat_ayah_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_kks" class="col-sm-2 col-form-label">No. KKS</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nomor KKS"
                                        id="nomor_kks" name="nomor_kks"
                                        value="{{ $siswa->nomor_kks ?? old('nomor_kks') }}">
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
                                        id="ibu_kandung" name="ibu_kandung"
                                        value="{{ $siswa->ibu_kandung ?? old('ibu_kandung') }}">
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
                                            @if (
                                                (isset($siswa->status_ibu) && $siswa->status_ibu == $status_ibu) ||
                                                    (!isset($siswa->status_ibu) && old('status_ibu') == $status_ibu))
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
                                        id="nik_ibu" name="nik_ibu"
                                        value="{{ $siswa->nik_ibu ?? old('nik_ibu') }}">
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
                                        value="{{ $siswa->tempat_lahir_ibu ?? old('tempat_lahir_ibu') }}">
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
                                        value="{{ $siswa->tanggal_lahir_ibu ?? old('tanggal_lahir_ibu') }}">
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
                                            @if (
                                                (isset($siswa->pendidikan_ibu) && $siswa->pendidikan_ibu == $pendidikan_ibu) ||
                                                    (!isset($siswa->pendidikan_ibu) && old('pendidikan_ibu') == $pendidikan_ibu))
                                                <option value="{{ $pendidikan_ibu }}" selected>{{ $pendidikan_ibu }}
                                                </option>
                                            @else
                                                <option value="{{ $pendidikan_ibu }}">{{ $pendidikan_ibu }}</option>
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
                                            @if (
                                                (isset($siswa->id_pekerjaan_ibu_for_siswa) && $siswa->id_pekerjaan_ibu_for_siswa == $pekerjaan_ibu->id) ||
                                                    (!isset($siswa->id_pekerjaan_ibu_for_siswa) && old('pekerjaan_ibu') == $pekerjaan_ibu->id))
                                                <option value="{{ $pekerjaan_ibu->id }}" selected>
                                                    {{ $pekerjaan_ibu->pekerjaan }}</option>
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
                                        value="{{ $siswa->nomor_telepon_ibu ?? old('nomor_telepon_ibu') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_telepon_ibu_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat_ibu" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Masukkan alamat_ibu" id="alamat_ibu" name="alamat_ibu" rows="3">{{ $siswa->alamat_ibu ?? old('alamat_ibu') }}</textarea>
                                    <div class="mt-2">
                                        <span class="text-danger error-text alamat_ibu_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_pkh" class="col-sm-2 col-form-label">No. PKH</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Masukkkan nomor PKH"
                                        id="nomor_pkh" name="nomor_pkh"
                                        value="{{ $siswa->nomor_pkh ?? old('nomor_pkh') }}">
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
                                        id="nama_wali" name="nama_wali"
                                        value="{{ $siswa->nama_wali ?? old('nama_wali') }}">
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
                                            @if (
                                                $siswa->id_pekerjaan_wali_for_siswa ??
                                                    (null == $pekerjaan_wali->id ?? old('pekerjaan_wali') == $pekerjaan_wali->id))
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
                                        value="{{ $siswa->nomor_telepon_wali ?? old('nomor_telepon_wali') }}">
                                    <div class="mt-2">
                                        <span class="text-danger error-text nomor_telepon_wali_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat_wali" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Masukkan alamat_wali" id="alamat_wali" name="alamat_wali"
                                        rows="3">{{ $siswa->alamat_wali ?? old('alamat_wali') }}</textarea>
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
                        <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-select" id="mapel" name="mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($semua_mapel as $mapel)
                                    @if ($user->id_mapel == $mapel->id ?? old('mapel') == $mapel->id)
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
                                    @if ($siswa->ijazah ?? null)
                                        <img src="{{ asset($siswa->ijazah) }}" alt="" class="img-thumbnail"
                                            width="200" id="showIjazah">
                                    @endif
                                    <input type="hidden" value="{{ $siswa->ijazah ?? null }}" id="ijazahPreview"
                                        name="ijazahPreview">
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
                                    <img src="@if ($user->profile_image) {{ asset($user->profile_image) }} @endif"
                                        alt="" class="img-thumbnail" width="200" id="showImage">
                                    <input type="hidden" value="{{ $user->profile_image }}" id="gambarPreview"
                                        name="gambarPreview">
                                </div>
                            </div>
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
                            <img src="@if ($user->profile_image) {{ asset($user->profile_image) }} @endif"
                                alt="" class="img-thumbnail" width="200" id="showImage">
                            <input type="hidden" value="{{ $user->profile_image }}" id="gambarPreview"
                                name="gambarPreview">
                        </div>
                    </div>
                @endif



                {{-- tambah id role --}}
                <input type="hidden" name="id_role" value="{{ $id_role }}" id="id_role">



                <button type="submit" class="btn btn-info waves-effect waves-light" style="margin-right: 5px">
                    <i class="ri-refresh-line align-middle me-1"></i>
                    <span style="vertical-align: middle">Update</span>
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

    function cetakData() {
        var id_siswa = {{ $user->id }};
        var url = '/data-user/print?';

        if (id_siswa) {
            url += 'id_siswa=' + id_siswa
        }

        window.open(url, '_blank');
    }

    function cetakRapor() {
        var id_siswa = {{ $user->id }};
        var url = '/data-rapor/print?';

        if (id_siswa) {
            url += 'id_siswa=' + id_siswa
        }

        window.open(url, '_blank');
    }

    // update data
    $('#formUbahData').on('submit', function(e) {
        e.preventDefault();

        var id = {{ $user->id }};
        let formData = new FormData($('#formUbahData')[0]);

        $.ajax({
            url: '/data-user/update/' + id,
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
                } else if (response.status == 'error2' || response.status == 'error3') {
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

                    // hide modal
                    $('#exampleModalScrollable').modal('hide');

                    // fetch data
                    filterData();
                }
            }
        })

    })
</script>
