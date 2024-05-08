<!doctype html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <!-- Log on to codeastro.com for more projects -->
    <title>E-Ticket(
        <?php echo $cetak[0]['kd_siparis']; ?>)
    </title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>
    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }

        img {
            float: left;
            padding-right: 10px;
        }
    </style>
</head>

<body onload="window.print()">
    <table width="100%">
        <tr>
            <td valign="top"><img src="<?php echo base_url($cetak[0]['qrcode_order']) ?>" alt="" width="200" /></td>
            <td align="right">
                <h1>E-TICKET</h1>
                <pre>
                <b><span style='font-size:15px'>Bilet Detayları </span></b>
                </br>
                Rezervason Kodu : <?php echo $cetak[0]['kd_siparis']; ?></br>
                Sefer kodu : <?php echo $cetak[0]['kd_sefer']; ?></br>
                Tarih : <?php echo $cetak[0]['tarih_alis_siparis']; ?></br>
                Müşteri : <?php echo $cetak[0]['isim_siparis']; ?></br>
                Sefer : <?php echo hari_indo(date('N', strtotime($cetak[0]['tarih_kalkis_siparis']))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $cetak[0]['tarih_kalkis_siparis'] . ''))); ?><br>
                Kalkış Tarihi : <?php echo date('H:i', strtotime($cetak[0]['kalkis_saati_sefer'])) . ' To ' . date('H:i', strtotime($cetak[0]['jam_tiba_jadwal'])) ?>
                Kalkış Yeri : <?php echo strtoupper($asal['sehir_varis']); ?></br>
                Varış Yeri : <?php echo strtoupper($cetak[0]['sehir_varis']); ?>
            </pre>
            </td>
        </tr>
    </table>
    <br />
    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>Ticket No.</th>
                <th>Passenger</th>
                <th>Age </th>
                <th>Seat</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cetak as $row) { ?>
                <tr>
                    <td scope="row">
                        <?php echo $row['kd_bilet']; ?>
                    </td>
                    <td align="left">
                        <?php echo $row['isim_koltuk_siparis']; ?>
                    </td>
                    <td align="center">
                        <?php echo $row['yas_koltuk_siparis']; ?> Years
                    </td>
                    <td align="center">
                        <?php echo $row['no_koltuk_siparis']; ?>
                    </td>
                    <td align="left">
                        <?php echo '$' . number_format(($row['fiyat_sefer'])); ?>
                    </td>
                <tr>
                <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td align="right">Total</td>
                <td align="right" class="gray">
                    <?php $total = count($cetak) * $cetak[0]['fiyat_sefer'];
                    echo '$' . number_format(($total)); ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <div id="container">
        <h1>Terms and Conditions</h1>

        <div id="body">
            <ol type="1">
                <li>BTBS * ONLY bus ticket agents. It does not operate the bus service itself. In order to provide a
                    comprehensive choice of bus operators, departure times and prices for customers, it has tied up with
                    many bus operators.
                    BTBS advice to customers is to choose a bus operator they know from and whose service they are
                    comfortable with.</li>
                <li>The departure time stated on the ticket is only a tentative time. However, the bus will not leave
                    the source before the time stated on the ticket. Passengers are required to provide the following
                    when boarding the bus:
                    (1) Copy of ticket (Print ticket or print ticket email).
                    (2) Valid proof of identity Failing to do so, they may not be allowed to board the bus.</li>
                <li>BTBS responsibilities include:
                    (1) Issue a valid ticket (ticket to be accepted by the bus operator) for its bus operator network
                    (2) Provide refund and support in case of cancellation
                    (3) Provide customer support and information in case of delays / hassles
                    Change bus: If the bus operator changes the bus type for some reason, BTBS will refund the
                    differential amount to the customer after being intimidated by the customer within 24 hours of
                    travel.</li>
                <li>BTBS's liability does NOT include:
                    (1) Bus operator bus does not leave/reach on time
                    (2) The seat of the bus operator etc does not fit the customer
                    hope
                    (3) Customer's baggage lost/stolen/damaged
                    (4) The bus operator changes the boarding point and/or uses the pick-up
                    If someone needs a refund to be credited back to their bank account, please
                    write your cash coupon details to support@btbs.web</li>
            </ol>
        </div>
    </div>

</body>

</html>