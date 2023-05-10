<?php 

namespace App\Controller\Admin;

class AdminDashboardController {

    function index()
    {
        // Messages flash
        if (array_key_exists('flash', $_SESSION) && $_SESSION['flash']) {
            $flashMessage = $_SESSION['flash'];
            $_SESSION['flash'] = null;
        }

        // Affichage du template
        $template = 'dashboard';
        include TEMPLATE_DIR . '/admin/base_admin.phtml';
    }
}