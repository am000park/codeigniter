<div id="sms_acc_wrap" class="modal">
    <h1>SMS 문자 인증</h1>
    <form name="smsAcc" id="smsAcc" method="post" action="<?php echo base_url('index.php/fax'); ?>">
        <input type="text" name="phone" id="phone" class="frm_input full_input" pattern="\d*" placeholder="핸드폰번호">
        <button type="button" id="sms_send" class="btn">문자 전송</button>
        <div id="sms_number_box">
            <input type="text" name="acc_number" id="acc_number" class="frm_input full_input" pattern="\d*" placeholder="인증번호">
            <button type="button" id="sms_chk" class="btn">인증</button>
        </div>
    </form>
</div>
<?php //echo site_url(); ?>
<script type="text/javascript">
    window.addEventListener("load", function() {
        
        var smsBtn = document.getElementById("sms_send");
        var smsChk = document.getElementById("sms_chk");

        smsBtn.addEventListener("click", function() {
            var phone = document.getElementById("phone");

            if(phone.value == '') {
                alert("핸드폰 번호를 입력해주세요.");
                phone.focus();
            }

            var data = {
                'phone': phone.value
            }

            smsBtn.style.display = "none";
            
            $.ajax({
                url: 'index.php/sms/send',
                type: 'post',
                dataType: 'json',
                cache: false,
                async: false,
                data: data
            }).done(function(res) {
                console.log(res);
                if(res.status == "error") {
                    alert(res.message);
                    return;
                }

                phone.setAttribute("readonly", "readonly");
                document.getElementById("sms_number_box").style.display = "block";
                alert("인증번호가 전송되었습니다.");

            });
            
            
            // var xhr = new XMLHttpRequest();

            // xhr.onreadystatechange = function() {
            //     if(this.readyState == 4 && this.status == 200) {
                    
            //         document.getElementById("sms_number_box").style.display = "block";
            //         alert("문자가 전송되었습니다.");
            //     }
            // }

            // xhr.open("POST", "index.php/sms/send", true);
            // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            // xhr.send(JSON.stringify(data));
            
        });


        smsChk.addEventListener("click", function() {
            var acc_number = document.getElementById("acc_number");

            if(acc_number.value == '') {
                alert("인증번호를 입력해주세요.");
                acc_number.focus();
                return;
            }

            $.ajax({
                url: 'index.php/sms/access',
                type: 'post',
                dataType: 'json',
                cache: false,
                async: false,
                data: { 'acc_number': acc_number.value }
            }).done(function(res) {
                if(res.status != 'success') {
                    alert(res.message);
                    return;
                }

                alert("인증되었습니다.");

				document.getElementById("smsAcc").submit();
            });
        });

    });
</script>