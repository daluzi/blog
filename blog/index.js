document.querySelector("#bianji").addEventListener( "click",function(){ 
    var editor = document.getElementById("container");
    var biaoti = document.getElementById("biaoti");
    editor.style.display = "block"; 
    biaoti.style.display = "block";
})
$(function(){
    $("#baocun").click(function(){
            // $.ajax({
            //     type : "POST",
            //     url : "../php/upload.php",
            //     // contentType : "application/json",
            //     data : {
            //         name: $(".name").val(),
            //         content: $(".container").val()
            //     },
            //     success : function(data){
            //         var data = JSON.parse(data);
            //         if (data.status_code == 2) {
            //             document.getElementById("baocun").innerHTML = "发表成功"; 
            //             window.location.href = '../blog/index.html';     
            //         }else if (data.status_code == 0) {
            //             document.getElementById("baocun").innerHTML = "发表失败"; 
            //         }else{
            //             console.log("服务器超时");
            //         }
            //     },
            //     error : function(){
            //         console.log("请求失败");
            //     }
            // })
    })
})