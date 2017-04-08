$(function() {
    $('#baocun').click(function() {
        var title = $('#name').val();
        var content = localStorage.getItem('ueditor_preference');
        content = JSON.parse(content)
        content = content['http_localhost_clblog_blog_newindex_phpcontainer-drafts-data'];
        $.ajax({
            url: 'http://localhost/clblog/php/upload.php',
            type: 'POST',
            data: {
                name: title,
                content,
            },
            success: function(res) {
                document.getElementById("displayey").innerHTML = "添加文章成功";
            },
            fail: err => {
                console.log(err);
            }
        });
    });
});
$(function() {
    $('.chgeesy').on('click', function() {
        var title = $(this).parent().find('.artile-title').html();
        var contt = $(this).parent().find('.artile-contt').html();
        var num = $(this).parent().find('.artile-num').html();
        $.ajax({
            url: '../php/modify.php',
            type: 'POST',
            data: {
                name: title,
                content: contt,
                id: num,
            },
            success: function(data){
                var data = JSON.parse(data);
                if (data.status_code == 2) {
                    console.log(status);
                }else{
                    console.log(status);
                }
            }
        });
    });
});