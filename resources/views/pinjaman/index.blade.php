@extends('layouts/app', ['title' => 'Data Pinjaman'])

@section('content')
@include('sweetalert::alert')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>PINJAMAN
                        <div class="page-title-subheading">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="active breadcrumb-item" aria-current="page">Pinjaman</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#importExcel">Impor <i class="fa fa-file-import"></i></a>
                    <a href="{{ route('pinjaman.export') }}" class="btn-shadow btn-sm mr-3 btn btn-primary">
                        Export
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-header">
                <h5 class="card-title">Data Users</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="mb-0 table table-striped table-hover table-bordered table-sm" id="data-table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center" width="3%">No</th>
                                <th>Nama</th>
                                <th>Total Pinjaman</th>
                                <th>Sisa Pinjaman</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tenor</th>
                                <th>Suku Bunga</th>
                                <th>Tunggakan</th>
                                {{-- <th>Angsuran Bunga</th> --}}
                                {{-- <th>Angsuran Pokok</th> --}}
                                <th>Angsuran Total</th>
                                <th>Status</th>
                                <th class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-styles')
    <!-- DataTables {
                data: 'date',
                name: 'date'
            },-->
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('custom-scripts')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template') }}/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    let table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,

        ajax: "{{ route('pinjaman.index') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: 'dt-body-center'
            },
            {
                data: 'user_id',
                name: 'user.name'
            },
            {
                data: 'total_pinjaman',
                name: 'total_pinjaman'
            },
            {
                data: 'saldo_pinjaman',
                name: 'saldo_pinjaman'
            },
            {
                data: 'tanggal_pinjam',
                name: 'tanggal_pinjam'
            },
            {
                data: 'tenor',
                name: 'tenor'
            },
            {
                data: 'suku_bunga',
                name: 'suku_bunga'
            },
            {
                data: 'arrears',
                name: 'arrears'
            },
            // {
            //     data: 'angsuran_bunga',
            //     name: 'angsuran_bunga'
            // },
            // {
            //     data: 'angsuran_pokok',
            //     name: 'angsuran_pokok'
            // },
            {
                data: 'total_angsuran',
                name: 'total_angsuran'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'dt-body-center'
            },
        ],
    });

    $('body').on('click', '#showDetails', function () {
        var pinjaman_id = $(this).data('id');
        $.get("{{ route('pinjaman.index') }}" + '/' + pinjaman_id, function(data) {
            $('#detailsModal').modal('show');
            $.each(data.angsuran, function (key, value) {
                var url = "{{route('angsuran.status', '')}}"+"/"+value.id;
                var csrf = $('meta[name="csrf-token"]').attr('content');
                let pending = `<form method="post" action="${url}"><input type="hidden" name="_token" value=${csrf}><input type="hidden" name="status" value="1"><button type="submit" class="btn btn-sm btn-warning">Pending</form>`;
                var paid = `<form method="post" action="${url}"><input type="hidden" name="_token" value=${csrf}><input type="hidden" name="status" value="0"><button type="submit" class="btn btn-sm btn-primary">Bayar</form>`;
                var late = `<button type="submit" class="btn btn-sm btn-danger">Telat</button>`;
                let date = new Date().toISOString().split('T')[0];
                $('#tbody').append(`
                    <tr class="yaya">
                        <td>${value.angsuran_keberapa}</td>
                        <td>${value.jatuh_tempo}</td>
                        <td>${value.total}</td>
                        <td>${value.bunga}</td>
                        <td>${value.pokok}</td>
                        <td><img src="/storage/${value.bukti_transaksi}" width="100"></td>
                        <td>
                            ${value.status == 0 ? pending : paid}
                        </td>
                        <td>
                            ${value.jatuh_tempo < date && value.status == 0 ? late : ''}
                        </td>
                    </tr>`);
            });
        });
        // Menhapus elemen djancok
        $('tr.yaya').remove();
    });
});
</script>

<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModal" style="display: none;"
aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModal">Users Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Angusran Ke bereap</th>
                            <th>Tgl jatuh tempo</th>
                            <th>Anguran Total</th>
                            <th>Anguran Bunga</th>
                            <th>Anguran Pokok</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL IMPORT EXCEL -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="detailsModal" style="display: none;"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModal">Import Pinjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header"><h3 class="card-title">Petunjuk Import Data Pinjaman</h3></div>
                    <div class="card-body">
                        <ul class="mb-3">
                            <li>Baris 1 = Nama Siswa</li>
                            <li>Baris 2 = NISN Siswa</li>
                            <li>Baris 3 = Jenis Kelamin (L/P)</li>
                            <li>Baris 4 = Agama</li>
                            <li>Baris 5 = Nama Kelas</li>
                            <li>Baris 6 = Tanggal Lahir</li>
                            <li>Baris 7 = No HP</li>
                            <li>Baris 8 = Email</li>
                            <li>Baris 9 = Alamat</li>
                        </ul>
                        <form action="{{ route('pinjaman.import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Import Disini <span class="text-danger">*</span></label>
                                <input type="file" class="form-control form-control-sm">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal import excel -->
@endsection
