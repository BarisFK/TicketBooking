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
  <!-- Log on to codeastro.com for more projects -->
  <div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h1 class="h5 text-gray-800">Satılan Biletler</h1>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Bilet Kodu</th>
                <th>İsim </th>
                <th>Koltuk </th>
                <th>Alış yeri</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($tiket as $row) { ?>
                <tr>
                  <td>
                    <?= $i++; ?>
                  </td>
                  <td>
                    <?= $row['kd_bilet']; ?>
                  </td>
                  <td>
                    <?= $row['isim_bilet']; ?>
                  </td>
                  <td>
                    <?= $row['koltuk_bilet']; ?>
                  </td>
                  <td>
                    <?= strtoupper($row['olusturma_tarih_bilet']); ?>
                  </td>
                  <td><a href="<?= base_url('backend/bilet/view_bilet/' . $row['kd_bilet']) ?>"
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
  </div><!-- Log on to codeastro.com for more projects -->
  <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- js -->
  <?php $this->load->view('backend/include/base_js'); ?>
</body>

</html>