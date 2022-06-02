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
                    <!-- <td>
                        @foreach($b->gambar_barang as $g)

                        @endforeach
                    </td> -->
                    
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