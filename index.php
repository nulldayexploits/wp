<?php include "template/top.php"; ?>

 <section class="mbr-section mbr-section-hero mbr-section-full mbr-after-navbar" id="header1-1">
        <div class="mbr-table-cell">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-6"><!-- 
                        <h5 class="mbr-section-title display-2" id="judul" style="padding-top: 120px;color:white;">Menu Rekomendasi Skincare Buat Kamu</h5> -->

                        <form action="rekomendasi.php" method="POST">
                        <br><br><br><br><br><br>
                        <input type="text" class="form-control" name="nama" placeholder="Nama kamu siapa?">
                        <br>
                        <span>Pilih dong jenis kulit mu dibawah ini:</span>
                        <br>

                        <input type="checkbox" name="NORMAL"> NORMAL
                        <input type="checkbox" name="BERMINYAK"> BERMINYAK
                        <input type="checkbox" name="KERING"> KERING
                        <input type="checkbox" name="BERJERAWAT"> BERJERAWAT
                        <input type="checkbox" name="SENSITIF"> SENSITIF<br>

                        <br>

                        <select name="usia" class="form-control">
                            <option value="">Usia Kamu Berapa?</option>
                            <option value="NULL">Terserah..</option>
                            <option value="17-20">17-20</option>
                            <option value="21-24">21-24</option>
                            <option value="25-28">25-28</option>
                            <option value="29-32">29-32</option>
                            <option value="> 32">Lebih Dari 32</option>
                        </select>
                        <br>

                        <select name="kualitas" class="form-control">
                            <option>Dari 10 - 100 kamu pilih kualitas skincare yang berapa persen sih?</option>
                            <option value="NULL">Kualitas apa ajah...</option>
                            <option value="60-70">60-70</option>
                            <option value="71-80">71-80</option>
                            <option value="81-90">81-90</option>
                            <option value="> 90">Lebih Dari 90</option>
                        </select>
                        <br>

                        <select name="harga" class="form-control">
                            <option>Pilih dong rentang harga yang kamu mau..</option>
                            <option value="NULL">Harga apa ajah...</option>
                            <option value="< 100 k">Dibawah Rp. 100.000</option>
                            <option value=">= 100 k">Diatas atau sama dengan Rp. 100.000</option>
                        </select>
                        <br>

                        <button class="btn btn-success" style="background-color: #ff69b4;border-color: white;">Minta Rekomendasi</button>

                        </form>

                        </div>

                        <div class="col-md-6 col-lg-6">
                            <img src="assets/gambar/model.png" style="padding-top:80px;">
                        </div>

                    </div>
                </div>
            </div>
          </div>
    </section>





<!-- add ijin modal -->


         <div id="main-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg"> 
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h2 class="entry-title" style="font-style: calibri; font-weight: bold;"><center>Selamat Datang!</center></h2>
                                </div>
                                <div class="modal-body">

                  <p>
                    Skincare adalah rangkaian dari berbagai penerapan yang mendukung keadaan integritas kulit, untuk meningkatkan sebuah penampilan dan mengubah kondisi kulit. Mereka dapat mengandung nutrisi, menghindari dari paparan sinar matahari yang berlebihan dan penggunaan produk kulit emolien yang tepat.
                  </p>

                  <p>
                      Struktur dan jenis kulit wajah yang dimiliki seseorang ditentukan oleh beberapa faktor, yakni:

                    <ol>
                        <li>Kandungan air pada kulit yang akan memengaruhi elastisitas kulit</li>
                        <li>Kandungan minyak yang memengaruhi kelembutan dan nutrisi kulit</li>
                        <li>Tingkat kepekaan kulit terhadap zat atau bahan tertentu</li>
                        <li>Berdasarkan ketiga faktor di atas, jenis kulit wajah dapat dibagi menjadi beberapa kategori, yaitu normal, berminyak, berjerawat, sensitif, kering dan kombinasi</li>
                    </ol>

                  </p>

                    <center>
                        <button class="btn btn-sm btn-success" id="btn_cancel_ijin" type="button" data-dismiss="modal" style="background: linear-gradient(90deg, rgba(255,0,176,1) 0%, rgba(255,0,194,1) 35%, rgba(255,0,224,1) 65%, rgba(226,0,255,1) 100%);border-color: white;"><i class="glyphicon glyphicon-ok"></i> Minta Rekomendasi</button>
                    </center>   


                                </div>
                            </div>
                        </div>
                    </div>


<!-- end add ijin modal -->



<?php include "template/bottom.php"; ?>

<script type="text/javascript">
    $( document ).ready(function() {
         $('#main-modal').modal('show');
    });
</script>