@extends('layout/master')
@section('title','Pelanggan')
@section('css')
<style>
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
<body>
        
    <div class="container">
    <br/>
		<h1>Pelanggan</h1>
	<br/>
	<br/>
        <button class="badge badge-success" data-toggle="modal" data-target="#tambahModal">Tambah Data Pelanggan</button><hr/>
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
                    <th>Akun Email</th>
                    <th>Keterangan</th>
                    <th>Diperbarui</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tfoot>
                <tr style="background-color:#BDDFEE">
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Akun Email</th>
                    <th>Keterangan</th>
                    <th>Diperbarui</th>
                    <th>Opsi</th>
                </tr>
            </tfoot>
            <tbody>
            <?php $count = 0 ?>
            @foreach($pelanggan as $p)
                <tr>
                    <?php $count = $count+1 ?>
                    <td>{{$count}}</td>
                    <td>{{$p->id_pelanggan}}</td>
                    <td>{{$p->nama_pelanggan}}</td>
                    <td>{{$p->alamat_pelanggan}}</td>
                    <td>{{$p->no_telp_pelanggan}}</td>
                    <td>{{$p->email}}</td>
                    <td>{{$p->keterangan}}</td>
                    <td>{{$p->timestamp}}</td>
                    <td><button class="badge badge-info" data-toggle="modal" data-target="#editModal{{$p->id_pelanggan}}">Edit</button></td>
                </tr>
                
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{$p->id_pelanggan}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pelanggan</h5>
                            </div>
                                    <div class="modal-body">
                                    <form autocomplete="off" method="post" action="{{ url('/pelanggan/update/'.$p->id_pelanggan) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_pelanggan">Nama</label>
                                        <input type="text" class="form-control" id ="nama_pelanggan" name="nama_pelanggan" value="{{ $p->nama_pelanggan }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_pelanggan">Alamat</label>
                                        <input type="text" class="form-control" id ="alamat_pelanggan" name="alamat_pelanggan" value="{{ $p->alamat_pelanggan }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp_pelanggan">No Telp</label>
                                        <input type="text" class="form-control" id ="no_telp_pelanggan" name="no_telp_pelanggan" value="{{ $p->no_telp_pelanggan }}">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggan</h5>
            </div>
                    <div class="modal-body">
                    <form autocomplete="off" method="post" action="{{ url('/pelanggan/store') }}" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group">
                            <label for="nama_pelanggan">Nama</label>
                            <input type="text" class="form-control" id ="nama_pelanggan" name="nama_pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="alamat_pelanggan">Alamat</label>
                            <input type="text" class="form-control" id ="alamat_pelanggan" name="alamat_pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="no_telp_pelanggan">No Telp</label>
                            <input type="text" class="form-control" id ="no_telp_pelanggan" name="no_telp_pelanggan">
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
</script>
@endsection