<?php include "template/top.php"; ?>

 <section class="mbr-section mbr-section-hero mbr-section-full mbr-after-navbar" id="header1-1">
        <div class="mbr-table-cell">
            <div class="container-fluid">
                <div class="row">
                    <div class="mbr-section-full col-md-12 col-lg-11">
                        <h5 class="mbr-section-title display-2" id="judul" style="padding-top: 120px;">Menu Rekomendasi Skincare Buat Kamu</h5>

                        <form action="rekomendasi.php" method="POST">
                        
                        <input type="text" class="form-control" name="nama" placeholder="Nama kamu siapa?" style="width:35%;">
                        <br>
                        <span>Pilih dong jenis kulit mu dibawah ini:</span>
                        <br>

                        <input type="checkbox" name="NORMAL"> NORMAL
                        <input type="checkbox" name="BERMINYAK"> BERMINYAK
                        <input type="checkbox" name="KERING"> KERING
                        <input type="checkbox" name="BERJERAWAT"> BERJERAWAT
                        <input type="checkbox" name="SENSITIF"> SENSITIF<br>

                        <br>

                        <select name="usia" class="form-control" style="width:35%;">
                            <option value="">Usia Kamu Berapa?</option>
                            <option value="NULL">Terserah..</option>
                            <option value="16-20">16-20</option>
                            <option value="21-24">21-24</option>
                            <option value="25-28">25-28</option>
                            <option value="29-32">29-32</option>
                            <option value="> 32">Lebih Dari 32</option>
                        </select>
                        <br>

                        <select name="kualitas" class="form-control" style="width:35%;">
                            <option>Dari 10 - 100 kamu pilih kualitas skincare yang berapa persen sih?</option>
                            <option value="NULL">Kualitas apa ajah...</option>
                            <option value="10-49">10-49</option>
                            <option value="50-70">50-70</option>
                            <option value="71-80">71-80</option>
                            <option value="81-90">81-90</option>
                            <option value="> 90">Lebih Dari 90</option>
                        </select>
                        <br>

                        <select name="harga" class="form-control" style="width:35%;">
                            <option>Pilih dong rentang harga yang kamu mau..</option>
                            <option value="NULL">Harga apa ajah...</option>
                            <option value="< 100 k">Dibawah Rp. 100.000</option>
                            <option value=">= 100 k">Diatas atau sama dengan Rp. 100.000</option>
                        </select>
                        <br>

                        <button class="btn btn-success" style="background-color: #ff69b4;border-color: #ff69b4;">Minta Rekomendasi</button>

                        </form>

                        </div>
                    </div>
                </div>
            </div>
          </div>
    </section>



<?php include "template/bottom.php"; ?>