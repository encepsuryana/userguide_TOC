<!-- Generate automate Link -->
<script type="text/javascript">
	function generateLink() {
		var str = document.getElementById('feat-name').value;
		document.getElementById('feat-link').value = str = str.replace(/[&\/\\#, +()$~%!@^_,|.'":*?<>{}]/g, '-').toLowerCase();;
	}
</script>

<!-- Generate Date Now -->
<script type="text/javascript">
	var date = new Date();
	
	var tahun   = date.getFullYear();
	var bulan   = date.getMonth();
	var tanggal = date.getDate();
	var hari    = date.getDay();
	var jam     = date.getHours();
	var menit   = date.getMinutes();
	var detik   = date.getSeconds();

	switch(hari) {
		case 0: hari = "Minggu"; break;
		case 1: hari = "Senin"; break;
		case 2: hari = "Selasa"; break;
		case 3: hari = "Rabu"; break;
		case 4: hari = "Kamis"; break;
		case 5: hari = "Jum'at"; break;
		case 6: hari = "Sabtu"; break;
	}

	switch(bulan) {
		case 0:  bulan = "Januari"; break;
		case 1:  bulan = "Februari"; break;
		case 2:  bulan = "Maret"; break;
		case 3:  bulan = "April"; break;
		case 4:  bulan = "Mei"; break;
		case 5:  bulan = "Juni"; break;
		case 6:  bulan = "Juli"; break;
		case 7:  bulan = "Agustus"; break;
		case 8:  bulan = "September"; break;
		case 9:  bulan = "Oktober"; break;
		case 10: bulan = "November"; break;
		case 11: bulan = "Desember"; break;
	}

	var tampilTanggal = hari + ", " + tanggal + " " + bulan + " " + tahun;
	var tampilWaktu   = jam + ":" + menit + ":" + detik;

	var tampil = tampilTanggal + " | " + tampilWaktu;

	document.getElementById("last-update").value = tampil;
</script>

<!-- Data Action -->
<script>
	var images = document.querySelectorAll('.card-text img'),
	modal = document.querySelector('.modal');

	// Loops through the all the images selected...
	images.forEach(function (image) {
    	// When the image is clicked...
    	image.addEventListener('click', function(event) {
    		modal.innerHTML = '<div class="modal-content"><img src="' + event.target.src + '"><br><span>' + event.target.alt + '</span></div>';
    		modal.style.display = 'block';
    	});
    });

	// When the user clicks somewhere in the "modal" area it automatically closes itself
	modal.addEventListener('click', function () {
		this.style.display = 'none';
	});
</script>