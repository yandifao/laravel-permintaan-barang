@extends('adminlte::page')

@section('css')
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }

    </style>

@section('title', 'Permintaan Barang List')
@section('content_header')
    <h1>Permintaan Barang List</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                                <strong>{{ session('success') }}</strong>

                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('error') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="float-right">
                            <a href="{{ route('permintaan_barang.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Tambah</a>

                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIK</th>
                                    <th>Nama Karyawan</th>
                                    <th>Departemen</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th width="210px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($permintaan->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">Data Kosong</td>
                                    </tr>
                                @else
                                    @foreach ($permintaan as $p)
                                        <tr>
                                            <th scope="row">{{ ++$i }}</th>
                                            {{-- <td>{{ $p->id }}</td> --}}
                                            <td>{{ $p->nik }}</td>
                                            <td>{{ $p->nama_karyawan }}</td>
                                            <td>{{ $p->departemen }}</td>
                                            <td>{{ $p->tanggal }}</td>
                                            <td>
                                                <span class="badge badge-{{ $p->status == 0 ? 'warning' : ($p->status == 1 ? 'success' : 'danger') }}" style="font-size: 14px">
                                                    {{ $p->status == 0 ? 'Belum diproses' : ($p->status == 1 ? 'Telah Diterima' : 'Ditolak') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#detailModal" data-id="{{ $p->id }}">
                                                        <i class="fas fa-eye"></i>
                                                        Detail
                                                    </button>
                                                    @if ($p->status == 1)
                                                        &nbsp;
                                                        {{-- print data --}}
                                                        <a href="{{ route('permintaan_barang.print', $p->id) }}" target="_blank"
                                                            class="btn btn-warning">
                                                            <i class="fas fa-print"></i>
                                                            Print
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        {{ $permintaan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal detail --}}
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="width: 100%">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Permintaan Barang - (<span id="no_permintaan"></span>)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detailBody">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>Tanggal Permintaan</td>
                                                    <td>:</td>
                                                    <td id="tgl_permintaan"></td>
                                                </tr>
                                                <tr>
                                                    <td>Keterangan</td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td width="30%">Tanggal Proses</td>
                                                    <td width="5%">:</td>
                                                    <td width="65%" id="tgl_proses"></td>
                                                </tr>
                                                <tr>
                                                    <td>Process By</td>
                                                    <td>:</td>
                                                    <td id="process_by"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Qty</th>
                                                        <th>Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="detailTable">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="detailFooter" class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    @if (Auth::user()->level == 'admin')
                        <button type="button" class="btn btn-danger" id="tolak"><i class="fas fa-times"></i> Tolak</button>

                        <button type="button" class="btn btn-success" id="proses"><i class="fas fa-check"></i> Proses</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        //fungsi dibawah untuk menghilangkan alert dengan efek fadeout
        $("#success-alert").fadeTo(2000, 500).fadeOut(500, function() {
            $("#success-alert").fadeOut(500);
        });

        $('#detailModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            // console.log(id)
            $.ajax({
                type: 'GET',
                url: '/permintaan-barang/show/' + id,
                dataType: 'json',
                success: function(result) {
                    $('#no_permintaan').text(result.data.id);
                    $('#tgl_permintaan').text(result.data.tanggal);
                    $('#departemen').text(result.data.departemen);
                    $('#tgl_proses').text(result.data.processed_at);
                    $('#process_by').text(result.data.processed_by);

                    if (result.data.status == 0 && '{{ Auth::user()->level }}' == 'admin') {
                        $('#proses').show();
                        $('#tolak').show();
                        $('#keterangan').attr('readonly', false);
                    } else {
                        $('#proses').hide();
                        $('#tolak').hide();
                        $('#keterangan').attr('readonly', true);
                        $('#keterangan').val(result.data.keterangan);
                    }

                    var detail = '';
                    $.each(result.barang, function(index, value) {
                        detail += '<tr>';
                        detail += '<td>' + (index + 1) + '</td>';
                        detail += '<td>' + value.kode_barang + '</td>';
                        detail += '<td>' + value.nama_barang + '</td>';
                        detail += '<td>' + value.jumlah + '</td>';
                        detail += '<td>' + value.satuan + '</td>';
                        detail += '</tr>';
                    });

                    $('#detailTable').html(detail);
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: error.responseJSON.message
                    })
                }
            })
        });

        $('#detailModal').on('hidden.bs.modal', function() {
            $('#keterangan').val('');
        });

        $('#proses').click(function() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Permintaan barang akan diproses!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Proses!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    var id = $('#no_permintaan').text();
                    var keterangan = $('#keterangan').val();
                    $.ajax({
                        type: 'POST',
                        url: "/permintaan-barang/proses",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            keterangan: keterangan,
                            status: 1,
                        },
                        dataType: 'json',
                        success: function(result) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: result.message
                            }).then((result) => {
                                location.reload();
                            })
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: error.responseJSON.message
                            })
                        }
                    })
                }
            });
        });

        $('#tolak').click(function() {
            if ($('#keterangan').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Keterangan tidak boleh kosong!'
                })
                return false;
            }

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Permintaan barang akan ditolak!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#28a745',
                confirmButtonText: 'Tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    var id = $('#no_permintaan').text();
                    var keterangan = $('#keterangan').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('permintaan_barang.proses') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            keterangan: keterangan,
                            status: 2,
                        },
                        dataType: 'json',
                        success: function(result) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: result.message
                            }).then((result) => {
                                location.reload();
                            })
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: error.responseJSON.message
                            })
                        }
                    })
                }
            });
        });
    </script>
@stop
