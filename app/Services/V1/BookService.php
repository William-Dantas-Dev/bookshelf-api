<?php

namespace App\Services\V1;

use App\Contracts\Book\BookServiceContract;
use App\DTO\BookDTO;
use App\Repositories\V1\BookRepository;
use Illuminate\Support\Facades\Auth;

class BookService implements BookServiceContract
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        return $this->bookRepository->index();
    }

    public function show(string $id)
    {
        return $this->bookRepository->show($id);
    }

    public function store(BookDTO $book)
    {
        $userId = Auth::id();
        $book->user_id = $userId;
        return $this->bookRepository->store($book);
    }

    public function update(BookDTO $book, string $id)
    {
        return $this->bookRepository->update($book, $id);
    }

    public function destroy(string $id)
    {
       return $this->bookRepository->destroy($id);
    }
}
