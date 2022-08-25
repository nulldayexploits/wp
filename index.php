<?php include "template/top.php"; ?>

 <section class="mbr-section mbr-section-hero mbr-section-full mbr-after-navbar" id="header1-1">
        <div class="mbr-table-cell">
            <div class="container-fluid">
                <div class="row">
                    <div class="mbr-section-full col-md-12 col-lg-11">
                        <h5 class="mbr-section-title display-2" id="judul" style="padding-top: 120px;">Menu Rekomendasi Skincare Buat Kamu</h5>

                        <input type="text" name="nama" placeholder="Nama kamu siapa?">
                        <br>
                        <span>Pilih dong jenis kulit mu dibawah ini:</span>
                        <br><br>

                        <select name="jenis_kulit" class="fonr-control">
                            <option>Jenis Kulit Kamu?</option>
                        </select>
                        <br><br>

                        <select name="usia" class="fonr-control">
                            <option>Usia Kamu Berapa?</option>
                        </select>
                        <br><br>

                        <select name="kualitas" class="fonr-control">
                            <option>Dari 10 - 100 kamu pilih kualitas skincare yang berapa persen sih?</option>
                        </select>
                        <br><br>

                        <select name="harga" class="fonr-control">
                            <option>Pilih dong rentang harga yang kamu mau..</option>
                        </select>
                        <br><br>

                        <button class="btn btn-success">Minta Rekomendasi</button>

                        </div>
                    </div>
                </div>
            </div>
          </div>
    </section>



<?php include "template/bottom.php"; ?>