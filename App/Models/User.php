<?php

namespace App\Models;

class User 
{

    private static $table ='user';

    public static function select(int $id){
        $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

        $sql = 'SELECT * FROM '.self::$table.' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }else {
            throw new \Exception("nenhum usuario encontrado!");
        };
    }

    public static function selectAll(){
        $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

        $sql = 'SELECT * FROM '.self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {   
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else {
            throw new \Exception("nenhum usuario encontrado!");
        }
    }

    public static function insert($data){
        $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

        $sql = 'INSERT INTO '.self::$table.' (name,email,password) VALUES (:me, :pa, :na)';
        
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':me', $data['name']);
        $stmt->bindValue(':pa', $data['email']);
        $stmt->bindValue(':na', $data['password']);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {
            return 'Usario inserido com sucesso';
        }else {
            throw new \Exception("Erro ao inserir");
        }
    }

    public static function delete(int $id){
        $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

        $sql = 'DELETE FROM '.self::$table.' WHERE id = :id';
        
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {
            return 'Usario Deletado com sucesso';
        }else {
            throw new \Exception("Erro ao Deletar");
        }
    }
    public static function update($id, $data){
        $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

        $sql = 'UPDATE '.self::$table.' SET name = :name, email = :email, password = :password WHERE id = :id';
        
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':name',$data['name']);
        $stmt->bindValue(':email',$data['email']);
        $stmt->bindValue(':password',$data['password']);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {
            return 'Usario Editado com sucesso';
        }else {
            throw new \Exception("Erro ao Editar");
        }
    }
}