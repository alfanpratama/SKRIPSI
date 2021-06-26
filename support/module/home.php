<?php
$namaBln = array("1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni", 
					 "7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
include ("../inc/koneksi.php"); 
include ("../inc/fungsi_hdt");  ?>

<br/>
<div style="margin-right:10%;margin-left:15%" class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<p><i class="icon fa fa-info"></i>
Welcome <?php echo $_SESSION['nama']; ?>! &nbsp;&nbsp;
Anda berada di halaman "Support Marketing"
</p>
</div>  

 
<?php
#include ("../inc/fungsi_hdt"); 
 $sql = "SELECT acc, COUNT( id_barang ) AS setuju FROM  detail_pesanan GROUP BY acc";	
 $hasil = mysql_query($sql);
?>
 
      <!--script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
      <script src="http://code.highcharts.com/highcharts.js"></script>
      <script src="http://code.highcharts.com/modules/exporting.js"></script-->
	  
    <script src="module/js/highcharts.js"></script>
    <script src="module/js/exporting.js"></script>
<div class="row">
<div class="col-md-6">
<div class="box box-success">
<div class="box-header with-border">
  <h3 class="box-title">Data Barang Yang Disetujui (Y) Dan Tidak Disetujui (N)</h3>
  <div class="box-tools pull-right">
	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>
<div class="box-body">
	<script type="text/javascript">
       $(function () {
		   
    $('#bola').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false,
        },
        title: {
            text: 'Monitoring Data Barang '
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'CV Amoeba Biosintesa',
            data: [
			<?php			
			while($data=mysql_fetch_array($hasil))
			{ ?>
                ['<?php echo $data['acc']?>',   <?php echo $data['setuju']?>],               
		   <?php
		   }//end while
		   ?>
            ]
        }]
    });
});   
    </script>
   <div id="bola" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>                  

</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
<div class="col-md-6">
<div class="box box-success">
<div class="box-header with-border">
  <h3 class="box-title">Data Pendapatan Sales</h3>
  <div class="box-tools pull-right">
	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>
<div class="box-body">
<script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column'
         },   
         title: {
            text: 'Grafik Pendapatan per Sales '
         },
         xAxis: {
            categories: ['Sales']
         },
         yAxis: {
            title: {
               text: 'Jumlah Pendapatan'
            }
         },
              series:             
            [
            <?php 
        	include('koneksi.php');
           // $sql   = "SELECT nm_lokasi  FROM lokasi_krj";
           //  $query = mysql_query( $sql )  or die(mysql_error());
           //  while( $ret = mysql_fetch_array( $query ) ){
           //  	$merek=$ret['nm_lokasi'];                     
           //       $sql_jumlah   = "SELECT nm_lokasi, COUNT( nip ) AS qty FROM  sk_krj a, lokasi_krj b where a.id_lokasi=b.id_lokasi and status_sk='aktif' and nm_lokasi='$merek' GROUP BY nm_lokasi";        
           //       $query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
           //       while( $data = mysql_fetch_array( $query_jumlah ) ){
           //          $jumlah = $data['qty']; 
                   

            $sql   = "SELECT nama  FROM user";
            $query = mysql_query( $sql )  or die(mysql_error());
            while( $ret = mysql_fetch_array( $query ) ){
              $merek=$ret['nama'];          
              $merek2=$ret['id_user'];           
                 $sql_jumlah   = "SELECT nama, sum(subtotal) AS jumlah from detail_pesanan a, user b where a.id_user=b.id_user and acc='Y' and nama = '$merek' GROUP BY nama ";        
                 $query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
                 while( $data = mysql_fetch_array( $query_jumlah ) ){
                    $jumlah = $data['jumlah'];                
                  }             
                  ?>
                  {
                      name: '<?php echo $merek; ?>',
                      data: [<?php echo $jumlah; ?>]
                  },
                  <?php } ?>
            ]
      });
   });	
</script>
<div id='container'></div>		
</div></div>
</div> 
<div class="col-md-6">
<div class="box box-success">
<div class="box-header with-border">
  <h3 class="box-title">Data Monitoring Pengeluaran Surat Penawaran </h3>
  <div class="box-tools pull-right">
	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>
<div class="box-body">
<script type="text/javascript">
		//2)script untuk membuat grafik, perhatikan setiap komentar agar paham
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'xxx', //letakan grafik di div id container
				//Type grafik, anda bisa ganti menjadi area,bar,column dan bar
                type: 'line',  
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Monitoring Surat Penawaran ',
                x: -20 //center
            },
            subtitle: {
                text: 'CV. Amoeba Biosintesa',
                x: -20
            },
            xAxis: { //X axis menampilkan data tahun 
                categories: [<?php 
				include"koneksi.php";
     //   SELECT nama, sum(subtotal) AS jumlah from detail_pesanan a, user b where a.id_user=b.id_user and acc='Y' and nama = '$merek' GROUP BY nama 
				$sql = mysql_query("select MONTH(tgl_prospek) as bln from pesanan group by bln ");
while ($k = mysql_fetch_array($sql)) { 
				echo "'";echo $namaBln[$k['bln']];echo "', ";
				}?> ]
            },
            yAxis: {
                title: {  //label yAxis
                    text: 'Jumlah Penawaran'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080' //warna dari grafik line
                }]
            },
            tooltip: { 
			//fungsi tooltip, ini opsional, kegunaan dari fungsi ini 
			//akan menampikan data di titik tertentu di grafik saat mouseover
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y ;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
			//series adalah data yang akan dibuatkan grafiknya,
			//saat ini mungkin anda heran, buat apa label indonesia dikanan 
			//grafik, namun fungsi label ini sangat bermanfaat jika
			//kita menggambarkan dua atau lebih grafik dalam satu chart,
			//hah, emang bisa? ya jelas bisa dong, lihat tutorial selanjutnya 
            series: [{  
                name: 'Penawaran',  
				//data yang akan ditampilkan 
                data: [<?php 				
				$sq = mysql_query("select COUNT(id_user) as id_user, MONTH(tgl_prospek)as bln from pesanan group by bln ");
while ($q = mysql_fetch_array($sq)) { 
				echo $q['id_user'];echo ", ";
				}?>]
            }]
        });
    });
    
});
		</script>
<div id="xxx" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
</div></div>
</div>

<div class="col-md-6">
<div class="box box-success">
<div class="box-header with-border">
  <h3 class="box-title">Data Pendapatan Bulanan</h3>
  <div class="box-tools pull-right">
	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>
<div class="box-body">
<script type="text/javascript">
		//2)script untuk membuat grafik, perhatikan setiap komentar agar paham
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'yyy', //letakan grafik di div id container
				//Type grafik, anda bisa ganti menjadi area,bar,column dan bar
                type: 'column',  
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Monitoring Pendapatan Bulanan',
                x: -20 //center
            },
            subtitle: {
                text: 'CV. Amoeba Biosintesa',
                x: -20
            },
            xAxis: { //X axis menampilkan data tahun 
                categories: [<?php 				
				$sql = mysql_query("select month(tgl_prospek) as bln from pesanan group by bln ");
while ($k = mysql_fetch_array($sql)) { 
				echo "'";echo $namaBln[$k['bln']];echo "', ";
				}?> ]
            },
            yAxis: {
                title: {  //label yAxis
                    text: 'Jumlah Pendapatan(perbulan)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080' //warna dari grafik line
                }]
            },
            tooltip: { 
			//fungsi tooltip, ini opsional, kegunaan dari fungsi ini 
			//akan menampikan data di titik tertentu di grafik saat mouseover
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y ;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
			//series adalah data yang akan dibuatkan grafiknya,
			//saat ini mungkin anda heran, buat apa label indonesia dikanan 
			//grafik, namun fungsi label ini sangat bermanfaat jika
			//kita menggambarkan dua atau lebih grafik dalam satu chart,
			//hah, emang bisa? ya jelas bisa dong, lihat tutorial selanjutnya 
            series: [{  
                name: 'Pendapatan',  
                name: 'Pendapatan',  
				//data yang akan ditampilkan 
                data: [<?php 				
				$sq = mysql_query("select a.no_surat,b.no_surat, sum(b.subtotal) as total, month(a.tgl_prospek)as bln from pesanan a, detail_pesanan b where a.no_surat-b.no_surat group by bln ");
while ($q = mysql_fetch_array($sq)) { 
				echo $q['total'];echo ", ";

				}?>]
            }]
        });
    });
    
});
		</script>
<div id="yyy" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
</div></div>
</div></div>