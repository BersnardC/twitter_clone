<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        input[type=text], textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            margin: 0 auto;
            width: 50%;
        }
    </style>
</head>
<body>


<div class="container">
    <h3>Contact Form</h3>
    <br>

    <form method="POST" action="{{ route('contact-us') }}">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Your email address.." value="{{ old('email') }}">

        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" placeholder="Enter Subject for contacting" value="{{ old('subject') }}">

        <label for="comments">Comments</label>
        <textarea id="comments" name="comments" placeholder="Write something.." style="height:200px">{{ old('comments') }}</textarea>

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>