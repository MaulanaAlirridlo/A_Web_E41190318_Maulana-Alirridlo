@extends('backend/layouts.template')

@section('content')
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="icon_document_alt"></i> Riwayat Hidup</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="{{ url('dashboard')}}">Home</a></li>
              <li><i class="icon_document_alt"></i>Riwayat Hidup</li>
              <li><i class="fa fa-files-o"></i>Pengalaman Kerja</li>
            </ol>
          </div>
        </div>
        {{-- Form validations --}}
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                {{ isset($admin_lecturer) ? 'Mengubah' : 'Menambahkan' }} Pengalaman Kerja
              </header>
              <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                      <strong>Whooops!</strong> There were some problems with your input. <br><br>
                      <ul>
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                      </ul>
                    </div>
                @endif
                <div class="panel-body">
                  <div class="form">
                    <form method="POST" action="{{ isset($pengalaman_kerja) ? route('pengalaman_kerja.update', $pengalaman_kerja->id) : 
                      route('pengalaman_kerja.store') }}" class="form-validare form-horizontal" id="pengalaman_kerja_form">
                      {!! csrf_field() !!}
                      {!! isset($pengalaman_kerja) ? method_field('PUT') : '' !!}
                      <input type="hidden" name="id" value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->id : "" }}">
                      <div class="form-group">
                        <label for="nama" class="control-label col-lg-2">Nama Perusahaan<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" id="nama" name="nama" minlength="5" 
                          value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->nama : '' }}" 
                          required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="jabatan" class="control-label col-lg-2">Jabatan<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" id="jabatan" name="jabatan" minlength="2"
                          value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->jabatan : '' }}"
                          required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tahun_masuk" class="control-label col-lg-2">Tahun Masuk<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control datepicker" id="tahun_masuk" name="tahun_masuk"
                          value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->tahun_masuk : '' }}"
                          required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tahun_keluar" class="control-label col-lg-2">Tahun Keluar<span class="required">*</span></label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control datepicker" id="tahun_keluar" name="tahun_keluar"
                          value="{{ isset($pengalaman_kerja) ? $pengalaman_kerja->tahun_keluar : '' }}"
                          required>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                          <button class="btn btn-primary" type="submit">Save</button>
                          <a href="{{route('pengalaman_kerja.index')}}"><button class="btn btn-default"
                            type="submit">Cancel</button></a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
        {{-- page end --}}
      </section>
    </section>
@endsection
@push('content-css')
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.css')}}">
@endpush
@push('content-js')
    <script src="{{ asset('backend/js/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript">
      $("#tahun_masuk").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
      });
      $("#tahun_keluar").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
      });
    </script>
@endpush