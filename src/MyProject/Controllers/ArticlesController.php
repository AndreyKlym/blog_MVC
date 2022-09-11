<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;   // неймспейс для модели User
use MyProject\View\View;

class ArticlesController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            // $this->view->renderHtml('errors/404.php', [], 404);
            throw new NotFoundException();
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);
    }


    public function edit(int $articleId): void
    {
        /** @var Article $article */
        $article = Article::getById($articleId);

        if ($article === null) {
            // $this->view->renderHtml('errors/404.php', [], 404);
            throw new NotFoundException();
            return;
        }

        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();

        // var_dump($article);
    }

    public function delete(int $id): void
    // public function delete(int $articleId): void
    {
        /** @var Article $article */
        $article = Article::getById($id);
        // $article = Article::getById($articleId);

        if ($article) {
            $article->delete();
            echo "Страница #$id удалена";
        }else{
            echo "Страница #$id не найдена";
        }
    }

    public function create(): void
    {
        $article = new Article();
        
        $article->setName('Новая статья');
        $article->setText('Новый текст');
        $article->setAuthorId(2);
        $article->setCreatedAt(date("Y-m-d H:i:s"));

        $article->save();
        var_dump($article);
    }

    public function add(): void
    {
        $author = User::getById(3);

        $article = new Article();
        $article->setAuthor($author);
        
        $article->setName('Новая название статьи');
        $article->setText('Новый текст для новой статьи');
        // $article->setCreatedAt(date("Y-m-d H:i:s"));

        $article->save();
        var_dump($article);
    }


}