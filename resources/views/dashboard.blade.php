@extends('layouts.master')

@section('title', $title)

@section('content')
<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-12 col-md-4">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Donasi Bulan Desember</span>
            <div>
                <span class="info-box-number mb-2">Rp 10.000.000</span>
                <span class="text-success">20 Donasi</span>
            </div>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-12 col-md-4">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Pengeluaran Bulan Desember</span>
            <div>
                <span class="info-box-number mb-2">Rp 5.000.000</span>
                <span class="text-danger">10 Pengeluaran</span>
            </div>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-12 col-md-4">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-dollar-sign"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Saldo Bulan Desember</span>
            <span class="info-box-number">Rp 5.000.000</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
  
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <div class="col-md-12">
    <!-- TABLE: TODAY'S DONATION -->
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Donasi Hari Ini</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
                <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jenis Donasi</th>
                <th>Metode Bayar</th>
                <th>Nominal</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><a href="#">Hamba Allah</a></td>
                    <td>Wakaf Tanah</td>
                    <td>Tunai</td>
                    <td>Rp 250.000.000</td>
                    <td>
                        <button class="btn btn-sm btn-warning"><i class="fa fa-print"></i> Cetak</button>
                    </td>
                </tr>
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Input Donasi Baru</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">Tutup Buku</a>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection()