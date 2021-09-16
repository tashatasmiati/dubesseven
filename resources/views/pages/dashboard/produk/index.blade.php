<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produk') }}
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
                    {data: 'namaproduk', name: 'namaproduk'},
                    {data: 'hargaproduk', name: 'hargaproduk'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: 'false',
                        searchable: 'false',
                        width: '25%'
                    }
                ]
            })
        </script>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-18">
                <a href="{{ route('dashboard.produk.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg" >
                    + Create Produk 
                </a>
                </div>
             <div class="shadow- overflow-hidden sm-rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                      <table id="crudTable">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Nama Produk</th>
                                <th>Harga Produk</th>
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