$(function(){
    $(".btn").click(function(){
        if ($(".userName").val() == ""){
            alert("用户名不能为空");
        }else if ($(".password").val() == "") {
            alert("密码不能为空");
        }else{
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
                        document.getElementById("urge").innerHTML = "注册成功";
                        window.location.href = '../signin/index.php';
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