<?php
require_once __DIR__ . '/BaseDao.class.php';

class CarDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct('cars');
    }
    public function getCarByName($name)
    {
        $query = "SELECT * FROM cars WHERE name = :name";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function count_cars_paginated($search)
    {
        $query = "SELECT COUNT(*) AS count 
                    FROM cars c
                    JOIN users u ON c.user_id = u.id
                    WHERE (LOWER(c.manufacturer) LIKE CONCAT('%', :search, '%') OR
                        LOWER(c.model) LIKE CONCAT('%', :search, '%'));";
        return $this->query_unique($query, [
            'search' => $search
        ]);
    }
    public function get_cars_paginated($user_id, $offset, $limit, $search, $order_column, $order_direction)
    {
        $query =
            "   SELECT c.id, c.manufacturer, c.model, c.year, c.engine, c.user_id
                FROM cars c
                JOIN users u ON c.user_id = u.id
                WHERE (LOWER(c.manufacturer) LIKE CONCAT('%', :search, '%') OR 
                LOWER(c.model) LIKE CONCAT('%', :search, '%') OR
                LOWER(c.year) LIKE CONCAT('%', :search, '%'))
           AND c.user_id = :user_id;
         ORDER BY $order_column $order_direction
         LIMIT $offset, $limit";

        return $this->query($query, [
            'search' => $search,
            "user_id" => $user_id
        ]);
    }

    public function get_cars_paginated_admin($offset, $limit, $search, $order_column, $order_direction)
    {
        $query =
            "   SELECT id, manufacturer, model, year, engine, user_id
                FROM cars 
                WHERE (LOWER(manufacturer) LIKE CONCAT('%', :search, '%') OR 
                LOWER(model) LIKE CONCAT('%', :search, '%') OR
                LOWER(year) LIKE CONCAT('%', :search, '%'))
         ORDER BY $order_column $order_direction
         LIMIT $offset, $limit;";

        return $this->query($query, [
            'search' => $search
        ]);
    }

}