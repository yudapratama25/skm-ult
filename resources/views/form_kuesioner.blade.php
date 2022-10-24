<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ULT Unmul - Unit Layanan Terpadu Universitas Mulawarman</title>
    <link 
        rel="shortcut icon" 
        href="https://ult.unmul.ac.id/front/images/logo-unmul16x16.png" 
        type="image/x-icon">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  </head>
  <body>
    <div class="container-fluid">
        <div class="card-form w-40 mxh-90-vh card-center">
            <div class="card-form-header">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('assets/images/logo-ult.png') }}" width="100%" alt="Logo ULT">
                    </div>
                    <div class="col-9">
                        <h3>KUESIONER SURVEI KEPUASAN MASYARAKAT (SKM)<br>PADA UNIT LAYANAN TERPADU<br>UNIVERISTAS MULAWARMAN</h3>
                    </div>
                </div>
            </div>
            <div class="card-form-body">
                <form action="{{ route('submit-kuesioner') }}" method="POST">
                    @csrf
                    <h6 class="mb-3">I. PROFIL RESPONDEN</h6>
                    <div class="form-group mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan nama lengkap" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Jenis Kelamin</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk-l" value="L" required>
                            <label class="form-check-label" for="jk-l">
                              Laki-laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk-p" value="P">
                            <label class="form-check-label" for="jk-p">
                              Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Pendidikan</label>
                        <select name="pendidikan" class="form-control" required>
                            <option value="-" selected disabled>Pilih pendidikan terakhir</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Pekerjaan</label>
                        <select name="pekerjaan" class="form-control" id="input-pekerjaan" required>
                            <option value="-" selected disabled>Pilih pekerjaan</option>
                            <option value="PNS">PNS</option>
                            <option value="TNI">TNI</option>
                            <option value="POLRI">POLRI</option>
                            <option value="SWASTA">SWASTA</option>
                            <option value="WIRAUSAHA">WIRAUSAHA</option>
                            <option value="LAINNYA">LAINNYA</option>
                        </select>
                    </div>
                    <div class="form-group mb-3 d-none" id="form-pekerjaan-lainnya">
                        <label>Pekerjaan Lainnya</label>
                        <input type="text" class="form-control" name="pekerjaan_lainnya" id="input-pekerjaan-lainnya" placeholder="Masukan pekerjaan anda">
                    </div>
                    <div class="form-group mb-3">
                        <label>Fakultas/Instansi</label>
                        <input type="text" class="form-control" name="instansi" placeholder="Masukan fakultas atau instansi" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Jenis Layanan Yang Diterima</label>
                        <input type="text" class="form-control" name="jenis_layanan" placeholder="Masukan jenis layanan" required>
                    </div>
                    <div class="card-divider my-3"></div>
                    <h6 class="mb-3">II. PENDAPAT RESPONDEN TENTANG PELAYANAN</h6>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?
                            <div class="form-group mt-2">
                                @php
                                    $options = ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'];
                                @endphp
                                @foreach ($options as $key => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="p1" id="p1-{{ $key }}" value="{{ $key + 1 }}" required>
                                        <label class="form-check-label" for="p1-{{ $key }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?
                            <div class="form-group mt-2">
                                @php
                                    $options = ['Tidak Mudah', 'Kurang Mudah', 'Mudah', 'Sangat Mudah'];
                                @endphp
                                @foreach ($options as $key => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="p2" id="p2-{{ $key }}" value="{{ $key + 1 }}" required>
                                        <label class="form-check-label" for="p2-{{ $key }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?
                            <div class="form-group mt-2">
                                @php
                                    $options = ['Tidak Cepat', 'Kurang Cepat', 'Cepat', 'Sangat Cepat'];
                                @endphp
                                @foreach ($options as $key => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="p3" id="p3-{{ $key }}" value="{{ $key + 1 }}" required>
                                        <label class="form-check-label" for="p3-{{ $key }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan?
                            <div class="form-group mt-2">
                                @php
                                    $options = ['Sangat Mahal', 'Cukup Mahal', 'Murah', 'Gratis'];
                                @endphp
                                @foreach ($options as $key => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="p4" id="p4-{{ $key }}" value="{{ $key + 1 }}" required>
                                        <label class="form-check-label" for="p4-{{ $key }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?
                            <div class="form-group mt-2">
                                @php
                                    $options = ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'];
                                @endphp
                                @foreach ($options as $key => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="p5" id="p5-{{ $key }}" value="{{ $key + 1 }}" required>
                                        <label class="form-check-label" for="p5-{{ $key }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kompetensi/kemampuan petugas dalam pelayanan?
                            <div class="form-group mt-2">
                                @php
                                    $options = ['Tidak Kompeten', 'Kurang Kompeten', 'Kompeten', 'Sangat Kompeten'];
                                @endphp
                                @foreach ($options as $key => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="p6" id="p6-{{ $key }}" value="{{ $key + 1 }}" required>
                                        <label class="form-check-label" for="p6-{{ $key }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?
                            <div class="form-group mt-2">
                                @php
                                    $options = ['Tidak Sopan dan Tidak Ramah', 'Kurang Sopan dan Kurang Ramah', 'Sopan dan Ramah', 'Sangat Sopan dan Sangat Ramah'];
                                @endphp
                                @foreach ($options as $key => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="p7" id="p7-{{ $key }}" value="{{ $key + 1 }}" required>
                                        <label class="form-check-label" for="p7-{{ $key }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?
                            <div class="form-group mt-2">
                                @php
                                    $options = ['Buruk', 'Cukup', 'Baik', 'Sangat Baik'];
                                @endphp
                                @foreach ($options as $key => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="p8" id="p8-{{ $key }}" value="{{ $key + 1 }}" required>
                                        <label class="form-check-label" for="p8-{{ $key }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan?
                            <div class="form-group mt-2">
                                @php
                                    $options = ['Tidak Ada', 'Ada Tetapi Tidak berfungsi', 'Berfungsi Kurang Maksimal', 'Dikelola Dengan Baik'];
                                @endphp
                                @foreach ($options as $key => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="p9" id="p9-{{ $key }}" value="{{ $key + 1 }}" required>
                                        <label class="form-check-label" for="p9-{{ $key }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            Kritik dan Saran
                            <div class="form-group mt-2">
                                <textarea name="saran" class="form-control" rows="5" placeholder="Masukan kritik dan saran disini"></textarea>
                            </div>
                        </li>
                    </ol>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button class="btn btn-primary w-25" type="submit">
                            Submit
                        </button>
                        <a href="{{ url('/') }}" class="link-secondary text-decoration-none">Kosongkan Form</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        var inputPekerjaan = document.getElementById('input-pekerjaan');
        inputPekerjaan.addEventListener('change', function() {
            console.log(this.value);
            if (this.value == "LAINNYA") {
                document.getElementById('form-pekerjaan-lainnya').classList.remove('d-none');
                document.getElementById('input-pekerjaan-lainnya').setAttribute('required', 'required');
            } else {
                document.getElementById('form-pekerjaan-lainnya').classList.add('d-none');
                document.getElementById('input-pekerjaan-lainnya').removeAttribute('required');
            }
        });
    </script>
    @if (session()->has('success'))
        <script type="text/javascript">
            Swal.fire(
                'Terima Kasih',
                'Data Kuesioner Anda Telah Disimpan',
                'success'
            );
        </script>
    @endif
  </body>
</html>