<?php require_once('generate.php'); 
if (isset($_POST['mikrotik'])){
    $file = 'domain-formatted.txt';
    echo file_get_contents($file);
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mikrotik ADBLOCK - HOSTSVN FILTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        #loading {
            display: none;
            margin-top: 20px;
        }

        #result {
            height: calc(100vh - 200px);
            resize: vertical;
        }
        
        .textarea-container {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Mikrotik ADBLOCK - HOSTSVN FILTER</h1>
        <hr>
        <code>/tool fetch url="https://duchuy2308.id.vn" http-method="post" http-data="mikrotik" dst-path="adblock-hostsvn.rsc"</code>

        <hr>
        <div class="textarea-container">
            <button id="downloadBtn" class="btn btn-primary">Download adblock-hostsvn.rsc</button>
        </div>
        <textarea id="result" class="form-control"></textarea> 
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script> 
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'domain-formatted.txt', 
                success: function(data) {
                    $('#result').val(data); 
                },
                error: function() {
                    $('#result').val('Failed to load domain-formatted.txt. Please reload this page!'); 
                }
            });

            $('#downloadBtn').click(function() {
                let adblockData = $('#result').val();
                let blob = new Blob([adblockData], {type: "text/plain;charset=utf-8"});
                saveAs(blob, "adblock-hostsvn.rsc");
            });
        });

    </script>
</body>
</html>
