<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>
    <?= $title ?>
  </title>
  <!-- css -->
  <?php $this->load->view('backend/include/base_css'); ?>
</head>

<body id="page-top">
  <!-- navbar -->
  <?php $this->load->view('backend/include/base_nav'); ?>
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- DataTales Example -->
    <!-- Log on to codeastro.com for more projects -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h1 class="h5 text-gray-800">Rezervasyonlar</h1>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Kod</th>
                <th>Sefer Kodu</th>
                <th>Kalkış Tarihi</th>
                <th>Müşteri</th>
                <th>Satış Tarihi</th>
                <th>Bilet Adedi</th>
                <th>Durum</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($order as $row) { ?>
                <tr>
                  <td>
                    <?= $i++; ?>
                  </td>
                  <td>
                    <?= $row['kd_siparis']; ?>
                  </td>
                  <td>
                    <?= $row['kd_sefer']; ?>
                  </td>
                  <td>
                    <?= hari_indo(date('N', strtotime($row['tarih_kalkis_siparis']))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $row['tarih_kalkis_siparis'] . ''))); ?>
                  </td>
                  <td>
                    <?= $row['isim_siparis']; ?>
                  </td>
                  <td>
                    <?= $row['tarih_alis_siparis']; ?>
                  </td>
                  <?php $sqlcek = $this->db->query("SELECT * FROM siparis WHERE kd_siparis LIKE '" . $row['kd_siparis'] . "'")->result_array(); ?>
                  <td>
                    <?= count($sqlcek); ?>
                  </td>
                  <?php if ($row['durum_siparis'] == '1') { ?>
                    <td class="btn-danger"> Ödenmedi</td>
                  <?php } elseif ($row['durum_siparis'] == '2') { ?>
                    <td class="btn-success"> Ödendi</td>
                  <?php } else { ?>
                    <td class="btn-warning"> İptal Edildi</td>
                  <?php } ?>
                  <td><a href="<?= base_url('backend/siparis/vieworder/' . $row['kd_siparis']) ?>"
                      class="btn btn btn-info">Görüntüle</a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.container-fluid -->
  </div>
  <!-- End of Main Content -->
  <!-- Footer -->
  <?php $this->load->view('backend/include/base_footer'); ?>
  <!-- End of Footer -->
  </div>
  <!-- End of Content Wrapper -->
  </div><!-- Log on to codeastro.com for more projects -->
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- js -->
  <?php $this->load->view('backend/include/base_js'); ?>
</body>

</html>