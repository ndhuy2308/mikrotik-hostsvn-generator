<?php
$localFilePath = 'domain.txt';
$fileUrl = 'https://raw.githubusercontent.com/bigdargon/hostsVN/master/option/domain.txt';
$fileCreationTime = date('Y-m-d H:i:s', filemtime($localFilePath));

$localFileContent = file_get_contents($localFilePath);
$remoteFileContent = file_get_contents($fileUrl);

if ($localFileContent !== $remoteFileContent) {
    file_put_contents($localFilePath, $remoteFileContent);
    $remoteFileContent = "#Lần thay đổi gần nhất: " . $fileCreationTime . "\n#------------------------------------------------------------------------\n" . $remoteFileContent;
    $formattedContent = formatContent($remoteFileContent);
    file_put_contents('domain-formatted.txt', $formattedContent); // Save formatted content to a new file
} else {
    $localFileContent = "#Lần thay đổi gần nhất: " . $fileCreationTime . "\n#------------------------------------------------------------------------\n" . $localFileContent;
    $formattedContent = formatContent($localFileContent);
    file_put_contents('domain-formatted.txt', $formattedContent); // Save formatted content to a new file
}

function formatContent($content) {
    $lines = explode("\n", $content);
    $lineCount = 0; // Tính tổng số dòng
    $formattedContent = "";
    
    foreach ($lines as $line) {
        $trimmedLine = trim($line);
        if (strlen($trimmedLine) <= 2) {
            // Loại bỏ dòng có kí tự ít hơn 1
            continue;
        }
        
        if (substr($trimmedLine, 0, 1) === '#') {
            // Không thêm tiền tố
            $formattedContent .= $trimmedLine . "\n";
        } else {
            // Thêm tiền tố
            $lineCount++;
            $formattedContent .= 'add address=240.0.0.1 name=' . $trimmedLine . "\n";
        }
    }
    
    $formattedContent = "/ip dns static" . "\n#------------------------------------------------------------------------\n" . "#Xin cám ơn filter từ hostsvn - bigdragon \n#Tổng số dòng: " . $lineCount. "\n" . $formattedContent;
    
    return $formattedContent;
}
?>
