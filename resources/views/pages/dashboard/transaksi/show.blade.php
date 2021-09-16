<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaksi &raquo; #{{$transaksi->id}} {{$transaksi->users_id}}
        </h2>
    </x-slot>
 
    <x-slot name="script">
        <script>
            //AJAK DataTable

            var datatable = $('#crudTable').DataTable({
                ajax: {
                    
                    url: '{!! url()->current() !!}'
                },
                columns: [
                    {data: 'id', name: 'id', width: '5x'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'produk.namaproduk', name: 'produk.namaproduk'},
                    {data: 'produk.hargaproduk', name: 'produk.hargaproduk'},
                    {data: 'alamat_tujuan', name: 'alamat_tujuan'},
                  
                ]
            })
        </script>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">Detail Transaksi</h2>
        
        <div class="bg-white overflow-hidden shadow sm:rounded-lg mb-10">
            <div class="p-6 bg-white border-b border-gray-200">
                <table class="table-auto w-full">
                    <tbody>
                        <tr>
                            <th class="border px-6 py-4 text-right">Name</th>
                            <td class="border px-6 py-4">{{ $transaksi->name }}</td>
                        </tr>
                        <tr>
                            <th class="border px-6 py-4 text-right">Pesan Ucapan</th>
                            <td class="border px-6 py-4">{{ $transaksi->pesan }}</td>
                        </tr>
                        <tr>
                            <th class="border px-6 py-4 text-right">Nama Instansi/Pengirim</th>
                            <td class="border px-6 py-4">{{ $transaksi->pengirim }}</td>
                        </tr>
                        <tr>
                            <th class="border px-6 py-4 text-right">Alamat Pengiriman</th>
                            <td class="border px-6 py-4">{{ $transaksi->alamat_tujuan }}</td>
                        </tr>
                        <tr>
                            <th class="border px-6 py-4 text-right">Tanggal Acara</th>
                            <td class="border px-6 py-4">{{ $transaksi->tglkirim }}</td>
                        </tr>
                        <tr>
                            <th class="border px-6 py-4 text-right">Handphone/Whatsapp</th>
                            <td class="border px-6 py-4">{{ $transaksi->nohp }}</td>
                        </tr>
                        <tr>
                            <th class="border px-6 py-4 text-right">Payment</th>
                            <td class="border px-6 py-4">{{ $transaksi->payment }}</td>
                        </tr>
                        <tr>
                            <th class="border px-6 py-4 text-right">Payment Url</th>
                            <td class="border px-6 py-4">{{ $transaksi->payment_url }}</td>
                        </tr>
                        <tr>
                            <th class="border px-6 py-4 text-right">Total Harga</th>
                            <td class="border px-6 py-4">{{ number_format ($transaksi->total_harga) }}</td>
                        </tr>
                        <tr>
                            <th class="border px-6 py-4 text-right">Status</th>
                            <td class="border px-6 py-4">{{ $transaksi->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">Item Transaksi</h2>
             <div class="shadow- overflow-hidden sm-rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                      <table id="crudTable">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Produk</th>
                                <th>Harga</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                 </div>
            </div>
        </div>
    </div>
</x-app-layout>
