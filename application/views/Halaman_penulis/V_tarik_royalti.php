<div class="container mt-2">
    <div class="row">
        <div class="col-md-6 card p-2">
            <label>Nama Pemilik Rekening :</label>
            <input type="text" class="form-control">
            <label>Nomor Rekening:</label>
            <input type="text" class="form-control">
            <label>Nama Bank :</label>
            <select class="form-control nama_bank">
             <option value="1">Bank Central Asia (BCA)</option>    
             <option value="2">Bank Mandiri</option>    
             <option value="3">Bank Negara Indonesia (BNI)</option>    
             <option value="4">Bank Rakyat Indonesia (BRI)</option>    
             <option value="5">Bank Tabungan Negara (BTN)</option>    
             <option value="6">Bank BRI Agroniaga</option>    
             <option value="7">Bank Anda</option>    
             <option value="8">Bank Artha Graha Internasional</option>    
             <option value="9">Bank Bukopin</option>    
             <option value="10">Bank Bumi Arta</option>    
             <option value="11">Bank Capital Indonesia</option>    
             <option value="12">Bank CIMB Niaga</option>    
             <option value="13">Bank Danamon Indonesia</option>    
             <option value="14">Bank Ekonomi Raharja</option>    
             <option value="15">Bank Ganesha</option>    
             <option value="16">Bank KEB Hana</option>    
             <option value="18">Bank Woori Saudara</option>    
             <option value="19">Bank ICBC Indonesia</option>    
             <option value="20">Bank Index Selindo</option>    
             <option value="21">Bank Maybank Indonesia</option>    
             <option value="22">Bank Maspion</option>    
             <option value="23">Bank Mayapada</option>    
             <option value="24">Bank Mega</option>
             <option value="25">Bank Mestika Dharma</option>    
             <option value="26">Bank Shinhan Indonesia</option>    
             <option value="27">Bank MNC Internasional</option>    
             <option value="28">Bank J Trust Indonesia</option>    
             <option value="29">Bank Nusantara Parahyangan</option>    
             <option value="30">Bank OCBC NISP</option>    
             <option value="31">Bank of India Indonesia</option>    
             <option value="32">Panin Bank</option>    
             <option value="33">Bank Permata</option>    
             <option value="34">Bank QNB Indonesia</option>    
             <option value="35">Bank SBI Indonesia</option>    
             <option value="36">Bank UOB Indonesia</option>    
             <option value="37">Amar Bank Indonesia</option>    
             <option value="38">Bank Andara</option>    
             <option value="39">Bank Artos Indonesia</option>    
             <option value="40">Bank Bisnis Internasional</option>    
             <option value="41">Bank Tabungan Pensiunan Nasional</option>    
             <option value="42">Bank Sahabat Sampoerna</option>    
             <option value="43">Bank Fama Internasional</option>    
             <option value="44">Bank Harda Internasional</option>    
             <option value="45">Bank Mayora</option>    
             <option value="46">Bank Mitraniaga</option>    
             <option value="47">Bank Multi Arta Sentosa</option>    
             <option value="48">Bank Pundi Indonesia</option>    
             <option value="49">Bank Royal Indonesia</option>    
             <option value="50">Bank Mandiri Taspen Pos</option>    
             <option value="51">Bank Yudha Bhakti</option>    
             <option value="52">Bank Jambi</option>    
             <option value="53">Bank Bengkulu</option>    
             <option value="54">Bank Sumsel Babel</option>    
             <option value="55">Bank Lampung</option>    
             <option value="56">Bank DKI</option>    
             <option value="57">Bank BJB</option>    
             <option value="58">Bank Jateng</option>    
             <option value="59">Bank BPD DIY</option>    
             <option value="60">Bank Jatim</option>    
             <option value="61">Bank ANZ Indonesia</option>    
             <option value="62">Bank Commonwealth</option>    
             <option value="62">Bank Agris</option>    
             <option value="63">Bank Capital Indonesia</option>    
             <option value="64">Bank Rabobank International Indonesia</option>    
             <option value="65">Citibank</option>    
             <option value="66">HSBC</option>    
             <option value="67">Bank Mega Syariah</option>    
             <option value="68">Bank Muamalat Indonesia</option>    
             <option value="69">Bank Syariah Mandiri</option>    
             <option value="70">BCA Syariah</option>    
             <option value="71">Bank BJB Syariah</option>    
             <option value="72">Bank BRI Syariah</option>    
             <option value="73">Panin Bank Syariah</option>    
             <option value="74">Bank Syariah Bukopin</option>    
             <option value="75">Bank Victoria Syariah</option>    
             <option value="76">BTPN Syariah</option>    
             <option value="77">Bank Maybank Syariah Indonesia</option>    
             <option value="78">Bank BTN Syariah</option>    
             <option value="79">Bank Danamon Syariah</option>    
             <option value="80">CIMB Niaga Syariah</option>    
             <option value="81">BII Syariah</option>    
             <option value="82">OCBC NISP Syariah</option>    
             <option value="83">Bank Permata Syariah</option>    
             <option value="84">Bank DKI Syariah</option>    
             <option value="85">Bank Kalbar Syariah</option>    
             <option value="86">Bank Kalsel Syariah</option>    
             <option value="87">Bank NTB Syariah</option>    
             <option value="88">Bank Riau Kepri Syariah</option>    
             <option value="89">Bank Sumsel Babel Syariah</option>    
             <option value="90">Bank Syariah Mandiri</option>    
          </select>
        </div>  
    </div>   
</div>

<script type="text/javascript">
$(document).ready(function() {
   $('.nama_bank').select2({
    theme: "bootstrap"
});
});

</script>
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

var t = $("#data_transfer").dataTable({
initComplete: function() {
var api = this.api();
$('#data_transfer')
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
ajax: {"url": "<?php echo base_url('Halaman_penulis/json_transfer_royalti') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_account",
"orderable": false
},
{"data": "nama_lengkap"},
{"data": "nomor_kontak"},
{"data": "email"},
{"data": "royalti"},
{"data": "biaya_admin"},
{"data": "royalti_bersih"},
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
<div class="container card p-2 mt-2 mb-2" >
<h4 align="center"> Data Transferan Bagi Hasil</h4><hr>

<table id="data_transfer" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Lengkap</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nomor Kontak</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Email</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Bagi hasil</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Admin</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Bagi Hasil Bersih</th>
<th style="width: 15%;" align="center"     aria-controls="datatable-fixed-header"  >Bukti Transfer</th>
</thead>
<tbody align="center">
</table>

</div>
<script type="text/javascript">
 function download_bukti(data){
 window.location="<?php echo base_url('Halaman_penulis/download_bukti/')?>"+data;
    
 }
 
</script>    