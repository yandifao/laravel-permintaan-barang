@extends('adminlte::page')

@section('css')
    <style>
        .select2-selection {
            height: 40px !important;
        }
    </style>

@section('title', 'Tambah Permintaan Barang')
@section('content_header')
    <h1>Tambah Permintaan Barang</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="nik" class="col-sm-2 col-form-label">Nik</label>
                                <select name="nik" id="nik" class="form-control select2" style="height: 150px">
                                    <option value="" disabled selected>Please Choose NIK ...</option>
                                    @foreach ($karyawan as $item)
                                        <option value="{{ $item->nik }}">{{ $item->nik . ' - ' . $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="nama" class="col-form-label">Nama</label>
                                <div class="">
                                    <input type="text" class="form-control" name="nama" id="nama" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="departemen" class="col-form-label">Departemen</label>
                                <div class="">
                                    <input type="text" class="form-control" name="departemen" id="departemen" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="tanggal" class="col-form-label">Tanggal Permintaan</label>
                                    @php
                                        $config = ['format' => 'YYYY-MM-DD HH:mm'];
                                        $date = \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d H:i');
                                    @endphp
                                    <x-adminlte-input-date name="tanggal" value="{{ $date }}" :config="$config" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer row mt-3">
                        <h4>Daftar Barang</h4>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form name="add_name" id="add_name">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="30%">Nama Barang</th>
                                                    <th>Lokasi</th>
                                                    <th>Tersedia</th>
                                                    <th>Kuantiti</th>
                                                    <th>Satuan</th>
                                                    <th>Keterangan</th>
                                                    <th>Status</th>
                                                    <th>x</th>
                                                </tr>
                                                <tbody id="list_barang">
                                                </tbody>
                                            </table>
                                            {{-- button in right --}}
                                            <div class="float-right">
                                                <button type="button" name="add" id="add"
                                                    class="btn btn-success"><i class="fas fa-plus"></i> Tambah</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- btn process and back --}}
    <div class="row mt-3" style="position: fixed; bottom: 20px; center: 0;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer">
                    <div class="float-right">
                        <a href="{{ route('permintaan-barang.index') }}" class="btn btn-secondary"><i
                                class="fas fa-arrow-left"></i> Kembali</a>
                        &nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary" onclick="saveData()"><i class="fas fa-save"></i>
                            Proses</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        // $('allways-foot').css('position', 'fixed');

        $('.select2').select2();
        $(document).ready(function() {
            $.ajax({
                url: "/permintaan-barang/getKaryawanById/{{ $nik }}",
                method: 'GET',
                success: function(data) {
                    $('#nik').val(data.nik).trigger('change');
                    $('#nama').val(data.nama);
                    $('#departemen').val(data.departemen);
                }
            });
        });


        $('#nik').change(function() {
            var nik = $(this).val();
            $.ajax({
                url: "/permintaan-barang/getKaryawanById/" + nik,
                method: 'GET',
                success: function(data) {
                    $('#nama').val(data.nama);
                    $('#departemen').val(data.departemen);
                }
            });
        });

        var i = 1;
        var badge = 'danger';
        var status = '';
        $('#add').click(function() {
            i++;
            $('#list_barang').append('<tr id="row' + i + '">' +
                '<td><select name="barang[]" id="barang_' + i +
                '" class="form-control select2" onchange="getBarang(' + i + ')">' +
                '<option value="" disabled selected>Please Choose Barang ...</option>' +
                '@foreach ($barang as $item)' +
                '<option value="{{ $item->kode_barang }}">{{ $item->kode_barang . ' - ' . $item->nama_barang }}</option>' +
                '@endforeach' +
                '</select></td>' +
                '<td><input type="text" name="lokasi[]" id="lokasi_' + i +
                '" class="form-control" disabled></td>' +
                '<td><input type="text" name="tersedia[]" id="tersedia_' + i +
                '" class="form-control" value="0" disabled></td>' +
                '<td><input type="number" name="kuantiti[]" id="kuantiti_' + i +
                '" class="form-control" onchange="getStatus(' + i + ')" onkeyup="getStatus(' + i + ')"></td>' +
                '<td><input type="text" name="satuan[]" id="satuan_' + i +
                '" class="form-control" disabled></td>' +
                '<td><input type="text" name="keterangan[]" id="keterangan_' + i +
                '" class="form-control"></td>' +
                '<td id="status_' + i + '"><span class="badge badge-' + badge + '">' + status +
                '<td><button type="button" name="remove" id="' + i +
                '" class="btn btn-danger btn_remove"><i class="fas fa-trash"></i></button></td>' +
                '</tr>');
            $('.select2').select2();
        });

        getBarang = function(i) {
            var kode_barang = $('#barang_' + i).val();
            console.log(kode_barang);
            $.ajax({
                url: "/permintaan-barang/getBarangById/" + kode_barang,
                method: 'GET',
                success: function(data) {
                    $('#lokasi_' + i).val(data.lokasi);
                    $('#tersedia_' + i).val(data.stock);
                    $('#satuan_' + i).val(data.satuan);
                }
            });
        }

        getStatus = function(i) {
            var kuantiti = $('#kuantiti_' + i).val();
            var tersedia = $('#tersedia_' + i).val();
            if (parseInt(tersedia) == 0) {
                badge = 'danger';
                status = 'Tidak Terpenuhi';
            } else if (parseInt(kuantiti) > parseInt(tersedia)) {
                badge = 'danger';
                status = 'Tidak Terpenuhi';
            } else {
                badge = 'success';
                status = 'Terpenuhi';
            }
            $('#status_' + i).html('<span class="badge badge-' + badge + '">' + status + '</span>');
        }

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        saveData = function() {
            // Validasi status
            var status = true;
            // Validasi list barang
            var listBarang = [];
            var barang = $('select[name="barang[]"]');
            var tersedia = $('input[name="tersedia[]"]');
            var kuantiti = $('input[name="kuantiti[]"]');
            var keterangan = $('input[name="keterangan[]"]');
            for (let i = 0; i < barang.length; i++) {
                if (parseInt(tersedia[i].value) == 0) {
                    status = false;
                }
                if (parseInt(kuantiti[i].value) > parseInt(tersedia[i].value)) {
                    status = false;
                } else {
                    if (barang[i].value != '' && kuantiti[i].value != '') {
                        listBarang.push({
                            kode_barang: barang[i].value,
                            kuantiti: parseInt(kuantiti[i].value),
                            keterangan: keterangan[i].value
                        });
                    }
                }
            }

            if (status && kuantiti.length > 0) {
                var data = {
                    _token: '{{ csrf_token() }}',
                    nik: $('#nik').val(),
                    tanggal: $('input[name="tanggal"]').val(),
                    barang: listBarang
                };
                $.ajax({
                    url: "/permintaan-barang/store",
                    method: 'post',
                    data: data,
                    success: function(data) {
                        if (data.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.error,
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.success,
                                // showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Status Permintaan Barang Tidak Terpenuhi',
                });
            }
        }
    </script>
@stop
