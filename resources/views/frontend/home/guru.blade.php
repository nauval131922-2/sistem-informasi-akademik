  <?php 
    $kepala_madrasah = App\Models\User::where('id_role', 2)->first();
    // get 3 data dari tabel user dengan id 3 dan urutkan berdasarkan id_kelas asc
    $semua_guru_wali_kelas = App\Models\User::where('id_role', 3)->orderBy('id_kelas', 'asc')->limit(3)->get();
    // get data dari tabel user dengan id 4 dan urutkan berdasarkan name asc
    // $guru_mata_pelajaran = App\Models\User::where('id', 4)->orderBy('name', 'asc')->get();

    // get nama jabatan dari tabel jabatan dengan id 1
    $jabatan_kepala_madrasah = App\Models\Jabatan::where('id', 2)->first();
    // get nama jabatan dari tabel jabatan dengan id 2
    $jabatan_guru_wali_kelas = App\Models\Jabatan::where('id', 3)->first();

    $jabatan = 'teacher';
  ?>
    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Guru</h2>
          {{-- <span style="line-height: 30px">Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</span> --}}
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                @if ($kepala_madrasah->profile_image)
                  <img src="{{ asset($kepala_madrasah->profile_image) }}" class="img-fluid" alt="">
                @else
                  <img src="https://source.unsplash.com/600x600/?quote" class="img-fluid" alt="">
                @endif
              </div>
              <div class="member-info">
                <h4>{{ $kepala_madrasah->name }}</h4>
                <span>
                  {{ $jabatan_kepala_madrasah->nama }}
                </span>
              </div>
            </div>
          </div>

          @foreach ($semua_guru_wali_kelas as $no => $guru_wali_kelas)
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
              <div class="member">
                <div class="member-img">
                  @if ($guru_wali_kelas->profile_image)
                    <img src="{{ asset($guru_wali_kelas->profile_image) }}" class="img-fluid" alt="">
                  @else
                    <img src="https://source.unsplash.com/600x600/?quote={{ $no+1 }}" class="img-fluid" alt="">
                  @endif
                </div>
                <div class="member-info">
                  <h4>{{ $guru_wali_kelas->name }}</h4>
                  <span>
                    @if ($guru_wali_kelas->id_kelas == 1)
                      {{ $jabatan_guru_wali_kelas->nama }} 1
                    @elseif ($guru_wali_kelas->id_kelas == 2)
                      {{ $jabatan_guru_wali_kelas->nama }} 2
                    @elseif ($guru_wali_kelas->id_kelas == 3)
                      {{ $jabatan_guru_wali_kelas->nama }} 3
                    @endif
                  </span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        
        <div>
          <div class="text-center"><a href="" class="btn-get-started">Selengkapnya</a></div>
        </div>
        
      </div>
    </section><!-- End Our Team Section -->