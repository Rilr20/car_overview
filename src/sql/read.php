<?php

function Search(?string $brand, ?string $model_year,?string $regNum, ?string $limit, PDO $conn) {
    $conditions = [];
    $params = [];
    if ($brand !== "") {
        $conditions[] = "brand = :brand";
        $params["brand"] = $brand;
    }

    $model_year = filter_var($model_year ?? null, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
    if ($model_year !== null && $model_year > 0) {
        $conditions[] = "model_year = :model_year";
        $params["model_year"] = $model_year;

    }
    if ($regNum !== "") {
        $conditions[] = "reg_number like :reg_number";
        $params["reg_number"] = "%$regNum%";

    }
    $sql = "SELECT id, reg_number, model, model_year FROM cars";

    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $limit = filter_var($limit, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
    if ($limit === null || $limit <= 0) {
        $limit = 25;
    }
    $limit = min($limit, 100);

    $sql .= " LIMIT " . $limit;

    // $sql .= " LIMIT 25";
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    // var_dump($sql);
    // var_dump($params);
    // exit;
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCarById(int $id, $conn) {
    $sql = "SELECT * FROM cars where id = ?";

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

function carCount($conn) {
    $sql = "SELECT count(reg_number) FROM cars;";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetch()[0];
}