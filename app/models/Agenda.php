<?php

namespace App\Models;

use App\Core\Model;

use PDO;
use PDOException;

class Agenda extends Model
{

    public static function findAll()
    {
        try {
            $db = static::getDb();
            
            $stmt = $db->query('SELECT * FROM agenda');

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;

        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo "Terjadi kegagalan koneksi ke database.";
        }
    }

    public static function findAgendaById($id)
    {
        try {
            $db = static::getDb();
            
            $stmt = $db->prepare('SELECT * FROM agenda where id = :id');
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            return $results;

        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo "Terjadi kegagalan koneksi ke database.";
        }
    }

    public static function insert($data)
    {

        try {

            $db = static::getDb();

            $sql = "INSERT INTO agenda (title, description, place, time)
                        VALUES(:title, :description, :place, :time)";

            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(":title", $data['title']);
            $stmt->bindParam(":description", $data['description']);
            $stmt->bindParam(":place", $data['place']);
            $stmt->bindParam(":time", $data['time'], PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->rowCount();

        } catch (PDOException $e) {
            echo "Terjadi kegagalan saat menyimpan data";
        }
    }

    public static function delete($id)
    {

        try {

            $db = static::getDb();

            $sql = "DELETE FROM agenda WHERE id = :id";

            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->rowCount();

        } catch (PDOException $e) {
            echo "Terjadi kegagalan saat menghapus data";
        }
    }

    public static function update($data)
    {

        try {

            $db = static::getDb();

            $sql = "UPDATE agenda
                    SET title = :title,
                        description = :description,
                        place = :place,
                        time = :time
                    WHERE id = :id";

            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(":title", $data['title']);
            $stmt->bindParam(":description", $data['description']);
            $stmt->bindParam(":place", $data['place']);
            $stmt->bindParam(":time", $data['time'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $data['id']);

            $stmt->execute();

            return $stmt->rowCount();

        } catch (PDOException $e) {
            echo "Terjadi kegagalan saat menyimpan data";
        }
    }

    public function search($keyword)
    {
        try {
            $db = static::getDb();
            
            $stmt = $db->prepare('SELECT * FROM agenda where title LIKE :title');
            $stmt->bindValue(":title", "%$keyword%");

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo "Terjadi kegagalan koneksi ke database.";
        }
    }
    
}
