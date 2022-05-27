@extends('layouts.backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-light">
                            <tbody>
                                <tr>
                                    <td width="90">Nama</td>
                                    <td width="10">:</td>
                                    <td>{{ $order?->user->name }}</td>
                                </tr>
                                <tr>
                                    <td width="90">No Telp</td>
                                    <td width="10">:</td>
                                    <td>{{ $order?->user->phone }}</td>
                                </tr>
                                <tr>
                                    <td width="90">Email</td>
                                    <td width="10">:</td>
                                    <td>{{ $order?->user->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('admin.transaksi.bayar', Crypt::encrypt($order?->id)) }}"
                            class="btn btn-primary float-right"><i class="fas fa-money-bill-wave mr-2"></i> Bayar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="row flex-column align-items-center">
                            <span>No Antrian :</span>
                            <span style="font-size: 50px;">{{ $order?->no_antrian }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-between align-items-center" style="width: 100%;">
                            <button class="btn btn-danger">Lewat</button>
                            <a href="{{ route('admin.transaksi.next', Crypt::encrypt($order?->id)) }}"
                                class="btn btn-primary">Next</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="product" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($order->products))
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img style='border-radius: 10px;' src="{{ $product->photo }}"
                                                    height="100" />
                                            </td>
                                            <td>{{ $product->nama }}</td>
                                            <td>Rp. {{ numberFormat($product->harga) }}</td>
                                            <td>{{ $product->pivot->qty }}</td>
                                            <td>Rp. {{ numberFormat($product->pivot->qty * $product->harga) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('layouts.includes.datatables')
@include('layouts.includes.toastr')
@push('script')
    <script>
        $(function() {
            $("#product").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#payment_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
{{-- @push('script')
    <script type="text/javascript">
        var table;
        setTimeout(function() {
            tableProduct();
        }, 500);
        var ajaxError = function(jqXHR, xhr, textStatus, errorThrow, exception) {
            if (jqXHR.status === 0) {
                toastr.error('Not connect.\n Verify Network.', 'Error!');
            } else if (jqXHR.status == 400) {
                toastr.warning(jqXHR['responseJSON'].message, 'Peringatan!');
            } else if (jqXHR.status == 404) {
                toastr.error('Requested page not found. [404]', 'Error!');
            } else if (jqXHR.status == 500) {
                toastr.error('Internal Server Error [500].' + jqXHR['responseJSON'].message, 'Error!');
            } else if (exception === 'parsererror') {
                toastr.error('Requested JSON parse failed.', 'Error!');
            } else if (exception === 'timeout') {
                toastr.error('Time out error.', 'Error!');
            } else if (exception === 'abort') {
                toastr.error('Ajax request aborted.', 'Error!');
            } else {
                toastr.error('Uncaught Error.\n' + jqXHR.responseText, 'Error!');
            }
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        // function to retrieve DataTable server side
        function tableProduct() {
            $('#product').dataTable().fnDestroy();
            table = $('#product').DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('api.products.index') }}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        "name": "photo",
                        "data": "photo",
                        "render": function(data, type, full, meta) {
                            return "<img style='border-radius: 10px;' src=\"" + data +
                                "\" height=\"100\"/>";
                        },
                        "title": "Image",
                        "orderable": true,
                        "searchable": true
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        "render": function(data, type, full, meta) {
                            return formatRupiah(String(data), 'Rp. ');
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                pageLength: 10,
                lengthMenu: [
                    [10, 20, 50, -1],
                    [10, 20, 50, 'All']
                ]
            });
        }

        // delete
        $('body').on('click', '.delete', function(e) {
            e.preventDefault();
            deleteProduct($(this).attr('id'))
        });

        function deleteProduct(id) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Category akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Sekarang!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/api/products/" + id + "/destroy",
                        type: 'DELETE',
                        success: function(resp) {
                            toastr.success(resp.message, 'Berhasil!');
                            table.ajax.reload();
                        },
                        error: ajaxError,
                    });
                }
            })
        }
    </script>
@endpush --}}
