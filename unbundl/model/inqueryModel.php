<?php
class inqueryModel{
    public function saveInquery($name, $phone, $email, $address, $carTypes){
        require_once '../helper/helperDb.php';
        $database=new dataBase();
        $conndb=$database->adminDbConn();

        $sql = "INSERT INTO inquery_details 
            (name, phone, email, address, car_types)
            VALUES (?, ?, ?, ?, ?)";

        $stmt = $conndb->prepare($sql);
    
        if (!$stmt) {
            return false;
        }
    
        $stmt->bind_param(
            "sssss",
            $name,
            $phone,
            $email,
            $address,
            $carTypes
        );
    
        return $stmt->execute();
    }

    public function saveCar($carName,$carType,$price,$fuelType,$imageName,$description) {
        require_once '../helper/helperDb.php';
        $database = new dataBase();
        $conndb = $database->adminDbConn();
    
        $sql = "INSERT INTO cars
                (car_name, car_type, price, fuel_type, image, description)
                VALUES (?, ?, ?, ?, ?, ?)";
    
        $stmt = $conndb->prepare($sql);
    
        if (!$stmt) {
            return false;
        }
    
        $stmt->bind_param(
            "ssssss",
            $carName,     // s → string
            $carType,     // s → string
            $price,       // s → string
            $fuelType,    // s → string
            $imageName,   // s → string
            $description  // s → string
        );
    
        return $stmt->execute();
    }

    public function getAllCars()
    {
        require_once '../helper/helperDb.php';
        $database = new dataBase();
        $conn = $database->adminDbConn();

        $sql = "SELECT * FROM cars ORDER BY id DESC";
        $result = $conn->query($sql);

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function deleteCar($id)
    {
        require_once '../helper/helperDb.php';
        $database = new dataBase();
        $conn = $database->adminDbConn();

        $stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function getCarById($id)
    {
        require_once '../helper/helperDb.php';
        $database = new dataBase();
        $conndb = $database->adminDbConn();
    
        $sql = "SELECT 
                    id,
                    car_name,
                    car_type,
                    price,
                    fuel_type,
                    image,
                    description
                FROM cars
                WHERE id = ?";
    
        $stmt = $conndb->prepare($sql);
    
        if (!$stmt) {
            return false;
        }
    
        $stmt->bind_param("i", $id);
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        return $result->fetch_assoc();
    }

    public function updateCar($id, $name, $type, $price, $fuel, $image, $description)
    {
        require_once '../helper/helperDb.php';
        $database = new dataBase();
        $conn = $database->adminDbConn();
    
        $sql = "UPDATE cars SET
                    car_name = ?,
                    car_type = ?,
                    price = ?,
                    fuel_type = ?,
                    image = ?,
                    description = ?
                WHERE id = ?";
    
        $stmt = $conn->prepare($sql);
        if (!$stmt) return false;
    
        $stmt->bind_param(
            "ssisssi",
            $name,
            $type,
            $price,
            $fuel,
            $image,
            $description,
            $id
        );
    
        return $stmt->execute();
    }

}
?>