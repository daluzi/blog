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
                        url : "./signin.php",
                        data : {
                            submit: 'asdfghjks',
                            username : $(".userName").val(),
                            password : $(".password").val()
                        },
                        success : function(data){
                            var data = JSON.parse(data);
                            if (data.status_code == 1) {
                                alert('登录成功，进入主页');
                                document.getElementById("urge").innerHTML = "登录成功"; 
                                window.location.href = '../blog/newindex.php';
                            }else if (data.status_code == 2) {
                                alert("用户名或密码错误");
                            }else{
                                console.log("服务器超时");
                            }
                        },
                        error : function(){
                            console.log("请求失败");
                        }
                    });
                } else {
                    alert('验证码错误');
                    $('.captcha-img').attr('src', '../php/captcha.php?' + Math.random());
                }
            }
        })
    })
})