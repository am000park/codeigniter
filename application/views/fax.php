<div id="file_wrap" class="modal">
	<h1>Mobile fax</h1>
	<div id="fax_img">
		<img src="<?php echo base_url('statis/img/fax_icon.png') ?>" alt="fax 아이콘">
	</div>
	<div>
		<form name="faxSendForm" id="faxSendForm">
			<input type="hidden" name="ssIdx" id="ssIdx" value="<?php echo $ss_idx; ?>">
			<input type="file" name="file" id="input_file" multiple>
			<button type="button" id="sel_fax" class="btn">사진/문서 첨부</button>
		</form>
	</div>
	<div>
		<ul id="file_lists"></ul>
	</div>
</div>

<button type="button" id="fax_send" class="btn">팩스 발송</button>

<script type="text/javascript">
window.addEventListener("load", function() {

	var fileLists = [];
	
	// 파일 추가
	function fileListsAdd() {
		var file_lists = document.getElementById("file_lists");
		var inputFile = document.getElementById("input_file");

		var file = Array.prototype.slice.call(inputFile.files);

		fileLists.push(file[0]);

		var create_li = document.createElement("li");
		create_li.innerText = file[0].name;

		file_lists.appendChild(create_li);

		file_lists.style.display = "block";

		console.log(fileLists);
	}

	// 파일 업로드
	function fileUpload(file) {

		console.log(file);
		/*
		var formData = new FormData();
		
		formData.append("file", file);

		$.ajax({
			url: 'index.php/fax/fax_send',
			type: 'post',
			dataType: 'json',
			enctype: 'multipart/form-data',
			data: fileLists
		}).done(function() {
		});
		*/
	}

	document.getElementById("sel_fax").addEventListener("click", function(){
		if(fileLists.length >= 5) {
			alert("파일은 최대 5개까지 등록이 가능합니다.");
			return;
		}

		document.getElementById("input_file").click();
		
	});

	document.getElementById("input_file").addEventListener("change", function() {
		fileListsAdd();
	});
	
	// fax 전송
	document.getElementById("fax_send").addEventListener("click", function() {
		
		for(var i=0; i<fileLists.length; i++) {
			fileUpload(fileLists[i]);
		}

	});

});
</script>