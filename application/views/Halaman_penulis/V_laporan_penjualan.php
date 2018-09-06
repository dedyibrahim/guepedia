

<?php
           $this->db->group_by('data_jumlah_penjualan.tanggal_transaksi');
           $this->db->where(array('id_account_penulis'=>$this->session->userdata('id_account')));
$tanggal = $this->db->get('data_jumlah_penjualan');

?>

<div class="container" style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   ">
<h4 align="center">Grafik Penjualan <?php echo $this->session->userdata('nama_lengkap') ?> <span class=" fa fa-pencil"></span></h4><hr>
 <div style="width:100%;">
     <canvas id="myChart" width="300" height="100"></canvas>
</div>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var options = {
animation: true,

};
var myChart = new Chart(ctx,{
type: 'bar',
data: {
labels: [<?php foreach ($tanggal->result_array()  as $hari) {

 echo json_encode($hari['tanggal_transaksi']),',';


} ?>],
datasets: [{
label: 'Bagi Hasil',
backgroundColor:"#36CAAB",
borderColor:"rgba(38, 185, 154, 0.7)",
pointBorderColor:"rgba(38, 185, 154, 0.7)",
pointBackgroundColor:"rgba(38, 185, 154, 0.7)",
pointHoverBackgroundColor:"#fff",
pointHoverBorderColor:"rgba(220,220,220,1)",
pointBorderWidth:1,
data: [<?php 
foreach ($tanggal->result_array()  as $pendapatan) {
$query = $this->db->get_where('data_jumlah_penjualan',array('tanggal_transaksi'=>$pendapatan['tanggal_transaksi'],'id_account_penulis'=>$this->session->userdata('id_account')));

$total_pendapatan = 0;
foreach($query->result_array() as  $hasil_pendapatan){
    $total_pendapatan += $hasil_pendapatan['royalti'];
}

echo $total_pendapatan,',';
}

?>],
}
],

},
 options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    callback: function(value, index, values) {
                        return 'Rp. ' + number_format(value);
                    }
                }
            }]
        },
        tooltips: {
            callbacks: {
                label: function(tooltipItem, chart){
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ':Rp. ' + number_format(tooltipItem.yLabel, 2);
                }
            }
        }
    }

}),options;
function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
</script>
</div>

<script type="text/javascript">
$(document).ready(function() {
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
return {
"iStart": oSettings._iDisplayStart,
"iEnd": oSettings.fnDisplayEnd(),
"iLength": oSettings._iDisplayLength,
"iTotal": oSettings.fnRecordsTotal(),
"iFilteredTotal": oSettings.fnRecordsDisplay(),
"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
};
};

var t = $("#data_penjualan").dataTable({
initComplete: function() {
var api = this.api();
$('#data_penjualan')
.off('.DT')
.on('keyup.DT', function(e) {
if (e.keyCode == 13) {
api.search(this.value).draw();
}
});
},
oLanguage: {
sProcessing: "loading..."
},
processing: true,
serverSide: true,
ajax: {"url": "<?php echo base_url('Halaman_penulis/json_penjualan') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_jumlah_penjualan",
"orderable": false
},
{"data": "no_invoices"},
{"data": "nama_customer"},
{"data": "tanggal_transaksi"},
{"data": "status_penjualan"},
{"data": "view"},


],
order: [[1, 'desc']],
rowCallback: function(row, data, iDisplayIndex) {
var info = this.fnPagingInfo();
var page = info.iPage;
var length = info.iLength;
var index = page * length + (iDisplayIndex + 1);
$('td:eq(0)', row).html(index);
}
});
});


</script>    
<div class="container" style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   " >
<h4 align="center"> Data Seluruh Penjualan </h4><hr>

<table id="data_penjualan" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >No Invoices</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Customer</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Tanggal Transaksi</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Status penjualan</th>
<th style="width: 15%;" align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>

</div>
