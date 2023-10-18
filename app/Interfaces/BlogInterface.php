<?php


namespace App\Interfaces;


interface BlogInterface
{
    public function getAll();
    public function getPagination();
    public function store($data);
    public function findById($id);
    public function update($id,$data);
    public function delete($id);
}
