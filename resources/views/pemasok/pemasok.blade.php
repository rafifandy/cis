@extends('layout/master')
@section('title','Pemasok')
@section('css')
@endsection
@section('content')
<body>
        
    <div class="container">
    <br/>
		<h1>Pemasok</h1>
	<br/>
	<br/>
        <button class="badge badge-success" data-toggle="modal" data-target="#tambahModal">Tambah Data Pemasok</button><hr/>
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
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Keterangan</th>
                    <th>Tgl Diperbarui</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php $count = 0 ?>
            @foreach($pemasok as $p)
                <tr>
                    <?php $count = $count+1 ?>
                    <td>{{$count}}</td>
                    <td>{{$p->id_pemasok}}</td>
                    <td>{{$p->nama_pemasok}}</td>
                    <td>{{$p->alamat_pemasok}}</td>
                    <td>{{$p->no_telp_pemasok}}</td>
                    <td>{{$p->keterangan}}</td>
                    <td>{{$p->timestamp}}</td>
                    <td><button class="badge badge-info" data-toggle="modal" data-target="#editModal{{$p->id_pemasok}}">Edit</button></td>
                </tr>
                
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{$p->id_pemasok}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pemasok</h5>
                            </div>
                                    <div class="modal-body">
                                    <form autocomplete="off" method="post" action="{{ url('/pemasok/update/'.$p->id_pemasok) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_pemasok">Nama</label>
                                        <input type="text" class="form-control" id ="nama_pemasok" name="nama_pemasok" value="{{ $p->nama_pemasok }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_pemasok">Alamat</label>
                                        <input type="text" class="form-control" id ="alamat_pemasok" name="alamat_pemasok" value="{{ $p->alamat_pemasok }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp_pemasok">No Telp</label>
                                        <input type="text" class="form-control" id ="no_telp_pemasok" name="no_telp_pemasok" value="{{ $p->no_telp_pemasok }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id ="keterangan" name="keterangan" value="{{ $p->keterangan }}">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pemasok</h5>
            </div>
                    <div class="modal-body">
                    <form autocomplete="off" method="post" action="{{ url('/pemasok/store') }}" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group">
                            <label for="nama_pemasok">Nama</label>
                            <input type="text" class="form-control" id ="nama_pemasok" name="nama_pemasok">
                        </div>
                        <div class="form-group">
                            <label for="alamat_pemasok">Alamat</label>
                            <input type="text" class="form-control" id ="alamat_pemasok" name="alamat_pemasok">
                        </div>
                        <div class="form-group">
                            <label for="no_telp_pemasok">No Telp</label>
                            <input type="text" class="form-control" id ="no_telp_pemasok" name="no_telp_pemasok">
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
</script>
@endsection