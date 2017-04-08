$(function(){
    $(".btn").click(function(){
        if ($(".userName").val() == ""){
            alert("用户名不能为空");
        }else if ($(".password").val() == "") {
            alert("密码不能为空");
        }else{
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
                        document.getElementById("urge").innerHTML = "登录成功"; 
                        window.location.href = '../blog/index.php';
                    }else if (data.status_code == 2) {
                    	alert("用户名不纯在");
                    }else{
                        console.log("服务器超时");
                    }
                },
                error : function(){
                    console.log("请求失败");
                }
            })
        }
    })
})