@extends('layouts.admin')
@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="container">
    <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">

        <div class="col-md-4">
            <div class="ibox">
                <div class="ibox-head text-white" style="background-color:#374f65 !important">
                    <div class="ibox-title">AmarPay Payment Gateway</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('admin.amarpay.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $amarpay->id }}">
                        <div class="form-group">
                            <label class="">StoreId</label>
                            <input type="text" class="form-control" name="store_id" value="{{ $amarpay->store_id }}">
                        </div>
                        <div class="form-group">
                            <label> Signature KEY</label>
                            <input class="form-control" name="signature_key" value="{{ $amarpay->signature_key }}" type="text">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="amarpayckeckbox" name="status" value="1" @if($amarpay->status==1) checked @endif >
                            <label for="amarpayckeckbox"> LIVE</label> <br>
                            <small>if checkbox are not check it work for sendbox</small>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <button class="btn btn-info float-right" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox">
                <div class="ibox-head text-white" style="background-color:#374f65 !important">
                    <div class="ibox-title">Surjopay Payment Gateway</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('admin.surjopay.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $surjopay->id }}">
                        <div class="form-group">
                            <label class="">StoreId</label>
                            <input type="text" class="form-control" name="store_id" value="{{ $surjopay->store_id }}">
                        </div>
                        <div class="form-group">
                            <label> Signature KEY</label>
                            <input class="form-control" name="signature_key" value="{{ $surjopay->signature_key }}" type="text">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="surjopayckeckbox" name="status" value="1" @if($surjopay->status==1) checked @endif >
                            <label for="surjopayckeckbox"> LIVE</label> <br>
                            <small>(if checkbox are not checked it work for sendbox)</small>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <button class="btn btn-info float-right" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox">
                <div class="ibox-head text-white" style="background-color:#374f65 !important">
                    <div class="ibox-title">SSL Commerz Payment G.</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="">StoreId</label>
                            <input type="text" class="form-control" name="store_id" value="{{ $ssl->store_id }}">
                        </div>
                        <div class="form-group">
                            <label> Signature KEY</label>
                            <input class="form-control" name="signature_key" value="{{ $ssl->signature_key }}" type="text">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="sslckeckbox" name="status" value="1" @if($ssl->status==1) checked @endif >
                            <label for="sslckeckbox"> LIVE</label> <br>
                            <small>if checkbox are not check it work for sendbox</small>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <button class="btn btn-info float-right" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
