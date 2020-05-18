<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Donasi;
use App\Core\FlashMessage;

class DonasiController {

    public function index() {
        $donasis = Donasi::findAll();

        View::render("donasi/index.html", [
            "donasi" => $donasis
        ]);
    }
    
    public function show($params) {

        $id = $params[0];

        $donasi = Donasi::findDonasiById($id);
        
        View::render("donasi/show.html", [
            "donasi" => $donasi
        ]);
    }
    
    public function add() {

        // Jika insert berhasil
        if(Donasi::insert($_POST) > 0) {
            FlashMessage::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASE_URL . '/donasi');
        } else {
            FlashMessage::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASE_URL . '/donasi');
        }
    }

    public function delete($params) {

        $id = $params[0];
        // Jika insert berhasil
        if(Agenda::delete($id) > 0) {
            FlashMessage::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASE_URL . '/agenda');
        } else {
            FlashMessage::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASE_URL . '/agenda');
        }
    }

    public function getupdate() {
        $id = $_POST['id'];

        $agenda = Agenda::findAgendaById($id);

        echo json_encode($agenda);
    }

    public function update() {
        // Jika update berhasil
        if(Agenda::update($_POST) > 0) {
            FlashMessage::setFlash('berhasil', 'diupdate', 'success');
            header('Location: ' . BASE_URL . '/agenda');
        } else {
            FlashMessage::setFlash('gagal', 'diupdate', 'danger');
            header('Location: ' . BASE_URL . '/agenda');
        }
    }

    public function search() {
        $keyword = $_POST['keyword'];
        
        $agendas = Agenda::search($keyword);

        View::render("agenda/index.html", [
            "agendas" => $agendas
        ]);
    }

}