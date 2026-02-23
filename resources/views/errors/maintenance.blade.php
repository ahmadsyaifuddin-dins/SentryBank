<!DOCTYPE html>
<html>

<head>
    <title>SYSTEM SUSPENDED</title>
    <style>
        body {
            background: #000;
            color: red;
            font-family: monospace;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        h1 {
            font-size: 3rem;
            border-bottom: 2px solid red;
            display: inline-block;
            padding-bottom: 10px;
        }

        p {
            color: #fff;
        }
    </style>
</head>

<body>
    <div>
        <h1>⚠️ SYSTEM SUSPENDED</h1>
        <p>{{ $message ?? 'Licensing Protocol Violation.' }}</p>
        <p>Reference ID: {{ $signature ?? 'UNKNOWN' }} | Request: {{ $reqId ?? '000' }}</p>
    </div>
</body>

</html>
