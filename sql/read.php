<?php

function Search(string $brand, string $model_year,string $regNum, $conn) {
    $conditions = [];
    $params = [];
    if ($brand != "") {
        $conditions[] = "brand like :brand";
        $params["brand"] = "%$brand%";
    }

    if ($model_year > 0) {
        $model_year = filter_var($model_year ?? null, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        $conditions[] = "model_year like :model_year";
        $params["model_year"] = "$model_year";

    }
    if ($regNum != "") {
        $conditions[] = "reg_number like :reg_number";
        $params["reg_number"] = "%$regNum%";

    }
    $sql = "SELECT id, reg_number, model, model_year FROM cars";

    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }


    $sql .= " LIMIT 25";
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    // var_dump($sql);
    // var_dump($params);
    // exit;
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCarById(int $id, $conn) {
    $sql = "SELECT * FROM cars where ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function formData($conn) {
    $sql = "SELECT DISTINCT brand FROM cars ORDER BY brand asc;";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}