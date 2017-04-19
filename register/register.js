$(function(){
    $('.captcha-img').on('click', function() {
        this.src = '../php/captcha.php?' + Math.random();
    });

    $(".btn").click(function(){
        if ($(".userName").val().trim() == ""){
            alert("用户名不能为空");
            return;
        }
        if ($(".password").val().trim() == "") {
            alert("密码不能为空");
            return;
        }
        // 验证码
        $.ajax({
            url: '../php/validate_captcha.php?code=' + $('.captcha').val(),
            success: function(res) {
                if (res) {
                    // 发送用户名和密码给后台
                    $.ajax({
                        type : "POST",
                        url : "./register.php",
                        data : {
                            submit: 'asdfghjks',    
                            username : $(".userName").val(),
                            password : $(".password").val()
                        },
                        success : function(data){
                            var data = JSON.parse(data); 
                            if (data.status_code == 2) {
                                alert('注册成功，返回登录');
                                window.location.href = '../signin/index.php';
                            }else {
                                alert('用户名已存在');
                                document.getElementById("urge").innerHTML = data.status;
                            }
                        },
                        error : function(){
                            document.getElementById("urge").innerHTML = data.status;
                        }
                    })
                } else {
                    alert('验证码错误');
                    $('.captcha-img').attr('src', '../php/captcha.php?' + Math.random());
                }
            }
        });
    })
})