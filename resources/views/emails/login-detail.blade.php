Hello <b>{{ $amil->nama }}</b>,

<p>Akun amil Anda berhasil dibuat.</p>

<p>Gunakan data login berikut untuk mengakses akun Anda.</p>

<table>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td>{{ $amil->email }}</td>
    </tr>
    <tr>
        <td>Password</td>
        <td>:</td>
        <td>{{ $amil->native_password }}</td>
    </tr>
</table>

<p>Rahasiakan data login akun Anda untuk menghindari hal-hal yang tidak diinginkan.</p>

<a href="{{ url('/') }}">Klik disini untuk login</a>

<p>Terima kasih</p>

{{ strtoupper(config('app.name')) }}