@extends('frontend.main')

@section('title')
    MI NU Nurul Ulum | Guru
@endsection

@section('main')

           <!-- ======= Our Team Section ======= -->
    <section id="team" class="team" style="margin-top: 60px">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Guru</h2>
        </div>

        <div class="row">
          @foreach ($semua_guru as $no=>$guru)
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
              <div class="member">
                <div class="member-img">
                  @if ($guru->profile_image)
                    <img src="{{ asset($guru->profile_image) }}" class="img-fluid" alt="">
                  @else
                    <img src="https://source.unsplash.com/600x600/?quote={{ $no+1 }}" class="img-fluid" alt="">
                  @endif
                </div>
                <div class="member-info">
                  <h4>{{ $guru->name }}</h4>
                  <span>
                    @if ($guru->id_role == 2)
                      {{ $guru->role->nama }}
                    @elseif ($guru->id_role == 3)
                      {{ $guru->role->nama }} {{ $guru->kelas->nama }}
                    @elseif ($guru->id_role == 4)
                        {{-- jika $guru->mapel->mata_pelajaran ada --}}
                        @if ($guru->mapel)
                            {{ $guru->role->nama }} {{ $guru->mapel->mata_pelajaran }}
                        @else
                            {{ $guru->role->nama }}
                        @endif
                    @endif
                  </span>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="guru-pagination" style="margin-top: 40px">
            {{ $semua_guru->links('vendor.pagination.custom') }}
        </div>
      </div>
    </section><!-- End Our Team Section -->
@endsection
