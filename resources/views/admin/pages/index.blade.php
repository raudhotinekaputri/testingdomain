@extends('adminlte::page')

@section('title', 'Kelola Halaman')

@section('content_header')
    <h1>Kelola Halaman</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pilih Halaman untuk Dikelola</h3>
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('admin.acaras.index') }}">Kelola Acara</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('admin.umkms.index') }}">Kelola UMKM</a>
            </li>
            <li class="liAst-group-item">
                <a href="{{ route('admin.produks.index') }}">Kelola Produk</a> 
            </li>
        </ul>
    </div>
</div>
@stop
