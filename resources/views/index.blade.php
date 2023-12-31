<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <title>IcingaDash</title>
    <style>
        .icinga-warning {
            background-color: #f6ad55;
        }
        .icinga-danger {
            background-color: #e53e3e;
            color:#fff;
        }
        .icinga-ok {
            background-color: #48bb78;
        }
    </style>
    @livewireStyles
</head>
<body>
<div class="container-fluid">
    <div class="row">
        @livewire('icinga-dash')
    </div>
</div>

@livewireScripts
</body>
</html>

