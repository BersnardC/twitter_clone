<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        .form-style-9{
            max-width: 450px;
            background: #FAFAFA;
            padding: 30px;
            margin: 50px auto;
            box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
            border-radius: 10px;
            border: 6px solid #305A72;
        }
        .form-style-9 ul{
            padding:0;
            margin:0;
            list-style:none;
        }
        .form-style-9 ul li{
            display: block;
            margin-bottom: 10px;
            min-height: 35px;
        }
        .form-style-9 ul li  .field-style{
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            padding: 8px;
            outline: none;
            border: 1px solid #B0CFE0;
            -webkit-transition: all 0.30s ease-in-out;
            -moz-transition: all 0.30s ease-in-out;
            -ms-transition: all 0.30s ease-in-out;
            -o-transition: all 0.30s ease-in-out;

        }.form-style-9 ul li  .field-style:focus{
             box-shadow: 0 0 5px #B0CFE0;
             border:1px solid #B0CFE0;
         }
        .form-style-9 ul li .field-split{
            width: 49%;
        }
        .form-style-9 ul li .field-full{
            width: 100%;
        }
        .form-style-9 ul li input.align-left{
            float:left;
        }
        .form-style-9 ul li input.align-right{
            float:right;
        }
        .form-style-9 ul li textarea{
            width: 100%;
            height: 100px;
        }
        .form-style-9 ul li input[type="button"],
        .form-style-9 ul li input[type="submit"] {
            -moz-box-shadow: inset 0px 1px 0px 0px #3985B1;
            -webkit-box-shadow: inset 0px 1px 0px 0px #3985B1;
            box-shadow: inset 0px 1px 0px 0px #3985B1;
            background-color: #216288;
            border: 1px solid #17445E;
            display: inline-block;
            cursor: pointer;
            color: #FFFFFF;
            padding: 8px 18px;
            text-decoration: none;
            font: 12px Arial, Helvetica, sans-serif;
        }
        .form-style-9 ul li input[type="button"]:hover,
        .form-style-9 ul li input[type="submit"]:hover {
            background: linear-gradient(to bottom, #2D77A2 5%, #337DA8 100%);
            background-color: #28739E;
        }

        form .alert ul {
            margin-bottom: 2em;
        }

        form .alert ul li {
            color: red;
            margin: 5px 0;
            min-height: auto;
        }
    </style>
</head>
<body>

    <form method="post" class="form-style-9">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @csrf

        <ul>
            <li>
                    @if ($errors->has('title'))
                        <span class="error">{{ $errors->first('title') }}</span>
                    @endif
                <input type="text" name="title" class="field-style field-full align-none" placeholder="Post Title" value="{{ old("title") }}" />
            </li>
            <li>
                <textarea name="body" class="field-style" placeholder="Post Body">{{ old("body") }}</textarea>
            </li>
            <li>
                <input type="submit" value="Save Post" />
            </li>
        </ul>
    </form>

</body>
</html>