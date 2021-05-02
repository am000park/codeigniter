<div id="sms_acc_wrap">
    <h1>SMS 문자 인증</h1>
    <form name="smsAcc" id="smsAcc" action="">
        <input type="text" name="hp" id="hp" class="frm_input full_input" pattern="/d*" placeholder="핸드폰번호">
        <button type="button" id="sms_send" class="btn">문자 전송</button>
        <div id="sms_number_box">
            <input type="text" name="sms_number" class="frm_input full_input" pattern="/d*" placeholder="인증번호">
            <button type="button" id="sms_chk" class="btn">인증</button>
        </div>
    </form>
</div>
<?php //echo site_url(); ?>
<script type="text/javascript">
    window.addEventListener("load", function() {
        
        var smsBtn = document.getElementById("sms_send");

        smsBtn.addEventListener("click", function() {
            var hp = document.getElementById("hp");

            if(hp.value == '') {
                alert("핸드폰 번호를 입력해주세요.");
                hp.focus();
            }

            var data = {
                phone: '11111'
            }

            smsBtn.style.display = "none";
            
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    
                    document.getElementById("sms_number_box").style.display = "block";
                    //alert("ddd");
                }
            }

            xhr.open("POST", "index.php/sms/send", true);
            xhr.send(JSON.stringify(data));
        });

    });
</script>