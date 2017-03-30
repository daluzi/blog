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
                url : "./register.php",
                // contentType : "application/json",
                data : {
                    submit: 'asdfghjks',    
                    username : $(".userName").val(),
                    password : $(".password").val()
                },
                success : function(data){
                    // document.getElementById("urge").innerHTML = data;
                    // console.log(data);
                    var data = JSON.parse(data); 
                    if (data.status_code == 2) {
                        document.getElementById("urge").innerHTML = "注册成功";
                        window.location.href = '../signin/index.html';
                    }else if (data.status_code == 1) {
                        document.getElementById("urge").innerHTML = "用户名已存在";
                    } else{
                        document.getElementById("urge").innerHTML = data.status;
                    }
                },
                error : function(){
                    document.getElementById("urge").innerHTML = data.status;
                }
            })
        }
    })
})