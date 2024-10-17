<?php
// Kết nối đến CSDL
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "csv";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["csvFile"]) && $_FILES["csvFile"]["error"] == 0) {
        $fileName = $_FILES["csvFile"]["tmp_name"];
        
        if (($handle = fopen($fileName, "r")) !== FALSE) {
            // Đọc và bỏ qua dòng tiêu đề
            fgetcsv($handle, 1000, ",");
            
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $customerID = $data[0];
                $customerName = $data[1];
                $contactName = $data[2];
                $address = $data[3];
                $city = $data[4];
                $postalCode = $data[5];
                $country = $data[6];
                
                // Chuẩn bị câu lệnh SQL
                $sql = "INSERT INTO customers (CustomerID, CustomerName, ContactName, Address, City, PostalCode, Country) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE 
                        CustomerName = VALUES(CustomerName),
                        ContactName = VALUES(ContactName),
                        Address = VALUES(Address),
                        City = VALUES(City),
                        PostalCode = VALUES(PostalCode),
                        Country = VALUES(Country)";
                
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("issssss", $customerID, $customerName, $contactName, $address, $city, $postalCode, $country);
                
                if ($stmt->execute()) {
                    echo "Dữ liệu đã được chèn hoặc cập nhật thành công.<br>";
                } else {
                    echo "Lỗi: " . $stmt->error . "<br>";
                }
                
                $stmt->close();
            }
            fclose($handle);
            echo "Quá trình xử lý CSV hoàn tất.";
        } else {
            echo "Không thể mở file CSV.";
        }
    } else {
        echo "Có lỗi xảy ra khi upload file.";
    }
}

$conn->close();
?>