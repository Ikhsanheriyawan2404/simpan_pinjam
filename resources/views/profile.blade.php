<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>قالب المدونة · PINJOL SYARIAH</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* stylelint-disable selector-list-comma-newline-after */

        .blog-header {
            line-height: 1;
            border-bottom: 1px solid #e5e5e5;
        }

        .blog-header-logo {
            font-family: Amiri, Georgia, "Times New Roman", serif;
            font-size: 2.25rem;
        }

        .blog-header-logo:hover {
            text-decoration: none;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: Amiri, Georgia, "Times New Roman", serif;
        }

        .display-4 {
            font-size: 2.5rem;
        }

        @media (min-width: 768px) {
            .display-4 {
                font-size: 3rem;
            }
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .nav-scroller .nav-link {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: .875rem;
        }

        .card-img-right {
            height: 100%;
            border-radius: 3px 0 0 3px;
        }

        .flex-auto {
            flex: 0 0 auto;
        }

        .h-250 {
            height: 250px;
        }

        @media (min-width: 768px) {
            .h-md-250 {
                height: 250px;
            }
        }

        /* Pagination */
        .blog-pagination {
            margin-bottom: 4rem;
        }

        .blog-pagination>.btn {
            border-radius: 2rem;
        }

        /*
 * Blog posts
 */
        .blog-post {
            margin-bottom: 4rem;
        }

        .blog-post-title {
            margin-bottom: .25rem;
            font-size: 2.5rem;
        }

        .blog-post-meta {
            margin-bottom: 1.25rem;
            color: #727272;
        }

        /*
 * Footer
 */
        .blog-footer {
            padding: 2.5rem 0;
            color: #727272;
            text-align: center;
            background-color: #f9f9f9;
            border-top: .05rem solid #e5e5e5;
        }

        .blog-footer p:last-child {
            margin-bottom: 0;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Amiri:wght@400;700&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
</head>

<body>

    <div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="link-secondary" href="#">الإشتراك في النشرة البريدية</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="#">كبير PINJOL SYARIAH</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="link-secondary" href="#" aria-label="بحث">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="mx-3" role="img" viewBox="0 0 24 24">
                            <title>بحث</title>
                            <circle cx="10.5" cy="10.5" r="7.5" />
                            <path d="M21 21l-5.2-5.2" />
                        </svg>
                    </a>
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('home') }}">إنشاء حساب</a>
                </div>
            </div>
        </header>

        <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                <a class="p-2 link-secondary" href="#">العالم</a>
                <a class="p-2 link-secondary" href="#">الولايات المتحدة</a>
                <a class="p-2 link-secondary" href="#">التقنية</a>
                <a class="p-2 link-secondary" href="#">التصميم</a>
                <a class="p-2 link-secondary" href="#">الحضارة</a>
                <a class="p-2 link-secondary" href="#">المال والأعمال</a>
                <a class="p-2 link-secondary" href="#">السياسة</a>
                <a class="p-2 link-secondary" href="#">الرأي العام</a>
                <a class="p-2 link-secondary" href="#">العلوم</a>
                <a class="p-2 link-secondary" href="#">الصحة</a>
                <a class="p-2 link-secondary" href="#">الموضة</a>
                <a class="p-2 link-secondary" href="#">السفر</a>
            </nav>
        </div>
    </div>

    <main class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">عنوان تدوينة مميزة أطول</h1>
                <p class="lead my-3">عدة أسطر نصية متعددة تعبر عن التدوية، وذلك لإعلام القراء الجدد بسرعة وكفاءة حول
                    أكثر الأشياء إثارة للاهتمام في محتويات هذه التدوينة.</p>
                <p class="lead mb-0"><a href="#" class="text-white fw-bold">أكمل القراءة...</a></p>
                <p class="lead mb-0"><a href="#" class="text-white fw-bold" id="btnPinjaman">Ajukan Pinjaman أكمل القراءة...</a></p>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <h3>Data Pinjaman</h3>
                <table class="table table-sm table-bordered table-striped">
                    <thead class="table-dark bg-white">
                        <tr>
                            <th>Status</th>
                            <th>Suku Bunga</th>
                            <th>Jangka</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tunggakan</th>
                            <th>Sisa Pinjaman</th>
                            <th>Angsuran Per Bulan</th>
                            <th>Total Pinjaman</th>
                            <th>No</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pinjaman as $item)
                        <tr>
                            <td>
                                @php
                                if ($item->status == NULL) {
                                    echo 'Menunggu';
                                } else if ($item->status == 1) {
                                    echo 'Diterima';
                                } else {
                                    echo 'Ditolak';
                                }
                                @endphp
                            </td>
                            <td>{{ $item->suku_bunga }} %</td>
                            <td>{{ $item->tenor }} Bulan</td>
                            <td>{{ $item->tanggal_pinjam ? date('d-m-Y', strtotime($item->tanggal_pinjam)) : '' }}</td>
                            <td>{{ number_format($item->arrears, 0) }}</td>
                            <td>{{ number_format($item->saldo_pinjaman, 0) }}</td>
                            <td>{{ number_format($item->total_angsuran, 0) }}</td>
                            <td>{{ number_format($item->total_pinjaman, 0) }}</td>
                            <td>{{ $loop->iteration }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <h3>Data Angsuran</h3>
                <table class="table table-sm table-bordered table-striped">
                    <thead class="table-dark bg-white">
                        <tr>
                            <th>Aksi</th>
                            <th>Aksi</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Jatuh Tempo</th>
                            <th>Total</th>
                            <th>Bunga</th>
                            <th>Pokok</th>
                            <th>Angsuran Ke</th>
                            <th>No</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($angsuran as $item)
                        <tr>
                            <form action="{{ route('angsuran.upload', $item->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                                </td>
                                <td>
                                    <input type="file" name="bukti_transaksi">
                                </td>
                            </form>
                            <td><img src="{{ $item->takeImage }}" width="100"></td>
                            <td>
                                @php
                                if ($item->status == 1) {
                                    $status = '<a class="btn btn-sm btn-primary">Sudah bayar</a>';
                                } else if ($item->status == 0 && \Carbon\Carbon::now() > $item->jatuh_tempo) {
                                    $status = '<a class="btn btn-sm btn-danger">Telat</a>';
                                } else {
                                    $status = '<a class="btn btn-sm btn-warning">Belum Bayar</a>';
                                }
                                echo $status;
                                @endphp
                            </td>
                            <td>{{ date('d-m-Y', strtotime($item->jatuh_tempo)) }}</td>
                            <td>{{ number_format($item->total, 0) }}</td>
                            <td>{{ number_format($item->bunga, 0) }}</td>
                            <td>{{ number_format($item->pokok, 0) }}</td>
                            <td>{{ $item->angsuran_keberapa }}</td>
                            <td>{{ $loop->iteration }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="blog-footer">
        <p>تم تصميم نموذج المدونة لـ <a href="https://getbootstrap.com/">Bootstrap</a> بواسطة <a
                href="https://twitter.com/mdo"><bdi lang="en" dir="ltr">@mdo</bdi></a>.</p>
        <p>
            <a href="#">عد إلى الأعلى</a>
        </p>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="modalPinjaman" tabindex="-1" aria-labelledby="modalPinjamanLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPinjamanLabel">Ajukan Pinjaman</h5>
                </div>
                <form action="{{ route('pinjaman.store') }}" method="post">
                    @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label for="total_pinjaman">Nominal Pinjaman</label>
                            <input type="number" class="form-control form-control-sm" name="total_pinjaman">
                        </div>
                        <div class="form-group">
                            <label for="tenor">Jangka Peminjaman</label>
                            <select class="form-control form-control-sm" name="tenor">
                                <option selected disabled>Pilih Tenor</option>
                                <option value="1">1 Bulan</option>
                                <option value="3">3 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btnSave">Ajukan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var total_pinjaman = $("input[name=total_pinjaman]").val();
            var tenor = $("input[name=tenor]").val();
            $('body').on('click', '#btnPinjaman', function() {
                $('#modalPinjaman').modal('show');
            });

            // $('body').on('click', '#btnSave', function () {
            //     $.ajax({
            //         type:'POST',
            //         url:"{{ route('pinjaman.store') }}",
            //         data:{total_pinjaman:total_pinjaman, tenor:tenor,},
            //         success:function(data){
            //             alert(data.success);
            //         }
            //     });
            // })
        })
    </script>
</body>

</html>
