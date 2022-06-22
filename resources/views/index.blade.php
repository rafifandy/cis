@extends('layout/master')
@section('title','Toko')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @guest
                        {{ __('Silahkan Login/Register jika ingin memesan') }}
                    @else
                        @if(Auth::user()->role != 1)
                            {{ __('You are logged in!') }} <hr/>
                            <br/>
                            <?php $countdata = 0 ?>
                            @foreach($pelanggan as $p)
                                @if($p->email == Auth::user()->email)
                                    <?php $countdata++ ?>
                                @endif
                            @endforeach
                                @if($countdata == 0)
                                    Lengkapi data diri sebelum memesan <hr/>
                                    <form autocomplete="off" method="post" action="{{ url('/profil/store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="nama_pelanggan">Email</label>
                                            <input type="text" class="form-control" id ="e-mail" name="e-mail" value="{{ Auth::user()->email }}" disabled>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="nama_pelanggan">Username</label>
                                            <input type="text" class="form-control" id ="e-mail" name="e-mail" value="{{ Auth::user()->name }}" disabled>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id ="email" name="email" value="{{ Auth::user()->email }}"><br/>
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
                                    </br>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    </form>
                                @elseif($countdata == 1)
                                    @foreach($pelanggan as $p)
                                        @if($p->email == Auth::user()->email)
                                            Profil <hr/><br/><br/>
                                            <form autocomplete="off" method="post" action="{{ url('/profil/update/'.$p->id_pelanggan) }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <label for="nama_pelanggan">Email</label>
                                                    <input type="text" class="form-control" id ="e-mail" name="e-mail" value="{{ Auth::user()->email }}" disabled>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="nama_pelanggan">Username</label>
                                                    <input type="text" class="form-control" id ="e-mail" name="e-mail" value="{{ Auth::user()->name }}" disabled>
                                                </div>
                                            </div>
                                            <br/>
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
                                            </br>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                            </form>
                                        @endif
                                    @endforeach
                                @endif

                        @elseif(Auth::user()->role == 1)   
                            {{ __('You are logged in!') }}
                        @endif
                    @endguest
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection