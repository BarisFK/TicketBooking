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
    <h1 class="h5 text-gray-800">Seferler</h1>
    <!-- DataTales Example -->
    <!-- Log on to codeastro.com for more projects -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <a href="<?= base_url('backend/sefer/tambahjadwal') ?>" class="btn btn-success pull-right">
          Sefer Ekle
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Kod</th>
                <th>Kalkış Yeri</th>
                <th>Varış Yeri</th>
                <th>Kalkış Zamanı</th>
                <th>Varış Zamanı</th>
                <th>Fiyat</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($jadwal as $row) { ?>
                <tr>
                  <td>
                    <?= $i++; ?>
                  </td>
                  <td>
                    <?= $row['kd_sefer']; ?>
                  </td>
                  <td>
                    <?= strtoupper($row['sehir_varis']); ?>
                  </td>
                  <td>
                    <?= strtoupper($row['sefer_alani']); ?>
                  </td>
                  <td>
                    <?= date('H:i', strtotime($row['kalkis_saati_sefer'])); ?>
                  </td>
                  <td>
                    <?= date('H:i', strtotime($row['varis_saati_sefer'])); ?>
                  </td>
                  <!-- <td>$<?= number_format((float) ($row['fiyat_sefer']), 0, ",", "."); ?>,-</td> -->
                  <td>
                    <?= number_format((float) ($row['fiyat_sefer']), 0, ",", "."); ?> TL
                  </td>
                  <td><a href="<?= base_url('backend/sefer/viewjadwal/' . $row['kd_sefer']) ?>"
                      class="btn btn-info">Görüntüle</a></td>
                  </td>
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
  <!-- Footer --><!-- Log on to codeastro.com for more projects -->
  <?php $this->load->view('backend/include/base_footer'); ?>
  <!-- End of Footer -->
  <!-- js -->
  <?php $this->load->view('backend/include/base_js'); ?>
</body>

</html>