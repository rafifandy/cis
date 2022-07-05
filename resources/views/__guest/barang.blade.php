@extends('/layout/master')
@section('title','Barang')
@section('css')
<style>
    td{
        font-size: 16px;
    }
</style>
@endsection
@section('content')
@guest
<body>
    <div class="container">
        
        <br/>
            <h1>Barang</h1>
            @include('/barang/kategori_btn')
        <br/>
        <hr/>
        @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
        @endif
	    <table id="t" class="display cell-border">
            <thead>
                <tr style="background-color:#BDDFFF">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
            <?php $count = 0 ?>
            @foreach($barang as $b)
                <tr>
                    <?php $count = $count+1 ?>
                    <td>{{$count}}</td>
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
                                        <img src="{{ asset('storage/'.$gb->foto_barang) }}" style='height: 800px; width: 800px; object-fit: contain'>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Gambar</h5>
                                    </div>
                                    <div class="modal-body">
                                        <table id="t">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Gambar</th>
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
                                                        <img src="{{ asset('storage/'.$gb->foto_barang) }}" style='height: 800px; width: 800px; object-fit: contain'>
                                                        </div>
                                                        </br>
                                                        <div class="modal-footer">
                                                            <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                <?php //$total += ($b->pivot->total_harga_barang) ?>
                                            </tr>
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
                    </td>
                    </td>
                    
                        <!-- @if($b->foto_barang == null)
                        <td></td>
                        @else
                        <td><a href="{{ asset('storage/'.$b->foto_barang) }}" download><img src="{{ asset('storage/'.$b->foto_barang) }}" style='height: 100px; width: 100px; object-fit: contain'></a></td>
                        @endif -->
                    <td>{{$b->keterangan}}</td>
                </tr>
                
                
            @endforeach
            </tbody>
        </table>
	</div>
</body>

@else
    @if(Auth::user()->role != 1)
        <script>window.location = "/customer/barang";</script>
    @elseif(Auth::user()->role == 1)   
        <script>window.location = "/barang";</script>
    @endif
@endguest
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