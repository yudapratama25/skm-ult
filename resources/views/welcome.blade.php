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
    
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:100vh;height:100vh;">
            <div class="col-12 col-md-8">
                <div class="col-12">
                    <h2 class="text-center text-white mb-4">SELAMAT DATANG DI SISTEM KUESIONER<br/>SURVEI KEPUASAN MASYARAKAT ULT. UNMUL</h2>
                </div>
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-3 me-2">
                            <div class="card card-user" onclick="showFormLogin('mahasiswa')">
                                <div class="card-body">
                                    <img src="{{ asset('images/visitor-skm.png') }}" alt="Pengunjung" class="w-100">
                                    <h6 class="text-center mt-2 mb-0">Responden</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ms-2">
                            <div class="card card-user" onclick="showFormLogin('admin')">
                                <div class="card-body">
                                    <img src="{{ asset('images/admin-skm.png') }}" alt="Admin" class="w-100">
                                    <h6 class="text-center mt-2 mb-0">Administrator</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div 
        class="modal fade" 
        id="modalLoginAdmin" 
        tabindex="-1" 
        aria-labelledby="modalShowRespondenLabel" 
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalShowRespondenLabel">Login Administrator</h1>
                </div>
                <div class="modal-body">
                    <form action="{{ route('submit-login', 'admin') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control" placeholder="Masukan Nomor Induk Pegawai" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                        </div>
                        {{-- <hr class="mt-3"> --}}
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary w-25">Submit</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div 
        class="modal fade" 
        id="modalLoginMahasiswa" 
        tabindex="-1" 
        aria-labelledby="modalShowRespondenLabel" 
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">Login Mahasiswa</h1>
                </div>
                <div class="modal-body">
                    <form action="{{ route('submit-login', 'mahasiswa') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Masukan Nomor Induk Mahasiswa" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary w-25">Submit</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const modalAdmin = new bootstrap.Modal('#modalLoginAdmin');
        const modalMahasiswa = new bootstrap.Modal('#modalLoginMahasiswa');
        
        function showFormLogin(type) {
            if (type == "admin") {
                modalAdmin.show();
            } else {
                modalMahasiswa.show();
            }
        }

        @if (session()->has('error'))
            alert(`{{ session('error') }}`);
        @endif
    </script>
  </body>
</html>