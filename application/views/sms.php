<div id="sms_acc_wrap">
    <h1>SMS 문자 인증</h1>
    <form name="smsAcc" id="smsAcc" action="">
        <input type="text" name="hp" id="hp" class="frm_input full_input" pattern="/d*" placeholder="핸드폰번호">
        <button type="button" id="sms_send" class="btn">문자 전송</button>
        <div id="sms_number_box">
            <input type="text" name="sms_number" class="frm_input full_input" pattern="/d*" placeholder="인증번호">
        </div>
    </form>
</div>
<?php //echo site_url(); ?>
<script type="text/javascript">
    window.addEventListener("load", function() {
        
        document.getElementById("sms_send").addEventListener("click", function() {
            var hp = document.getElementById("hp").value;
            var data = {
                hp: hp
            }
            
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    alert("ddd");
                }
            }

            xhr.open("POST", "index.php/sms/send", true);
            xhr.send(JSON.stringify(data));
        });

    });
</script>