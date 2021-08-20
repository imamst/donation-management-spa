<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>No Kwitansi Donasi {{ $donasi->no_kwitansi }}</title>
</head>
<body style="height: 283.465pt;width: 496.063pt;padding: 56.692pt;font-size: 10pt;position: relative;">
	<div style="width: inherit;position: absolute;top: 50%;transform: translateY(-50%);">
		<p style="text-align: right;margin-right: 56.693pt;">Depok, {{ $tanggal }}</p>
	
		<table>
			<tbody>
				<tr>
					<td>No. Kwitansi</td>
					<td width="14.173pt">:</td>
					<td>{{ $donasi->no_kwitansi }}</td>
				</tr>
				<tr>
					<td>Telah terima dari</td>
					<td width="14.173pt">:</td>
					<td>{{ $donasi->nama_donatur }}</td>
				</tr>
				<tr style="vertical-align: top;">
					<td>Alamat</td>
					<td>:</td>
					<td>{{ $donasi->alamat_donatur }}</td>
				</tr>
				<tr>
					<td>Jenis Transaksi</td>
					<td>:</td>
					<td>{{ $donasi->metode_donasi }}</td>
				</tr>
				<tr>
					<td>Untuk keperluan/pembayaran</td>
					<td>:</td>
					<td>{{ $donasi->nama_jenis_donasi }}</td>
				</tr>
				@if($donasi->metode_donasi != "Barang")
				<tr>
					<td>Nominal</td>
					<td>:</td>
					<td>Rp {{ $donasi->nominal_rupiah }}</td>
				</tr>
				@endif
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td>{{ $donasi->keterangan }}</td>
				</tr>
			</tbody>
		</table>

		<div style="width: 100%;margin-top: 28.346pt">
			<div style="text-align: center;display: inline-block;width: 50%;">
				<p style="margin-bottom: 21.259pt;">Yang menyerahkan</p>
				<p>( {{ $donasi->nama_donatur }} )</p>
			</div>
			<div style="text-align: center;display: inline-block;width: 48%;">
				<p style="margin-bottom: 21.259pt;">Penerima</p>
				<p>( {!! Auth::user()->nama !!} )</p>
			</div>
		</div>
	</div>
</body>
</html>