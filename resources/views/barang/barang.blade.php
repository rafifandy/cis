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
	<center>
        <br/>
		<h1>Barang</h1>
	</center>
	<br/>
	<br/>
    <div class="container">
        <button class="badge badge-success" data-toggle="modal" data-target="#tambahModal">Tambah Data Barang</button><hr/>
        @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
        @endif
	    <table id="t" class="display cell-border">
            <thead>
                <tr style="background-color:#BDDFFF">
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Harga Sementara</th>
                    <th>Keterangan</th>
                    <th>Diperbarui</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($barang as $b)
                <tr>
                    <td>{{$b->id_barang}}</td>
                    <td>{{$b->nama_barang}}</td>
                    @if($b->foto_barang == null)
                    <td></td>
                    @else
                    <td><img src="{{ asset('storage/'.$b->foto_barang) }}" style='height: 100px; width: 100px; object-fit: contain'></td>
                    @endif
                    @if($b->harga_sementara == null)
                    <td>{{$b->harga_sementara}}</td>
                    @else
                    <td style="text-align:right">{{number_format($b->harga_sementara)}}</td>
                    @endif
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
                                    <div class="form-group">
                                        <label for="foto_barang">Upload Foto Barang</label><br/>
                                        <input type="file" id="foto_barang" onchange="readURL2(this);" name="foto_barang" accept=".jpg, .jpeg, .png">
                                        <img id="blah2" src="http://placehold.it/1" style='height: 150px; width: 150px; object-fit: contain' alt="your image" />
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_sementara">Harga Sementara</label>
                                        <input type="number" class="form-control" id ="harga_sementara" name="harga_sementara" value="{{ $b->harga_sementara }}">
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
                      <div class="form-group">
                        <label for="foto_barang">Upload Foto Barang</label><br/>
						<input type="file" id="foto_barang" onchange="readURL(this);" name="foto_barang" accept=".jpg, .jpeg, .png">
                        <img id="blah" src="http://placehold.it/1" style='height: 150px; width: 150px; object-fit: contain' alt="your image" />
					  </div>
                      <div class="form-group">
                        <label for="harga_sementara">Harga Sementara</label>
                        <input type="number" class="form-control" id ="harga_sementara" name="harga_sementara">
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