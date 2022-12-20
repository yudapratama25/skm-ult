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
    <div class="d-flex flex-column align-items-center">
        <div class="filter-form mb-3">
            <form action="{{ url('/responden') }}" method="GET" class="d-flex align-items-end">
                <div class="form-group w-75">
                    <label>Filter Data:</label>
                    <input type="date" class="form-control" name="date" value="{{ $date_filter ?? null }}" max="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group w-25 d-flex justify-content-end">
                    <button class="btn btn-primary" style="width:90%;">Cari</button>
                </div>
            </form>
        </div>
        <div class="d-flex gap-4 align-items-center px-4">
            <div class="w-50">
                <div class="card-form min-vh-90">
                    <div class="card-form-header">
                        <h3>JUMLAH RESPONDEN</h3>
                    </div>
                    <div class="card-form-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Responden</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($respondens as $responden)
                                    <tr>
                                        <td id="nama-responden-{{ $responden->id }}">Responden Ke-{{ $loop->iteration }}</td>
                                        <td>
                                            <button 
                                                class="btn btn-primary btn-sm" 
                                                type="button" 
                                                onclick="showDetailResponden({{ $responden->id }})">
                                                Lihat
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Belum ada responden</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="w-50">
                <div class="card-form">
                    <div class="card-form-header">
                        <h3>HASIL SURVEI {{ ($date_filter != null) ? \Carbon\Carbon::parse($date_filter)->isoFormat('D MMMM Y') : null }}</h3>
                    </div>
                    <div class="card-form-body">
                        <div id="mainchart" style="position: relative;height:400px;overflow: hidden;"></div>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item py-3">
                                Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?
                                @php
                                    $options = ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'];
                                @endphp
                                <ol class="mt-2" type="A">
                                    @foreach ($options as $key => $option)
                                        <li>{{ $option }} <small>({{ $result['p1'][$key+1] }} orang)</small></li>
                                    @endforeach
                                </ol>
                            </li>
                            <li class="list-group-item py-3">
                                Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?
                                @php
                                    $options = ['Tidak Mudah', 'Kurang Mudah', 'Mudah', 'Sangat Mudah'];
                                @endphp
                                <ol class="mt-2" type="A">
                                    @foreach ($options as $key => $option)
                                        <li>{{ $option }} <small>({{ $result['p2'][$key+1] }} orang)</small></li>
                                    @endforeach
                                </ol>
                            </li>
                            <li class="list-group-item py-3">
                                Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?
                                @php
                                    $options = ['Tidak Cepat', 'Kurang Cepat', 'Cepat', 'Sangat Cepat'];
                                @endphp
                                <ol class="mt-2" type="A">
                                    @foreach ($options as $key => $option)
                                        <li>{{ $option }} <small>({{ $result['p3'][$key+1] }} orang)</small></li>
                                    @endforeach
                                </ol>
                            </li>
                            <li class="list-group-item py-3">
                                Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan?
                                @php
                                    $options = ['Sangat Mahal', 'Cukup Mahal', 'Murah', 'Gratis'];
                                @endphp
                                <ol class="mt-2" type="A">
                                    @foreach ($options as $key => $option)
                                        <li>{{ $option }} <small>({{ $result['p4'][$key+1] }} orang)</small></li>
                                    @endforeach
                                </ol>
                            </li>
                            <li class="list-group-item py-3">
                                Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?
                                @php
                                    $options = ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'];
                                @endphp
                                <ol class="mt-2" type="A">
                                    @foreach ($options as $key => $option)
                                        <li>{{ $option }} <small>({{ $result['p5'][$key+1] }} orang)</small></li>
                                    @endforeach
                                </ol>
                            </li>
                            <li class="list-group-item py-3">
                                Bagaimana pendapat Saudara tentang kompetensi/kemampuan petugas dalam pelayanan?
                                @php
                                    $options = ['Tidak Kompeten', 'Kurang Kompeten', 'Kompeten', 'Sangat Kompeten'];
                                @endphp
                                <ol class="mt-2" type="A">
                                    @foreach ($options as $key => $option)
                                        <li>{{ $option }} <small>({{ $result['p6'][$key+1] }} orang)</small></li>
                                    @endforeach
                                </ol>
                            </li>
                            <li class="list-group-item py-3">
                                Bagaimana pendapat Saudara tentang perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?
                                @php
                                    $options = ['Tidak Sopan dan Tidak Ramah', 'Kurang Sopan dan Kurang Ramah', 'Sopan dan Ramah', 'Sangat Sopan dan Sangat Ramah'];
                                @endphp
                                <ol class="mt-2" type="A">
                                    @foreach ($options as $key => $option)
                                        <li>{{ $option }} <small>({{ $result['p7'][$key+1] }} orang)</small></li>
                                    @endforeach
                                </ol>
                            </li>
                            <li class="list-group-item py-3">
                                Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?
                                @php
                                    $options = ['Buruk', 'Cukup', 'Baik', 'Sangat Baik'];
                                @endphp
                                <ol class="mt-2" type="A">
                                    @foreach ($options as $key => $option)
                                        <li>{{ $option }} <small>({{ $result['p8'][$key+1] }} orang)</small></li>
                                    @endforeach
                                </ol>
                            </li>
                            <li class="list-group-item py-3">
                                Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan?
                                @php
                                    $options = ['Tidak Ada', 'Ada Tetapi Tidak berfungsi', 'Berfungsi Kurang Maksimal', 'Dikelola Dengan Baik'];
                                @endphp
                                <ol class="mt-2" type="A">
                                    @foreach ($options as $key => $option)
                                        <li>{{ $option }} <small>({{ $result['p9'][$key+1] }} orang)</small></li>
                                    @endforeach
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div 
        class="modal fade" 
        id="modalShowResponden" 
        tabindex="-1" 
        aria-labelledby="modalShowRespondenLabel" 
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalShowRespondenLabel">Detail Responden</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <td>
                                Nama Responden
                            </td>
                            <td id="td-nama">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jenis Kelamin
                            </td>
                            <td id="td-jenis-kelamin">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Pendidikan
                            </td>
                            <td id="td-pendidikan">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Pekerjaan
                            </td>
                            <td id="td-pekerjaan">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Instansi
                            </td>
                            <td id="td-instansi">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jenis Layanan
                            </td>
                            <td id="td-jenis-layanan">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Waktu Pengisian
                            </td>
                            <td id="td-waktu-pengisian">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Total Point
                            </td>
                            <td id="td-total-point">
                            </td>
                        </tr>
                    </table>

                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?
                            @php
                                $options = ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'];
                            @endphp
                            <ul class="mt-2">
                                @foreach ($options as $key => $option)
                                    <li class="option-detail-responden d-none" id="p1-{{ $key+1 }}">{{ $option }}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?
                            @php
                                $options = ['Tidak Mudah', 'Kurang Mudah', 'Mudah', 'Sangat Mudah'];
                            @endphp
                            <ul class="mt-2">
                                @foreach ($options as $key => $option)
                                    <li class="option-detail-responden d-none" id="p2-{{ $key+1 }}">{{ $option }}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?
                            @php
                                $options = ['Tidak Cepat', 'Kurang Cepat', 'Cepat', 'Sangat Cepat'];
                            @endphp
                            <ul class="mt-2">
                                @foreach ($options as $key => $option)
                                    <li class="option-detail-responden d-none" id="p3-{{ $key+1 }}">{{ $option }}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan?
                            @php
                                $options = ['Sangat Mahal', 'Cukup Mahal', 'Murah', 'Gratis'];
                            @endphp
                            <ul class="mt-2">
                                @foreach ($options as $key => $option)
                                    <li class="option-detail-responden d-none" id="p4-{{ $key+1 }}">{{ $option }}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?
                            @php
                                $options = ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'];
                            @endphp
                            <ul class="mt-2">
                                @foreach ($options as $key => $option)
                                    <li class="option-detail-responden d-none" id="p5-{{ $key+1 }}">{{ $option }}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kompetensi/kemampuan petugas dalam pelayanan?
                            @php
                                $options = ['Tidak Kompeten', 'Kurang Kompeten', 'Kompeten', 'Sangat Kompeten'];
                            @endphp
                            <ul class="mt-2">
                                @foreach ($options as $key => $option)
                                    <li class="option-detail-responden d-none" id="p6-{{ $key+1 }}">{{ $option }}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?
                            @php
                                $options = ['Tidak Sopan dan Tidak Ramah', 'Kurang Sopan dan Kurang Ramah', 'Sopan dan Ramah', 'Sangat Sopan dan Sangat Ramah'];
                            @endphp
                            <ul class="mt-2">
                                @foreach ($options as $key => $option)
                                    <li class="option-detail-responden d-none" id="p7-{{ $key+1 }}">{{ $option }}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?
                            @php
                                $options = ['Buruk', 'Cukup', 'Baik', 'Sangat Baik'];
                            @endphp
                            <ul class="mt-2">
                                @foreach ($options as $key => $option)
                                    <li class="option-detail-responden d-none" id="p8-{{ $key+1 }}">{{ $option }}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item py-3">
                            Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan?
                            @php
                                $options = ['Tidak Ada', 'Ada Tetapi Tidak berfungsi', 'Berfungsi Kurang Maksimal', 'Dikelola Dengan Baik'];
                            @endphp
                            <ul class="mt-2">
                                @foreach ($options as $key => $option)
                                    <li class="option-detail-responden d-none" id="p9-{{ $key+1 }}">{{ $option }}</li>
                                @endforeach
                            </ul>
                        </li>
                    </ol>
                    <p class="mt-3">
                        Kritik & Saran <br>
                        <span id="td-saran" class="text-secondary"></span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/echarts.min.js') }}"></script>
    <script type="text/javascript">
        const modalResponden = new bootstrap.Modal(document.getElementById('modalShowResponden'));

        var dom = document.getElementById('mainchart');
        var myChart = echarts.init(dom, null, {
                        renderer: 'canvas',
                        useDirtyRect: false
                    });
        var app = {};

        var option;

        option = {
            color: ['#10b981', "#f59e0b", "#ef4444"],
            title: {
                text: 'Tingkat Kepuasan Pelayanan',
                subtext: 'Berdasarkan akumulasi point responden',
                left: 'right'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [
                {
                    name: 'Tanggapan',
                    type: 'pie',
                    radius: '50%',
                    data: [
                        { value: {{ $chart['sangat_memuaskan'] }}, name: 'Sangat Memuaskan'},
                        { value: {{ $chart['memuaskan'] }}, name: 'Memuaskan'},
                        { value: {{ $chart['tidak_memuaskan'] }}, name: 'Tidak Memuaskan'}
                    ],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };

        if (option && typeof option === 'object') {
            myChart.setOption(option);
        }

        window.addEventListener('resize', myChart.resize);

        async function showDetailResponden(kuesionerId) {
            var response = null;
            var request = await fetch(window.location.origin+'/responden/'+kuesionerId)
                                .then((response) => response.json())
                                .then(function(data) {
                                    response = data;
                                });

            if (response != null) {
                let name = document.getElementById(`nama-responden-${kuesionerId}`).innerHTML;
                console.log(name);
                setTimeout(() => {
                    document.getElementById('td-nama').innerHTML = name;
                }, 700);
                document.getElementById('td-jenis-kelamin').innerHTML = (response.jenis_kelamin == "P") ? "Perempuan" : "Laki-laki";
                document.getElementById('td-pendidikan').innerHTML = response.pendidikan;
                document.getElementById('td-pekerjaan').innerHTML = response.pekerjaan;
                document.getElementById('td-jenis-layanan').innerHTML = response.jenis_layanan;
                document.getElementById('td-instansi').innerHTML = response.instansi;
                document.getElementById('td-nama').innerHTML = response.nama;
                document.getElementById('td-waktu-pengisian').innerHTML = response.waktu_pengisian;
                document.getElementById('td-saran').innerHTML = (response.saran == "-") ? "Tidak ada" : response.saran;
                document.getElementById('td-total-point').innerHTML = response.total_point + " point";

                for (let index = 1; index <= 9; index++) {
                    document.querySelector(`#p${index}-${response[`p${index}`]}`).classList.remove('d-none');
                }

                modalResponden.show();
            }
        }

        document.getElementById('modalShowResponden').addEventListener('hidden.bs.modal', event => {
            document.querySelectorAll(".option-detail-responden").forEach((element) => element.classList.add("d-none"))
        });

        setTimeout(() => {
            document.getElementById('mainchart').style.height = "350px";
        }, 2000);
    </script>
  </body>
</html>