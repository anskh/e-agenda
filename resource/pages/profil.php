<div class="content-header">
    <h4 class="content-title ~mx-auto">Profil</h4>
</div>
<div class="content-body row">
    <div class="card col-xl-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped lh-lg">
                    <thead class="table-light">
                        <th class="text-center">Atribut</th>
                        <th class="text-center" colspan="2">Nilai</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td><?= $data['username'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $data['nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            <td><?= $data['role'] ?></td>
                        </tr>
                        <tr>
                            <td>Fungsi</td>
                            <td>:</td>
                            <td><?= $data['fungsi'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>