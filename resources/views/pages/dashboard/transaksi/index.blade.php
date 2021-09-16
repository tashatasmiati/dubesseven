<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi') }}
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
                   // {data: 'name', name: 'name'},
                    {data: 'pesan', name: 'pesan'},
                    {data: 'pengirim', name: 'pengirim'},
                    {data: 'alamat_tujuan', name: 'alamat_tujuan'},
                    {data: 'tglkirim', name: 'tglkirim'},
                    {data: 'nohp', name: 'nohp'},
                    {data: 'total_harga', name: 'total_harga'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: 'false',
                        searchable: 'false',
                        width: '5%'
                    }
                ]
            })
        </script>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               
             <div class="shadow- overflow-hidden sm-rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                      <table id="crudTable">
                          <thead>
                              <tr>
                                <th>ID</th>
                            
                                <th>Pesan Ucapan</th>
                                <th>Instansi Pengirim</th>
                                <th>Alamat Tujuan</th>
                                <th>Tanggal Acara</th>
                                <th>Handphone</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                 </div>
            </div>
        </div>
    </div>
</x-app-layout>
