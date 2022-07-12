@extends('/layout/master')
@section('title','Barang')
@section('css')
<style>
    td{
        font-size: 16px;
    }
    /* col search */
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    tfoot {
        display: table-header-group;
    }
</style>
@endsection
@section('content')
@guest
    <script>window.location = "/guest/barang";</script>
@else
    @if(Auth::user()->role != 1)
        <script>window.location = "/customer/barang";</script>
    @elseif(Auth::user()->role == 1)   
<body>
    <div class="container">
        
        <br/>
            <h1>Barang</h1>
            <!-- @include('/barang/kategori_btn') -->
        <br/>
        <hr/>
        <button class="badge badge-success" data-toggle="modal" data-target="#tambahModal">Tambah Data Barang</button><hr/>
        @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
        @endif
	    <table id="t" class="display cell-border">
            <thead>
                <tr style="background-color:#BDDFFF">
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Updated at</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tfoot>
                <tr style="background-color:#BDDFEE">
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Updated at</th>
                    <th>Opsi</th>
                </tr>
            </tfoot>
            <tbody>
            <?php $count = 0 ?>
            @foreach($barang as $b)
                <tr>
                    <?php $count = $count+1 ?>
                    <td>{{$count}}</td>
                    <td>{{$b->id_barang}}</td>
                    <td>{{$b->nama_barang}}</td>
                    <td>
                        
                        <?php $jmlg = 0 ?>
                        @foreach($gambar as $gb)
                            @if($b->id_barang == $gb->id_barang)
                            @if($jmlg == 0)
                            <img src="{{ asset('storage/'.$gb->foto_barang) }}" data-toggle="modal" data-target="#view1Modal{{$gb->id_gambar}}" style='height: 100px; width: 100px; object-fit: contain'>
                            <div class="modal fade" style="text-align: center" id="view1Modal{{$gb->id_gambar}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="max-width: 100%; width: auto; max-height: 100%; height: auto; display: inline-block" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                        <a href="{{ asset('storage/'.$gb->foto_barang) }}" download><img src="{{ asset('storage/'.$gb->foto_barang) }}" style='height: 800px; width: 800px; object-fit: contain'></a>
                                        </div>
                                        </br>
                                        <div class="modal-footer">
                                            <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $jmlg++ ?>
                            @endif
                            @endif
                        @endforeach
                        <hr/>
                        <button class="badge badge-info" data-toggle="modal" data-target="#modalGambar{{$b->id_barang}}" style="width:80px;margin:5px">More..</button>
                        
                        <div class="modal fade" id="modalGambar{{$b->id_barang}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $b->id_barang }} -  Gambar</h5>
                                    </div>
                                    <div class="modal-body">
                                        <button class="badge badge-success" data-dismiss="modal" data-toggle="modal" data-target="#tambahModalGambar{{$b->id_barang}}" style="width:80px;margin:5px">Tambah</button><hr/>
                                        <table id="t">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Gambar</th>
                                                    <th>Timestamp</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $countgg = 0 ?>
                                            @foreach($gambar as $gb)
                                            @if($gb->id_barang == $b->id_barang)
                                            <tr>
                                                <?php $countgg = $countgg+1 ?>
                                                <td>{{$countgg}}</td>
                                                <td><img src="{{ asset('storage/'.$gb->foto_barang) }}" data-toggle="modal" data-target="#view2Modal{{$gb->id_gambar}}" style='height: 100px; width: 100px; object-fit: contain'></td>
                                                <div class="modal fade" style="text-align: center" id="view2Modal{{$gb->id_gambar}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" style="max-width: 100%; width: auto; max-height: 100%; height: auto; display: inline-block" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                        <a href="{{ asset('storage/'.$gb->foto_barang) }}" download><img src="{{ asset('storage/'.$gb->foto_barang) }}" style='height: 800px; width: 800px; object-fit: contain'></a>
                                                        </div>
                                                        </br>
                                                        <div class="modal-footer">
                                                            <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <td>{{ $gb->timestamp }}</td>
                                                <td><button class="badge badge-info" data-toggle="modal" data-target="#editModalGambar{{$gb->id_gambar}}">Edit</button></td>
                                                
                                                <?php //$total += ($b->pivot->total_harga_barang) ?>
                                            </tr>
                                            <!-- Modal Edit Gambar -->
                                            <div class="modal fade" id="editModalGambar{{$gb->id_gambar}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{$gb->id_barang}}  -  Edit Gambar</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form autocomplete="off" method="post" action="{{ url('/barang/gambar/update/'.$b->id_barang.'/'.$gb->id_gambar) }}" enctype="multipart/form-data">
                                                            @csrf
                                                                <!-- <input type="hidden" class="form-control" id ="id_barang" name="id_barang" value="{{ $b->id_barang }}"> -->
                                                            <div class="form-group">
                                                                <label for="foto_barang">Upload Foto Barang</label><br/>
                                                                <input type="file" id="foto_barang" onchange="readURL2(this);" name="foto_barang" accept=".jpg, .jpeg, .png">
                                                                <img id="blah2" src="http://placehold.it/1" style='height: 150px; width: 150px; object-fit: contain' alt="your image" />
                                                            </div>
                                                        </div>
                                                        </br>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </br>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Tambah Gambar -->
                        <div class="modal fade" id="tambahModalGambar{{$b->id_barang}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $b->id_barang }} - Tambah Gambar</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form autocomplete="off" method="post" action="{{ url('/barang/gambar/store/'.$b->id_barang) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="foto_barang">Upload Foto Barang</label><br/>
                                            <input type="file" id="foto_barang" onchange="readURL(this);" name="foto_barang" accept=".jpg, .jpeg, .png">
                                            <img id="blah" src="http://placehold.it/1" style='height: 150px; width: 150px; object-fit: contain' alt="your image" />
                                        </div>
                                    </div>
                                    </br>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    </td>
                    
                        <!-- @if($b->foto_barang == null)
                        <td></td>
                        @else
                        <td><a href="{{ asset('storage/'.$b->foto_barang) }}" download><img src="{{ asset('storage/'.$b->foto_barang) }}" style='height: 100px; width: 100px; object-fit: contain'></a></td>
                        @endif -->
                        @if($b->harga_beli == null)
                        <td>{{$b->harga_beli}}</td>
                        @else
                        <td style="text-align:right">{{number_format($b->harga_beli)}}</td>
                        @endif
                        @if($b->harga_jual == null)
                        <td>{{$b->harga_jual}}</td>
                        @else
                        <td style="text-align:right">{{number_format($b->harga_jual)}}</td>
                        @endif

                    <td>{{$b->stok}}</td>
                    <td>{{$b->kategori->nama_kategori}}</td>
                    <td>{{$b->keterangan}}</td>
                    <td>{{$b->timestamp}}</td>
                    <td><button class="badge badge-info" data-toggle="modal" data-target="#editModal{{$b->id_barang}}">Edit</button></td>
                </tr>
                
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{$b->id_barang}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
                            </div>
                                    <div class="modal-body">
                                    <form autocomplete="off" method="post" action="{{ url('/barang/update/'.$b->id_barang) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang</label>
                                        <input type="text" class="form-control" id ="nama_barang" name="nama_barang" value="{{ $b->nama_barang }}">
                                    </div>
                                    @if($k == 0 )
                                    <div class="form-group">
                                        <label for="id_pelanggan">ID Kategori</label>
                                        <input type="text" class="form-control" name="id_kategori" id ="id_kategori" list="kategori2" value="{{ $b->id_kategori }}">
                                        <datalist id="kategori2">
                                            @foreach($kategori_barang as $ktg)
                                            <option value="{{$ktg->id_kategori}}">{{$ktg->nama_kategori}}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="harga_beli">Harga Beli</label>
                                        <input type="number" class="form-control" id ="harga_beli" name="harga_beli" value="{{ $b->harga_beli }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_jual">Harga Jual</label>
                                        <input type="number" class="form-control" id ="harga_jual" name="harga_jual" value="{{ $b->harga_jual }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <input type="number" class="form-control" id ="stok" name="stok" value="{{ $b->stok }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id ="keterangan" name="keterangan" value="{{ $b->keterangan }}">
                                    </div>
                                    </div>
                                    </br>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" >Submit</button>
                                    </form>
                                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
	</div>
</body>
<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
            </div>
                    <div class="modal-body">
                    <form autocomplete="off" method="post" action="{{ url('/barang/store') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id ="nama_barang" name="nama_barang">
                      </div>
                    @if($k == 0)
                      <div class="form-group">
                        <label for="id_kategori">ID Kategori</label>
                        <input type="text" class="form-control" name="id_kategori" id ="id_kategori" list="kategori">
                        <datalist id="kategori">
                            @foreach($kategori_barang as $ktg)
                            <option value="{{$ktg->id_kategori}}">{{$ktg->nama_kategori}}</option>
                            @endforeach
                        </datalist>
                      </div>
                    @else
                    <input type="hidden" class="form-control" id ="id_kategori" name="id_kategori" value="{{ $k }}">
                    @endif
                      <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" class="form-control" id ="harga_beli" name="harga_beli">
                      </div>
                      <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" id ="harga_jual" name="harga_jual">
                      </div>
                      <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id ="stok" name="stok" >
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id ="keterangan" name="keterangan">
                      </div>
                    </div>
                    </br>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
        </div>
    </div>
</div>
<!-- onclick="return confirm('text')" -->
    @endif
@endguest
@endsection
@section('script')
<script type="text/javascript">

    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#t tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
    
        // DataTable
        var table = $('#t').DataTable({
            //dom: 'Bfrtip',
            //buttons: ['excel'],
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            initComplete: function () {
                // Apply the search
                this.api()
                    .columns()
                    .every(function () {
                        var that = this;
    
                        $('input', this.footer()).on('keyup change clear', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
            },
        });
    });   

    // input img preview
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (a) {
                $('#blah2')
                    .attr('src', a.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection