<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Rekap;
use App\Core\FlashMessage;

class RekapController {

    public function index() {
        $rekaps = Rekap::findAll();

        View::render("rekap/index.html", [
            "rekaps" => $rekaps
        ]);
    }
    
    public function show($params) {

        $id = $params[0];

        $rekap = Rekap::findRekapById($id);
        
        View::render("rekap/show.html", [
            "rekap" => $rekap
        ]);
    }
    
    public function add() {

        // Jika insert berhasil
        if(Agenda::insert($_POST) > 0) {
            FlashMessage::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASE_URL . '/agenda');
        } else {
            FlashMessage::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASE_URL . '/agenda');
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