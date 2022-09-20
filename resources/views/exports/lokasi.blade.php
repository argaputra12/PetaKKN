<table>
    <thead>
        <tr>
            <th>Kelompok</th>
            <th>Desa</th>
            <th>Kecamatan</th>
            <th>Kota</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lokasi as $l)
        <tr>
            <td>{{ $l->kelompok->identitas_kelompok }}</td>
            <td>{{ $l->desa->nama_desa }}</td>
            <td>{{ $l->desa->nama_kecamatan }}</td>
            <td>{{ $l->desa->kota->nama }}</td>
            <td>{{ $l->kelompok->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
