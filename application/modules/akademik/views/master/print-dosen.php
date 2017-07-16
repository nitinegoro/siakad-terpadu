<!DOCTYPE html>
<html>
   <head>
      <title><?php echo $title; ?></title>
      <style>
         body { font-family:'Arial Narrow';  }
         table { font-size:12px; font-family:'Arial Narrow'; }
         .header { width:100%; height:10%; font-weight:500;  }
         .big-title {  font-family:'Arial Narrow'; font-size:xx-large; letter-spacing:3px; word-spacing: 10px; font-weight:bold; }
         .small-title {  font-family:'Arial'; font-size:7px; letter-spacing:normal; text-transform: uppercase; }
         .content { font-size:11px; font-family:'Arial Narrow'; margin-top:20px;}
         .upper { text-transform: uppercase;  }
         .underline { text-decoration: underline; }
         .bold { font-weight:bold; }
         .text-center { text-align: center; }
         table.mini-font { font-size: 10px; }
         table.gridtable { border-width: 0; border-color: #757572; border-collapse: collapse; }
         table.gridtable th {  border-width: 0.1px; padding: 4px; border-style: solid; border-color: #757572; text-transform: none; }
         table.gridtable td { border-width: 0.1px; border-top: 0px; padding: 4px 3px 5px 3px; border-style: solid; border-color: #757572; }
         table.kop tr { line-height: 50% }
         table.kop { margin-top: -5px; }
         h5 { margin: 10px; }
        .wrapper {
            background-image: url(<?php echo base_url("assets/img/logo_watermark.png"); ?>);
            background-repeat: no-repeat;
           /*  background-attachment: fixed; */
            background-position: center; 
            page-break-inside: avoid;
            height: 800px;
        }
         @media all {
         .watermark {
         display: none;
         background-image: url(<?php echo base_url("assets/img/logo_kop.png"); ?>);
         float: right;
         }
         .pagebreak {
         display: none;
         }
         }
         @media print {
         .watermark {
         display: block;
         }
         .pagebreak {
            display: block;
            page-break-after: always;
         }
         }
        /*  @page { size: 'A4'; } */
         @media print {
         table {page-break-inside: avoid;}
         }
      </style>
   </head>
   <body>
      <!--  onload="window.print()" -->
      <div class="table">
         <div class="header">
            <img style="float: left; padding-right: 10px;" src="<?php echo base_url("assets/img/logo_kop.png") ?>" alt="">
            <strong class="big-title">STIE PERTIBA PANGKALPINANAG</strong>
            <table class="kop">
               <tr style="padding-top: 0px;">
                  <td class="small-title" width="115">program sarjana (S1)</td>
                  <td width="10" style="text-align: center;" class="small-title">:</td>
                  <td class="small-title" style="vertical-align: top; line-height: 150%">izin penyelenggara surat dirjen dikti kemendikbud r.i NO..12176/D/T/K-II/2012 tanggal 05 Juni 2012 Terakeditasi "B" SK.BAT-PT KEMNDIKBUD R.I N0. 020/BAN/BAN-PT/Ak-XV/S1/VII/2012 Tanggal 12 Juli 2012</td>
               </tr>
               <tr style="padding-top: 0px;">
                  <td class="small-title">program pascasarjana (S2)</td>
                  <td width="10" style="text-align: center;" class="small-title">:</td>
                  <td class="small-title" style="vertical-align: top; line-height: none">Terakeditasi "C" SK. BAN-PT KEMINDIKBUD R.I No. 169/SK/BAN-PT/AKRED/M/VI/2014 Tanggal 6 Juni 2014</td>
               </tr>
               <tr style="padding-top: 0px;">
                  <td class="small-title">Alamat</td>
                  <td width="10" style="text-align: center;" class="small-title">:</td>
                  <td class="small-title" style="vertical-align: top; line-height: none">JL. Adyaksa No. 9 Pangkalpinang - Bangka Belitung Telp. (0717) 423374 FAX.(0717) 439289</td>
               </tr>
               <tr style="padding-top: 0px;">
                  <td colspan="3" style="font-size: 7px;"><span>E-Mail : <span style="color: blue">stie_pertiba@yahoo.co.id</span></span> <span style="padding-left: 20px;">Website : <span style="color: blue">http://www.stiepertiba.ac.id</span></span></td>
               </tr>
            </table>
         </div>
         <hr style="width: 100%;">
      </div>
    <div class="wrapper">
      <h5 class="upper text-center"><?php echo $title; ?></h5>
      <table class="gridtable mini-font" width="100%">
        <thead>
            <tr>
                <th>No. </th>
                <th>Kode Dosen</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            /**
             * Start Loop Data Dosen
             *
             * @var string
             **/
            $number = ($this->input->get('page') != '') ? $this->input->get('page') : 1;
            foreach($data_dosen as $row) :
            ?>
            <tr>
                <td class="text-center"><?php echo $number++; ?>.</td>
                <td class="text-center"><?php echo $row->lecturer_code; ?></td>
                <td> <?php echo $row->name; ?>  <br> <?php echo $row->nidn; ?></td>
                <td class="text-center"><?php echo $row->address; ?></td>
                <td class="text-center"><?php echo $row->phone; ?></td>
                <td class="text-center"><?php echo data_status($row->status); ?></td>
            </tr>
            <?php 
            // End
            endforeach;
            ?>
        </tbody>
      </table>

          
      </div>
      <div class="pagebreak"></div>
    </div>
   </body>
</html>