<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Agenda;
use App\Core\FlashMessage;

class AgendaController {

    public function index() {
        $agendas = Agenda::findAll();

        View::render("agenda/index.html", [
            "agendas" => $agendas
        ]);
    }
    
    public function show($params) {

        $id = $params[0];

        $agenda = Agenda::findAgendaById($id);
        
        View::render("agenda/show.html", [
            "agenda" => $agenda
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