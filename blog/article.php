<?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: ../signin/index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Blog</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet"> 
    <link href="blog.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./atom-one-light.css">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="highlight.js"></script>
    <script type="text/javascript" src="LanEditor.js"></script>
    <style type="text/css">
        #caonima {
            display: none;
        }
        #edit {
            margin: 0 auto;
            width: 800px;
            height: 600px;
            overflow: hidden;
        }
        #editor {
            box-sizing: border-box;
            float: left;
            padding: 5px;
            width: 50%;
            height: 100%;
            border: 1px solid #ccc;
        }
        #show {
            box-sizing: border-box;
            float: left;
            padding: 5px;
            width: 50%;
            height: 100%;
            font-size: 14px;
            color: #fff;
            border-left: 1px dashed #666;
            border-right: 1px dashed #666;
            background: #ccc;
            overflow-y: scroll;
        }
        #show::-webkit-scrollbar {
            width: 0;
        }
        #show img {
            max-width: 80%;
        }
        .add-article-con {
            padding-left: 10px;
            padding-right: 10px;
        }
        .add-content {
            position: relative;
            margin-bottom: 20px;
            padding: 10px;
            padding-bottom: 70px;
            border-radius: 10px;
            box-shadow: 1px 1px 10px #dbdcdc, -1px -1px 10px #dbdcdc, -1px 1px 10px #dbdcdc, 1px -1px 10px #dbdcdc;
            border: 1px solid #ccc;
        }
        .article_name {
            display: block;
            width: 95%;
            height: 30px;
            line-height: 30px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .article_tags {
            margin: 15px 0;
            font-size: 18px;
            color: #333;
        }
        .tag {
            margin: 0 5px;
            padding: 5px 10px;
            color: #fff;
            font-size: 16px;
            border-radius: 3px;
            background: #007fff;
            cursor: pointer;
        }
        .add-tag_con {
            margin-top: 10px;
        }
        .add-tag_input {
            width: 160px;
            height: 30px;
            font-size: 14px;
            line-height: 30px;
        }
        .add-tag_btn {
            margin-right: 5px;
            padding: 5px 10px;
            color: #fff;
            font-style: normal;
            font-size: 16px;
            border-radius: 3px;
            background: #ccc;
            cursor: pointer;
        }
        .article_brief {
            width: 95%;
            height: 40px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .article_content {
            width: 96%;
            height: 600px;
        }
        .submit {
            position: absolute;
            bottom: 15px;
            right: 40px;
            width: 70px;
            height: 30px;
            background: #007fff;
            color: #fff;
            font-size: 20px;
            text-align: center;
            line-height: 30px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item" href="./index.php">首页</a>
            <a class="blog-nav-item" href="./newindex.php">后台管理</a>
            <a class="blog-nav-item" href="./article.php">添加文章</a>
            <?php if (isset($_SESSION['username'])) {
                echo '<span class="blog-nav-item signin">';
                echo $_SESSION['username'];
                echo '</span><a class="blog-nav-item logout" href="##">注销</a>';
            
            } else {
                header("Location: ../signin/index.php");
            }
            ?>
        </nav>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-8 blog-main">
        </div>
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>关于</h4>
                <p>此网页可以为博主发布新的博客文章</p>
            </div>
        </div>
        <section class="add-article-con">
            <h3>添加文章</h3>
            <div class="add-content">
                <h4>文章标题：</h4>
                <input type="text" class="article_name" id="name" placeholder="请输入文章标题">
                <!-- <h4>文章简介：</h4>
                <textarea class="article_brief" placeholder="请输入文章简介"></textarea> -->
                <h4>输入文章信息</h4>
                <div class="article_content">
                    <section id="edit">
                        <textarea id="editor" name="editor"></textarea>
                        <div id="show"></div>
                    </section>
                </div>
                <div class="submit">提交</div>
            </div>
        </section>
      </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        var lan = LanEditor.init({
            textelem: "editor",
            showelem: "show",
            PluginsMode: false
        });
        if (lan.status == false){
            return ;
        } else {
            // 默认保存LanEditor快速指南文件
            // 获取文件创建的时间
            var createTime = LanEditor.Time.GetTimestamp();
            // 文件名
            LanEditor.File.CurOpenFile.name = "article";
            // 创建时间
            LanEditor.File.CurOpenFile.time = createTime;
            // 保存文件
            LanEditor.File.SaveFile();
            // 渲染
            LanEditor.RenderHTML();
        }
    });

    var urlObj = {};

    if (window.location.search.length > 1) {
      for (var aItKey, nKeyId = 0, aCouples = window.location.search.substr(1).split("&"); nKeyId < aCouples.length; nKeyId++) {
        aItKey = aCouples[nKeyId].split("=");
        urlObj[decodeURIComponent(aItKey[0])] = aItKey.length > 1 ? decodeURIComponent(aItKey[1]) : "";
      }
    }
    if (urlObj.id) {
        $.ajax({
            url: `../php/article.php?id=${urlObj.id}&title=${urlObj.title}`,
            success: function(res) {
                res = JSON.parse(res);
                $('#name').val(res.name);
                var contentBody = $("#editor");
                contentBody.html(res.content);

                $('.submit').on('click', function() {
                    var title = $('#name').val();
                    // var content = localStorage.getItem('ueditor_preference');
                    // if (title === res.name) {
                    //     if (!content) {
                    //         alert('你还没有做任何修改');
                    //         return;
                    //     }
                    // }
                    if (!title.trim()) {
                        alert('请输入文章名');
                        return;
                    }
                    var content = '';
                    for (var sessionName in window.localStorage) {
                        if (sessionName.match(/\d+\$article/g)) {
                            var val = window.localStorage[sessionName];
                            content = val;
                        }
                    }
                    if (!content.trim()) {
                        alert('请输入内容');
                        return;
                    }
                    $.ajax({
                        url: '../php/modify.php',
                        type: 'POST',
                        data: {
                            id: urlObj.id,
                            name: title,
                            content
                        },
                        success: function(res) {
                            res = JSON.parse(res);
                            if (res.status_code) {
                                alert('更新文章成功');
                                location.href = './newindex.php';
                            }
                        }
                    })

                })
            }
        });
    } else {
        $('.submit').on('click', function() {
            var title = $('#name').val();
            
            if (!title.trim()) {
                alert('请输入文章名');
                return;
            }
            var content = '';
            for (var sessionName in window.localStorage) {
                if (sessionName.match(/\d+\$article/g)) {
                    var val = window.localStorage[sessionName];
                    content = val;
                }
            }
            if (!content.trim()) {
                alert('请输入内容');
                return;
            }
            $.ajax({
                url: '../php/upload.php',
                type: 'POST',
                data: {
                    name: title,
                    content
                },
                success: function(res) {
                    res = JSON.parse(res);
                    if (res.status_code) {
                        alert('添加文章成功');
                        location.href = './newindex.php';
                    }
                }
            })

        })
    }
    </script>

    <script type="text/javascript" src="new.js"></script>
  </body>
</html>
