<html>
<head>
    <style>
        html, body {
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100%;
        }
        body {
            display: flex;
            align-items: center; /*定义body的元素垂直居中*/
            justify-content: center;
        }
    </style>
</head>
<body>
<div class="div">
<form action="{{url('index')}}" method="post">
    {{csrf_field()}}
    地址：<input type="text" name="url">
    <input type="submit" value="确定">
</form>
</div>
</body>
</html>