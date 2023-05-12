<?php 

namespace App\Controller\Admin;
use App\Model\ArticleModel;


class AdminDashboardController {

    function dashboard()
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


    public function manageArticles()
    {
        header('Location: ' . constructUrl('admin_manage_articles'));
        exit;
    }
}