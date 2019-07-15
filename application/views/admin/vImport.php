<?php include APPPATH .'views/admin/include/header.php' ?>

<div class="container">
    <h3>Mechanizm importowania plików .csv [SL] do bazy na potrzeby AJD </h3>
    <hr>
    <form action="cImport/upload" method="POST" ENCTYPE="multipart/form-data">
        <div class="form-group text-center">
            <div class="card">
                <div class="card-header">
                    Wybierz plik .csv
                </div>
                <div class="card-body">
                    <select name="raport" id="raport">
                        <option value="1_1">1.1</option>
                        <option value="1_2">1.2</option>
                        <option value="1_3">1.3</option>
                        <option value="1_4">1.4</option>
                        <option value="1_8">1.8</option>
                    </select>
                    <input type="file" name="plik"/>  <button type="submit" class="btn btn-primary">Wczytaj plik</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <h3>Historia importowanych plików</h3>
        <table class="table">
            <thead>
            <th>L.p</th>
            <th>Raport</th>
            <th>Data</th>
            <th>Nazwa pliku</th>
            <th>Rozmiar pliku</th>
            </thead>
            <tbody>

<?php include APPPATH .'views/admin/include/footer.php' ?>
