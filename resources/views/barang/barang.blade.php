@extends('layout/master')
@section('title','Barang')
@section('css')
<style>
    td{
        font-size: 16px;
    }
</style>
@endsection
@section('content')
<body>
	
	
    <div class="container">
        
        <br/>
            <h1>Barang</h1>
            @include('barang/kategori_btn')
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
                    <th>Keterangan</th>
                    <th>Diperbarui</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php $count = 0 ?>
            @foreach($barang as $b)
                <tr>
                    <?php $count = $count+1 ?>
                    <td>{{$count}}</td>
                    <td>{{$b->id_barang}}</td>
                    <td>{{$b->nama_barang}}</td>
                    <td>
                        
                        <?php $countg = 0 ?>
                        @foreach($b->gambar_barang as $g)
                            <?php $countgb = $countgb+1 ?>
                        @endforeach
                        @foreach($b->gambar_barang as $g)
                            @if($countgb > 0 and $g->id_gambar == 1)
                            <a href="{{ asset('storage/'.$g->foto_barang) }}" download><img src="{{ asset('storage/'.$g->foto_barang) }}" style='height: 100px; width: 100px; object-fit: contain'></a>
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
                                        <button class="badge badge-success" data-dismiss="modal" data-toggle="modal" data-target="#tambahModalDetail{{$p->id_penjualan}}" style="width:80px;margin:5px">Tambah</button><hr/>
                                        <table id="t">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Subtotal</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $countgg = 0 ?>
                                            @foreach($p->barang as $b)
                                            <tr>
                                                <?php $countgg = $countgg+1 ?>
                                                <td>{{$countgg}}</td>
                                                <td>{{ $b->nama_barang }}</td>
                                                <td>{{ $b->pivot->jumlah_barang }}</td>
                                                <td>{{ number_format($b->pivot->harga_barang) }}</td>
                                                <td>{{ number_format($b->pivot->total_harga_barang) }}</td>
                                                <td><button class="badge badge-info" data-toggle="modal" data-target="#editModalDetail{{$p->id_penjualan}}_{{$b->id_barang}}">Edit</button></td>
                                                <!-- <li>{{ $b->pivot->jumlah_barang }} | {{ $b->nama_barang }} | {{ number_format($b->pivot->harga_barang) }} | {{ number_format($b->pivot->jumlah_barang * $b->pivot->harga_barang) }}</li> -->
                                                <?php //$total += ($b->pivot->total_harga_barang) ?>
                                            </tr>
                                            <!-- Modal Edit Detail -->
                                            <div class="modal fade" id="editModalDetail{{$p->id_penjualan}}_{{$b->id_barang}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_penjualan }} - {{$b->id_barang}}  -  Edit Barang</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form autocomplete="off" method="post" action="{{ url('/penjualan/detail/update/'.$p->id_penjualan.'/'.$b->id_barang) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <input type="hidden" class="form-control" id ="id_penjualan" name="id_penjualan" value="{{ $p->id_penjualan }}">
                                                                <input type="hidden" class="form-control" id ="status" name="status" value="{{ $p->status + 1}}">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="view">Barang</label>
                                                                        <input type="text" class="form-control" id ="view" name="view" value="{{$b->id_barang}} - {{$b->nama_barang}}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="stok_barang">Stok</label>
                                                                        <input type="number" class="form-control" id ="stok_be" name="stok_e" value="{{$b->stok}}" disabled>
                                                                        <input type="number" class="form-control" id ="stok_barange" name="stok_barange" value="{{$b->stok}}" hidden>
                                                                        <input type="number" class="form-control" id ="stok_jumlah" name="stok_jumlah" value="{{ $b->pivot->jumlah_barang }}" hidden>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="harga_barang">Harga</label>
                                                                        <input type="number" class="form-control" id ="harga_barang" name="harga_barang" value="{{ $b->pivot->harga_barang }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="jumlah_barang">Jumlah</label>
                                                                        <input type="number" class="form-control" id ="jumlah_barang" name="jumlah_barang" value="{{ $b->pivot->jumlah_barang }}">
                                                                    </div>
                                                                </div>
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
                    </td>
                    </td>
                    
                        @if($b->foto_barang == null)
                        <td></td>
                        @else
                        <td><a href="{{ asset('storage/'.$b->foto_barang) }}" download><img src="{{ asset('storage/'.$b->foto_barang) }}" style='height: 100px; width: 100px; object-fit: contain'></a></td>
                        @endif
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
                                        <label for="foto_barang">Upload Foto Barang</label><br/>
                                        <input type="file" id="foto_barang" onchange="readURL2(this);" name="foto_barang" accept=".jpg, .jpeg, .png">
                                        <img id="blah2" src="http://placehold.it/1" style='height: 150px; width: 150px; object-fit: contain' alt="your image" />
                                    </div>
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
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                        <label for="foto_barang">Upload Foto Barang</label><br/>
						<input type="file" id="foto_barang" onchange="readURL(this);" name="foto_barang" accept=".jpg, .jpeg, .png">
                        <img id="blah" src="http://placehold.it/1" style='height: 150px; width: 150px; object-fit: contain' alt="your image" />
					  </div>
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
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready( function () {
        $('#t').DataTable();
    } );
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