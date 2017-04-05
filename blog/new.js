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
                console.log(res);
            },
            fail: err => {
                console.log(err);
            }
        });
    });
});